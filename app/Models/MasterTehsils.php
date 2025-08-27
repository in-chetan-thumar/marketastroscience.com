<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTehsils extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'tehsil',
        'tehsil_code',
        'synonyms_name',
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
        'latitude',
        'longitude',
        'is_new',
        'comments',
        'pincode_assigned',
        'map_tehsil_id',
        'map_pincode',
        'verified_on_map',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];
}
