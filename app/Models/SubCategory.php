<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'category_id',
        'name',
        'slug',
        'icon',
        'subcategory_code',
        'serial_no',
        'short_details',
        'status'
    ];

}
