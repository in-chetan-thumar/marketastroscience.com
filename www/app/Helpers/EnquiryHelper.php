<?php

namespace App\Helpers;

use App\Models\Blog;
use App\Models\Enquiry;
use App\Models\OptionList;
use Carbon\Carbon;
use Illuminate\Support\MessageBag;

class EnquiryHelper
{

   public function getTableData($request)
   {
      try {
         $data = $params = [];
         $params['query_str'] = $request->query_str ?? '';
         $params['is_active'] = $request->is_active ?? '';

         // Determine if pagination parameters are present
         $paginate = isset($request->start) && isset($request->length);
         if ($paginate) {
            $page = $request->start / $request->length + 1;
            $length = $request->length;
            $start = ($page - 1) * $length;
         }

         // Retrieve the blog with filtering
         $enquiryQuery = resolve('enquiry-repo')->filter($params);

         // Get the total count of records before filtering
         $totalRecords = Enquiry::count();

         // Get the filtered count of records
         $filteredRecords = $enquiryQuery->count();

         // Apply ordering
         if (isset($request->order) && isset($request->columns)) {
            $order = $request->order[0];
            $columnIndex = $order['column'];
            $columnName = $request->columns[$columnIndex]['data'];
            $direction = $order['dir'];

            if (in_array($columnName, ['name', 'number', 'email', 'master_state_id', 'master_tehsil_id', 'created_at'])) {
               $enquiryQuery = $enquiryQuery->orderBy($columnName, $direction);
            }
         }

         // Apply pagination if parameters are present
         if ($paginate) {
            $enquiryQuery = $enquiryQuery->skip($start)->take($length);
         }

         // Get the filtered and paginated results
         $enquiries = $enquiryQuery->get();

         foreach ($enquiries as $enquiry) {
            $statusColumn = '<div class="form-check form-switch">';
            if ($enquiry->is_active == 'Y') {
               $statusColumn .= '<input class="form-check-input ms-2" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked title="Change Status" data-url="' . route('enquiry.status', $enquiry->id) . '" onclick="popupMassage(event)">';
            } else {
               $statusColumn .= '<input class="form-check-input ms-2" type="checkbox" role="switch" id="flexSwitchCheckDefault" title="Change Status" data-url="' . route('enquiry.status', $enquiry->id) . '" onclick="popupMassage(event)">';
            }
            $statusColumn .= '</div>';

            $data[] = [
               'name' => $enquiry->name,
               'number' => $enquiry->number,
               'email' => $enquiry->email,
               'state' => $enquiry->masterState->state,
               'city' => $enquiry->masterDistrict->district,
               'date' => \Carbon\Carbon::parse($enquiry->created_at)->format('d-m-Y H:i'),
               'status' => $statusColumn,
               //                'action' => '<div class="btn-group" role="group">
//     <i class="mdi mdi-dots-vertical" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
//     <div class="dropdown-menu">
//     ' . (auth()->user()->can('blogs.edit') ?
//                   '<a class="dropdown-item" onclick="showEditModel(event)" href="' . route('blogs.edit', $enquiry->id) . '">Edit</a>' :
//                   '') . '
//     ' . (auth()->user()->can('blog.delete') ?
//                   '<a class="dropdown-item" data-url="' . route('blog.delete', $enquiry->id) . '" onclick="deletePopupMassage(event)">Delete</a>' :
//                   '') . '
//     </div>
// </div>',
               'id' => $enquiry->id,
            ];
         }

         return [
            'draw' => $request->draw ?? 0,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
         ];
      } catch (\Exception $e) {
         return response()->json([
            'error' => true,
            'message' => resolve('common-helper')->generateErrorMessage($e),
         ]);
      }
   }

   public function changeStatus($id)
   {
      $enquiry = resolve('enquiry-repo')->findByID($id);
      if ($enquiry->is_active == 'Y') {
         $enquiry->is_active = 'N';
      } else {
         $enquiry->is_active = 'Y';
      }
      return $enquiry->save();
   }
}
