<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;

class CoursePost extends Model
{
	protected $fillable = ['title','desc','course_id','image','file'];

    public function course()
	{
   		return $this->belongsTo(Course::class);
	}
}
