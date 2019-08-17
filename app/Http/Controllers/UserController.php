<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use App\Rol; 

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'ASC')->get();
        return view('users.index', compact('users'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rols = Rol::orderBy('name','ASC')-> pluck('name', 'id'); 
        return view('users.create', compact('rols'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'username' => 'required | unique:users,username', 
            'rol_id' => 'required',
            'ci' => 'required',
            'email' => 'required | unique:users,email', 
            'password' => 'required'
        ]);

        //$key = Helper::getToken();  PRUEBAS
        //dd($key);     PRUEBAS

        $request['password'] = bcrypt($request->password);
        //Generar usuario 
        $user = User::create($request->all()); 

        // Verificar imagen en el request

        return redirect('users'); 
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
