@extends('layouts.layout')

@section('content')
    <style>
        .redcolor {
            color: red;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #preview img {
            width: 150px;
        }

        .form-control {
            border: 0px;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="titles p-1">
                    <h5>View Employee Details</h5>
                </div>

                <hr class="mt-0">
                <div class="row">
                    <div class="col-xl-7 col-lg-12 col-md-12">
                        <div class="Employee_form mt-4">
                            <div class="row">
                                <div class="col-xl-5 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="employee_code">Employee Code</label>
                                        <label class="form-control">{{ $employee->employee_code ?? '-' }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                                <div class="col-xl-5 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="employee_name">Employee Name</label>
                                        <label class="form-control">{{ $employee->name ?? '-' }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                            </div>

                            <div class="row">
                                <div class="col-xl-5 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <label class="form-control">{{ $employee->phone ?? '-' }}</label>

                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                                <div class="col-xl-5 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <label class="form-control">{{ $employee->dob ? \Carbon\Carbon::parse($employee->dob)->format('d-m-Y') : '-' }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                            </div>

                            <div class="row">
                                <div class="col-xl-5 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="blood_group">Blood Group</label>
                                        <label class="form-control">{{ snakeCaseToTitleCase($employee->blood_group) ?? '-' }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                                <div class="col-xl-5 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="employee_role">Employee Role</label>
                                        <label class="form-control">{{$employee->roles && isset($employee->roles[0]) ? $employee->roles[0]->name : '-' }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                            </div>

                            <div class="row">
                                <div class="col-xl-5 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="date_of_joining">Date of Joining</label>
                                        <label class="form-control">{{ $employee->date_of_joining ? \Carbon\Carbon::parse($employee->date_of_joining)->format('d-m-Y') : '-' }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                                <div class="col-xl-5 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="reliving_date">Reliving Date</label>
                                        <label class="form-control">{{ $employee->reliving_date ? \Carbon\Carbon::parse($employee->reliving_date)->format('d-m-Y') : '-' }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                            </div>

                            <div class="row">
                                <div class="col-xl-5 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="username">Email/Username</label>
                                        <label class="form-control">{{ $employee->email ?? '-' }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                                <div class="col-xl-5 col-lg-5 col-md-5">
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                            </div>

                        </div>
                        {{--Customer Details form end--}}
                    </div>
                </div>

                <div class="modal-footer shadow  custom_footer border-0 my-5 w-100 justify-content-center">
                    <a href="{{ route('employee.index') }}">
                        <button type="button" class="btn btn-primary-custom btn-sm px-4 mx-4">Cancel</button>
                    </a>
                    <a href="{{ route('employee.edit', $employee->id) }}"><button type="submit"
                            class="btn btn-add-primary btn-sm px-4">Edit
                    </button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
