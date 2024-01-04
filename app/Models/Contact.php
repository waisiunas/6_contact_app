<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'category_id',
        'mobile_number',
        'email',
        'facebook',
        'instagram',
        'youtube',
        'dob',
        'picture',
        'address',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
