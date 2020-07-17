<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodTradeCenter extends Model
{
  protected $table = 'srvy_food_trade_centers';
  public $primaryKey = 'id';
  public $timestamps = false;
}
