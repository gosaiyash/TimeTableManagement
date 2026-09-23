<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class services_model extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $fillable = ['s_name','description','image','deleted'];

}
