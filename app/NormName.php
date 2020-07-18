<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NormName extends Model
{
  protected $table = 'tb_normname';
  public $primaryKey = 'id';
  public $timestamps = false;
}
