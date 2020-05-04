@extends('template')

@section('content')

@php
    $i = 1;
@endphp

    <div class="breadcrumb">
        <h1>Dashboard</h1>
        <ul>
            <li>| Main Dashboard</li>
        </ul>
        <div style="column-span: all;"></div>
        <button type="button" name="Refresh" onclick="reloadmasterdata()" class="btn btn-success"><i class="i-Refresh text-12"></i> Refresh</button>
    </div>
    <div class="separator-breadcrumb border-top"></div>
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
        <div class="col-md-8">
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
                        <canvas id="LineChart" height="117px"></canvas>
                    </div>                
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Total Subscription Status & Chart</h4>
                    <div class="row">
                        <div class="col-md-12" style="padding-top: 20px; padding-bottom: 20px;">
                            <canvas id="PieChart1" height="140px"></canvas>
                        </div>                
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 70%;">Subscription Status</th>
                                            <th scope="col" style="width: 30%;">Total Users</th>
                                        </tr>
                                        <tr>
                                            <th style="background-color: green; color: white">Premium Users</th>
                                            <th style="background-color: green; color: white">{{ $totalpremium }}</th>
                                        </tr>
                                        <tr>
                                            <th style="background-color: red; color: white">Free Users</th>
                                            <th style="background-color: red; color: white">{{ $totalfree }}</th>
                                        </tr>
                                        <tr>
                                            <th style="background-color: orange; color: white">Triak Users</th>
                                            <th style="background-color: orange; color: white">{{ $totaltrial }}</th>
                                        </tr>
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
                            <h6 class="card-title mb-3">User Sex</h6>
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
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">User Active / Inactive</h4>
                    <div class="row">
                        <div class="col-md-12" style="padding-top: 20px; padding-bottom: 20px;">
                            <canvas id="DoughnutChart1" height="150px"></canvas>
                        </div>                
                    </div>                
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">User Expired Soon</h4>
                    <div class="row">
                        <div class="col-md-12" style="padding-top: 20px; padding-bottom: 20px;">
                            <canvas id="DoughnutChart2" height="150px"></canvas>
                        </div>                
                    </div>                
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Total Company >< Users</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="companyTable">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%;">No.</th>
                                    <th scope="col" style="width: 45%;">Company Name</th>
                                    <th scope="col" style="width: 25%;">Total Users</th>
                                    <th scope="col" style="width: 10%;">Show</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($company_list as $company)
                                    <tr>
                                        <td scope="row" style="text-align: center;">{{ $i++ }}</td>
                                        <td>{{ $company->company_name }}</td>
                                        <td style="text-align: right;">{{ $company->member_counter }}</td>
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
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Modal title</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere autem consequuntur unde? Dolore, dolor iusto.</p>
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

    var OpenModalData = function(dataid){
        
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
            }
        }
        var myChart = new Chart(ctx, configdata);
        myChart.update();
    }

    function InitializeChart(){
        // CHART COMPANY >< USERS
        var ctx = document.getElementById("PieChart1");
        var data = {
                labels: ["Premium Users", "Free Users", "Trial Users"],
                datasets: [{
                data: [{{ $totalpremium }}, {{ $totalfree }}, {{ $totaltrial }}],
                backgroundColor: ["#008000", "#FF0000", "#FFA500"],
                hoverBackgroundColor: ["#777877", "#777877", "#777877"]
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
                        "{{ $user_age->age_number }}",
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
                        "{{ $user_checkin->checkin_status }}",
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

        // CHART SEX
        var ctx = document.getElementById("BarChart4");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($user_sex_list as $user_sex)
                        "{{ $user_sex->sex }}",
                    @endforeach
                ],
                datasets: [{
                    label: '# of Total',
                    data: [
                        @foreach ($user_sex_list as $user_sex)
                            {{ $user_sex->total }},
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach ($user_sex_list as $user_sex)
                            "{{ $user_sex->color_code }}",
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
        // END OF CHART SEX

        // CHART HEALTH
        var ctx = document.getElementById("BarChart5");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($user_health_list as $user_health)
                        "{{ $user_health->health_status }}",
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
            }
        }

        var LineChart = new Chart(ctx, configdata);

        // END OF REGISTERED USER CHART

        var ctx = document.getElementById("DoughnutChart1");
        var data = {
            labels: [
                @foreach ($user_status_list as $user_status)
                    "{{ $user_status->user_status }}",
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

        var ctx = document.getElementById("DoughnutChart2");
        var data = {
            labels: [
                @foreach ($expired_status_list as $expired_status)
                    "{{ $expired_status->expired_status }}",
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach ($expired_status_list as $expired_status)
                        {{ $expired_status->total }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach ($expired_status_list as $expired_status)
                        "{{ $expired_status->color_code }}",
                    @endforeach
                ],
            }]
        };
        var DoughnutChart2 = new Chart(ctx, {
            type: 'doughnut',
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: data
        }); // Pie chart
    }

    $('.datepicker').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    });	
</script>
@endsection