<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class temptimetablemodel extends Model
{
    protected $table = 'temptimetable';
    protected $primaryKey = 'id';
    protected $fillable = ['fs_id','no','time','end_time','division','deleted'];
}
