<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodProducts extends Model
{
  protected $table = 'tb_food_products';
  public $primaryKey = 'id';
  public $timestamps = false;
}
