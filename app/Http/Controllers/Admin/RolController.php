<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rol; 

class RolController extends Controller
{

    /*
    public function __construct()
    {

        $user = Auth::user();

       if($user->rol_id != 1)
        {
            return "No tiene suficientes permisos"; 
        }
    } */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rols = Rol::orderBy('name', 'ASC')->get();
     
        return view('superadmin.rols.index', compact('rols'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.rols.create');
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
            'name' => 'required|unique:rols,name|max:50'
        ]);

        $rol = Rol::create($request->all()); 
        return redirect('/rols'); 
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
        $rol  = Rol::find($id); 

        return view('superadmin.rols.edit', compact('rol'));

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
        
        $rol = Rol::find($id); 
        $request->validate([
            'name' => 'required|unique:rols,name,'.$rol->name.',name|max:50',

        ]);

        $rol->name=$request->name;
        $rol->save();

        return redirect('/rols'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Rol::find($id); 
        if($rol){
            $rol->delete(); 
        }

        return redirect('/rols');
    }
}
