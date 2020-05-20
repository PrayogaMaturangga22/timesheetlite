<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\users;
use App\staff;
use App\company;
use App\payment_request;
use App\payment;
use App\registered_user;
use App\price_history;
use Carbon\carbon;

use App\contact;
use App\request_demo;
use App\subscriber;

use DB;

use DateTime;
use DatePeriod;
use DateInterval;

class JSONController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getusersfilter(Request $request){

        $filterby = $request->filterby;
        $filtervalue = $request->filtervalue;
        $app_status = $request->app_status;
        
        if ($app_status != "ALL") {
            $users_list_filter = users::select('public_users.*', 'public_company.app_status', 'public_staff.phone_number', 'public_staff.full_name', 'public_company.company_name')
                ->leftJoin('public_staff', 'public_users.id', '=', 'public_staff.user_id')
                ->leftJoin('public_company', 'public_staff.company_id', '=', 'public_company.id')
                ->where($filterby, 'LIKE', '%' . $filtervalue . '%')
                ->where('app_status', '=', $app_status)
                ->get();
        }else{
            $users_list_filter = users::select('public_users.*', 'public_company.app_status', 'public_staff.phone_number', 'public_staff.full_name', 'public_company.company_name')
                ->leftJoin('public_staff', 'public_users.id', '=', 'public_staff.user_id')
                ->leftJoin('public_company', 'public_staff.company_id', '=', 'public_company.id')
                ->where($filterby, 'LIKE', '%' . $filtervalue . '%')
                ->get();
        }

        return json_encode($users_list_filter);
    }

    public function getcontactfilter(Request $request){

        $filterby = $request->filterby;
        $filtervalue = $request->filtervalue;
        
        $fromdate = $request->fromdate;
        $todate = $request->todate;

		$fromdate = Carbon::createFromFormat('d-m-Y', $fromdate)->format('Y-m-d');
        $todate = Carbon::createFromFormat('d-m-Y', $todate)->format('Y-m-d');

        $contact_list_filter = contact::
                        where('contact_date', '>=', $fromdate)->
                        where($filterby, 'LIKE', '%' . $filtervalue . '%')->
                        where('contact_date', '<=', $todate)->get();

        return json_encode($contact_list_filter);
    }

    public function getrequest_demofilter(Request $request){

        $filterby = $request->filterby;
        $filtervalue = $request->filtervalue;
        
        $fromdate = $request->fromdate;
        $todate = $request->todate;

		$fromdate = Carbon::createFromFormat('d-m-Y', $fromdate)->format('Y-m-d');
        $todate = Carbon::createFromFormat('d-m-Y', $todate)->format('Y-m-d');

        $request_demo_list_filter = request_demo::
                        where('request_date', '>=', $fromdate)->
                        where($filterby, 'LIKE', '%' . $filtervalue . '%')->
                        where('request_date', '<=', $todate)->get();

        return json_encode($request_demo_list_filter);
    }

    public function getsubscriberfilter(Request $request){

        $fromdate = $request->fromdate;
        $todate = $request->todate;

		$fromdate = Carbon::createFromFormat('d-m-Y', $fromdate)->format('Y-m-d');
        $todate = Carbon::createFromFormat('d-m-Y', $todate)->format('Y-m-d');

        $subscriber_list_filter = subscriber::
                        where('subscription_date', '>=', $fromdate)->
                        where('subscription_date', '<=', $todate)->get();

        return json_encode($subscriber_list_filter);
    }

    public function getpaymentfilter(Request $request){
        $company_id = $request->company_id;
        
        if ($company_id == "ALL") {
            $payment_list_filter = payment::leftJoin('public_company', 'payment.token', '=', 'public_company.registered_token')->get();
        }else{
            $company = company::findOrFail($company_id);

            $token = $company->registered_token;
    
            $payment_list_filter = payment::leftJoin('public_company', 'payment.token', '=', 'public_company.registered_token')->where('token', '=', $token)->get();
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
        
		$fromdate = Carbon::createFromFormat('d-m-Y', $fromdate)->format('Y-m-d');
        $todate = Carbon::createFromFormat('d-m-Y', $todate)->format('Y-m-d');

        // --insert dummy data for chart no date --
        
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod(new DateTime($fromdate), $interval, new DateTime($todate));

        foreach ($period as $date) {
            $registered_user = registered_user::where('date', '=', $date)->first();

            $data_array = [
                "date" => $date,
                "total" => 0
            ];

            if ($registered_user == null){
                $registered_user = registered_user::create($data_array);
            }

        }
        
        // -----------------------------------------

        $registered_user_list = registered_user::where('date', '>=', $fromdate)->where('date', '<=', $todate)->orderBy('date', 'asc')->get();

        return json_encode($registered_user_list);
    }

    public function getuserscompany(Request $request){
        $dataid = $request->dataid;
        
        $users_list_filter = users::
            leftJoin('public_staff', 'public_users.id', '=', 'public_staff.user_id')
            ->leftJoin('public_company', 'public_staff.company_id', '=', 'public_company.id')
            ->where('company_id', '=', $dataid)
            ->get();

        return json_encode($users_list_filter);
    }

    public function getrequest_demodetail(Request $request){
        $dataid = $request->dataid;

        $request_demo_list_filter = request_demo::findOrFail($dataid);

        return json_encode($request_demo_list_filter);
    }

    public function getuserdetail(Request $request){
        $dataid = $request->dataid;

        $users_list_filter = users::select('public_users.*', 'public_company.*', 'public_staff.*', 'superior.full_name as superior_name')
            ->leftJoin('public_staff', 'public_users.id', '=', 'public_staff.user_id')
            ->leftJoin('public_company', 'public_staff.company_id', '=', 'public_company.id')
            ->leftJoin('public_staff as superior', 'public_staff.superior_id', '=', 'superior.id')
            ->where('public_users.id', '=', $dataid)
            ->get();

        return json_encode($users_list_filter[0]);
    }

    public function getcontactdetail(Request $request){
        $dataid = $request->dataid;

        $contact_list_filter = contact::findOrFail($dataid);

        return json_encode($contact_list_filter);
    }

    public function getprice_historyfilter(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $from_date = Carbon::createFromFormat('d-m-Y', $from_date)->format('Y-m-d');
        $to_date = Carbon::createFromFormat('d-m-Y', $to_date)->format('Y-m-d');

        $to_date = carbon::parse($to_date)->addDays(1);

        $price_history_list = price_history::where('change_date', '>=', $from_date)->where('change_date', '<=', $to_date)->orderBy('change_date', 'desc')->get();

        return json_encode($price_history_list);
    }
}