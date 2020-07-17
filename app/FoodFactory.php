<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodFactory extends Model
{
  protected $table = 'srvy_food_factories';
  public $primaryKey = 'id';
  public $timestamps = false;
}
