<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogFoodReserve extends Model
{
  protected $table = 'log_food_reserve';
  public $primaryKey = 'id';
  public $timestamps = false;
}
