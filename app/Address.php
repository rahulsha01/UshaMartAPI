<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $primaryKey = "ad_id";
    public $incrementing = false;
    public $table = "addresses";

}
