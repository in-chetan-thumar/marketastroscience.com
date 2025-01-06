<?php


namespace App\Repositories;

use App\Models\Blog;

class BlogRepository
{
   public $model;

   /**
    * BlogRepository constructor.
    */
   public function __construct(Blog $model)
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
      $blog = $this->model->create($params);
      return $blog;
   }

   // Update recoard
   public function update($params, $id)
   {
      $blog = $this->findByID($id)->update($params);
      return $blog;
   }

   //Check blog slug already exist
   public function slugExists($params)
   {
      if (isset($params['id']) and !empty($params['id'])) {
         return $this->model->where('slug', $params['slug'])->where('id', '!=', $params['id'])->exists();
      } else {
         return $this->model->where('slug', $params['slug'])->exists();
      }
   }

   public function filter($params)
   {
      // Filter by search query
      if (!empty($params['query_str'])) {
         $this->model = $this->model->where(function ($query) use ($params) {
            $query->where('title', 'LIKE', '%' . $params['query_str'] . '%')
               ->orWhere('description', 'LIKE', '%' . $params['query_str'] . '%');
         });
      }
      $this->model = $this->model->when(!empty($params['is_active']), function ($query) use ($params) {
         return $query->where('is_active', $params['is_active']);
      });

      $this->model = $this->model->when(!empty($params['slug']), function ($query) use ($params) {
         return $query->where('slug', $params['slug']);
      });

      return $this->model;

   }

}
