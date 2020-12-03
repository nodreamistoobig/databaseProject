<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected $fillable = ['name'];
	
	public function department(){
		return $this->belongsTo(Department::class);
	}
	
	public function groups(){
		return $this->hasMany(Group::class);
	}
}
