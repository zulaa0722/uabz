<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
  protected $table = 'tb_province';
  public $primaryKey = 'id';
  public $timestamps = false;
}
