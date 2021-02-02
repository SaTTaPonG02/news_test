<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    protected $table='tb_new';
    protected $primaryKey='id';
    protected $fillable =['id','date','imagse','titles','details'];
}
