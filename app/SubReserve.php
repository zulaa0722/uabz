<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubReserve extends Model
{
  protected $table = 'tb_sub_reserve';
  public $primaryKey = 'id';
  public $timestamps = false;
}
