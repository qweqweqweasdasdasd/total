<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $primaryKey = 'stream_id';
	protected $table = 'streams';
    protected $fillable = [
    	'p_name'
    ];
}
