<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogCattle extends Model
{
  protected $table = 'tb_norms';
  public $primaryKey = 'id';
  public $timestamps = false;
}
