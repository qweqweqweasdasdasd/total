<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $primaryKey = 'pro_id';
	protected $table = 'professions';
    protected $fillable = [
    	'pro_name','teacher_ids','pro_desc','cover_img','carousel_imgs'
    ];

    //专业和课程关系(一对多)
    public function course()
    {
        return $this->hasMany('App\Course','pro_id','pro_id')->orderBy('pro_id','desc');
    }
}
