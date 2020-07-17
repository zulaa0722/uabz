<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
  protected $table = 'srvy_vehicles';
  public $primaryKey = 'id';
  public $timestamps = false;
}
