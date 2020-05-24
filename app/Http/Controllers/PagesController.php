<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\users;
use App\company;

use App\pricing;
use App\price_history;

use App\summarized_table;
use App\registered_user;
use App\registered_user_detail;

use App\subscription_status;
use App\pulldata;
use App\payment_request;
use App\payment;

use App\contact;
use App\request_demo;
use App\subscriber;

use Carbon\carbon;
use DB;
use Auth;

use DateTime;
use DatePeriod;
use DateInterval;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function users()
    {
        $access_type = Auth::user()->access_type;

        if ($access_type != "Admin"){
            return redirect('/');
        }

        $users_list = users::select('public_users.*', 'public_company.app_status')
            ->leftJoin('public_staff', 'public_staff.user_id', '=', 'public_users.id')
            ->leftJoin('public_company', 'public_staff.company_id', '=', 'public_company.id')
            ->get();

        return view('users', compact('users_list'));
    }

    public function contact()
    {
        $access_type = Auth::user()->access_type;

        $fromdate = Carbon::now()->year . "-" . substr('00' . Carbon::now()->month, 1, 2) . "-01";

        $todate = Carbon::now();
        $todate = substr($todate, 0, 10);

        $contact_list = contact::where('contact_date', '>=', $fromdate)->where('contact_date', '<=', $todate)->orderBy('contact_date', 'desc')->get();

        $fromdate = date_format(date_create($fromdate), "d-m-Y");
        $todate = date_format(date_create($todate), "d-m-Y");

        if ($access_type != "Admin"){
            return redirect('/');
        }

        return view('contact', compact('contact_list', 'fromdate', 'todate'));
    }

    public function request_demo()
    {
        $access_type = Auth::user()->access_type;

        $fromdate = Carbon::now()->year . "-" . substr('00' . Carbon::now()->month, 1, 2) . "-01";

        $todate = Carbon::now();
        $todate = substr($todate, 0, 10);

        $request_demo_list = request_demo::where('request_date', '>=', $fromdate)->where('request_date', '<=', $todate)->orderBy('request_date', 'desc')->get();

        $fromdate = date_format(date_create($fromdate), "d-m-Y");
        $todate = date_format(date_create($todate), "d-m-Y");

        if ($access_type != "Admin"){
            return redirect('/');
        }

        return view('request_demo', compact('request_demo_list', 'fromdate', 'todate'));
    }

    public function subscriber()
    {
        $access_type = Auth::user()->access_type;

        $fromdate = Carbon::now()->year . "-" . substr('00' . Carbon::now()->month, 1, 2) . "-01";

        $todate = Carbon::now();
        $todate = substr($todate, 0, 10);

        $subscriber_list = subscriber::where('subscription_date', '>=', $fromdate)->where('subscription_date', '<=', $todate)->orderBy('subscription_date', 'desc')->get();

        $fromdate = date_format(date_create($fromdate), "d-m-Y");
        $todate = date_format(date_create($todate), "d-m-Y");

        if ($access_type != "Admin"){
            return redirect('/');
        }

        return view('subscriber', compact('subscriber_list', 'fromdate', 'todate'));
    }

    public function company()
    {
        $access_type = Auth::user()->access_type;

        if ($access_type != "Admin"){
            return redirect('/');
        }

        $company_list = company::all();

        return view('company', compact('company_list'));
    }

    public function paymentrequest()
    {
        $access_type = Auth::user()->access_type;

        if ($access_type != "Admin"){
            return redirect('/');
        }

        $company_list = company::all();

        return view('payment_request', compact('company_list'));
    }

    public function paymentstatus()
    {
        $access_type = Auth::user()->access_type;

        if ($access_type != "Admin"){
            return redirect('/');
        }

        $payment_list = payment::all();
        $company_list = company::pluck('company_name', 'id');
		$company_list->prepend('ALL', 'ALL');
        return view('paymentstatus', compact('payment_list', 'company_list'));
    }

    public function pulldata()
    {
        $access_type = Auth::user()->access_type;

        if ($access_type != "Admin"){
            return redirect('/');
        }

        $pulldata_list = pulldata::all();

        return view('pulldata', compact('pulldata_list'));
    }

    public function pricing()
    {
        $access_type = Auth::user()->access_type;

        if ($access_type != "Admin"){
            return redirect('/');
        }

        $fromdate = carbon::now()->addYears(-1);
        $fromdate = substr($fromdate, 0, 10);

        $todate = carbon::now();
        $todate = substr($todate, 0, 10);

        $pricing = pricing::first();

        $todate = carbon::parse($todate)->addDays(1);
        $price_history_list = price_history::where('change_date', '>=', $fromdate)->where('change_date', '<=', $todate)->orderBy('change_date', 'desc')->get();

        $fromdate = date_format(date_create($fromdate), "d-m-Y");
        $todate = date_format(date_create($todate), "d-m-Y");

        return view('pricing', compact('pricing', 'price_history_list', 'fromdate', 'todate'));
    }

    public function index()
    {
        $fromdate = carbon::now()->addDays(-10);
        $fromdate = substr($fromdate, 0, 10);

        $yearparam = carbon::now();
        $yearparam = substr($yearparam, 0, 4);

        $todate = carbon::now()->addDays(1);
        $todate = substr($todate, 0, 10);

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

        $fromdate = date_format(date_create($fromdate), "d-m-Y");
        $todate = date_format(date_create($todate), "d-m-Y");

        $totalusers = summarized_table::where('column_name', '=', 'V1')->first();
        $totalusers = $totalusers->total;
        $totalcompany = summarized_table::where('column_name', '=', 'V2')->get()->first();
        $totalcompany = $totalcompany->total;
        $totalpayment_request = summarized_table::where('column_name', '=', 'V3')->get()->first();
        $totalpayment_request = $totalpayment_request->total;
        $totalreceipt = summarized_table::where('column_name', '=', 'V4')->get()->first();
        $totalreceipt = $totalreceipt->total;

        $user_subscription_list = summarized_table::whereRaw("LEFT(column_name, 2) = 'UT'")->get();

        $company_list = company::orderBy('member_counter', 'desc')->get();

        $user_health_list = summarized_table::whereRaw("LEFT(column_name, 2) = 'UH'")->get();
        $user_gender_list = summarized_table::whereRaw("LEFT(column_name, 2) = 'UG'")->get();
        $user_checkin_list = summarized_table::whereRaw("LEFT(column_name, 2) = 'UC'")->get();
        $user_age_list = summarized_table::whereRaw("LEFT(column_name, 2) = 'UA'")->get();
        $user_status_list = summarized_table::whereRaw("LEFT(column_name, 2) = 'US'")->get();

        $expired_status_month_list = summarized_table::whereRaw("LEFT(column_name, 3) = 'EPM'")->get();
        $expired_status_week_list = summarized_table::whereRaw("LEFT(column_name, 3) = 'EPW'")->get();

        $trial_color = subscription_status::where('name', '=', 'Trial')->get();
        $premium_color = subscription_status::where('name', '=', 'Premium')->get();
        $free_color = subscription_status::where('name', '=', 'Free')->get();

        $trial_color = $trial_color[0]->color_code;
        $premium_color = $premium_color[0]->color_code;
        $free_color = $free_color[0]->color_code;

        return view('welcome', compact(
            'totalcompany', 
            'totalusers', 
            'totalpayment_request', 
            'totalreceipt',

            'trial_color',
            'premium_color',
            'free_color',

            'company_list', 

            'user_health_list',
            'user_gender_list',
            'user_checkin_list',
            'user_age_list',
            'user_subscription_list',

            'user_status_list',
            'expired_status_month_list',
            'expired_status_week_list',

            'registered_user_list',

            'registered_user_detail_list',

            'fromdate',
            'todate', 

            'yearparam'
        ));
    }

    public function updatePrice(Request $request){
        $price = $request->price;

        $pricing = pricing::findOrFail('1');

        $from_price = $pricing->price;

        $pricing->price = $price;

        $pricing->update();

        $array = [
            "from_price" => $from_price,
            "to_price" => $price,
            "change_date" => carbon::now(),
        ];

        $price_history = price_history::create($array);

        return json_encode($price_history);
    }
}
