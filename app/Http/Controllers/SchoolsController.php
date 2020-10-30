<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Classroom;
use Illuminate\Http\Request;

class SchoolsController extends Controller
{	

	protected $schools;
	protected $classrooms;
	
	public function __construct(School $schools, Classroom $classrooms){
		$this->schools = $schools;
		$this->classrooms = $classrooms;
	}

    public function index(Request $request){
		$schools = $this->schools->all();
		return view('schools.schools', compact('schools'));
	}
	
	public function show(Request $request, $id){
		$school = $this->schools->where('id', $id)->first();
		$classrooms = $this->classrooms->where('school_id', $id)->get();
		return view('schools.school', ['school' => $school, 'classrooms' => $classrooms]);
	}
	
	public function create(Request $request){
		return view('schools.create');
	}	
	
	public function store(Request $request){
		$validatedData = $request->validate([
			'name' => 'required|max:100',
			'address' => 'required|max:100',
			'phone' => 'max:30',
			
		],
		['name.required' => 'Вы не указали название школы!',
		'name.max' => 'Название школы не может быть больше 100 символов!',
		'address.required' => 'Вы не указали адрес школы',
		'phone.max' => 'Номер телефона не может быть больше 30 символов!']
		);
		
		$this->schools->insert([
			'name' => $request->name,
			'address' => $request->address,
			'phone' => $request->phone
		]);
		session()->flash('message', 'Школа успешно создана');
		
		return redirect(route('allSchools'));
	}	
	
	public function edit(Request $request, $id){
		$school = $this->schools->where('id', $id)->first();
		return view('schools.edit', ['school' => $school]);
	}
	
	public function update(Request $request, $id){
		
		$validatedData = $request->validate([
			'name' => 'required|max:100',
			'address' => 'required|max:100',
			'phone' => 'max:30',
		],
		['name.required' => 'Вы не указали название школы!',
		'name.max' => 'Название школы не может быть больше 100 символов!',
		'address.required' => 'Вы не указали адрес школы',
		'phone.max' => 'Номер телефона не может быть больше 30 символов!']
		);
		
		$school = $this->schools->where('id', $id)->update([
			'name' => $request->name,
			'address' => $request->address,
			'phone' => $request->phone
		]);
		session()->flash('message', 'Школа успешно изменена');
		return redirect(route('allSchools'));
	}
	
	
	public function classroom_create(Request $request, $id){
		return view('schools.classroom_create', ['id' => $id]);
	}
	
	public function classroom_store(Request $request, $id){
		
		$validatedData = $request->validate([
			'name' => 'required|max:100',
			'capasity' => 'required|max:40',
		],
		['name.required' => 'Вы не указали название кабинета!',
		'name.max' => 'Название кабинета не может быть больше 100 символов!',
		'capasity.required' => 'Вы не указали вместимость кабинета',
		'capasity.max' => 'Вместимость кабинета не может быть больше 40',]
		);		
		
		$classroom = $this->classrooms->insert([
			'name' => $request->name,
			'capasity' => $request->capasity,
			'school_id' => $id
		]);
		session()->flash('message', 'Кабинет успешно создан');
		return redirect()->action('App\Http\Controllers\SchoolsController@show', ['id' => $id]);
	}
	
	public function classroom_edit(Request $request, $id_s, $id_c){
		$classroom = $this->classrooms->where('id', $id_c)->first();
		return view('schools.classroom_edit', ['classroom' => $classroom]);
	}
	
	public function classroom_update(Request $request, $id_s, $id_c){
		
		$validatedData = $request->validate([
			'name' => 'required|max:100',
			'capasity' => 'required|max:40',
		],
		['name.required' => 'Вы не указали название кабинета!',
		'name.max' => 'Название кабинета не может быть больше 100 символов!',
		'capasity.required' => 'Вы не указали вместимость кабинета',
		'capasity.max' => 'Вместимость кабинета не может быть больше 40',]
		);	
		
		
		$classroom = $this->classrooms->where('id', $id_c)->update([
			'name' => $request->name,
			'capasity' => $request->capasity,
		]);
		
		
		session()->flash('message', 'Кабинет успешно изменен');
		return redirect()->action('App\Http\Controllers\SchoolsController@show', ['id' => $id_s]);
	}
}
