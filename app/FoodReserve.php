<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodReserve extends Model
{
  protected $table = 'tb_food_reserve';
  public $primaryKey = 'id';
  public $timestamps = false;
}
