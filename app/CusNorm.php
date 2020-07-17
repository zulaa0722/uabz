<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CusNorm extends Model
{
  protected $table = 'tb_cus_norms';
  public $primaryKey = 'id';
  public $timestamps = false;
}
