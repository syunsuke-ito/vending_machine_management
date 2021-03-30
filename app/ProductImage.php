<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'products_image';

    protected $fillable = [
        'product_id',
        "file_name",
        "file_path"
    ];

    public static $rules = array(
        'product_id' => 'integer',
        "file_name"=> 'string',
        "file_path" => 'string'
    );


    public function product()
    {
        return $this->belongsTo('App\Product');
    }

  
    public function getData(){
        return $this->file_path;
    }
}
