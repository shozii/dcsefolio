<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
	protected $fillable = ['id','token','name'];

    public function instructor()
	{
   		return $this->belongsTo(Instructor::class);
	}
}
