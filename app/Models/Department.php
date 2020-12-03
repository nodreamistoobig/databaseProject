<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected $fillable = ['name'];
	
	public function positions(){
		return $this->hasMany(Position::class);
	}
	
	public function rooms(){
		return $this->hasMany(Room::class);
	}
	
	public function employees(){
		return $this->hasMany(Employee::class);
	}
	
	public function groups(){
		return $this->hasMany(Group::class);
	}
}
