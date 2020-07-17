<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
  protected $table = 'tb_organizations';
  public $primaryKey = 'id';
  public $timestamps = false;
}
