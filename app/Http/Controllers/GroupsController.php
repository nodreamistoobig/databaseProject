<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\School;
use App\Models\Program;
use App\Models\Classroom;
use App\Models\Staff;
use Illuminate\Http\Request;

use App\Listeners\onLessonAdded;
use App\Events\LessonAdded;
use Event;

class GroupsController extends Controller
{
	
	protected $groups;
	protected $schools;
	protected $programs;
	protected $classrooms;
	protected $staff;
	
	public function __construct(Group $groups, School $schools, Program $programs, Staff $staff, Classroom $classrooms){
		$this->groups = $groups;
		$this->schools = $schools;
		$this->programs = $programs;
		$this->staff = $staff;
		$this->classrooms = $classrooms;
	}
	
    public function index(Request $request){
		$groups = $this->groups->all();
		$schools = $this->schools->all();
		$programs = $this->programs->all();
		$staff = $this->staff->where('status', 'Учитель')->get();
		return view('groups.groups', ['groups'=>$groups, 'schools'=>$schools, 'programs'=>$programs, 'teachers'=>$staff]);
	}
	
	public function show(Request $request, $id){
		$group = $this->groups->where('id', $id)->first();
		$school = $this->schools->where('id', $group->school_id)->first();
		$program = $this->programs->where('id', $group->program_id)->first();
		$teacher = $this->staff->where('id', $group->teacher_id)->first();
		return view('groups.group', ['group'=>$group, 'school'=>$school, 'program'=>$program, 'teacher'=>$teacher]);
	}
	
	public function create(Request $request){
		$schools = $this->schools->all();
		$programs = $this->programs->all();
		$staff = $this->staff->where('status', 'Учитель')->get();
		return view('groups.group_create', ['schools'=>$schools, 'programs'=>$programs, 'teachers'=>$staff]);
	}
	
	public function store(Request $request){
		$validatedData = $request->validate([
			'school' => 'required',
			'program' => 'required',
			'level' => 'required',
			'teacher' => 'required',
		]
		);
		
		$group = $this->groups->insert([
			'school_id'  => $request->school,
			'program_id' => $request->program,
			'level'      => $request->level,
			'teacher_id' => $request->teacher,
		]);
		session()->flash('message', 'Группа успешно создана');
		return redirect(route('allGroups'));
	}
	
	public function edit(Request $request, $id){
		$group = $this->groups->where('id', $id)->first();
		$schools = $this->schools->all();
		$programs = $this->programs->all();
		$staff = $this->staff->where('status', 'Учитель')->get();
		return view('groups.group_edit', ['group'=> $group, 'schools'=>$schools, 'programs'=>$programs, 'teachers'=>$staff]);
	}
	
	public function update(Request $request, $id){
		$validatedData = $request->validate([
			'school' => 'required',
			'program' => 'required',
			'level' => 'required',
			'teacher' => 'required',
		]
		);
		
		$group = $this->groups->where('id', $id)->update([
			'school_id'  => $request->school,
			'program_id' => $request->program,
			'level'      => $request->level,
			'teacher_id' => $request->teacher,
		]);
		session()->flash('message', 'Группа успешно изменена');
		return redirect(route('allGroups'));
	}
	
	public function lesson_create(Request $request, $id){
		$group = $this->groups->where('id', $id)->first();
		$classrooms = $this->classrooms->where('school_id',$group->school_id)->get();
		return view('groups.lesson_create', ['group'=>$group, 'classrooms'=>$classrooms]);
	}
	
	public function lesson_store(Request $request,$id){
		$group = $this->groups->where('id', $id)->first();
		$validatedData = $request->validate([
			'day_of_week' => 'required|max:1|min:1',
			's_time' => 'required',
			'e_time' => 'required',
			'classroom' => 'required',
		],
		['day_of_week.max' => 'Номер дня недели не может быть меньше 1 и больше 7',
		]
		
		);
		
		$lesson = [
			'day_of_week'  => $request->day_of_week,
			'start_time' => $request->s_time,
			'end_time'      => $request->e_time,
			'classroom_id' => $request->classroom,
		];
		
		event(new LessonAdded($group, $lesson));
				
		session()->flash('message', 'Урок успешно создан');
		return redirect()->action('App\Http\Controllers\GroupsController@show', ['id' => $id]);
	}
	
	public function lesson_delete(Request $request, $id, $id_l){
		$group = $this->groups->where('id', $id)->first();
		$lesson = $group->schedule->find($id_l);
		$lesson->delete();
		
		
		return redirect()->action('App\Http\Controllers\GroupsController@show', ['id' => $id]);
	}
}
