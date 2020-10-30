<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{	

	protected $programs;
	
	public function __construct(Program $programs){
		$this->programs = $programs;
	}

    public function index(Request $request){
		$programs = $this->programs->all();
		return view('programs.programs', compact('programs'));
	}
	
	public function show(Request $request, $id){
		$program = $this->programs->where('id', $id)->first();
		return view('programs.program', ['program' => $program]);
	}
	
	public function create(Request $request){
		return view('programs.program_create');
	}	
	
	public function store(Request $request){
		$validatedData = $request->validate([
			'name' => 'required|max:100'
		],
		['name.required' => 'Вы не указали название программы!',
		'name.max' => 'Название программы не может быть больше 100 символов!',]
		);
		
		
		Program::create($validatedData);
		session()->flash('message', 'Программа успешно создана');
		
		return redirect(route('allPrograms'));
	}	
	
	public function edit(Request $request, $id){
		$program = $this->programs->where('id', $id)->first();
		return view('programs.program_edit', ['program' => $program]);
	}
	
	public function update(Request $request, $id){
		$validatedData = $request->validate([
			'name' => 'required|max:100'
		],
		['name.required' => 'Вы не указали название программы!',
		'name.max' => 'Название программы не может быть больше 100 символов!',]
		);
		
		$program = $this->programs->where('id', $id)->update(['name' => $request->name]);
		session()->flash('message', 'Программа успешно изменена');
		return redirect(route('allPrograms'));
	}
}
