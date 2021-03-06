<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected $fillable = ['surname', 'firstname', 'fathername', 'birthday', 'phone'];
	
	public function kids()
    {
        return $this->belongsToMany(Kid::class);
    }
}
