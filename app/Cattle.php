<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cattle extends Model
{
  protected $table = 'tb_cattle';
  public $primaryKey = 'id';
  public $timestamps = false;
}
