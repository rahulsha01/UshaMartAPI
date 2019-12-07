<?php

namespace App;
use App\categories;
use Illuminate\Database\Eloquent\Model;

class MainCategories extends Model
{
    protected $primaryKey = 'um_mCatId';
    public $table = 'main_categories';


    public function hasCategories()
    {
        return $this->hasMany('App\categories', 'um_mCatId');
    }
}
