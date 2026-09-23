<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin_model extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $fillable = ['name','email','password','image','deleted'];

}
