@extends('template')

@section('content')

@php
    $i = 1;
    $z = 1;
@endphp

    <div class="breadcrumb">
        <h1>Dashboard</h1>
        <ul>
            <li>| Main Dashboard</li>
        </ul>
        <div style="column-span: all;"></div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="p-4 rounded d-flex align-items-center bg-primary text-white"><i class="i-Cool-Guy text-32 mr-3"></i>
                <div>
                    <h4 class="text-18 mb-1 text-white">Total Users</h4><span>Total: {{ $totalusers }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="p-4 rounded d-flex align-items-center bg-success text-white"><i class="i-Factory text-32 mr-3"></i>
                <div>
                    <h4 class="text-18 mb-1 text-white">Total Companies</h4><span>Total: {{ $totalcompany }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="p-4 rounded d-flex align-items-center bg-danger text-white"><i class="i-Big-Data text-32 mr-3"></i>
                <div>
                    <h4 class="text-18 mb-1 text-white">Total Payment Req Issued</h4><span>Total: {{ $totalpayment_request }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="p-4 rounded d-flex align-items-center bg-warning text-white"><i class="i-Big-Data text-32 mr-3"></i>
                <div>
                    <h4 class="text-18 mb-1 text-white">Total Receipt Received</h4><span>Total: {{ $totalreceipt }}</span>
                </div>
            </div>
        </div>
    </div>        
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Registered User</h4>
                    <form onsubmit="LoadRegisterChart()">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                <p class="text-12 mb-1">Filter From / To</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6" style="padding: 5px;">
                                <input id="fromdateregister" type="text" style="text-align: center;" class="form-control datepicker" value="{{ $fromdate }}" readonly required>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6" style="padding: 5px;">
                                <input id="todateregister" type="text" style="text-align: center;" class="form-control datepicker" value="{{ $todate }}" readonly required>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12" style="padding: 5px;">
                                <button style="submit" class="btn btn-primary">Filter Data</button>
                            </div>
                        </div>
                    </form>
                    <div style="padding-top: 20px; padding-bottom: 20px;">
                        <canvas id="LineChart" height="50px" style="min-height:300px"></canvas>
                    </div>                
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Total Subscription Status - Line Chart</h4>
                    <form onsubmit="LoadSubscriptionChart()">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                <p class="text-12 mb-1">Filter By Year</p>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6" style="padding: 5px;">
                                <select id="yearparam" class="form-control" readonly required>
                                    @for ($z = 0; $z < 100; $z++)
                                        @php
                                            $yearloop = 2000 + $z;
                                        @endphp
                                        <option for="yearparam" value="{{ $yearloop }}" <?php if($yearloop == $yearparam) { echo "selected"; }?>>{{ $yearloop }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12" style="padding: 5px;">
                                <button style="submit" class="btn btn-primary">Filter Data</button>
                            </div>
                        </div>
                    </form>
                    <div style="padding-top: 20px; padding-bottom: 20px;">
                        <canvas id="LineChart2" height="103px" style="min-height: 100%"></canvas>
                    </div>                
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Total Subscription Status - Pie Chart</h4>
                    <div class="row">
                        <div class="col-md-12" style="padding-top: 20px; padding-bottom: 20px;">
                            <canvas id="PieChart1" height="120px"></canvas>
                        </div>                
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 70%;">Subscription Status</th>
                                            <th scope="col" style="width: 30%;">Total Users</th>
                                        </tr>
                                        @foreach ($user_subscription_list as $user_subscription)
                                            <tr>
                                                <th style="background-color: {{ $user_subscription->color_code }}; color: white">{{ $user_subscription->column_desc }}</th>
                                                <th style="background-color: {{ $user_subscription->color_code }}; color: white">{{ $user_subscription->total }}</th>
                                            </tr>
                                        @endforeach
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Users Demography</h4>
                    <div class="row">
                        <div class="col-md-3" style="padding-top: 20px; padding-bottom: 20px;">
                            <h6 class="card-title mb-3">User Age</h6>
                            <canvas id="BarChart2" height="150px"></canvas>
                        </div>                
                        <div class="col-md-3" style="padding-top: 20px; padding-bottom: 20px;">
                            <h6 class="card-title mb-3">User Check In</h6>
                            <canvas id="BarChart3" height="150px"></canvas>
                        </div>                
                        <div class="col-md-3" style="padding-top: 20px; padding-bottom: 20px;">
                            <h6 class="card-title mb-3">User Gender</h6>
                            <canvas id="BarChart4" height="150px"></canvas>
                        </div>                
                        <div class="col-md-3" style="padding-top: 20px; padding-bottom: 20px;">
                            <h6 class="card-title mb-3">User Health</h6>
                            <canvas id="BarChart5" height="150px"></canvas>
                        </div>                
                    </div>                
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Company Active / Inactive</h4>
                    <div class="row">
                        <div class="col-md-12" style="padding-top: 20px; padding-bottom: 20px;">
                            <canvas id="DoughnutChart1" height="150px"></canvas>
                        </div>                
                    </div>                
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="ul-widget__head">
                        <div class="ul-widget__head-label">
                            <h4 class="card-title mb-3">Company Expired Soon</h4>
                        </div>
                        <div class="ul-widget__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold ul-widget-nav-tabs-line" role="tablist">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#content1" role="tab" aria-selected="true" id="WeeklyTab">Weekly</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#content2" role="tab" aria-selected="false" id="MonthlyTab">Monthly</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ul-widget__body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="content1">
                                <div class="col-md-12" style="padding-top: 20px; padding-bottom: 20px;">
                                    <canvas id="HorizontalBarChart2" height="150px"></canvas>
                                </div>                
                            </div>
                            <div class="tab-pane" id="content2">
                                <div class="col-md-12" style="padding-top: 20px; padding-bottom: 20px;">
                                    <canvas id="HorizontalBarChart3" height="150px"></canvas>
                                </div>                
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Total Company >< Users</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="companyTable">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%;">No.</th>
                                    <th scope="col" style="width: 15%;">Kode Perusahaan</th>
                                    <th scope="col" style="width: 30%;">Company Name</th>
                                    <th scope="col" style="width: 15%;">Total Users</th>
                                    <th scope="col" style="width: 10%;">App Status</th>
                                    <th scope="col" style="width: 10%;">Show</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($company_list as $company)
                                    <tr>
                                        <td scope="row" style="text-align: center;">{{ $i++ }}</td>
                                        <td>{{ $company->kode_perusahaan }}</td>
                                        <td>{{ $company->company_name }}</td>
                                        <td style="text-align: right;">{{ $company->member_counter }} User(s)</td>
                                        @if ($company->app_status == "1")
                                            <td><a class="badge badge-success" href="#">Active</td>
                                        @else
                                            <td><a class="badge badge-danger" href="#">Inactive</td>
                                        @endif
                                        <td style="text-align: center;"><button type="button" class="btn btn-link btn-sm text-primary mr-2" onclick="OpenModalData({{ $company->id }})"><i class="nav-icon i-Files font-weight-bold"></i></button></td>
                                    </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="userscompanyModal" tabindex="-1" role="dialog" aria-labelledby="userscompanyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userscompanyModalLabel">List User From Company</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <table style="width: 100%" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 30%;">Kode Perusahaan</th>
                                <th style="width: 70%;"><span id="modalkode_perusahaan"></span></th>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Company Name</th>
                                <th style="width: 70%;"><span id="modalcompany_name"></span></th>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Total Users</th>
                                <th style="width: 70%;"><span id="modalmember_counter"></span> User(s)</th>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Company Status</th>
                                <th style="width: 70%;"><span id="modalapp_status"></span></th>
                            </tr>
                        </thead>
                    </table>
                    <h4 class="card-title mb-3">Users List Detail</h4>
                    <div class="table-responsive">
                        <table style="width: 100%" class="table table-bordered table-striped" id="companyUsersTable">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No.</th>
                                    <th style="width: 20%;">User Name</th>
                                    <th style="width: 20%;">Full Name</th>
                                    <th style="width: 20%;">Phone Number</th>
                                    <th style="width: 28%;">Email</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>    
@endsection

@section('script')
<script>
    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
        var content1 = document.getElementById("content1");
        var content2 = document.getElementById("content2");

        activeTab = e.target.id;

        if (activeTab == "WeeklyTab"){
            $("#content1").hide();
            $("#content1").fadeIn(1000);
        }else{
            $("#content2").hide();
            $("#content2").fadeIn(1000);
        }
    })
    
    var OpenModalData = function(dataid){
        var i = 1;
        var table = document.getElementById('companyUsersTable');

        $.ajax({
            type: 'POST',
            url: 'getcompanydata',
            data: {dataid: dataid, _token: '{{csrf_token()}}' },
            success: function (data) {
                var vdata=JSON.parse(data);

                $('#modalkode_perusahaan').html(vdata.kode_perusahaan);
                $('#modalcompany_name').html(vdata.company_name);
                $('#modalmember_counter').html(vdata.member_counter);

                if (vdata.app_status == "1"){
                    $('#modalapp_status').html("Active");
                }else{
                    $('#modalapp_status').html("Inactive");
                }

                $.ajax({
                    type: 'POST',
                    url: 'getuserscompany',
                    data: {dataid: dataid, _token: '{{csrf_token()}}' },
                    success: function (data) {
                        $(table).DataTable().clear().destroy();

                        var vdata_list=JSON.parse(data);
                        vdata_list.forEach(function(vdata){
                            var newRow = jQuery(
                                    "<tr>" +
                                        "<td scope='row' style='text-align: center;'>" + i + "</td>" +
                                        "<td>" + vdata.username + "</td>" +
                                        "<td>" + vdata.full_name + "</td>" +
                                        "<td>" + vdata.phone_number + "</td>" +
                                        "<td>" + vdata.email + "</td>" +
                                    "</tr>");
                            jQuery(table).append(newRow);
                            i++;
                        });
                        $(table).DataTable();
                    }
                });
            }
        });

        $('#userscompanyModal').modal('show'); 
    }

    $(document).ready(function() {
        $('#companyTable').DataTable();
        InitializeChart();
    })


    var configdata;
    var LoadRegisterChart = function() {
        event.preventDefault();

        var fromdate = document.getElementById("fromdateregister").value;
        var todate = document.getElementById("todateregister").value;

        var labels = [];
        var datas = [];

        if (fromdate === ""){
            swal({
                type: 'error',
                title: 'From Period Empty!',
                text: 'Please select valid date!',
                confirmButtonText: 'Dismiss',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-danger'
            });
            return;
        }

        if (todate === ""){
            swal({
                type: 'error',
                title: 'To Period Empty!',
                text: 'Please select valid date!',
                confirmButtonText: 'Dismiss',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-danger'
            });
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'getregisteruserdata',
            data: {fromdate: fromdate, todate: todate, _token: '{{csrf_token()}}' },
            success: function (data) {
                var vdata_list=JSON.parse(data);
                vdata_list.forEach(function(vdata){
                    labels.push("" + moment(vdata.date).format('DD-MMM-YY') + "");
                })
                vdata_list.forEach(function(vdata){
                    datas.push(vdata.total);
                })
                addData(LineChart, labels, datas);
            }
        });

    }

    var LoadSubscriptionChart = function() {
        event.preventDefault();

        var yearparam = document.getElementById("yearparam").value;

        var vdatapremium = [];
        var vdatatrial = [];
        var vdatafree = [];

        if (yearparam === ""){
            swal({
                type: 'error',
                title: 'From Period Empty!',
                text: 'Please select valid date!',
                confirmButtonText: 'Dismiss',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-danger'
            });
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'getsubscriptiondata',
            data: {yearparam: yearparam, _token: '{{csrf_token()}}' },
            success: function (data) {
                var vdata_list=JSON.parse(data);
                vdata_list.forEach(function(vdata){
                    if (vdata.status == "Premium"){
                        vdatapremium.push(vdata.total);
                    }
                    if (vdata.status == "Free"){
                        vdatafree.push(vdata.total);
                    }
                    if (vdata.status == "Trial"){
                        vdatatrial.push(vdata.total);
                    }
                })
                addData2(LineChart, vdatapremium, vdatatrial, vdatafree);
            }
        });

    }

    function addData(chartID, vlabel, vdata) {
        var ctx = document.getElementById('LineChart').getContext('2d');
        var configdata = {
            type: 'line',
            data: {
                labels: vlabel,
                datasets: [{
                    label: "Registered User Data",
                    backgroundColor: '#EBE0FF',
                    borderColor: '#AA7FFF',
                    data: vdata
                }]
            },

            options: {
                legend: {
                    position: 'bottom'
                },
                responsive: false,
                maintainAspectRatio: false,
            }
        }
        var myChart = new Chart(ctx, configdata);
        myChart.update();
    }

    function addData2(chartID, vdatapremium, vdatatrial, vdatafree) {
        var ctx = document.getElementById('LineChart2').getContext('2d');

        var configdata = {
            type: 'line',
            data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                label: "Premium",
                borderColor: "{{ $premium_color }}",
                pointBorderColor: "{{ $premium_color }}",
                pointBackgroundColor: "{{ $premium_color }}",
                pointBorderWidth: 1,
                fill: false,
                data: vdatapremium,
            }, {
                label: "Free",
                borderColor: "{{ $free_color }}",
                pointBorderColor: "{{ $free_color }}",
                pointBackgroundColor: "{{ $free_color }}",
                pointBorderWidth: 1,
                fill: false,
                data: vdatafree,
            }, {
                label: "Trial",
                borderColor: "{{ $trial_color }}",
                pointBorderColor: "{{ $trial_color }}",
                pointBackgroundColor: "{{ $trial_color }}",
                pointBorderWidth: 1,
                fill: false,
                data: vdatatrial,
            }]
            },
            options: {
                legend: {
                    position: 'bottom'
                },
            }
        }

        var myChart = new Chart(ctx, configdata);
        myChart.update();
    }

    function InitializeChart(){
        // CHART COMPANY >< USERS
        var ctx = document.getElementById("PieChart1");
        var data = {
                labels: [
                    @foreach ($user_subscription_list as $user_subscription)
                        "{{ str_replace('Total ', '', $user_subscription->column_desc) }}" ,
                    @endforeach
                ],
                datasets: [{
                data: [
                    @foreach ($user_subscription_list as $user_subscription)
                        {{ $user_subscription->total }} ,
                    @endforeach
                ],
                backgroundColor: [
                    @foreach ($user_subscription_list as $user_subscription)
                        "{{ $user_subscription->color_code }}" ,
                    @endforeach
                ],
            }]
        };
        var PieChart1 = new Chart(ctx, {
            type: 'pie',
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: data,
            options: {
                legend: {
                    display: false
                },
            }
        });
        // END OF CHART COMPANY >< USERS

        // CHART AGE
        var ctx = document.getElementById("BarChart2");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($user_age_list as $user_age)
                        "{{ $user_age->column_desc }}",
                    @endforeach
                ],
                datasets: [{
                    label: '# of Total',
                    data: [
                        @foreach ($user_age_list as $user_age)
                            {{ $user_age->total }},
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach ($user_age_list as $user_age)
                            "{{ $user_age->color_code }}",
                        @endforeach
                    ],
                }]
            },
            options: {
                legend: {
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                    }]
                }
            }
        });
        // END OF CHART AGE

        // CHART CHECK IN
        var ctx = document.getElementById("BarChart3");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($user_checkin_list as $user_checkin)
                        "{{ $user_checkin->column_desc }}",
                    @endforeach
                ],
                datasets: [{
                    label: '# of Total',
                    data: [
                        @foreach ($user_checkin_list as $user_checkin)
                            {{ $user_checkin->total }},
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach ($user_checkin_list as $user_checkin)
                            "{{ $user_checkin->color_code }}",
                        @endforeach
                    ],
                }]
            },
            options: {
                legend: {
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                    }]
                }
            }
        });
        // END OF CHART CHECK IN        

        // CHART GENDER
        var ctx = document.getElementById("BarChart4");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($user_gender_list as $user_gender)
                        "{{ $user_gender->column_desc }}",
                    @endforeach
                ],
                datasets: [{
                    label: '# of Total',
                    data: [
                        @foreach ($user_gender_list as $user_gender)
                            {{ $user_gender->total }},
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach ($user_gender_list as $user_gender)
                            "{{ $user_gender->color_code }}",
                        @endforeach
                    ],
                }]
            },
            options: {
                legend: {
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                    }]
                }
            }
        });
        // END OF CHART GENDER

        // CHART HEALTH
        var ctx = document.getElementById("BarChart5");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($user_health_list as $user_health)
                        "{{ $user_health->column_desc }}",
                    @endforeach
                ],
                datasets: [{
                    label: '# of Total',
                    data: [
                        @foreach ($user_health_list as $user_health)
                            {{ $user_health->total }},
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach ($user_health_list as $user_health)
                            "{{ $user_health->color_code }}",
                        @endforeach
                    ],
                }]
            },
            options: {
                legend: {
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                    }]
                }
            }
        });
        // END OF CHART HEALTH

        // REGISTERED USER CHART
        var ctx = document.getElementById('LineChart').getContext('2d');
        configdata = {
            type: 'line',
            data: {
            labels: [
                @foreach ($registered_user_list as $registered_user)
                    "{{ date_format(date_create($registered_user->date), 'd-M-y') }}",
                @endforeach
            ],
            datasets: [{
                label: "Registered User Data",
                backgroundColor: '#EBE0FF',
                borderColor: '#AA7FFF',
                data: [
                    @foreach ($registered_user_list as $registered_user)
                        {{ $registered_user->total }},
                    @endforeach
                ]
            }]
            },
            options: {
                legend: {
                    position: 'bottom'
                },
                responsive: true,
                maintainAspectRatio: false
            }
        }

        var LineChart = new Chart(ctx, configdata);

        // END OF REGISTERED USER CHART

        // SUBSCRIPTION LINE CHART
        var ctx = document.getElementById("LineChart2");

        var configdata = {
            type: 'line',
            data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                label: "Premium",
                borderColor: "{{ $premium_color }}",
                pointBorderColor: "{{ $premium_color }}",
                pointBackgroundColor: "{{ $premium_color }}",
                pointBorderWidth: 1,
                fill: false,
                data: [
                    @foreach ($registered_user_detail_list as $registered_user_detail)
                        @if ($registered_user_detail->status == "Premium")
                            {{ $registered_user_detail->total }},
                        @endif
                    @endforeach
                ]
            }, {
                label: "Free",
                borderColor: "{{ $free_color }}",
                pointBorderColor: "{{ $free_color }}",
                pointBackgroundColor: "{{ $free_color }}",
                pointBorderWidth: 1,
                fill: false,
                data: [
                    @foreach ($registered_user_detail_list as $registered_user_detail)
                        @if ($registered_user_detail->status == "Free")
                            {{ $registered_user_detail->total }},
                        @endif
                    @endforeach
                ]
            }, {
                label: "Trial",
                borderColor: "{{ $trial_color }}",
                pointBorderColor: "{{ $trial_color }}",
                pointBackgroundColor: "{{ $trial_color }}",
                pointBorderWidth: 1,
                fill: false,
                data: [
                    @foreach ($registered_user_detail_list as $registered_user_detail)
                        @if ($registered_user_detail->status == "Trial")
                            {{ $registered_user_detail->total }},
                        @endif
                    @endforeach
                ]
            }]
            },
            options: {
                legend: {
                    position: 'bottom'
                },
            }
        }

        var lineChart = new Chart(ctx, configdata);
        // END OF SUBSCRIPTION LINE CHART

        var ctx = document.getElementById("DoughnutChart1");
        var data = {
            labels: [
                @foreach ($user_status_list as $user_status)
                    "{{ $user_status->column_desc }}",
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach ($user_status_list as $user_status)
                        {{ $user_status->total }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach ($user_status_list as $user_status)
                        "{{ $user_status->color_code }}",
                    @endforeach
                ],
            }]
        };
        var DoughnutChart1 = new Chart(ctx, {
            type: 'doughnut',
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: data
        }); // Pie chart

        var ctx = document.getElementById("HorizontalBarChart2");
        var mybarChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: [
                    @foreach ($expired_status_week_list as $expired_status_week)
                        "{{ $expired_status_week->column_desc }}",
                    @endforeach                
                ],
                datasets: [{
                    label: '# of Total Expired',
                    backgroundColor: [
                        @foreach ($expired_status_week_list as $expired_status_week)
                            "{{ $expired_status_week->color_code }}",
                        @endforeach                
                    ],
                    data: [
                        @foreach ($expired_status_week_list as $expired_status_week)
                            {{ $expired_status_week->total }} ,
                        @endforeach                
                        0
                    ]
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctx = document.getElementById("HorizontalBarChart3");
        var mybarChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: [
                    @foreach ($expired_status_month_list as $expired_status_month)
                        "{{ $expired_status_month->column_desc }}",
                    @endforeach                
                ],
                datasets: [{
                    label: '# of Total Expired',
                    backgroundColor: [
                        @foreach ($expired_status_month_list as $expired_status_month)
                            "{{ $expired_status_month->color_code }}",
                        @endforeach                
                    ],
                    data: [
                        @foreach ($expired_status_month_list as $expired_status_month)
                            {{ $expired_status_month->total }} ,
                        @endforeach                
                        0
                    ]
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }

    $('.datepicker').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    });	
</script>
@endsection