<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Room;
use App\Models\Kid;
use Illuminate\Http\Request;

class GroupsController extends Controller
{	

	public $departments;
	public $employees;
	
	public function __construct (){
		$this->departments = Department::orderBy('name')->get();
		$this->employees = Employee::orderBy('surname')->get();
	}

	public function index(Request $request){
		$groups = Group::all();
		return view('groups.groups', compact('groups'));
	}
	
	public function show(Request $request, $id){
		$group = Group::where('id', $id)->first();
		if($group){
			return view('groups.group', ['group' => $group]);
		}
		else{abort(404);}
	}
	
	public function create(Request $request){
		return view('groups.create', ['departments' => $this->departments, 'employees' => $this->employees]);
	}	
	
	public function store(Request $request){
		
		$validatedData = self::group_data($request);
		
		$room = Room::find($request->room_id);
		$educator = Employee::find($request->educator_id);
		
		if($room->department == $educator->department){
			$department = Department::find($room->department)->first();
			
			Group::insert([
				'name' => $request->name,
				'department_id' => $department->id,
				'room_id' => $request->room_id,
				'educator_id' => $request->educator_id,
				'manager_id' => $request->manager_id,
			]);
		
			session()->flash('message', 'Группа успешно создана');
		
			return redirect(route('allGroups'));
		}
		else{
			session()->flash('message', 'Кабинет и воспитатель должны принадлежать одному отделу');
			return view('groups.create', ['departments' => $this->departments, 'employees' => $this->employees]);
		}
	}	
	
	public function edit(Request $request, $id){
		$group = Group::where('id', $id)->first();
		if ($group){
			return view('groups.edit', ['group' => $group, 'employees' => $this->employees, 'departments' => $this->departments]);
		}
		else {abort(404);}
	}
	
	public function update(Request $request, $id){
		
		$group = Group::where('id', $id)->first();
		
		if($group){
		
			$validatedData = self::group_data($request);
			$room = Room::find($request->room_id);
			$educator = Employee::find($request->educator_id);
			
			if($room->department == $educator->department){
				$department = Department::find($room->department)->first();
			
				Group::where('id', $id)->update([
					'name' => $request->name,
					'department_id' => $department->id,
					'room_id' => $request->room_id,
					'educator_id' => $request->educator_id,
					'manager_id' => $request->manager_id,
				]);
				session()->flash('message', 'Группа успешно изменена');
				return redirect()->action('App\Http\Controllers\GroupsController@show', ['id' => $id]);
			}
			else{
				session()->flash('message', 'Кабинет и воспитатель должны принадлежать одному отделу');
				return view('groups.edit', ['group' => $group, 'employees' => $this->employees, 'departments' => $this->departments]);
			}
		}
		else {abort(404);}
	}
	
	public function archive(Request $request, $id){
		$group = Group::where('id', $id)->first();
		if($group){
			$group->delete();
			return redirect(route('allGroups'));
		}
		else{abort(404);}
		
	}
	
	public function group_data(Request $request){
		$validatedData = $request->validate([
			'name' => 'max:30',
			'room_id' => 'required',
			'educator_id' => 'required',
			'manager_id' => 'required',
			
		],
		[
			'room_id.required' => 'Вы не указали кабинет!',
			'educator_id.required' => 'Вы не указали воспитателя!',
			'manager_id.required' => 'Вы не указали ответственного за группу!',
			'name.max' => 'Название не может быть больше 30 символов',
		]
		);
		return $validatedData;
	}
	
	
	public function kid_add(Request $request, $id_g){
		$kids = Kid::paginate(10);
		$group = Group::find($id_g);
		if($group){
			return view('groups.kid_add', ['group' => $group, 'kids' => $kids]);	
		}
		else {abort(404);}
	}
	
	public function kid_save(Request $request, $id_g, $id_k){
		$group = Group::find($id_g);
		$kid = Kid::find($id_k);
		if($kid and $group){
			
			$group->kids()->save($kid);
			return redirect()->action('App\Http\Controllers\GroupsController@show', ['id' => $id_g]);	
		}
		else {abort(404);}
	}
	
	public function kid_delete(Request $request, $id_g, $id_k){
		$kid = Kid::find($id_k);
		$group = Group::find($id_g);
		if($kid and $group){
			
			$kid->group()->dissociate();
			$kid->save();
			return redirect()->action('App\Http\Controllers\GroupsController@show', ['id' => $id_g]);	
		}
		else {abort(404);}
	}
}
