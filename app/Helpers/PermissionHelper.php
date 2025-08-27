<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\MessageBag;

class PermissionHelper
{

    public function getTableData($request)
    {
        try {
            $data = $params = [];
            $params['query_str'] = $request->query_str ?? '';

            // Determine if pagination parameters are present
            $paginate = isset($request->start) && isset($request->length);
            if ($paginate) {
                $page = $request->start / $request->length + 1;
                $length = $request->length;
                $start = ($page - 1) * $length;
            }

            // Retrieve the permissions with filtering
            $permissionsQuery = resolve('permission-repo')->filter($params);

            // Get the total count of records
            $totalRecords = $permissionsQuery->count();

            // Apply ordering
            if (isset($request->order) && isset($request->columns)) {
                $order = $request->order[0];
                $columnIndex = $order['column'];
                $columnName = $request->columns[$columnIndex]['data'];
                $direction = $order['dir'];

                if (in_array($columnName, ['title', 'name', 'permission_label', 'status'])) {
                    $permissionsQuery = $permissionsQuery->orderBy($columnName, $direction);
                }
            }

            // Apply pagination if parameters are present
            if ($paginate) {
                $permissionsQuery = $permissionsQuery->skip($start)->take($length)->latest();
            } else {
                $permissionsQuery = $permissionsQuery->latest();
            }

            $permissions = $permissionsQuery->get();
            $count = $permissions->count();

            foreach ($permissions as $permission) {
                $statusColumn = '<div class="form-check form-switch">';
                if ($permission->is_active == 'Y') {
                    $statusColumn .= '<input class="form-check-input ms-2" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked title="Change Status" data-url="' . route('permission.status', $permission->id) . '" onclick="popupMassage(event)">';
                } else {
                    $statusColumn .= '<input class="form-check-input ms-2" type="checkbox" role="switch" id="flexSwitchCheckDefault" title="Change Status" data-url="' . route('permission.status', $permission->id) . '" onclick="popupMassage(event)">';
                }
                $statusColumn .= '</div>';

                $data[] = [
                    'title' => $permission->title,
                    'name' => $permission->name,
                    'permission_label' => $permission->permission_label,
                    'status' => $statusColumn,
                    'action' => '<div class="btn-group" role="group">
    <i class="mdi mdi-dots-vertical" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
    <div class="dropdown-menu">
    ' . (auth()->user()->can('permission.edit') ?
                        '<a class="dropdown-item" onclick="showEditModel(event)" href="' . route('permission.edit', $permission->id) . '">Edit</a>' :
                        '') . '
    ' . (auth()->user()->can('permission.delete') ?
                        '<a class="dropdown-item" data-url="' . route('permission.delete', $permission->id) . '" onclick="deletePopupMassage(event)">Delete</a>' :
                        '') . '
    </div>
</div>',
                    'id' => $permission->id,
                ];
            }

            return [
                'draw' => $request->draw ?? 0,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
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
        $permission = resolve('permission-repo')->findByID($id);
        if ($permission->is_active == 'Y') {
            $permission->is_active = 'N';
        } else {
            $permission->is_active = 'Y';
        }
        return $permission->save();
    }

    public function getRedirectablePermission()
    {
        $params = [];
        $params['is_redirectable'] = 'Y';
        $permissions = resolve('permission-repo')->filter($params)->pluck('permission_label', 'name');

        return $permissions;
    }

}
