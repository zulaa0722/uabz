<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
  protected $table = 'tb_population';
  public $primaryKey = 'id';
  public $timestamps = false;
}
