@extends('template')

@section('content')

@php
    $i = 1;
@endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb">
                <h1>Master Data</h1>
                <ul>
                    <li>| Master Pricing</li>
                </ul>
                <div style="column-span: all;"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div style="padding-bottom: 20px;">
                        <form onsubmit="SavePriceData(this)">
                            @csrf
                            <div class="row">
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <p>Current Price / New Price</p>
                                </div>
                            </div>
                            <input type="hidden" id="real_old_price" value="{{ $pricing->price }}">
                            <div class="row">
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <div class="form-group">
                                    <input style="text-align: right;" type="text" class="form-control" id="old_price" value="{{ number_format($pricing->price, 0) }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <input style="text-align: right;" type="text" class="form-control" id="price" value="0" min="100" required>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="Update Price">Update Price</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h4 class="card-title mb-3">Price History</h4>
                    <div style="padding-bottom: 20px;">
                        <form onsubmit="FilterPriceHistory(this)">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Filter Data : </p>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control datepicker" id="from_date" value="{{ $fromdate }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control datepicker" id="to_date" value="{{ $todate }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="Filter Data">Filter Data</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="price_historyTable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10%;">No.</th>
                                        <th scope="col" style="width: 30%;">Change Date</th>
                                        <th scope="col" style="width: 30%;">From Price</th>
                                        <th scope="col" style="width: 30%;">To Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($price_history_list as $price_history)
                                        <tr>
                                            <td scope="row" style="text-align: center;">{{ $i++ }}</td>
                                            <td>{{ date_format(date_create($price_history->change_date), "d-M-Y H:i:s") }}</td>
                                            <td style="text-align: right;">{{ number_format($price_history->from_price, 0) }}</td>
                                            <td style="text-align: right;">{{ number_format($price_history->to_price, 0) }}</td>
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
    $('#price_historyTable').DataTable();
    var SavePriceData = function(e){
        event.preventDefault();
        var price = document.getElementById("price").value;
        var real_old_price = document.getElementById("real_old_price").value;

        if ((parseFloat(price) || 0) < 1000){
            swal('Failed!', 'New price data is invalid!', 'error');
            return;
        }

        if ((parseFloat(price) || 0) == (parseFloat(real_old_price) || 0)){
            swal('Failed!', 'Same price, no need to change data!', 'error');
            return;
        }

        swal({
            title: "Are you sure want to update?",
            text: "Price data will be updated, are you sure want to continue?",
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
            $.ajax({
                type: 'POST',
                url: 'updatePrice',
                data: {price: price, _token: '{{csrf_token()}}' },
                success: function (data) {
                    var vdata = JSON.parse(data);
                    FilterPriceHistory();
                    $('#old_price').val(parseFloat(vdata.to_price).toLocaleString("en"));
                    $('#real_old_price').val(vdata.to_price);
                    $('#price').val(0);
                    swal('Success!', 'Your price data sucessfully updated!', 'success');
                }
            })
        }, function (dismiss) {
            if (dismiss === 'cancel') {
                return;
            }
        });
    }
    var FilterPriceHistory = function(e) {
        if (e != null){
            event.preventDefault();
        }

        var from_date = document.getElementById("from_date").value;
        var to_date = document.getElementById("to_date").value;

        var table = document.getElementById("price_historyTable");

        var i = 1;

        if (from_date === ""){
            swal({
                type: 'error',
                title: 'From Date Empty!',
                text: 'Please select valid from date!',
                confirmButtonText: 'Dismiss',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-danger'
            });
            return;
        }

        if (to_date === ""){
            swal({
                type: 'error',
                title: 'To Date Empty!',
                text: 'Please select valid to date!',
                confirmButtonText: 'Dismiss',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-danger'
            });
            return;
        }

        $(table).find('tbody').detach();
		jQuery(table).append('<tbody>');

		$.ajax({
			type: 'POST',
			url: 'getprice_historyfilter',
			data: {from_date: from_date, to_date: to_date, _token: '{{csrf_token()}}' },
			success: function (data) {
                $(table).DataTable().clear().destroy();

				var vdata_list=JSON.parse(data);
				vdata_list.forEach(function(vdata){
					var newRow = jQuery(
							"<tr>" +
                                "<td scope='row' style='text-align: center;'>" + i + "</td>" +
                                "<td>" + moment(vdata.change_date).format('DD-MMM-YYYY hh:mm:ss') + "</td>" +
                                "<td style='text-align: right;'>" + parseFloat(vdata.from_price).toLocaleString("en") + "</td>" +
                                "<td style='text-align: right;'>" + parseFloat(vdata.to_price).toLocaleString("en") + "</td>" +
							"</tr>");
					jQuery(table).append(newRow);
                    i++;
				});

                $(table).DataTable();
			}
		});
    };
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
    });
</script>
@endsection