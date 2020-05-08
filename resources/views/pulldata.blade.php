@extends('template')

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
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
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
                                            <td>{{ date_format(date_create($pulldata->last_pull_date), "d-M-Y H:i:s") }}</td>
                                            <td style="text-align: center;"><a class="btn btn-link btn-sm text-primary mr-2" href="{{ URL::asset('getData/' . $pulldata->table_name) }}"><i class="nav-icon i-Right font-weight-bold"></i></a></td>
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