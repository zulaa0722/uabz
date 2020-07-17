<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officials extends Model
{
  protected $table = 'srvy_officials';
  public $primaryKey = 'id';
  public $timestamps = false;
}
