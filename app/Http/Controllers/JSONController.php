<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\users;
use App\staff;
use App\registered_user;

use Carbon\carbon;

class JSONController extends Controller
{
    public function getusersfilter(Request $request){

        $filterby = $request->filterby;
        $filtervalue = $request->filtervalue;
        $user_status = $request->user_status;
        
        if ($user_status != "ALL") {
            $users_list_filter = users::
                leftJoin('staff', 'users.id', '=', 'staff.user_id')
                ->leftJoin('company', 'staff.company_id', '=', 'company.id')
                ->where($filterby, 'LIKE', '%' . $filtervalue . '%')
                ->where('user_status', '=', $user_status)
                ->get();
        }else{
            $users_list_filter = users::
                leftJoin('staff', 'users.id', '=', 'staff.user_id')
                ->leftJoin('company', 'staff.company_id', '=', 'company.id')
                ->where($filterby, 'LIKE', '%' . $filtervalue . '%')
                ->get();
        }

        return json_encode($users_list_filter);
    }

    public function getregisteruserdata(Request $request){

        $fromdate = $request->fromdate;
        $todate = $request->todate;
        
		$fromdate = Carbon::createFromFormat('d-m-Y', $fromdate)->format('Y-m-d');;
        $todate = Carbon::createFromFormat('d-m-Y', $todate)->format('Y-m-d');;

        $registered_user_list = registered_user::where('date', '>=', $fromdate)->where('date', '<=', $todate)->get();

        return json_encode($registered_user_list);
    }
}