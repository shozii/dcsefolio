<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/about/{id}', 'CourseController@about_user');

Route::get('/', function(){
	return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::get('/profile/{id}', 'HomeController@profile');
Route::patch('/edit/{id}', 'HomeController@edit_semester');

Route::get('/home/course/{id}','CoursePostController@show_user');


//Logged in users/instructor cannot access or send requests these pages
Route::group(['middleware' => 'instructor_guest'], function() {

Route::get('instructor_register', 'InstructorAuth\RegisterController@showRegistrationForm');
Route::post('instructor_register', 'InstructorAuth\RegisterController@register');

Route::get('instructor_login', 'InstructorAuth\LoginController@showLoginForm');
Route::post('instructor_login', 'InstructorAuth\LoginController@login');

//Password reset routes
Route::get('instructor_password/reset', 'InstructorAuth\ForgotPasswordController@showLinkRequestForm');
Route::post('instructor_password/email', 'InstructorAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('instructor_password/reset/{token}', 'InstructorAuth\ResetPasswordController@showResetForm');
Route::post('instructor_password/reset', 'InstructorAuth\ResetPasswordController@reset');


});

//Only logged in instructors can access or send requests to these pages
Route::group(['middleware' => 'instructor_auth'], function(){

	Route::post('instructor_logout', 'InstructorAuth\LoginController@logout');
	Route::get('/instructor_home', 'InstructorHomeController@show');
	//other routes
	//Route::get('/instructor_home', 'InstructorHomeController@index');
	Route::get('/instructor_home/course/{id}','CoursePostController@show');
	Route::post('/instructor_home/course/{id}','CoursePostController@store');
	Route::post('/instructor_home/posts', 'PostController@store');
	Route::delete('/instructor_home/posts/{id}','PostController@delete');

	Route::post('/instructor_home/course', 'CourseController@store');

	//course post 
	Route::delete('courses/{id}','CoursePostController@delete');
	Route::get('courses/{id}/editpage','CoursePostController@editpage');
	Route::patch('courses/{id}/edit','CoursePostController@edit');

	//about routes
	Route::get('/course/{id}/about','CourseController@about');
	Route::patch('course/{id}/about','CourseController@update');
	Route::delete('course/{id}/delete','CourseController@delete');

	Route::get('posts/{id}/editpage','PostController@editpage');
	Route::patch('posts/{id}/edit','PostController@edit');
	
});

//APIs
//logins
Route::get('/loginstudent/{email}','APIcontroller@loginStudent');
Route::get('/logininstructor/{email}','APIcontroller@loginInstructor');
//get all courses wrt student
Route::get('student/courses/{id}', 'APIcontroller@coursesStudent');
//get all courses wrt instructor
Route::get('instructor/courses/{id}', 'APIcontroller@coursesInstructor');
//get all courseposts wrt courses
Route::get('/courses/{id}/posts', 'APIcontroller@courseposts');
//get all posts
Route::get('/posts', 'APIcontroller@posts');