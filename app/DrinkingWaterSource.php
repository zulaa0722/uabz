<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrinkingWaterSource extends Model
{
    protected $table = 'srvy_drinking_water_sources';
    public $primaryKey = 'id';
    public $timestamps = false;
}
