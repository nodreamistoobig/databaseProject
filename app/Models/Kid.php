<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Kid extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected $fillable = ['surname', 'firstname', 'fathername', 'birthday', 'phone'];
	
	public function parents()
    {
        return $this->belongsToMany(Client::class);
    }
	
	public function group(){
		return $this->belongsTo(Group::class);
	}
}
