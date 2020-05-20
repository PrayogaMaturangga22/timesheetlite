@extends('template')

@section('content')

@php
    $i = 1;
@endphp
    <div class="breadcrumb">
        <h1>Master Data</h1>
        <ul>
            <li>| Master Subscriber</li>
        </ul>
        <div style="column-span: all;"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div style="padding-bottom: 20px;">
                        <form onsubmit="Filtersubscriber(this)">
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
                            <table class="table table-striped table-bordered" id="subscriberTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%;">No.</th>
                                        <th scope="col" style="width: 10%;">subscriber Date</th>
                                        <th scope="col" style="width: 15%;">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscriber_list as $subscriber)
                                        <tr>
                                            <td scope="row" style="text-align: center;">{{ $i++ }}</td>
                                            <td>{{ date_format(date_create($subscriber->subscription_date), "d-M-Y") }}</td>
                                            <td>{{ $subscriber->email }}</td>
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
@endsection

@section('script')
<script>
    $('#subscriberTable').DataTable();
    var Filtersubscriber = function(e) {
        event.preventDefault();

        var fromdate = document.getElementById("fromdate").value;
        var todate = document.getElementById("todate").value;

        var table = document.getElementById("subscriberTable");

        var i = 1;

        $(table).find('tbody').detach();
		jQuery(table).append('<tbody>');

		$.ajax({
			type: 'POST',
			url: 'getsubscriberfilter',
			data: {fromdate: fromdate, todate: todate, _token: '{{csrf_token()}}' },
			success: function (data) {
                $(table).DataTable().clear().destroy();
				var vdata_list=JSON.parse(data);
				vdata_list.forEach(function(vdata){
					var newRow = jQuery(
							"<tr>" +
                                "<td scope='row' style='text-align: center;'>" + i + "</td>" +
                                "<td>" + moment(vdata.subscription_date).format('DD-MMM-YYYY') + "</td>" +
                                "<td>" + vdata.email + "</td>" +
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

