<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable= ['name', 'company'];

    protected $guarded = ['price', 'quantity'];

}
