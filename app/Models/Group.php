<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected $fillable = ['name'];
	
	public function kids(){
		return $this->hasMany(Kid::class);
	}
	
	public function manager(){
		return $this->belongsTo(Employee::class);
	}
	
	public function educator(){
		return $this->belongsTo(Employee::class);
	}
	
	public function department(){
		return $this->belongsTo(Department::class);
	}
	
	public function room(){
		return $this->belongsTo(Room::class);
	}
}
