<?php


namespace App\Repositories;


use App\Models\AssessmentQuestion;
use App\Models\City;
use App\Models\Document;
use App\Models\OptionList;
use App\Models\TrainingListDocument;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OptionListRepository
{
    public $model;

    /**
     * UserRepository constructor.
     */
    public function __construct(OptionList $model)
    {
        $this->model = $model;
    }

    // Get data by id
    public function findByID($id)
    {
        return $this->model->findorFail($id);
    }

    // Create new recoard
    public function create($params)
    {
        $option = $this->model->create($params);
        return $option;
    }

    // Update recoard
    public function update($params, $id)
    {
        $option = $this->findByID($id)->update($params);
        return $option;
    }

    public function optionExists($params)
    {
        if (isset($params['id']) and !empty($params['id'])) {
            return $this->model->where('option_value', $params['option_value'])->where('list_type', $params['list_type'])->whereNot('id', $params['id'])->exists();
        } else {
            return $this->model->where('option_value', $params['option_value'])->where('list_type', $params['list_type'])->exists();
        }
    }

    public function filter($params)
    {
        // dd($params);
        // Filter by search query
        if (!empty($params['query_str'])) {
            $this->model = $this->model->where(function ($query) use ($params) {
                $query->where('list_type', 'LIKE', '%' . $params['query_str'] . '%')
                    ->orWhere('option_value', 'LIKE', '%' . $params['query_str'] . '%');
            });
        }
        // $this->model = $this->model->when(!empty($params['query_str']), function ($query) use ($params) {
        //     $query->where('list_type', 'LIKE', '%' . $params['query_str'] . "%");
        // });
        // $this->model = $this->model->when(!empty($params['query_str']), function ($query) use ($params) {
        //     $query->where('option_value', 'LIKE', '%' . $params['query_str'] . "%");
        // });
        // $this->model = $this->model->when(!empty($params['query_str']), function ($query) use ($params) {
        //     $query->where('option_title', 'LIKE', '%' . $params['query_str'] . "%");
        // });
        $this->model = $this->model->when(!empty($params['list_type']), function ($query) use ($params) {
            $query->where('list_type', $params['list_type']);
        });

        // dd($this->model->toSql(),$this->model->getBindings());
        $this->model = $this->model->when(isset($params['start_date'], $params['end_date']) and !empty($params['start_date'] and !empty($params['end_date'])), function ($q) use ($params) {
            return $q->whereBetween('created_at', [$params['start_date'], $params['end_date']]);
        });
        $this->model = $this->model->when(!empty($params['is_active']), function ($query) use ($params) {
            return $query->where('is_active', $params['is_active']);
        });


        return $this->model;

    }

}
