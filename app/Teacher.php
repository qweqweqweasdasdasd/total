<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $primaryKey = 'teacher_id';
	protected $table = 'teachers';
    protected $fillable = [
    	'teacher_name','teacher_phone','teacher_city','teacher_address','teacher_company','teacher_email','teacher_pic','teacher_desc'
    ];
}
