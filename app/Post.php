<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
 	protected $fillable = ['title','desc','image', 'p_file','instructor_id'];

 	public function instructor()
	{
   		return $this->belongsTo(Instructor::class);
	}
  
}
