<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Course extends Model
{
   protected $fillable = ['code','name','semester', 'instructor_id'];

   public function instructor()
   {

   	return $this->belongsTo(Instructor::class);
   }

   public function coursepost(){
        return $this->hasMany(CoursePost::class);
    }

   public function path(){
   	return '/instructor_home/course/'.$this->id;
   }

   public function path_user(){
    return '/home/course/'.$this->id;
   }

     public function addCpost(CoursePost $cpost,$courseId){
        $cpost->course_id=$courseId;
        return $this->coursepost()->save($cpost);
    }
}

