<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	public function program($programs){
		return $programs->find($this->program_id)->name;
	}
	
	public function school($schools){
		return $schools->find($this->school_id)->name;
	}
	
	public function teacher($teachers){
		return $teachers->find($this->teacher_id)->last_name . ' ' . $teachers->find($this->teacher_id)->first_name;
	}
	
	public function schedule(){
		return $this->morphMany('App\Models\Schedule', 'schedulable');
	}
}
