<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'company_name',
        'street_address',
    ];

    public static $rules = array(
        'company_name' => 'string',
        'street_address' => 'string',
    );

    public function product()
    {
        return $this->hasMany('App\Product');
    }

    public function getData(){
        return $this->company_name;
    }

}


