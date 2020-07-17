<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
  protected $table = 'tb_sectors';
  public $primaryKey = 'id';
  public $timestamps = false;
}
