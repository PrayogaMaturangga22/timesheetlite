@extends('template')

@section('content')

@php
    $i = 1;
@endphp
    <div class="breadcrumb">
        <h1>Master Data</h1>
        <ul>
            <li>| Master Company</li>
        </ul>
        <div style="column-span: all;"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div style="padding-bottom: 20px;">
                        <form onsubmit="Filtercompany(this)">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Filter Data : </p>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6">
                                    <select name="filterby" id="filterby" class="form-control">
                                        <option value="company_name" for="filterby" selected>Company Name</option>
                                        <option value="address" for="filterby">Address</option>
                                        <option value="contact" for="filterby">Contact</option>
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
                                                <input type="radio" name="app_status" value="ALL" checked><span>ALL Status</span><span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label class="radio radio-primary">
                                                <input type="radio" name="app_status" value="1"><span>Active</span><span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <label class="radio radio-primary">
                                                <input type="radio" name="app_status" value="0"><span>Inactive</span><span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="companyTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 3%;">No.</th>
                                        <th scope="col" style="width: 20%;">Company Name</th>
                                        <th scope="col" style="width: 15%;">Address</th>
                                        <th scope="col" style="width: 10%;">Contact</th>
                                        <th scope="col" style="width: 10%;">Website</th>
                                        <th scope="col" style="width: 10%;">Password</th>
                                        <th scope="col" style="width: 15%;">Member</th>
                                        <th scope="col" style="width: 15%;">Token</th>
                                        <th scope="col" style="width: 5%;">App Status</th>
                                        <th scope="col" style="width: 5%;">Trial Quota</th>
                                        <th scope="col" style="width: 5%;">Show</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($company_list as $company)
                                        <tr>
                                            <td scope="row" style="text-align: center;">{{ $i++ }}</td>
                                            <td>{{ $company->company_name }}</td>
                                            <td>{{ $company->address }}</td>
                                            <td>{{ $company->contact }}</td>
                                            <td>{{ $company->website }}</td>
                                            <td>{{ $company->password }}</td>
                                            <td>{{ $company->member_counter }} User(s)</td>
                                            <td>{{ $company->registered_token }}</td>
                                            @if ($company->app_status == "1")
                                                <td><a class="badge badge-success m-2" href="#">Active</a></td>                            
                                            @else
                                                <td><a class="badge badge-danger m-2" href="#">Inactive</a></td>                            
                                            @endif
                                            <td>{{ $company->trial_kuota }} Month(s)</td>
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
    </div>
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
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
    $('#companyTable').DataTable();
    var OpenModalData = function(dataid){
        $('#showModal').modal('show');
    };
    var Filtercompany = function(e) {
        event.preventDefault();

        var app_status = $('input[name="app_status"]:checked').val();

		var selector = document.getElementById("filterby");
		var filterby = selector[selector.selectedIndex].value;
        var filtervalue = document.getElementById("filtervalue").value;

        var table = document.getElementById("companyTable");

        var i = 1;

        $(table).find('tbody').detach();
		jQuery(table).append('<tbody>');

		$.ajax({
			type: 'POST',
			url: 'getcompanyfilter',
			data: {filterby: filterby, filtervalue: filtervalue, app_status: app_status, _token: '{{csrf_token()}}' },
			success: function (data) {
				var vdata_list=JSON.parse(data);
				vdata_list.forEach(function(vdata){
                    if (vdata.app_status == "1"){
                        var color_app_status = "success";
                    }else{
                        var color_app_status = "danger";
                    }

					var newRow = jQuery(
							"<tr>" +
                                "<td scope='row' style='text-align: center;'>" + i + "</td>" +
                                "<td>" + vdata.company_name + "</td>" +
                                "<td>" + vdata.address + "</td>" +
                                "<td>" + vdata.contact + "</td>" +
                                "<td>" + vdata.website + "</td>" +
                                "<td>" + vdata.password + "</td>" +
                                "<td>" + vdata.member_counter + " User(s)</td>" +
                                "<td>" + vdata.registered_token + "</td>" +
                                "<td><a class='badge badge-" + color_app_status + " m-2' href='#'>Active</a></td>" +                        
                                "<td>" + vdata.trial_kuota + " Month(s)</td>" +
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