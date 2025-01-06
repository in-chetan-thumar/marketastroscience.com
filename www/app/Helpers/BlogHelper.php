<?php

namespace App\Helpers;

use App\Models\Blog;
use App\Models\OptionList;
use Carbon\Carbon;
use Illuminate\Support\MessageBag;

class BlogHelper
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
         $blogsQuery = resolve('blog-repo')->filter($params);

         // Get the total count of records before filtering
         $totalRecords = Blog::count();

         // Get the filtered count of records
         $filteredRecords = $blogsQuery->count();

         // Apply ordering
         if (isset($request->order) && isset($request->columns)) {
            $order = $request->order[0];
            $columnIndex = $order['column'];
            $columnName = $request->columns[$columnIndex]['data'];
            $direction = $order['dir'];

            if (in_array($columnName, ['title', 'description', 'blog_date'])) {
               $blogsQuery = $blogsQuery->orderBy($columnName, $direction);
            }
         }

         // Apply pagination if parameters are present
         if ($paginate) {
            $blogsQuery = $blogsQuery->skip($start)->take($length);
         }

         // Get the filtered and paginated results
         $blogs = $blogsQuery->get();

         foreach ($blogs as $blog) {
            $statusColumn = '<div class="form-check form-switch">';
            if ($blog->is_active == 'Y') {
               $statusColumn .= '<input class="form-check-input ms-2" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked title="Change Status" data-url="' . route('blog.status', $blog->id) . '" onclick="popupMassage(event)">';
            } else {
               $statusColumn .= '<input class="form-check-input ms-2" type="checkbox" role="switch" id="flexSwitchCheckDefault" title="Change Status" data-url="' . route('blog.status', $blog->id) . '" onclick="popupMassage(event)">';
            }
            $statusColumn .= '</div>';

            $data[] = [
               'title' => $blog->title,
               'image' => '<img src="' . asset(config('constants.BLOG_FILE_URL') . $blog->file) . '" alt="Blog Image" style="width: 110px;">',
               'description' => $blog->description,
               'date' => \Carbon\Carbon::parse($blog->blog_date)->format('d F Y'),
               'status' => $statusColumn,
               'action' => '<div class="btn-group" role="group">
    <i class="mdi mdi-dots-vertical" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
    <div class="dropdown-menu">
    ' . (auth()->user()->can('blogs.edit') ?
                  '<a class="dropdown-item" onclick="showEditModel(event)" href="' . route('blogs.edit', $blog->id) . '">Edit</a>' :
                  '') . '
    ' . (auth()->user()->can('blog.delete') ?
                  '<a class="dropdown-item" data-url="' . route('blog.delete', $blog->id) . '" onclick="deletePopupMassage(event)">Delete</a>' :
                  '') . '
    </div>
</div>',
               'id' => $blog->id,
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
      $blog = resolve('blog-repo')->findByID($id);
      if ($blog->is_active == 'Y') {
         $blog->is_active = 'N';
      } else {
         $blog->is_active = 'Y';
      }
      return $blog->save();
   }
}
