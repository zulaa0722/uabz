<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalSaltDeposit extends Model
{
  protected $table = 'srvy_local_salt_deposits';
  public $primaryKey = 'id';
  public $timestamps = false;
}
