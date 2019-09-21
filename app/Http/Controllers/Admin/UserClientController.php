<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; 
use App\Client;

class UserClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $user = User::find($user_id); 
 
        $clients = Client::where('user_id', $user->id)->get(); 
        

        return view('superadmin.clients.index', compact('clients', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        $user = User::find($user_id); 

        return view('superadmin.clients.create', compact('user')); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($user_id, Request $request)
    {

        $request->validate([
            'user_id' => 'required', 
            'name' => 'required', 
            'ci' => 'required', 
            'phone' => 'required'

        ]);

        $client = Client::create($request->all());  
        return redirect('/users/'.$client->user_id.'/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id, $id)
    {   


        $user = User::find($user_id); 
        $client = Client::find($id); 

        return view('superadmin.clients.edit', compact('user', 'client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($user_id, Request $request, $id)
    {
        
        $client = Client::find($id); 

        $request->validate([
            'user_id' => 'required', 
            'name' => 'required', 
            'ci' => 'required', 
            'phone' => 'required'

        ]);

        $client->fill($request->all()); 
        $client->save(); 

        return redirect('/users/'.$client->user_id.'/clients'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $id)
    {
        $client = Client::find($id);

        if($client){
            $client->delete();
        }

        return redirect('/users/'.$user_id.'/clients');

    }
}
