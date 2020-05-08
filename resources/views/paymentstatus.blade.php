@extends('template')

@section('content')

@php
    $i = 1;
@endphp
    <div class="breadcrumb">
        <h1>Billing</h1>
        <ul>
            <li>| Payment Status</li>
        </ul>
        <div style="column-span: all;"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div style="padding-bottom: 20px;">
                        <form onsubmit="Filterpayment(this)">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Filter Data : </p>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-6">
                                    {!! Form::select('company_id', $company_list, 'ALL', ['class'=>'form-control select2', 'placeholder' => 'Select Company . . .', 'required', 'id'=>'company_id'])  !!}
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="Filter Data">Filter Data</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="paymentTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 3%;">No.</th>
                                        <th scope="col" style="width: 15%;">Token</th>
                                        <th scope="col" style="width: 17%;">Company Name</th>
                                        <th scope="col" style="width: 18%;">Payment Period</th>
                                        <th scope="col" style="width: 18%;">Trial Period</th>
                                        <th scope="col" style="width: 10%;">Feature Type</th>
                                        <th scope="col" style="width: 13%;">Payment Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment_list as $payment)
                                        <tr>
                                            <td scope="row" style="text-align: center;">{{ $i++ }}</td>
                                            <td>{{ substr($payment->token, 0, 10) }} ... </td>
                                            <td>{{ $payment->company->company_name }}</td>
                                            <td>{{ date_format(date_create($payment->payment_start), "d-M-Y") }} s/d {{ date_format(date_create($payment->payment_end), "d-M-Y") }}</td>
                                            <td>{{ date_format(date_create($payment->trial_start), "d-M-Y") }} s/d {{ date_format(date_create($payment->trial_end), "d-M-Y") }}</td>
                                            <td>{{ $payment->feature_type }}</td>
                                            <td>{{ $payment->payment_duration }}</td>
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
                            <h4 class="card-title mb-3">From payment Table</h4>
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
    $('#paymentTable').DataTable();
    var Filterpayment = function(e) {
        event.preventDefault();

		var selector = document.getElementById("company_id");
		var company_id = selector[selector.selectedIndex].value;

        var table = document.getElementById("paymentTable");

        var i = 1;

        $(table).find('tbody').detach();
		jQuery(table).append('<tbody>');

		$.ajax({
			type: 'POST',
			url: 'getpaymentfilter',
			data: { company_id: company_id, _token: '{{csrf_token()}}' },
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
                                "<td>" + vdata.token + "</td>" +
                                "<td>" + vdata.company_name + "</td>" +
                                "<td>" + moment(vdata.payment_start).format('DD-MMM-YYYY') + " s/d " + moment(vdata.payment_end).format('DD-MMM-YYYY') + "</td>" +
                                "<td>" + moment(vdata.trial_start).format('DD-MMM-YYYY') + " s/d " + moment(vdata.trial_end).format('DD-MMM-YYYY') + "</td>" +
                                "<td>" + vdata.feature_type + "</td>" +
                                "<td>" + vdata.payment_duration + "</td>" +
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

@section('script')
<script>
	$('.select2').select2();
</script>
@endsection