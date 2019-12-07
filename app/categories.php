<?php

namespace App;
use App\MainCategories;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $primaryKey = 'um_catId';
    public $table = 'categories';


    function belongToMainCategories()
    {
        return $this->belongsTo('App\MainCategories' , 'um_mCatId' , 'um_catId');
    }
}
