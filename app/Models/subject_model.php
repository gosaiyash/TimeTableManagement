<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subject_model extends Model
{
    protected $table = 'subject_models';
    protected $primaryKey = 'id';
    protected $fillable = ['subject_code','subject_name','total_lectures','deleted'];

}
