<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class upload_time_table extends Model
{
    protected $table = 'Upload_time_table';
    protected $primaryKey = 'id';
    protected $fillable = ['date','path','description','sem'];
}
