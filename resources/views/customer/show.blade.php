@extends('layouts.layout')

@section('content')
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #preview img {
            width: 150px;
        }

        .showPageData .form-control {
            border: 0px solid transparent;
        }

        #list_table tr td a:focus {
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgb(0 123 255 / 0%);
        }

        .showPageData a.active {
            border: 1px solid #F29B0B;
            background: #F29B0B !important;
            color: white !important;
        }

        .showPageData .nav-link {
            border: 1px solid #F29B0B;
            color: #F29B0B !important;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="titles">
                    <div class="d-flex justify-content-between">
                        <div><h5>View Customer Details</h5></div>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="row showPageData my-2">
                    <div class="col-md-12">
                        <div class="tab-content">
                            <div id="home" class="tab-pane active">
                                <div class="row">
                                    <div class="col-xl-9 col-lg-12 col-md-12">
                                        <div class="Employee_form mt-4">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-12">
                                                    <div class="form-group text-nowrap">
                                                        <label for="customer_code">Customer Code</label>
                                                        <label
                                                            class="form-control">{{ $customer->customer_code ?? '-' }}</label>
                                                    </div>
                                                </div>

                                                <div class="col-xl-1 col-lg-1 col-md-12"></div>

                                                <div class="col-xl-4 col-lg-4 col-md-12">
                                                    <div class="form-group text-nowrap">
                                                        <label for="name">Name</label>
                                                        <label
                                                            class="form-control">{{ $customer->name ?? '-' }}</label>
                                                    </div>
                                                </div>

                                                <div class="col-xl-3 col-lg-3 col-md-12"></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-12">
                                                    <div class="form-group text-nowrap">
                                                        <label for="dob">Primary Number</label>
                                                        <label
                                                            class="form-control">{{ $customer->mobile ?? '-' }}</label>
                                                    </div>
                                                </div>

                                                <div class="col-xl-1 col-lg-1 col-md-12"></div>

                                                <div class="col-xl-4 col-lg-4 col-md-12">
                                                    <div class="form-group text-nowrap">
                                                        <label for="in_charge_phone_number_two">Secondary Number</label>
                                                        <label
                                                            class="form-control">{{ $customer->mobile2 ?? '-' }}</label>
                                                    </div>
                                                </div>

                                                <div class="col-xl-3 col-lg-3 col-md-12"></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-12">
                                                    <div class="form-group text-nowrap">
                                                        <label for="date">Date</label>
                                                        <label class="form-control">{{ Carbon\Carbon::parse($customer->date)->format('d-m-Y') ?? '-' }}</label>
                                                    </div>
                                                </div>

                                                <div class="col-xl-1 col-lg-1 col-md-12"></div>
                                                <div class="col-xl-4 col-lg-4 col-md-12"></div>
                                                <div class="col-xl-3 col-lg-3 col-md-12"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="modal-footer shadow  custom_footer border-0 my-5 w-100 justify-content-center">
                                    <a href="{{ route('customer.index') }}">
                                        <button type="button" class="btn btn-primary-custom btn-sm px-4 mx-5">Cancel
                                        </button>
                                    </a>
                                    @can('Edit Customer')
                                        <a href="{{ route('customer.edit', $customer->id) }}">
                                            <button type="submit"
                                                    class="btn btn-add-primary  btn-sm px-4">Edit
                                            </button>
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




