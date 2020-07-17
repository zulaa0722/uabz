<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Axax extends Model
{
  protected $table = 'tb_axax';
  public $primaryKey = 'id';
  public $timestamps = false;

  // protected $fillable = [
  //     'axaxName', 'levelID', 'inTime', 'mainOrgID', 'supportOrgID',
  // ];
}
