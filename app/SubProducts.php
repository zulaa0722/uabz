<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubProducts extends Model
{
  protected $table = 'tb_sub_products';
  public $primaryKey = 'id';
  public $timestamps = false;
}
