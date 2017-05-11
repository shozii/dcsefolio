<?php

namespace App;
//use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
//Trait for sending notifications in laravel
use Illuminate\Notifications\Notifiable;
//trait for resetting password
use Illuminate\Auth\Passwords\CanResetPassword;

use Illuminate\Foundation\Auth\User as Authenticatable1;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
//Notification for Instructor
use App\Notifications\InstructorResetPasswordNotification;

class Instructor extends \Eloquent implements Authenticatable, CanResetPasswordContract
{
use AuthenticableTrait, CanResetPassword;
 // This trait has notify() method defined
  use Notifiable;

    //Mass assignable attributes
  protected $fillable = [
      'name', 'email', 'password', 'token',
  ];

  //hidden attributes
   protected $hidden = [
       'password', 'remember_token',
   ];
	//Send password reset notification
  public function sendPasswordResetNotification($token)
  {
      $this->notify(new InstructorResetPasswordNotification($token));
  }

   public function posts(){
        return $this->hasMany(Post::class);
    }
    
    public function addPost(Post $post,$instructorId){
        $post->instructor_id=$instructorId;
        return $this->posts()->save($post);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function addCourse(Course $course, $instructorId){
        $course->instructor_id=$instructorId;
        return $this->courses()->save($course);
    }

    public function token()
  {
      return $this->belongsTo(Token::class);
  }

}
