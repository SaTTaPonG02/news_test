<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class news_category extends Model
{
    
    protected $table='tb_new_category';
    protected $primaryKey='id';
    protected $fillable =['id','titles','details'];
}
