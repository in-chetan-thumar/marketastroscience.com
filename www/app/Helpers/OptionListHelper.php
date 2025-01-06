<?php

namespace App\Helpers;

use App\Models\OptionList;
use Carbon\Carbon;
use Illuminate\Support\MessageBag;

class OptionListHelper
{

    public function getTableData($request)
    {
        try {
            $data = $params = [];
            $params['query_str'] = $request->query_str ?? '';
            $params['is_active'] = $request->is_active ?? '';
            $params['list_type'] = $request->list_type ?? '';

            // Determine if pagination parameters are present
            $paginate = isset($request->start) && isset($request->length);
            if ($paginate) {
                $page = $request->start / $request->length + 1;
                $length = $request->length;
                $start = ($page - 1) * $length;
            }

            // Retrieve the options with filtering
            $optionsQuery = resolve('option-repo')->filter($params);

            // Get the total count of records before filtering
            $totalRecords = OptionList::count();

            // Get the filtered count of records
            $filteredRecords = $optionsQuery->count();

            // Apply ordering
            if (isset($request->order) && isset($request->columns)) {
                $order = $request->order[0];
                $columnIndex = $order['column'];
                $columnName = $request->columns[$columnIndex]['data'];
                $direction = $order['dir'];

                if (in_array($columnName, ['list_type', 'option_value', 'option_title', 'sort_id'])) {
                    $optionsQuery = $optionsQuery->orderBy($columnName, $direction);
                }
            }

            // Apply pagination if parameters are present
            if ($paginate) {
                $optionsQuery = $optionsQuery->skip($start)->take($length);
            }

            // Get the filtered and paginated results
            $options = $optionsQuery->get();

            foreach ($options as $option) {
                $statusColumn = '<div class="form-check form-switch">';
                if ($option->is_active == 'Y') {
                    $statusColumn .= '<input class="form-check-input ms-2" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked title="Change Status" data-url="' . route('option.list.status', $option->id) . '" onclick="popupMassage(event)">';
                } else {
                    $statusColumn .= '<input class="form-check-input ms-2" type="checkbox" role="switch" id="flexSwitchCheckDefault" title="Change Status" data-url="' . route('option.list.status', $option->id) . '" onclick="popupMassage(event)">';
                }
                $statusColumn .= '</div>';

                $data[] = [
                    'list_type' => $option->list_type,
                    'option_value' => $option->option_value,
                    'option_title' => $option->option_title,
                    'sort_id' => $option->sort_id,
                    'status' => $statusColumn,
                    'action' => '<div class="btn-group" role="group">
    <i class="mdi mdi-dots-vertical" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
    <div class="dropdown-menu">
    ' . (auth()->user()->can('option-list.edit') ?
                        '<a class="dropdown-item" onclick="showEditModel(event)" href="' . route('option-list.edit', $option->id) . '">Edit</a>' :
                        '') . '
    ' . (auth()->user()->can('option.list.delete') ?
                        '<a class="dropdown-item" data-url="' . route('option.list.delete', $option->id) . '" onclick="deletePopupMassage(event)">Delete</a>' :
                        '') . '
    </div>
</div>',
                    'id' => $option->id,
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
        $option = resolve('option-repo')->findByID($id);
        if ($option->is_active == 'Y') {
            $option->is_active = 'N';
        } else {
            $option->is_active = 'Y';
        }
        return $option->save();
    }

    public function masterOptionDropdown($list_type)
    {
        $params['list_type'] = $list_type;
        $params['is_active'] = 'Y';
        $data = resolve('b-option-repo')->filter($params);
        $dropdownData = $data
            ->orderBy('sort_id')
            ->where('list_type', $params['list_type'])->pluck('option_title', 'option_value');
        return $dropdownData;
    }



}
