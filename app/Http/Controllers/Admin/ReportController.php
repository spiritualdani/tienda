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
        $sales = Sale::orderBy('created_at', 'DESC'); 
        //dd($sales);

        $user_id = $request->user;
        $period = $request->period; 
        $specific = $request->specific;



        if(isset($user_id))
        {

            /*N*/
            $sales = $sales->where('user_id', $user_id);

      

            if(isset($specific))
            {

                $sales = $sales->whereDate('created_at', $specific);
               
            }

            else
            {
                if(isset($period))
                {
                    switch($period)
                    {    
                        case 0: 
                            $days = Carbon::today(); // con hora 0:0:0 
                            //$sales = $sales->where('created_at','>', $days);
                            break;
                        case 1:
                            $days = Carbon::today()->subDays(7); // dia 0:0:0 
                            break; 

                        case 2: 
                            $days = Carbon::now()->firstOfMonth();   
                            break;

                        case 3: 
                            $days = Carbon::now()->firstOfYear(); 
                            break; 

                        default: 
                            $days = Carbon::today();
                            break;
                    }

                    $sales = $sales->where('created_at', '>', $days);

                }

            }

            $sales = $sales->get();

          
        }

        else 
        {

            if(isset($specific))
            {

                $sales = Sale::whereDate('created_at', $specific);
                
            }

            else  
            {
                 
                switch($period)
                {
                    case 0: 
                        $days = Carbon::today(); // con hora 0:0:0 
                        //$sales = $sales->where('created_at','>', $days);
                        break;
                    case 1:
                        $days = Carbon::today()->subDays(7); // dia 0:0:0 
                        break; 

                    case 2: 
                        $days = Carbon::now()->firstOfMonth();   
                        break;

                    case 3: 
                        $days = Carbon::now()->firstOfYear(); 
                        break; 

                    default: 
                        $days = Carbon::today();
                        break;

                } 

                $sales = $sales->where('created_at', '>', $days);

            }

            $sales = $sales->get();

        }

 
       return view('superadmin.reports.index', compact('periods', 'users', 'sales', 'request'));

      
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
