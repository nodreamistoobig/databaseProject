<?php

namespace App\Http\Controllers;

use App\Models\Staff;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    protected $staff;
	
	public function __construct(Staff $staff){
		$this->staff = $staff;
	}

    public function index(Request $request){
		$staff = $this->staff->all();
		return view('staff.full_staff', compact('staff'));
	}
	
	public function show(Request $request, $id){
		$staff = $this->staff->where('id', $id)->first();
		return view('staff.one_staff', ['s' => $staff]);
	}
	
	public function create(Request $request){
		return view('staff.staff_create');
	}
	
	public function store(Request $request){
		$validatedData = $request->validate([
			'last_name'   => 'required|max:50',
			'first_name'  => 'required|max:50',
			'father_name' => 'max:50',
			'birthday'    => 'required',
			'phone'       => 'required|max:30',
			'status'      => 'required|max:30',
			
		]
		);
		
		$this->staff->insert([
			'last_name'   => $request->last_name, 
			'first_name'  => $request->first_name,
			'father_name' => $request->father_name,
			'birthday'    => $request->birthday,
			'phone'       => $request->phone,
			'status'      => $request->status,
		]);
		session()->flash('message', 'Сотрудник успешно создан');
		
		return redirect(route('allStaff'));
	}
	
	public function edit(Request $request, $id){
		$staff = $this->staff->where('id', $id)->first();
		return view('staff.edit', ['s'=>$staff]);
	}
	
	public function update(Request $request, $id){
		$validatedData = $request->validate([
			'last_name'   => 'required|max:50',
			'first_name'  => 'required|max:50',
			'father_name' => 'max:50',
			'birthday'    => 'required',
			'phone'       => 'required|max:30',
			'status'      => 'required|max:30',
			
		]
		);
		
		$this->staff->where('id', $id)->update([
			'last_name'   => $request->last_name, 
			'first_name'  => $request->first_name,
			'father_name' => $request->father_name,
			'birthday'    => $request->birthday,
			'phone'       => $request->phone,
			'status'      => $request->status,
		]);
		session()->flash('message', 'Сотрудник успешно изменен');
		
		return redirect()->action('App\Http\Controllers\StaffController@show', ['id' => $id]);
	}
}
