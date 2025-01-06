<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDistricts extends Model
{
    use HasFactory;

    protected $fillable = [
        'master_state_id',
        'master_state_fdc_id',
        'ao_id',
        'district',
        'district_code',
        'synonyms_name',
        'is_new',
        'comments',
        'hindi',
        'gujarati',
        'marathi',
        'panjabi',
        'tamil',
        'telugu',
        'kannada',
        'bengali',
        'oriya',
        'assamese',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];
}
