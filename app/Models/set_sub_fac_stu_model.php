<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class set_sub_fac_stu_model extends Model
{
    protected $table = 'set_sub_fac_stu';
    protected $primaryKey = 'id';
    protected $fillable = ['faculty_id','subject_id','min_lec','max_lec','daily_lec','total_lec','remain_A','remain_B','remain_C','remain_D','class_type','roomno','deleted'];

}
