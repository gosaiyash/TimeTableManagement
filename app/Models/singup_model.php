<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class singup_model extends Model
{
    protected $table = 'student_singup_models';
    protected $primaryKey = 'id';
    protected $fillable = ['enrollment_no','first_name','last_name','birthdate','email','password','sem','img','deleted'];

}
