<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sym extends Model
{
  protected $table = 'tb_sym';
  public $primaryKey = 'id';
  public $timestamps = false;
}
