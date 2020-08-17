<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Danger extends Model
{
    protected $table = 'tb_danger';
    public $primaryKey = 'id';
    public $timestamps = false;
}
