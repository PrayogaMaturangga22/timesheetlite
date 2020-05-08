@extends('template')

@section('content')

@php
    $i = 1;
@endphp
    <div class="breadcrumb">
        <h1>Master Data</h1>
        <ul>
            <li>| Master Users</li>
        </ul>
        <div style="column-span: all;"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div style="padding-bottom: 20px;">
                        <form onsubmit="FilterUsers(this)">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Filter Data : </p>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6">
                                    <select name="filterby" id="filterby" class="form-control">
                                        <option value="full_name" for="filterby" selected>Full Name</option>
                                        <option value="username" for="filterby">User Name</option>
                                        <option value="email" for="filterby">E-Mail</option>
                                        <option value="company_name" for="filterby">Company Name</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="filtervalue" placeholder="Insert Keyword">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="Filter Data">Filter Data</button>
                                    </div>
                                </div>
                                <div class="col-lg-3 offset-1 col-md-4 col-sm-12" style="float: right;">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12">
                                            <label class="radio radio-primary">
                                                <input type="radio" name="user_status" value="ALL" checked><span>ALL Status</span><span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label class="radio radio-primary">
                                                <input type="radio" name="user_status" value="1"><span>Active</span><span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label class="radio radio-primary">
                                                <input type="radio" name="user_status" value="0"><span>Inactive</span><span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="usersTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 3%;">No.</th>
                                        <th scope="col" style="width: 12%;">Users Name</th>
                                        <th scope="col" style="width: 15%;">Full Name</th>
                                        <th scope="col" style="width: 15%;">Company Name</th>
                                        <th scope="col" style="width: 10%;">Birth Date</th>
                                        <th scope="col" style="width: 15%;">Telephone</th>
                                        <th scope="col" style="width: 15%;">Email</th>
                                        <th scope="col" style="width: 10%;">Status</th>
                                        <th scope="col" style="width: 5%;">Show</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users_list as $users)
                                        <tr>
                                            <td scope="row" style="text-align: center;">{{ $i++ }}</td>
                                            <td>{{ $users->username }}</td>
                                            <td>{{ $users->staff->full_name }}</td>
                                            <td>{{ $users->staff->company->company_name }}</td>
                                            <td>{{ date_format(date_create($users->staff->date_of_birth), "d-M-Y") }}</td>
                                            <td>{{ $users->staff->phone_number }}</td>
                                            <td>{{ $users->email }}</td>
                                            @if ($users->user_status == "1")
                                                <td><a class="badge badge-success m-2" href="#">Active</a></td>                            
                                            @else
                                                <td><a class="badge badge-danger m-2" href="#">Inactive</a></td>                            
                                            @endif
                                            <td style="text-align: center;"><button type="button" class="btn btn-link btn-sm text-primary mr-2" onclick="OpenModalData({{ $users->id }})"><i class="nav-icon i-Files font-weight-bold"></i></button></td>
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
                    <h5 class="modal-title" id="showModalLabel">User Detail</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <h4 class="card-title mb-3">From Staff Table</h4>
                            <table style="width: 100%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 30%;">Full Name</th>
                                        <th style="width: 70%;"><span id="modalfull_name"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">Company</th>
                                        <th style="width: 70%;"><span id="modalcompany_name"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">Position</th>
                                        <th style="width: 70%;"><span id="modalposition_name"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">Superior</th>
                                        <th style="width: 70%;"><span id="modalsuperior_name"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">Gender</th>
                                        <th style="width: 70%;"><span id="modalgender"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">Address</th>
                                        <th style="width: 70%;"><span id="modaladdress"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">Phone Number</th>
                                        <th style="width: 70%;"><span id="modalphone_number"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">DOB</th>
                                        <th style="width: 70%;"><span id="modaldate_of_birth"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">WFH Status</th>
                                        <th style="width: 70%;"><span id="modalwfh_status"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">Health Condition</th>
                                        <th style="width: 70%;"><span id="modalhealth_condition"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">Total Task</th>
                                        <th style="width: 70%;"><span id="modaltotal_task"></span> Task(s)</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">Total Done</th>
                                        <th style="width: 70%;"><span id="modaltotal_task_done"></span> Task(s)</th>
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
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <h4 class="card-title mb-3">From Users Table</h4>
                            <table style="width: 100%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 30%;">User Name</th>
                                        <th style="width: 70%;"><span id="modalusername"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">E-mail</th>
                                        <th style="width: 70%;"><span id="modalemail"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">Password</th>
                                        <th style="width: 70%;"><span id="modalpassword"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">PIN</th>
                                        <th style="width: 70%;"><span id="modalpin"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">IMEI</th>
                                        <th style="width: 70%;"><span id="modalimei"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">Device Name</th>
                                        <th style="width: 70%;"><span id="modaldevice_name"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;">User Status</th>
                                        <th style="width: 70%;"><span id="modaluser_status"></span></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
    $('#usersTable').DataTable();
    var OpenModalData = function(dataid){
		$.ajax({
			type: 'POST',
			url: 'getuserdetail',
			data: {dataid: dataid, _token: '{{csrf_token()}}' },
			success: function (data) {
				var vdata=JSON.parse(data);

                if (vdata.user_status == "1"){
                    var user_statusname = "Active";
                }else{
                    var user_statusname = "Inactive";
                }

                if (vdata.wfh_status == "1"){
                    var wfh_statusname = "Active";
                }else{
                    var wfh_statusname = "Inactive";
                }

                $('#modalfull_name').html(vdata.full_name);
                $('#modalcompany_name').html(vdata.company_name);
                $('#modalposition_name').html(vdata.position_name);
                $('#modalsuperior_name').html(vdata.superior_name);
                $('#modalgender').html(vdata.gender);
                $('#modaladdress').html(vdata.address);
                $('#modalphone_number').html(vdata.phone_number);
                $('#modaldate_of_birth').html(moment(vdata.date_of_birth).format('DD-MMM-YYYY'));
                $('#modalwfh_status').html(wfh_statusname);
                $('#modalhealth_condition').html(vdata.health_condition);
                $('#modaltotal_task').html(vdata.total_task);
                $('#modaltotal_task_done').html(vdata.total_task_done);
                $('#modalcreated_at').html(moment(vdata.created_at).format('DD-MMM-YYYY HH:mm:ss'));
                $('#modalupdated_at').html(moment(vdata.updated_at).format('DD-MMM-YYYY HH:mm:ss'));

                $('#modalusername').html(vdata.username);
                $('#modalemail').html(vdata.email);
                $('#modalpassword').html(vdata.password);
                $('#modalpin').html(vdata.pin);
                $('#modalimei').html(vdata.imei);
                $('#modaldevice_name').html(vdata.device_name);
                $('#modaluser_status').html(user_statusname);
			}
		});

        $('#showModal').modal('show');
    };
    var FilterUsers = function(e) {
        event.preventDefault();

        var user_status = $('input[name="user_status"]:checked').val();

		var selector = document.getElementById("filterby");
		var filterby = selector[selector.selectedIndex].value;
        var filtervalue = document.getElementById("filtervalue").value;

        var table = document.getElementById("usersTable");

        var i = 1;

        $(table).find('tbody').detach();
		jQuery(table).append('<tbody>');

		$.ajax({
			type: 'POST',
			url: 'getusersfilter',
			data: {filterby: filterby, filtervalue: filtervalue, user_status: user_status, _token: '{{csrf_token()}}' },
			success: function (data) {
				var vdata_list=JSON.parse(data);
				vdata_list.forEach(function(vdata){
                    if (vdata.user_status == "1"){
                        var color_user_status = "success";
                        var caption_status = "Active";
                    }else{
                        var color_user_status = "danger";
                        var caption_status = "Inactive";
                    }

					var newRow = jQuery(
							"<tr>" +
                                "<td scope='row' style='text-align: center;'>" + i + "</td>" +
                                "<td>" + vdata.username + "</td>" +
                                "<td>" + vdata.full_name + "</td>" +
                                "<td>" + vdata.company_name + "</td>" +
                                "<td>" + moment(vdata.date_of_birth).format('DD-MMM-YYYY') + "</td>" +
                                "<td>" + vdata.phone_number + "</td>" +
                                "<td>" + vdata.email + "</td>" +
                                "<td><a class='badge badge-" + color_user_status + " m-2' href='#'>" + caption_status + "</a></td>" +                        
                                "<td style='text-align: center;'><button type='button' class='btn btn-link btn-sm text-primary mr-2' onclick='OpenModalData(" + vdata.id + ")'><i class='nav-icon i-Files font-weight-bold'></i></button></td>" +
							"</tr>");
					jQuery(table).append(newRow);
                    i++;
				});
			}
		});
        return false;
    };
</script>
@endsection