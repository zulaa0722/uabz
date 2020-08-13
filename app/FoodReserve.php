<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FoodReserve extends Model
{
    protected $table = 'tb_food_reserve';
    public $primaryKey = 'id';
    public $timestamps = false;



    public function getReserveKcalBySum($sumID){
        $sumKcal = DB::table('tb_food_reserve')
            ->where('symID', '=', $sumID)
            ->sum('totalKcal');
        return $sumKcal;
    }


    
}
