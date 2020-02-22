<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Sale;
use Carbon\Carbon;  
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $periods = ['day', 'week', 'month', 'year', 'another...'];  
                    $users = User::orderBy('name', 'ASC')->pluck('name', 'id');

                    //$users = array();
                    //$users[0] = "all";
                    

                    /*
                    foreach($users_t as $index=>$user_t)
                    {
                        $users[$index] = $user_t;
                    }
                    */
                        
                        //dd($request->all());
                    if(isset($request->period)){

                        $period = $request->period;
                              

                        if(isset($request->user))
                        {
                            $user_id = $request->user; 
                        }
                        else 
                        {
                            $user_id = null; 
                        } 

                        switch($period) {
                            
                            case 0: 
                                

                                    //echo "Day"; 
                                    $date = Carbon::now()->toDateTimeString();
                                    $date = substr($date,0,10);
                                    if($user_id)
                                    {

                                        $sales = Sale::whereDate('created_at',$date)->where('user_id', $user_id)->get(); 

                                    }
                                    else
                                    {

                                        $sales = Sale::whereDate('created_at',$date)->get();
                                    }

                                        return view('superadmin.reports.index', compact('periods','users','sales'));
                                               
                                    break; 

                            case 1: 
                                            //echo "Week"; 
                                        if($user_id == "0")
                                        {

                                            $sales = Sale::whereDate('created_at',$date)->get();

                                            dd($sales);

                                            return view('superadmin.reports.index', compact('periods','users','sales'));
                                        }
                                        else{
                                            $sales = Sale::whereDate('created_at',$date)->where('user_id', $user_id)->get(); 

                                            return view('superadmin.reports.index', compact('periods','users','sales'));    
                                        }

                                        break; 

                            case 2: 
                                            //echo "Month"; 
                                            $name = User::selectedUser($period, $date, $sales, $user);  
                                            break; 

                            case 3: 
                                            //echo "Year"; 
                                            $name = User::selectedUser($period, $date, $sales, $user);  
                                            break; 
                            case 4: 
                                            //echo "Another"; 
                                            break;

                            }


                        return view('superadmin.reports.index', compact('periods', 'users', 'sales'));
                    } 

                     $sales = null; 
                   
                        return view('superadmin.reports.index', compact('periods', 'users', 'sales'));
                    

      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'period' => 'required', 
            //'user' => 'required',
        ]);
                
        $period = $request->period;
        $user = $request->user;
        //dd($user);
        $date = Carbon::now()->toDateTimeString();
        $date = substr($date,0,10);
        //$date = str_replace(':', ',', $date);   
        //$date = str_replace('-', ',', $date);
        //$date = str_replace(' ', ',', $date);

        switch($period) {
            case 0: 
                //echo "Day"; 
                if($user == null)
                    {
                        $sales = Sale::whereDate('created_at',$date)->get();
                    }
                else{
                        $sales = Sale::whereDate('created_at',$date)->where('user_id', $user)->get();    
                    }

                dd($sales);
                        
                $name = User::selectedUser($period, $date, $sales, $user); 
                      
                break; 

            case 1: 
                //echo "Week"; 
                $name = User::selectedUser($period); 
                break; 

            case 2: 
                //echo "Month"; 
                $name = User::selectedUser($period);  
                break; 

            case 3: 
                //echo "Year"; 
                $name = User::selectedUser($period); 
                break; 
            case 4: 
                //echo "Another"; 
                break;

                }
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

    public function query($period, $id)
    {
        $date = Carbon::now()->toDateTimeString();
        $date = substr($date,0,10);
        $user_id = $id; 


        switch($period) {
            case 0: 
                //echo "Day"; 
                if($user_id == 0)
                {
                    $sales = Sale::whereDate('created_at',$date)->get();
                    return $sales; 
                }
                else{
                    $sales = Sale::whereDate('created_at',$date)->where('user_id', $user_id)->get(); 
                    return $sales;    
                }

                // dd($sales);
                        
                // $name = User::selectedUser($period, $date, $sales, $user); 
                      
                break; 

            case 1: 
                        //echo "Week"; 
                        $name = User::selectedUser($period, $date, $sales, $user);  
                        break; 

            case 2: 
                        //echo "Month"; 
                        $name = User::selectedUser($period, $date, $sales, $user);  
                        break; 

            case 3: 
                        //echo "Year"; 
                        $name = User::selectedUser($period, $date, $sales, $user);  
                        break; 
            case 4: 
                        //echo "Another"; 
                        break;

        }

    }
}
