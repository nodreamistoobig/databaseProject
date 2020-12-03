<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\Group;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{	

	public $departments;
	//public $positions;
	
	public function __construct (){
		$this->departments = Department::orderBy('name')->get();
		//$this->positions = Position::all();
	}

	public function index(Request $request){
		$employees = Employee::all();
		return view('employees.employees', compact('employees'));
	}
	
	public function show(Request $request, $id){
		$employee = Employee::where('id', $id)->first();
		if($employee){
			return view('employees.employee', ['employee' => $employee]);
		}
		else{abort(404);}
	}
	
	public function create(Request $request){
		return view('employees.create', ['departments' => $this->departments]);
	}	
	
	public function store(Request $request){
		
		$validatedData = self::employee_data($request);		
		$position = Position::find($validatedData['position_id']);
		
		Employee::insert([
				'surname' => $request->surname,
				'firstname' => $request->firstname,
				'fathername' => $request->fathername,
				'birthday' => $request->birthday,
				'phone' => $request->phone,
				'department_id' => $position->department->id,
				'position_id' => $request->position_id
			]);
		
		session()->flash('message', 'Сотрудник успешно создан');
		
		return redirect(route('allEmployees'));
	}	
	
	public function edit(Request $request, $id){
		$employee = Employee::where('id', $id)->first();
		if ($employee){
			return view('employees.edit', ['employee' => $employee, 'departments' => $this->departments]);
		}
		else {abort(404);}
	}
	
	public function update(Request $request, $id){
		
		if(Employee::where('id', $id)->first()){
		
			$validatedData = self::employee_data($request);
			$position = Position::find($validatedData['position_id']);
			
			$department = Employee::where('id', $id)->update([
				'surname' => $request->surname,
				'firstname' => $request->firstname,
				'fathername' => $request->fathername,
				'birthday' => $request->birthday,
				'phone' => $request->phone,
				'department_id' => $position->department->id,
				'position_id' => $request->position_id
			]);
			session()->flash('message', 'Данные сотрудника успешно изменены');
			return redirect()->action('App\Http\Controllers\EmployeesController@show', ['id' => $id]);
		}
		else {abort(404);}
	}
	
	public function archive(Request $request, $id){
		$e = Employee::where('id', $id)->first();
		$groups = Group::all();
		foreach ($groups as $group){
			if ($group->educator == $e or $group->manager == $e){
				session()->flash('message', 'Сотрудник не может быть удален, пока на нем есть группы.');
				return redirect(route('allEmployees'));
			}
		}
		if($e){
			$e->delete();
			return redirect(route('allEmployees'));
		}
		else{abort(404);}
		
	}
	
	public function employee_data(Request $request){
		$validatedData = $request->validate([
			'surname' => 'required|max:30',
			'firstname' => 'required|max:30',
			'fathername' => 'required|max:30',
			'birthday' => 'required',
			'phone' => 'required|max:12',
			'position_id' => 'required'
			
		],
		[
			'surname.required' => 'Вы не указали фамилию сотрудника!',
			'firstname.required' => 'Вы не указали имя сотрудника!',
			'fathername.required' => 'Вы не указали отчество сотрудника!',
			'birthday.required' => 'Вы не указали дату рождения сотрудника!',
			'phone.required' => 'Вы не указали телефон сотрудника!',
			'position_id.required' => 'Вы не указали должностную позицию сотрудника!',
			'surname.max' => 'Фамилия не может быть больше 30 символов',
			'firstname.max' => 'Имя не может быть больше 30 символов',
			'fathername.max' => 'Отчество не может быть больше 30 символов',
			'phone.max' => 'Телефон не может быть больше 12 символов',
		]
		);
		return $validatedData;
	}
}
