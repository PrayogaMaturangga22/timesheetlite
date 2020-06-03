@extends('template')

@section('loading-bar')
<div id="loadingcontainer" style="display: none;">
    <div id="innercontainer">
        <center>
            <span id="loaders" class="spinner-glow spinner-glow-dark mr-5"></span>  
            <h4 class="card-title mb-3">Pulling your data, please wait ...</h4>
        </center>
    </div>
</div>
@endsection

@section('content')

@php
    $i = 1;
@endphp
    <div class="breadcrumb">
        <h1>Services</h1>
        <ul>
            <li>| Pull Data</li>
        </ul>
        <div style="column-span: all;"></div>
    </div>
    <div class="row" style="margin-bottom: 200px;">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div style="padding-bottom: 20px;">
                        <button type="button" onclick="PullAllData()" class="btn btn-primary" value="Pull All Data">Pull All Data</button>
                        <button type="button" onclick="RecalculateData()" class="btn btn-success" value="Pull All Data">Recalculate Data</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%;">No.</th>
                                    <th scope="col" style="width: 40%;">Table Name</th>
                                    <th scope="col" style="width: 40%;">Last Pull Date</th>
                                    <th scope="col" style="width: 15%;">Pull Data Now</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pulldata_list as $pulldata)
                                    <tr>
                                        <td scope="row" style="text-align: center;">{{ $i++ }}</td>
                                        <td>{{ $pulldata->table_name }}</td>
                                        <td id="table{{ $pulldata->table_name }}">{{ date_format(date_create($pulldata->last_pull_date), "d-M-Y H:i:s") }}</td>
                                        <td style="text-align: center;"><button class="btn btn-link btn-sm text-primary mr-2" onclick="PullRequest('{{ $pulldata->table_name }}')"><i class="nav-icon i-Right font-weight-bold"></i></a></td>
                                    </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

<script>
    var PullAllData = function(datatable){
        var datatable = 'company';
        swal({
            title: "Are you sure want to pull all data?",
            text: "All data from all tables will be pulled from server and will take some minutes to complete. Are you sure to continue?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: 'Continue!',
            cancelButtonText: "No, cancel it!",
            confirmButtonClass: 'btn btn-lg btn-success mr-5',
            cancelButtonClass: 'btn btn-lg btn-danger',
            buttonsStyling: false
        }).then(function () {
            var loadingcontainer = document.getElementById('loadingcontainer');
            loadingcontainer.style.display = "block";

            if (loadingcontainer.style.display === "block"){
                $.ajax({
                    type: 'POST',
                    url: 'getData',
                    data: {datatable: datatable, _token: '{{csrf_token()}}' },
                    success: function (data) {
                        var vdata=JSON.parse(data);
                        $('#table' + datatable).html(moment(vdata.last_pull_date).format('DD-MMM-YYYY hh:mm:ss'));

                        datatable = 'users_temp';

                        $.ajax({
                            type: 'POST',
                            url: 'getData',
                            data: {datatable: datatable, _token: '{{csrf_token()}}' },
                            success: function (data) {
                                var vdata=JSON.parse(data);
                                $('#table' + datatable).html(moment(vdata.last_pull_date).format('DD-MMM-YYYY hh:mm:ss'));

                                datatable = 'users';

                                $.ajax({
                                    type: 'POST',
                                    url: 'getData',
                                    data: {datatable: datatable, _token: '{{csrf_token()}}' },
                                    success: function (data) {
                                        var vdata=JSON.parse(data);
                                        $('#table' + datatable).html(moment(vdata.last_pull_date).format('DD-MMM-YYYY hh:mm:ss'));

                                        $.ajax({
                                            type: 'POST',
                                            url: 'getData',
                                            data: {datatable: datatable, _token: '{{csrf_token()}}' },
                                            success: function (data) {
                                                var vdata=JSON.parse(data);
                                                $('#table' + datatable).html(moment(vdata.last_pull_date).format('DD-MMM-YYYY hh:mm:ss'));

                                                datatable = 'staff';

                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'getData',
                                                    data: {datatable: datatable, _token: '{{csrf_token()}}' },
                                                    success: function (data) {
                                                        var vdata=JSON.parse(data);
                                                        $('#table' + datatable).html(moment(vdata.last_pull_date).format('DD-MMM-YYYY hh:mm:ss'));
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'getData',
                                                            data: {datatable: datatable, _token: '{{csrf_token()}}' },
                                                            success: function (data) {
                                                                var vdata=JSON.parse(data);
                                                                $('#table' + datatable).html(moment(vdata.last_pull_date).format('DD-MMM-YYYY hh:mm:ss'));

                                                                datatable = 'checkin_wfh';

                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: 'getData',
                                                                    data: {datatable: datatable, _token: '{{csrf_token()}}' },
                                                                    success: function (data) {
                                                                        var vdata=JSON.parse(data);
                                                                        $('#table' + datatable).html(moment(vdata.last_pull_date).format('DD-MMM-YYYY hh:mm:ss'));
                                                                        $.ajax({
                                                                            type: 'POST',
                                                                            url: 'getData',
                                                                            data: {datatable: datatable, _token: '{{csrf_token()}}' },
                                                                            success: function (data) {
                                                                                var vdata=JSON.parse(data);
                                                                                $('#table' + datatable).html(moment(vdata.last_pull_date).format('DD-MMM-YYYY hh:mm:ss'));

                                                                                datatable = 'health_monitoring';

                                                                                $.ajax({
                                                                                    type: 'POST',
                                                                                    url: 'getData',
                                                                                    data: {datatable: datatable, _token: '{{csrf_token()}}' },
                                                                                    success: function (data) {
                                                                                        var vdata=JSON.parse(data);
                                                                                        $('#table' + datatable).html(moment(vdata.last_pull_date).format('DD-MMM-YYYY hh:mm:ss'));
                                                                                        loadingcontainer.style.display = "none";
                                                                                        swal('Success!', 'Pull all data sucessfully!', 'success');
                                                                                    }
                                                                                })
                                                                            }
                                                                        })
                                                                    }
                                                                })
                                                            }
                                                        })
                                                    }
                                                })
                                            }
                                        })
                                    }
                                })
                            }
                        })
                    }
                })
            }
        }, function (dismiss) {
            if (dismiss === 'cancel') {
                return;
            }
        });
    };

    var RecalculateData = function(datatable){
        var datatable = 'company';
        swal({
            title: "Recalculate data?",
            text: "You can try recalculate data if the dashboard not updated or show a wrong value, continue?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: 'Continue!',
            cancelButtonText: "No, cancel it!",
            confirmButtonClass: 'btn btn-lg btn-success mr-5',
            cancelButtonClass: 'btn btn-lg btn-danger',
            buttonsStyling: false
        }).then(function () {
            var loadingcontainer = document.getElementById('loadingcontainer');
            loadingcontainer.style.display = "block";

            if (loadingcontainer.style.display === "block"){
                $.ajax({
                    type: 'POST',
                    url: 'recalculateData',
                    data: {_token: '{{csrf_token()}}' },
                    success: function (data) {
                        if (data == "success"){
                            loadingcontainer.style.display = "none";
                            swal('Success!', 'Pull all data sucessfully!', 'success');
                        }
                    }
                })
            }
        }, function (dismiss) {
            if (dismiss === 'cancel') {
                return;
            }
        });
    };

    var PullRequest = function(datatable){
        swal({
            title: "Are you sure want to pull data?",
            text: "Data will be pulled from server and will take some minutes to complete. Are you sure to continue?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: 'Continue!',
            cancelButtonText: "No, cancel it!",
            confirmButtonClass: 'btn btn-lg btn-success mr-5',
            cancelButtonClass: 'btn btn-lg btn-danger',
            buttonsStyling: false
        }).then(function () {
            var loadingcontainer = document.getElementById('loadingcontainer');
            loadingcontainer.style.display = "block";

            if (loadingcontainer.style.display === "block"){
                $.ajax({
                    type: 'POST',
                    url: 'getData',
                    data: {datatable: datatable, _token: '{{csrf_token()}}' },
                    success: function (data) {
                        var vdata=JSON.parse(data);
                        $('#table' + datatable).html(moment(vdata.last_pull_date).format('DD-MMM-YYYY hh:mm:ss'));
                        loadingcontainer.style.display = "none";
                        swal('Success!', 'Your selected data sucessfully!', 'success');
                    }
                })
            }
        }, function (dismiss) {
            if (dismiss === 'cancel') {
                return;
            }
        });
    };

</script>
@endsection