@extends('layouts.layout')

@section('content')
    <style>
        .box label {
            position: relative;
            cursor: pointer;
        }

        .box label input {
            display: none;
        }

        .box label span {
            position: relative;
            display: inline-block;
            margin: 0px 14px 0px 0px;
            font-size: 17px;
            padding: 1px;
            width: 58px;
            background: #e8e8e8;
            border: 1px solid #70707063;
            color: #707070b8;
            border-radius: 4px;
        }

        .box label input:checked ~ span {
            color: #fff;
            border: 1px solid #3a996f;
        }

        .box label input:checked ~ span:before {
            content: '';
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background: #008eff;
            z-index: -1;
            /*filter: blur(10px);*/
        }

        .box label input:checked ~ span:after {
            content: '';
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background: #008eff;
            z-index: -1;
            /*filter: blur(15px);*/
        }

        .box label input:checked ~ span.yes {
            color: white;
            /*border-color:#62ff00;*/
            background-color: #3a996f;
        }

        .box label input:checked ~ span.yes:before,
        .box label input:checked ~ span.yes:after {
            /*background:#62ff00;*/
        }

        .box label input:checked ~ span.no {
            color: white;
            border-color: #ff0000;
            background-color: red;
        }

        .box label input:checked ~ span.no:before,
        .box label input:checked ~ span.no:after {
            background: #ff0000;
        }

    </style>
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h5>Dashboard</h5>

            <div class="container-fluid mt-4">
                <div class="card border-0">
                    <div class="row adjustWidth mt-4 mb-4">
                        <div class="col-xl-3 col-lg-6 col-md-6">
                            <div class="card dashBoardBox1 customMargin shadow">
                                <div class="card-body p-xl-2 p-lg-2 p-md-3">
                                    <h6 class="card-title mb-1">Total Customers</h6>
                                    <h6 class="card-text text-right mt-5">
                                        {{$customer}}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6">
                            <div class="card dashBoardBox2 customMargin shadow">
                                <div class="card-body p-xl-2 p-lg-2 p-md-3">
                                    <h6 class="card-title mb-1">Total Employees</h6>
                                    <h6 class="card-text text-right mt-5">
                                        {{$employee}}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6">
                            @can('Manager Dashboard')
                            <div class="card dashBoardBox3 customMargin shadow">
                                <div class="card-body p-xl-2 p-lg-2 p-md-3">
                                    <h6 class="card-title mb-1">Total Products</h6>
                                    <h6 class="card-text text-right text-success mt-5">
                                         {{$product}}</h6>
                                </div>
                            </div>
                            @endcan
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6">
                            @can('Manager Dashboard')
                            <div class="card dashBoardBox4 customMargin shadow">
                                <div class="card-body p-xl-2 p-lg-2 p-md-3">
                                    <h6 class="card-title mb-1">Supplier Pending Amount</h6>
                                    <h6 class="card-text text-right text-danger mt-5">
                                        ₹ {{0}}</h6>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>

                @if($user->can('Manager Dashboard'))

                @elseif($user->can('Employee Dashboard'))

                @else
                    <h1>Welcome!!!</h1>
                @endif

            </div>
        </div>
    </div>
@endsection
