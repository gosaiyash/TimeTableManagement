<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class add_faculty_model extends Model
{
    protected $table = 'add_faculty_models';
    protected $primaryKey = 'id';
    protected $fillable = ['faculty_code','faculty_name','faculty_mo','email','deleted'];

}
