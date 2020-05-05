<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\users;
use App\company;

use App\summarized_table;
use App\registered_user;
use App\registered_user_detail;

use App\subscription_status;

use Carbon\carbon;

use DB;

class PagesController extends Controller
{
    public function users()
    {
        $users_list = users::all();

        return view('users', compact('users_list'));
    }

    public function company()
    {
        $company_list = company::all();

        return view('company', compact('company_list'));
    }

    public function index()
    {
        $fromdate = carbon::now()->addMonths(-1);
        $fromdate = substr($fromdate, 0, 10);

        $yearparam = carbon::now();
        $yearparam = substr($yearparam, 0, 4);

        $todate = carbon::now();
        $todate = substr($todate, 0, 10);

        $registered_user_list = registered_user::where('date', '>=', $fromdate)->where('date', '<=', $todate)->get();

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

        $company_list = company::all();

        $user_health_list = summarized_table::whereRaw("LEFT(column_name, 2) = 'UH'")->get();
        $user_gender_list = summarized_table::whereRaw("LEFT(column_name, 2) = 'UG'")->get();
        $user_checkin_list = summarized_table::whereRaw("LEFT(column_name, 2) = 'UC'")->get();
        $user_age_list = summarized_table::whereRaw("LEFT(column_name, 2) = 'UA'")->get();
        $user_status_list = summarized_table::whereRaw("LEFT(column_name, 2) = 'US'")->get();
        $expired_status_list = summarized_table::whereRaw("LEFT(column_name, 2) = 'EP'")->get();

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
            'expired_status_list',

            'registered_user_list',

            'registered_user_detail_list',

            'fromdate',
            'todate', 

            'yearparam'
        ));
    }
}
