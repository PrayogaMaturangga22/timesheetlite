@extends('template')

@section('content')

@php
    $i = 1;
@endphp
    <div class="breadcrumb">
        <h1>Master Data</h1>
        <ul>
            <li>| Master Request Demo</li>
        </ul>
        <div style="column-span: all;"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div style="padding-bottom: 20px;">
                        <form onsubmit="Filterrequest_demo(this)">
                            @csrf
                            <div class="row">
                                <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
                                    <p>Periode : </p>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control datepicker" id="fromdate" placeholder="Select Date" value="{{ $fromdate }}" readonly style="text-align: center;">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control datepicker" id="todate" placeholder="Select Date" value="{{ $todate }}" readonly style="text-align: center;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <select name="filterby" id="filterby" class="form-control">
                                            <option value="name" for="filterby" selected>Name</option>
                                            <option value="email" for="filterby">E - mail</option>
                                            <option value="company_name" for="filterby">Company Name</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="filtervalue" placeholder="Insert Keyword">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="Filter Data">Filter Data</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="request_demoTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%;">No.</th>
                                        <th scope="col" style="width: 10%;">Request Date</th>
                                        <th scope="col" style="width: 15%;">Name</th>
                                        <th scope="col" style="width: 15%;">Phone Number</th>
                                        <th scope="col" style="width: 20%;">E- mail</th>
                                        <th scope="col" style="width: 20%;">Company Name</th>
                                        <th scope="col" style="width: 5%;">Show</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($request_demo_list as $request_demo)
                                        <tr>
                                            <td scope="row" style="text-align: center;">{{ $i++ }}</td>
                                            <td>{{ date_format(date_create($request_demo->request_date), "d-M-Y") }}</td>
                                            <td>{{ $request_demo->name }}</td>
                                            <td>{{ $request_demo->phone_number }}</td>
                                            <td>{{ $request_demo->email }}</td>
                                            <td>{{ $request_demo->company_name }}</td>
                                            <td style="text-align: center;"><button type="button" class="btn btn-link btn-sm text-primary mr-2" onclick="OpenModalData({{ $request_demo->id }})"><i class="nav-icon i-Files font-weight-bold"></i></button></td>
                                        </tr>                                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Request Demo Detail</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <h4 class="card-title mb-3">From Staff Table</h4>
                    <table style="width: 100%" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 30%;">Request Date Date</th>
                                <th style="width: 70%;"><span id="modalrequest_date"></span></th>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Name</th>
                                <th style="width: 70%;"><span id="modalname"></span></th>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Phone Number</th>
                                <th style="width: 70%;"><span id="modalphone_number"></span></th>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Company Name</th>
                                <th style="width: 70%;"><span id="modalcompany_name"></span></th>
                            </tr>
                            <tr>
                                <th style="width: 30%;">E - Mail</th>
                                <th style="width: 70%;"><span id="modalemail"></span></th>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Created At</th>
                                <th style="width: 70%;"><span id="modalcreated_at"></span></th>
                            </tr>

                            <tr>
                                <th style="width: 30%;">Last Updated</th>
                                <th style="width: 70%;"><span id="modalupdated_at"></span></th>
                            </tr>
                        </thead>
                    </table>
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
    $('#request_demoTable').DataTable();
    var OpenModalData = function(dataid){
		$.ajax({
			type: 'POST',
			url: 'getrequest_demodetail',
			data: {dataid: dataid, _token: '{{csrf_token()}}' },
			success: function (data) {
				var vdata=JSON.parse(data);

                $('#modalrequest_date').html(moment(vdata.request_date).format('DD-MMM-YYYY'));
                $('#modalname').html(vdata.name);
                $('#modalphone_number').html(vdata.phone_number);
                $('#modalemail').html(vdata.email);
                $('#modalcompany_name').html(vdata.company_name);
                $('#modalcreated_at').html(moment(vdata.created_at).format('DD-MMM-YYYY HH:mm:ss'));
                $('#modalupdated_at').html(moment(vdata.updated_at).format('DD-MMM-YYYY HH:mm:ss'));
			}
		});

        $('#showModal').modal('show');
    };
    var Filterrequest_demo = function(e) {
        event.preventDefault();

		var selector = document.getElementById("filterby");
		var filterby = selector[selector.selectedIndex].value;
        var filtervalue = document.getElementById("filtervalue").value;

        var fromdate = document.getElementById("fromdate").value;
        var todate = document.getElementById("todate").value;

        var table = document.getElementById("request_demoTable");

        var i = 1;

        $(table).find('tbody').detach();
		jQuery(table).append('<tbody>');

		$.ajax({
			type: 'POST',
			url: 'getrequest_demofilter',
			data: {filterby: filterby, filtervalue: filtervalue, fromdate: fromdate, todate: todate, _token: '{{csrf_token()}}' },
			success: function (data) {
                $(table).DataTable().clear().destroy();
				var vdata_list=JSON.parse(data);
				vdata_list.forEach(function(vdata){
					var newRow = jQuery(
							"<tr>" +
                                "<td scope='row' style='text-align: center;'>" + i + "</td>" +
                                "<td>" + moment(vdata.request_date).format('DD-MMM-YYYY') + "</td>" +
                                "<td>" + vdata.name + "</td>" +
                                "<td>" + vdata.phone_number + "</td>" +
                                "<td>" + vdata.email + "</td>" +
                                "<td>" + vdata.company_name + "</td>" +
                                "<td style='text-align: center;'><button type='button' class='btn btn-link btn-sm text-primary mr-2' onclick='OpenModalData(" + vdata.id + ")'><i class='nav-icon i-Files font-weight-bold'></i></button></td>" +
							"</tr>");
					jQuery(table).append(newRow);
                    i++;
				});

                $(table).DataTable();
			}
		});
        return false;
    };

    $('.datepicker').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    });	
</script>
@endsection

