<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
	use SoftDeletes;
	protected $fillable = ['surname', 'firstname', 'fathername', 'birthday', 'phone'];
	
	public function department(){
		return $this->belongsTo(Department::class);
	}
	
	public function position(){
		return $this->belongsTo(Position::class);
	}
	
	public function groups(){
		return $this->hasMany(Group::class);
	}
}
