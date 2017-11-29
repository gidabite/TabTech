<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'category', 'price', 'json_characteristics', 'src_img_1', 'src_img_2', 'src_img_3'
    ];
}
