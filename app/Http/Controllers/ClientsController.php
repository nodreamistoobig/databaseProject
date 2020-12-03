<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Kid;
use App\Models\Group;
use Illuminate\Http\Request;

class ClientsController extends Controller
{	

	public function clients_show(Request $request){
		$clients = Client::paginate(10);
		return view('clients.clients', ['clients' => $clients]);
	}
	
	public function client_show(Request $request, $id){
		$client = Client::where('id', $id)->first();
		if ($client){
			return view('clients.client', ['client' => $client]);
		}
		else{abort(404);}
	}
	
	public function client_create(Request $request){
		return view('clients.client_create');
	}
	
	private function client_data(Request $request){
		$validatedData = $request->validate([
			'surname' => 'required|max:30',
			'firstname' => 'required|max:30',
			'fathername' => 'required|max:30',
			'birthday' => 'required',
			'phone' => 'required|max:12',
			
		],
		[
			'surname.required' => 'Вы не указали фамилию клиента!',
			'firstname.required' => 'Вы не указали имя клиента!',
			'fathername.required' => 'Вы не указали отчество клиента!',
			'birthday.required' => 'Вы не указали дату рождения клиента!',
			'phone.required' => 'Вы не указали телефон клиента!',
			'surname.max' => 'Фамилия не может быть больше 30 символов',
			'firstname.max' => 'Имя не может быть больше 30 символов',
			'fathername.max' => 'Отчество не может быть больше 30 символов',
			'phone.max' => 'Телефон не может быть больше 12 символов',
		]
		);
		return $validatedData;
	}
	
	public function client_store(Request $request){
		
		$validatedData = self::client_data($request);
		
		$client = Client::create($validatedData);
		
		session()->flash('message', 'Данные клиента успешно созданы');
		
		return redirect()->action('App\Http\Controllers\ClientsController@client_show', ['id' => $client->id]);
	}	
	
	
	
	public function client_edit(Request $request, $id){
		$client = Client::where('id', $id)->first();
		if($client){
			return view('clients.client_edit', ['client' => $client]);
		}
		else {abort(404);}
	}
	
	public function client_update(Request $request, $id){
		
		if(Client::where('id', $id)->first()){
		
			$validatedData = self::client_data($request);
			
			$client = Client::where('id', $id)->update([
				'surname' => $request->surname,
				'firstname' => $request->firstname,
				'fathername' => $request->fathername,
				'birthday' => $request->birthday,
				'phone' => $request->phone,
				
			]);
			session()->flash('message', 'Данные клиента успешно изменены');
			return redirect()->action('App\Http\Controllers\ClientsController@client_show', ['id' => $id]);
		}
		else {abort(404);}
	}
	
	public function client_archive(Request $request, $id){
		$client = Client::where('id', $id)->first();
		if($client){
			$client->kids()->detach();
			$client->delete();
			return redirect(route('allClients'));
		}
		else{abort(404);}
		
	}
	
	public function kid_data(Request $request){
		$validatedData = $request->validate([
			'surname' => 'required|max:30',
			'firstname' => 'required|max:30',
			'fathername' => 'required|max:30',
			'birthday' => 'required',
			'phone' => 'max:12',
			
		],
		[
			'surname.required' => 'Вы не указали фамилию ребенка!',
			'firstname.required' => 'Вы не указали имя ребенка!',
			'fathername.required' => 'Вы не указали отчество ребенка!',
			'birthday.required' => 'Вы не указали дату рождения ребенка!',
			'surname.max' => 'Фамилия не может быть больше 30 символов',
			'firstname.max' => 'Имя не может быть больше 30 символов',
			'fathername.max' => 'Отчество не может быть больше 30 символов',
			'phone.max' => 'Телефон не может быть больше 12 символов',
		]
		);
		return $validatedData;
	}
	
	public function kids_show(Request $request){
		$kids = Kid::paginate(10);
		return view('clients.kids', ['kids' => $kids]);
	}
	
	public function kid_show(Request $request, $id){
		$kid = Kid::where('id', $id)->first();
		if($kid){
			return view('clients.kid', ['kid' => $kid]);
		}
		else{abort(404);}
	}
	
	public function kid_create(Request $request){
		return view('clients.kid_create');
	}
	
	public function kid_store(Request $request){
		
		$validatedData = self::kid_data($request);
		
		$kid = Kid::create($validatedData);
		
		session()->flash('message', 'Данные ребенка успешно созданы');
		
		return redirect()->action('App\Http\Controllers\ClientsController@kid_show', ['id' => $kid->id]);
	}

	public function kid_edit(Request $request, $id){
		$kid = Kid::where('id', $id)->first();
		if($kid){
			return view('clients.kid_edit', ['kid' => $kid]);
		}
		else {abort(404);}
	}	
	
	public function kid_update(Request $request, $id){
		
		if (Kid::where('id', $id)->first()){
		
			$validatedData = self::kid_data($request);
			
			$kid = Kid::where('id', $id)->update([
				'surname' => $request->surname,
				'firstname' => $request->firstname,
				'fathername' => $request->fathername,
				'birthday' => $request->birthday,
				'phone' => $request->phone,
				
			]);
			session()->flash('message', 'Данные ребенка успешно изменены');
			return redirect()->action('App\Http\Controllers\ClientsController@kid_show', ['id' => $id]);
		}
		else {abort(404);}
	}
	
	public function kid_archive(Request $request, $id){
		$kid = Kid::where('id', $id)->first();
		if($kid){
			$kid->parents()->detach();
			$kid->delete();
			return redirect(route('allKids'));
		}
		else{abort(404);}
		
	}
	
	
	
	public function parent_add(Request $request, $id){
		$kid = Kid::find($id);
		if($kid){
			return view('clients.parent_add', ['kid' => $kid]);		
		}
		else{abort(404);}
	}
	
	public function parent_add_existed(Request $request, $id){
		$kid = Kid::find($id);
		$clients = Client::paginate(10);
		if($kid){
			return view('clients.parent_add_existed', ['kid' => $kid, 'clients' => $clients]);	
		}
		else {abort(404);}
	}
	
	public function parent_attach(Request $request, $id){
		$kid = Kid::find($id);
		
		if($kid) {
		
			$validatedData = self::client_data($request);
			$parent = Client::create($validatedData);
			
			$parent->kids()->attach($kid);
			
			return redirect()->action('App\Http\Controllers\ClientsController@kid_show', ['id' => $id]);
		}
		else {abort(404);}
	}
	
	public function parent_attach_existed(Request $request, $id_k, $id_p){
		$kid = Kid::find($id_k);
		$client = Client::find($id_p);
		
		if($client and $kid){
			
			$client->kids()->attach($kid);
			
			return redirect()->action('App\Http\Controllers\ClientsController@kid_show', ['id' => $id_k]);	
		}
		else {abort(404);}
	}
	
	public function parent_detach(Request $request, $id_k, $id_p){
		$client = Client::where('id', $id_p)->first();
		$kid = Kid::where('id', $id_k)->first();
		if($client and $kid){
			$kid->parents()->detach($client);
			return redirect()->action('App\Http\Controllers\ClientsController@kid_show', ['id' => $id_k]);	
		}
		else{abort(404);}
	}
	
	public function kid_add(Request $request, $id){
		$client = Client::find($id);
		if($client){
			return view('clients.kid_add', ['client' => $client]);	
		}
		else {abort(404);}
	}
	
	public function kid_add_existed(Request $request, $id){
		$client = Client::find($id);
		$kids = Kid::paginate(10);
		if($client){
			return view('clients.kid_add_existed', ['client' => $client, 'kids' => $kids]);	
		}
		else {abort(404);}
	}
	
	public function kid_attach(Request $request, $id){
		$client = Client::find($id);
		
		if($client){
		
			$validatedData = self::kid_data($request);
			$kid = Kid::create($validatedData);
			
			$kid->parents()->attach($client);
			
			return redirect()->action('App\Http\Controllers\ClientsController@client_show', ['id' => $id]);	
		}
		else {abort(404);}
	}
	
	public function kid_attach_existed(Request $request, $id_p, $id_k){
		$client = Client::find($id_p);
		$kid = Kid::find($id_k);
		
		if($client and $kid){
			
			$kid->parents()->attach($client);
			
			return redirect()->action('App\Http\Controllers\ClientsController@client_show', ['id' => $id_p]);	
		}
		else {abort(404);}
	}
	
	public function kid_detach(Request $request, $id_p, $id_k){
		$client = Client::where('id', $id_p)->first();
		$kid = Kid::where('id', $id_k)->first();
		if($client and $kid){
			$client->kids()->detach($kid);
			return redirect()->action('App\Http\Controllers\ClientsController@client_show', ['id' => $id_p]);	
		}
		else{abort(404);}
	}
	
	public function group_add(Request $request, $id_k){
		$groups = Group::paginate(10);
		$kid = Kid::find($id_k);
		if($kid){
			return view('clients.group_add', ['groups' => $groups, 'kid' => $kid]);	
		}
		else {abort(404);}
	}
	
	public function group_save(Request $request, $id_k, $id_g){
		$kid = Kid::find($id_k);
		$group = Group::find($id_g);
		if($kid and $group){
			
			$group->kids()->save($kid);
			return redirect()->action('App\Http\Controllers\ClientsController@kid_show', ['id' => $id_k]);	
		}
		else {abort(404);}
	}
	
	public function group_delete(Request $request, $id_k, $id_g){
		$kid = Kid::find($id_k);
		$group = Group::find($id_g);
		if($kid and $group){
			
			$kid->group()->dissociate();
			$kid->save();
			return redirect()->action('App\Http\Controllers\ClientsController@kid_show', ['id' => $id_k]);	
		}
		else {abort(404);}
	}
}
