<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Program;

class Programs {

	public function getAll(){
		
		return Program::all();
		
		//$sql = DB::table('groups');
		//dd($sql->getBindings());
		//return DB::table('groups')->paginate(2);
		
		
		//return $this->groups;
	}

	public function get($id){
		
		return Program::where('id', $id)->first();
		
		//$sql = DB::table('groups')->where('id', $id);
		//dd($sql->getBindings(), $sql->first());
		
		//return DB::table('groups')->where('id', $id)->get();
		//return DB::table('groups')->where('id', $id)->first();
		
		
		
		/*foreach ($this->groups as $group){
			if($id == $group->id)
				return $group;
		}*/
	}

}