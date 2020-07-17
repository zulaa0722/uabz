<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodWarehouse extends Model
{
  protected $table = 'srvy_food_warehouses';
  public $primaryKey = 'id';
  public $timestamps = false;
}
