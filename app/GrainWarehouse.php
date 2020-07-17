<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrainWarehouse extends Model
{
  protected $table = 'srvy_grain_warehouses';
  public $primaryKey = 'id';
  public $timestamps = false;
}
