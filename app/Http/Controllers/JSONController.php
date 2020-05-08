<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\users;
use App\staff;
use App\company;
use App\payment_request;
use App\payment;
use App\registered_user;
use Carbon\carbon;

use DB;

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

    public function getpaymentfilter(Request $request){
        $company_id = $request->company_id;
        
        if ($company_id == "ALL") {
            $payment_list_filter = payment::leftJoin('company', 'payment.token', '=', 'company.registered_token')->get();
        }else{
            $company = company::findOrFail($company_id);

            $token = $company->registered_token;
    
            $payment_list_filter = payment::leftJoin('company', 'payment.token', '=', 'company.registered_token')->where('token', '=', $token)->get();
        }

        return json_encode($payment_list_filter);
    }

    public function getcompanyfilter(Request $request){

        $filterby = $request->filterby;
        $filtervalue = $request->filtervalue;
        $app_status = $request->app_status;
        
        if ($app_status != "ALL") {
            $company_list_filter = company::where($filterby, 'LIKE', '%' . $filtervalue . '%')->where('app_status', '=', $app_status)->get();
        }else{
            $company_list_filter = company::where($filterby, 'LIKE', '%' . $filtervalue . '%')->get();
        }

        return json_encode($company_list_filter);
    }

    public function getcompanydata(Request $request){
        $dataid = $request->dataid;

        $company = company::findOrFail($dataid);

        return json_encode($company);
    }

    public function getpayment_request(Request $request){
        $company_id = $request->dataid;

        $payment_request_list = payment_request::where('company_id', '=', $company_id)->get();

        return json_encode($payment_request_list);
    }

    public function getsubscriptiondata(Request $request){

        $yearparam = $request->yearparam;
        
        $registered_user_detail_list = DB::select(DB::raw("
            SELECT 'January' as 'MonthName', a.name as 'status', IFNULL(SUM(b.total), 0) total
            FROM subscription_status a
            LEFT JOIN registered_user_detail b ON a.name = b.status AND LEFT(b.date, 4) = '$yearparam' AND SUBSTR(b.date, 6, 2) = '01'
            GROUP BY a.name

            UNION ALL

            SELECT 'February' as 'MonthName', a.name as 'status', IFNULL(SUM(b.total), 0) total
            FROM subscription_status a
            LEFT JOIN registered_user_detail b ON a.name = b.status AND LEFT(b.date, 4) = '$yearparam' AND SUBSTR(b.date, 6, 2) = '02'
            GROUP BY a.name

            UNION ALL

            SELECT 'March' as 'MonthName', a.name as 'status', IFNULL(SUM(b.total), 0) total
            FROM subscription_status a
            LEFT JOIN registered_user_detail b ON a.name = b.status AND LEFT(b.date, 4) = '$yearparam' AND SUBSTR(b.date, 6, 2) = '03'
            GROUP BY a.name

            UNION ALL

            SELECT 'April' as 'MonthName', a.name as 'status', IFNULL(SUM(b.total), 0) total
            FROM subscription_status a
            LEFT JOIN registered_user_detail b ON a.name = b.status AND LEFT(b.date, 4) = '$yearparam' AND SUBSTR(b.date, 6, 2) = '04'
            GROUP BY a.name

            UNION ALL

            SELECT 'May' as 'MonthName', a.name as 'status', IFNULL(SUM(b.total), 0) total
            FROM subscription_status a
            LEFT JOIN registered_user_detail b ON a.name = b.status AND LEFT(b.date, 4) = '$yearparam' AND SUBSTR(b.date, 6, 2) = '05'
            GROUP BY a.name

            UNION ALL

            SELECT 'June' as 'MonthName', a.name as 'status', IFNULL(SUM(b.total), 0) total
            FROM subscription_status a
            LEFT JOIN registered_user_detail b ON a.name = b.status AND LEFT(b.date, 4) = '$yearparam' AND SUBSTR(b.date, 6, 2) = '06'
            GROUP BY a.name

            UNION ALL

            SELECT 'July' as 'MonthName', a.name as 'status', IFNULL(SUM(b.total), 0) total
            FROM subscription_status a
            LEFT JOIN registered_user_detail b ON a.name = b.status AND LEFT(b.date, 4) = '$yearparam' AND SUBSTR(b.date, 6, 2) = '07'
            GROUP BY a.name

            UNION ALL

            SELECT 'August' as 'MonthName', a.name as 'status', IFNULL(SUM(b.total), 0) total
            FROM subscription_status a
            LEFT JOIN registered_user_detail b ON a.name = b.status AND LEFT(b.date, 4) = '$yearparam' AND SUBSTR(b.date, 6, 2) = '08'
            GROUP BY a.name

            UNION ALL

            SELECT 'September' as 'MonthName', a.name as 'status', IFNULL(SUM(b.total), 0) total
            FROM subscription_status a
            LEFT JOIN registered_user_detail b ON a.name = b.status AND LEFT(b.date, 4) = '$yearparam' AND SUBSTR(b.date, 6, 2) = '09'
            GROUP BY a.name

            UNION ALL

            SELECT 'October' as 'MonthName', a.name as 'status', IFNULL(SUM(b.total), 0) total
            FROM subscription_status a
            LEFT JOIN registered_user_detail b ON a.name = b.status AND LEFT(b.date, 4) = '$yearparam' AND SUBSTR(b.date, 6, 2) = '10'
            GROUP BY a.name

            UNION ALL

            SELECT 'November' as 'MonthName', a.name as 'status', IFNULL(SUM(b.total), 0) total
            FROM subscription_status a
            LEFT JOIN registered_user_detail b ON a.name = b.status AND LEFT(b.date, 4) = '$yearparam' AND SUBSTR(b.date, 6, 2) = '11'
            GROUP BY a.name

            UNION ALL

            SELECT 'December' as 'MonthName', a.name as 'status', IFNULL(SUM(b.total), 0) total
            FROM subscription_status a
            LEFT JOIN registered_user_detail b ON a.name = b.status AND LEFT(b.date, 4) = '$yearparam' AND SUBSTR(b.date, 6, 2) = '12'
            GROUP BY a.name
        "));

        return json_encode($registered_user_detail_list);
    }

    public function getregisteruserdata(Request $request){

        $fromdate = $request->fromdate;
        $todate = $request->todate;
        
		$fromdate = Carbon::createFromFormat('d-m-Y', $fromdate)->format('Y-m-d');;
        $todate = Carbon::createFromFormat('d-m-Y', $todate)->format('Y-m-d');;

        $registered_user_list = registered_user::where('date', '>=', $fromdate)->where('date', '<=', $todate)->get();

        return json_encode($registered_user_list);
    }

    public function getuserscompany(Request $request){
        $dataid = $request->dataid;
        
        $users_list_filter = users::
            leftJoin('staff', 'users.id', '=', 'staff.user_id')
            ->leftJoin('company', 'staff.company_id', '=', 'company.id')
            ->where('company_id', '=', $dataid)
            ->get();

        return json_encode($users_list_filter);
    }

    public function getuserdetail(Request $request){
        $dataid = $request->dataid;

        $users_list_filter = users::select('users.*', 'company.*', 'staff.*', 'position.*', 'superior.full_name as superior_name')
            ->leftJoin('staff', 'users.id', '=', 'staff.user_id')
            ->leftJoin('company', 'staff.company_id', '=', 'company.id')
            ->leftJoin('position', 'staff.position_id', '=', 'position.id')
            ->leftJoin('staff as superior', 'staff.superior_id', '=', 'superior.id')
            ->where('users.id', '=', $dataid)
            ->get();

        return json_encode($users_list_filter[0]);
    }
}