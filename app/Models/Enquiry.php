<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{

    use HasFactory;
    protected $table = "enquiries";
    protected $fillable = [
        'name',
        'email',
        'number',
        'master_state_id',
        'master_tehsil_id',
        'is_active',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    public function masterState()
    {
        return $this->belongsTo(MasterState::class, 'master_state_id', 'id');
    }

    public function masterDistrict()
    {
        return $this->belongsTo(MasterDistricts::class, 'master_tehsil_id', 'id');
    }
}
