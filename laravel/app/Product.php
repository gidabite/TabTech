<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
class Product extends Model
{
    use SearchableTrait;
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.name' => 10,
            'products.description' => 10,
            'products.json_characteristics' => 10,
            'categories.name' => 10
        ],
        'joins' => [
            'categories' => ['products.category','categories.name'],
        ],
    ];
    protected $fillable = [
        'name', 'description', 'category', 'price', 'json_characteristics', 'src_img_1', 'src_img_2', 'src_img_3'
    ];
}
