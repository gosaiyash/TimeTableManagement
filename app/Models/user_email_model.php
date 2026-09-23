<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_email_model extends Model
{
    protected $table = 'user_email';
    protected $primaryKey = 'id';
    protected $fillable = ['u_id','email','deleted'];

}
