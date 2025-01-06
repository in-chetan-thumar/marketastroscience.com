<?php


namespace App\Repositories;

use App\Models\Role;
use http\Env\Request;
use Spatie\Permission\Models\Permission;


class PermissionRepository
{
    private $model;

    /**
     * RoleRepository constructor.
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function findByID($id)
    {
        return $this->model->findById($id);
    }

    // Create new recoard
    public function create($params)
    {
        return $this->model->create($params);
    }

    // Update recoard
    public function update($params, $id)
    {
        return $this->findByID($id)->update($params);
    }

    public function filter($params)
    {
        if (!empty($params['query_str'])) {
            $this->model = $this->model->where(function ($query) use ($params) {
                $query->where('title', 'LIKE', '%' . $params['query_str'] . '%')
                    ->orWhere('name', 'LIKE', '%' . $params['query_str'] . '%')
                    ->orWhere('permission_label', 'LIKE', '%' . $params['query_str'] . '%');
            });
        }
        $this->model = $this->model->when(!empty($params['is_redirectable']), function ($query) use ($params) {
            $query->where('is_redirectable', $params['is_redirectable']);
        });
        return $this->model;
    }



}
