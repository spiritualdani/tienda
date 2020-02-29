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
        $periods = ['day', 'week', 'month', 'year', 'another'];  
        $users = User::orderBy('name', 'ASC')->pluck('name', 'id');
        $sales = "null"; 
        //dd($sales);

        $user_id = $request->user;
        $period = $request->period; 
        $specific = $request->specific;



        if(isset($user_id))
        {
            

            if(isset($specific))
            {

                $sales = Sale::where('user_id', $user_id)->whereDate('created_at', $specific)->get();
                return view('superadmin.reports.index', compact('periods', 'users', 'sales'));
            }

            else
            {

                switch($period)
                {    
                    case 0: 
                        $date = Carbon::now();
                        $sales =  Sale::where('user_id', $user_id)->whereDate('created_at', $date)->get();
                        return view('superadmin.reports.index', compact('periods', 'users', 'sales'));
                        break;
                    case 1:
                        $date = Carbon::now()->subDays(7);
                        $now = Carbon::now();
                        dd($now);
                        $sales = Sale::where('user_id', $user_id)->where('created_at', '<', $now)->where('created_at', '>=', $date)->get();
                        return view('superadmin.reports.index', compact('periods', 'users', 'sales'));
                        break; 

                    case 2: 
                        /*
                        $date = Carbon::now()->subDays(30)->toDateTimeString(); 
                        $date = substr($date, 0,10);
                        */
                        $date = Carbon::now(); 
                        $date = substr($date, 5, 2);
                        $sales = Sale::where('user_id', $user_id)->whereMonth('created_at', $date)->get();
                        return view('superadmin.reports.index', compact('periods', 'users', 'sales'));

                    case 3: 
                        $date = Carbon::now();
                        $date = substr($date, 0,4);
                        $date = Carbon::create($date);
                        $sales = Sale::where('user_id', $user_id)->where('created_at', '>=',$date)->get();
                        return view('superadmin.reports.index', compact('periods', 'users', 'sales'));
                        break; 
                }
            }
          
        }

        else 
        {

            if(isset($specific))
            {

                $sales = Sale::whereDate('created_at', $specific)->get();
                return view('superadmin.reports.index', compact('periods', 'users', 'sales'));
            }

            else  
            {
                 
                switch($period)
                {
                    case 0: 
                        $date = Carbon::now()->toDateTimeString(); 
                        $date = substr($date,0,10); 

                        $sales = Sale::whereDate('created_at', $date)->get();
                        return view('superadmin.reports.index', compact('periods', 'users', 'sales'));
                        break; 

                    case 1: 
                        $date = Carbon::now()->subDays(7); 
                        // ejemplo : 2020-02-28  $date = 2020-02-21
                        $sales = Sale::where('created_at', '<', Carbon::now())->where('created_at', '>=', $date)->get();
                        return view('superadmin.reports.index', compact('periods', 'users', 'sales'));
                        break; 

                    case 2: 
                        /*
                        $date = Carbon::now()->subDays(30)->toDateTimeString();
                        $date = substr($date, 0, 10);
                        */

                        $date = Carbon::now(); 
                        $date = substr($date, 5, 2);
                        $sales = Sale::whereMonth('created_at', $date)->get();
                        return view('superadmin.reports.index', compact('periods', 'users', 'sales'));

                        break; 

                    case 3: 
                        $date = Carbon::now(); 
                        $date = substr($date,0,4);
                        $date = Carbon::create($date);
                        $sales = Sale::where('created_at', '>=',$date)->get();
                        return view('superadmin.reports.index', compact('periods', 'users', 'sales'));

                        break;

                } 

            }
        }
 
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
        //
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

    }
}
