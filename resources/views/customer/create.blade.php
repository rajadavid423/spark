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
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="titles p-1">
                    <h5>{{ $customer ? 'Edit ' : 'Create' }} Customer</h5>
                </div>

                <hr class="mt-0">

                <form method="POST" class="form-validate" enctype="multipart/form-data"
                      action="{{ $customer ? route('customer.update', $customer->id) : route('customer.store') }}">
                    @csrf
                    @if($customer)
                        @method('PUT')
                    @endif
                    <div class="Employee_form mt-4">
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group text-nowrap">
                                    <label for="customer_code">Customer Code <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control form-control-sm select2 @error('customer_code') is-invalid @enderror"
                                           id="customer_code" name="customer_code"
                                           value="{{ $customer ? old('customer_code', $customer->customer_code) : $sequenceNo }}"
                                           readonly @if($customer) disabled @endif>
                                    @error('customer_code')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-1 col-lg-1 col-md-1"></div>

                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group text-nowrap">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                           id="name" name="name"
                                           class="form-control form-control-sm @error('name') is-invalid @enderror"
                                           value="{{ $customer ? old('name', $customer->name) : old('name') }}"
                                           required>
                                    @error('name')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-1 col-md-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group text-nowrap">
                                    <label for="dob">Primary Number <span class="text-danger">*</span></label>
                                    <input type="number" required
                                           class="form-control form-control-sm @error('mobile') is-invalid @enderror"
                                           id="mobile" name="mobile"
                                           value="{{ $customer ? old('mobile', $customer->mobile) : old('mobile') }}">
                                    @error('mobile')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-1 col-lg-1 col-md-1"></div>

                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group text-nowrap">
                                    <label for="in_charge_phone_number_two">Secondary Number</label>
                                    <input type="number"
                                           class="form-control form-control-sm @error('mobile2') is-invalid @enderror"
                                           id="mobile2" name="mobile2"
                                           value="{{ $customer ? old('mobile2', $customer->mobile2) : old('mobile2') }}">
                                    @error('mobile2')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-1 col-md-1"></div>
                        </div>


                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group text-nowrap">
                                    <label for="date">Date</label>
                                    <input type="date"
                                           class="form-control form-control-sm select2 @error('date') is-invalid @enderror"
                                           id="date" name="date"
                                           value="{{ $customer ? old('date', $customer->date) : (old('date') ?? now()->format('Y-m-d')) }}">
                                    @error('date')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-1 col-lg-1 col-md-1"></div>

                            <div class="col-xl-4 col-lg-5 col-md-5">

                            </div>

                            <div class="col-xl-3 col-lg-1 col-md-1"></div>
                        </div>
                    </div>

                    <div class="modal-footer shadow  custom_footer border-0 my-5 w-100 justify-content-center">
                        <a href="{{ route('customer.index') }}">
                            <button type="button" class="btn btn-primary-custom btn-sm px-4">Cancel</button>
                        </a>
                        <button type="submit" class="btn btn-add-primary btn-sm px-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




