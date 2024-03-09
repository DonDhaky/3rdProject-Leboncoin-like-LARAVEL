<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'ads';
    protected $primarykey = 'id';
    protected $fillable = [
        'title',
        'category',
        'description',
        'path', //for the picture
        'price',
        'location',
    ];
}
