<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterState extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_title',
        'zone_id',
        'state',
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
        'code',
        'synonyms_name',
        'slug',
        'sort_no',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];
}
