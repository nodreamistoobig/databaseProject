<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Group;

class Groups {

	protected $groups = [];
	
	public function __construct(){
		
		$this->groups = [
			[
				"school" => "Center",
				"program" => "Math",
				"year" => "9",
				"level" => "1"
			],
			[
				"school" => "Lermontov",
				"program" => "English",
				"year" => "11",
				"level" => "1"
			],
		];
		
		//DB::table('groups')->insert($this->groups);
	}
	
	public function getAll(){
		
		return Group::all();
		
		//$sql = DB::table('groups');
		//dd($sql->getBindings());
		//return DB::table('groups')->paginate(2);
		
		
		//return $this->groups;
	}

	public function get($id){
		
		return Group::where('id', $id)->first();
		
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