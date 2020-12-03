<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use App\Models\Room;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{	

	public function index(Request $request){
		$departments = Department::all();
		return view('departments.departments', compact('departments'));
	}
	
	public function show(Request $request, $id){
		$department = Department::where('id', $id)->first();
		if($department){
			return view('departments.department', ['department' => $department]);
		}
		else{abort(404);}
	}
	
	public function create(Request $request){
		return view('departments.create');
	}	
	
	public function store(Request $request){
		$validatedData = $request->validate([
			'name' => 'required|max:100',
			
		],
		['name.required' => 'Вы не указали название отдела!']
		);
		
		Department::create($validatedData);
		
		session()->flash('message', 'Отдел успешно создан');
		
		return redirect(route('allDepartments'));
	}	
	
	public function edit(Request $request, $id){
		$department = Department::where('id', $id)->first();
		if ($department){
			return view('departments.edit', ['department' => $department]);
		}
		else {abort(404);}
	}
	
	public function update(Request $request, $id){
		
		if(Department::where('id', $id)->first()){
		
			$validatedData = $request->validate([
				'name' => 'required|max:100',
			],
			['name.required' => 'Вы не указали название отдела!']
			);
			
			$department = Department::where('id', $id)->update([
				'name' => $request->name
			]);
			session()->flash('message', 'Отдел успешно изменен');
			return redirect(route('allDepartments'));
		}
		else {abort(404);}
	}
	
	public function archive(Request $request, $id){
		$dep = Department::where('id', $id)->first();
		if($dep){
			if ($dep->groups->count() > 0 or $dep->employees->count() > 0){
				session()->flash('message', 'Отдел не может быть удален, пока в нем есть сотрудники и группы.');
				return redirect(route('allDepartments'));
			}
			$rooms = $dep->rooms();
			$positions = $dep->positions();
			$dep->delete();
			$rooms->delete();
			$positions->delete();
			return redirect(route('allDepartments'));
		}
		else{abort(404);}
		
	}
	
	
	public function position_create(Request $request, $id){
		if (Department::where('id', $id)->first()){
			return view('departments.position_create', ['id' => $id]);
		}
		else {abort(404);}
	}
	
	public function position_store(Request $request, $id){
		if (Department::where('id', $id)->first()){
		
			$validatedData = $request->validate([
				'name' => 'required|max:100',
			],
			['name.required' => 'Вы не указали название должностной позиции!',
			'name.max' => 'Название должностной позиции не может быть больше 100 символов!']
			);		
			
			Position::insert(['name' => $request->name, 'department_id' => $id]);
			
			session()->flash('message', 'Должностная позиция успешно создана');
			
			return redirect()->action('App\Http\Controllers\DepartmentsController@show', ['id' => $id]);
		}
		else{abort(404);}
		
	}
	
	public function position_edit(Request $request, $id_d, $id_p){
		$position = Position::where('id', $id_p)->first();
		if($position and Department::where('id', $id_d)->first()){
			return view('departments.position_edit', ['position' => $position]);
		}
		else{abort(404);}
	}
	
	public function position_update(Request $request, $id_d, $id_p){
		
		if(Position::where('id', $id_p)->first() and Department::where('id', $id_d)->first()){
		
			$validatedData = $request->validate([
				'name' => 'required|max:100',
			],
			['name.required' => 'Вы не указали название должностной позиции!',
			'name.max' => 'Название должностной позиции не может быть больше 100 символов!',]
			);	
			
			
			$position = Position::where('id', $id_p)->update([
				'name' => $request->name,
			]);
			
			
			session()->flash('message', 'Должностная позиция успешно изменен');
			return redirect()->action('App\Http\Controllers\DepartmentsController@show', ['id' => $id_d]);
		}
		else{abort(404);}
	}
	
	public function position_archive(Request $request, $id_d, $id_p){
		$position = Position::where('id', $id_p)->first();
		if($position and Department::where('id', $id_d)->first()){
			if($position->employees->count() > 0){
				session()->flash('message', 'Должностная позиция не может быть удалена, пока есть сотрудники с этой позицией.');
				return redirect()->action('App\Http\Controllers\DepartmentsController@show', ['id' => $id_d]);
			}
			$position->delete();
			return redirect()->action('App\Http\Controllers\DepartmentsController@show', ['id' => $id_d]);
		}
		else{abort(404);}
	}
	
	public function room_create(Request $request, $id){
		if (Department::where('id', $id)->first()){
			return view('departments.room_create', ['id' => $id]);
		}
		else{abort(404);}
	}
	
	public function room_store(Request $request, $id){
		if (Department::where('id', $id)->first()){
		
			$validatedData = $request->validate([
				'name' => 'required|max:50',
			],
			['name.required' => 'Вы не указали название кабинета!',
			'name.max' => 'Название кабинета не может быть больше 50 символов!']
			);		
			
			Room::insert(['name' => $request->name, 'department_id' => $id]);
			
			session()->flash('message', 'Кабинет успешно создан');
			
			return redirect()->action('App\Http\Controllers\DepartmentsController@show', ['id' => $id]);
		}
		else{abort(404);}
	}
	
	public function room_edit(Request $request, $id_d, $id_r){
		$room = Room::where('id', $id_r)->first();
		if (Department::where('id', $id_d)->first() and $room){
			return view('departments.room_edit', ['room' => $room]);
		}
		else{abort(404);}
	}
	
	public function room_update(Request $request, $id_d, $id_r){
		
		if (Department::where('id', $id_d)->first() and Room::where('id', $id_r)->first()){
		
			$validatedData = $request->validate([
				'name' => 'required|max:50',
			],
			['name.required' => 'Вы не указали название кабинета!',
			'name.max' => 'Название кабинета не может быть больше 50 символов!',]
			);	
			
			
			$room = Room::where('id', $id_r)->update([
				'name' => $request->name,
			]);
			
			
			session()->flash('message', 'Кабинет успешно изменен');
			return redirect()->action('App\Http\Controllers\DepartmentsController@show', ['id' => $id_d]);
		}
		else{abort(404);}
	}
	
	public function room_archive(Request $request, $id_d, $id_r){
		$room = Room::where('id', $id_r)->first();
		if (Department::where('id', $id_d)->first() and $room){
			
			if($room->groups->count() > 0){
				session()->flash('message', 'Кабинет не может быть удален, пока есть группы, занимающиеся в нем.');
				return redirect()->action('App\Http\Controllers\DepartmentsController@show', ['id' => $id_d]);
			}
			$room->delete();
			return redirect()->action('App\Http\Controllers\DepartmentsController@show', ['id' => $id_d]);
		}
		else{abort(404);}
	}
}
