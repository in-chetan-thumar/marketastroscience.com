<?php


namespace App\Repositories;

use App\Models\Enquiry;

class EnquiryRepository
{
   public $model;

   /**
    * EnquiryRepository constructor.
    */
   public function __construct(Enquiry $model)
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
      $enquiry = $this->model->create($params);
      return $enquiry;
   }

   // Update recoard
   public function update($params, $id)
   {
      $enquiry = $this->findByID($id)->update($params);
      return $enquiry;
   }

   public function filter($params)
   {
      // Filter by search query
      if (!empty($params['query_str'])) {
         $this->model = $this->model->where(function ($query) use ($params) {
            $query->where('name', 'LIKE', '%' . $params['query_str'] . '%')
               ->orWhere('email', 'LIKE', '%' . $params['query_str'] . '%')
               ->orWhere('number', 'LIKE', '%' . $params['query_str'] . '%');
         });
      }
      $this->model = $this->model->when(!empty($params['is_active']), function ($query) use ($params) {
         return $query->where('is_active', $params['is_active']);
      });

      return $this->model;

   }

}
