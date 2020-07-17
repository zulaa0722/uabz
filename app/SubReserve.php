<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubReserve extends Model
{
  protected $table = 'tb_sub_reserves';
  public $primaryKey = 'id';
  public $timestamps = false;
}
