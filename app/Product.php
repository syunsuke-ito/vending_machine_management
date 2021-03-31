<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = array('id');
    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment'
    ];

    public static $rules = array(
        'company_id' => 'integer',
        'product_name' => 'required',
        'price' => 'required|integer',
        'stock' => 'required|integer',
    );

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function companyGetData(){
        return $this->company_id->company_name;
    }

    public function productimage()
    {
        return $this->hasMany('App\ProductImage');
    }
}
