<?php


namespace App\Repositories;


use App\Models\City;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public $model;

    /**
     * UserRepository constructor.
     */
    public function __construct(User $model)
    {
        return $this->model = $model;
    }

    // Get data by id
    public function findByID($id)
    {
        return $this->model->findorFail($id);
    }

    // Get data by username
    public function findByUsername($username)
    {
        if (config('constants.MOBILE_OTP_LOGIN') || config('constants.EMAIL_OTP_LOGIN') || config('constants.USER_PASSWORD_LOGIN')) {

            if (config('constants.MOBILE_OTP_LOGIN')) {
                return $this->model->where('mobile', $username)->first();
            } else {
                return $this->model->where('email', $username)->first();
            }
        }
    }

    // Create new recoard
    public function create($params)
    {
        $user = $this->model->create($params);

        $user->assignRole($params['role']);

        return $user;
    }

    // Update recoard
    public function update($params, $id)
    {
        $user = $this->findByID($id)->update($params);

        // Update role
        if ($user and isset($params['role']) and !empty($params['role']) and is_numeric($params['role'])) {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $this->findByID($id)->syncRoles($params['role']);
        }
        return $user;
    }

    // Change Password


    public function updateProfile($params, $id)
    {
        return $this->findByID($id)->update($params);
    }

    public function filter($params)
    {
        // dd($params);
        // Filter by active status
        if (!empty($params['is_active'])) {
            $this->model = $this->model->where('is_active', $params['is_active']);
        }

        // Filter by role
        if (!empty($params['role'])) {
            $this->model = $this->model->whereHas('roles', function ($query) use ($params) {
                $query->where('id', $params['role']);
            });
        }

        // Exclude SUPER_ADMIN role
        $this->model = $this->model->whereHas('roles', function ($query) {
            $query->where('name', '<>', config('constants.SUPER_ADMIN'));
        });

        // Filter by search query
        if (!empty($params['query_str'])) {
            $this->model = $this->model->where(function ($query) use ($params) {
                $query->where('name', 'LIKE', '%' . $params['query_str'] . '%')
                    ->orWhere('email', 'LIKE', '%' . $params['query_str'] . '%');
            });
        }

        // Filter by creation date range
        if (isset($params['start_date'], $params['end_date']) && !empty($params['start_date']) && !empty($params['end_date'])) {
            $this->model = $this->model->whereBetween('created_at', [$params['start_date'], $params['end_date']]);
        }

        return $this->model;
    }

}
