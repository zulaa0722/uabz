<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogCattle extends Model
{
  protected $table = 'log_cattle';
  public $primaryKey = 'id';
  public $timestamps = false;
}
