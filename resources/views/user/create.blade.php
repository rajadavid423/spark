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

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 36px;
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 37px;
            user-select: none;
            -webkit-user-select: none;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 6px;
            right: 1px;
            width: 20px;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="titles p-1">
                    <h5>{{ $employee ? 'Edit' : 'Create' }} Employee</h5>
                </div>

                <hr class="mt-0">

                <form method="POST" class="form-validate" enctype="multipart/form-data"
                      action="{{ $employee ? route('employee.update', $employee->id) : route('employee.store') }}">
                    @csrf
                    @if($employee) @method('PUT') @endif
                    <div class="Employee_form mt-4">
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label for="employee_code">Employee Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm @error('employee_code') is-invalid @enderror" id="employee_code" name="employee_code"
                                           value="{{ $employee ? old('employee_code', $employee->employee_code) : $sequenceNo }}" readonly @if($employee) disabled @endif>
                                    @error('employee_code')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-1 col-lg-1 col-md-1"></div>

                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label for="employee_name">Employee Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name"
                                           value="{{ $employee ? old('name', $employee->name) : old('name') }}" required>
                                    @error('name')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-1 col-md-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" id="phone" name="phone"
                                           value="{{ $employee ? old('phone', $employee->phone) : old('phone') }}" required>
                                    @error('phone')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-1 col-lg-1 col-md-1"></div>

                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" class="form-control form-control-sm @error('dob') is-invalid @enderror"
                                           id="dob" name="dob" value="{{ $employee ? old('dob', $employee->dob) : old('dob') }}">
                                    @error('dob')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-1 col-md-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label for="blood_group">Blood Group</label>
                                    <select class="form-control form-control-sm select2 @error('blood_group') is-invalid @enderror" style="width: 100%;"
                                             id="blood_group" name="blood_group">
                                        @foreach(BLOOD_GROUPS as $bloodGroup)
                                            <option value="{{$bloodGroup}}" {{ (old('blood_group') == $bloodGroup || ($employee && $employee->blood_group == $bloodGroup)) ? 'selected' :  '' }}>{{snakeCaseToTitleCase($bloodGroup)}}</option>
                                        @endforeach
                                    </select>
                                    @error('blood_group')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-1 col-lg-1 col-md-1"></div>

                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label for="employee_role">Employee Role <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm select2 @error('role_id') is-invalid @enderror" style="width: 100%;"
                                            required id="role_id" name="role_id">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" @if(isset($admin->roles[0]) && $admin->roles[0]->id == $role->id) selected @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-1 col-md-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label for="date_of_joining">Date of Joining </label>
                                    <input type="date" class="form-control form-control-sm @error('date_of_joining') is-invalid @enderror"
                                           id="date_of_joining" name="date_of_joining"
                                           value="{{ $employee ? old('date_of_joining', $employee->date_of_joining) : old('date_of_joining') }}">
                                    @error('date_of_joining')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-xl-1 col-lg-1 col-md-1"></div>

                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label for="reliving_date">Reliving Date</label>
                                    <input type="date" class="form-control form-control-sm @error('reliving_date') is-invalid @enderror" id="reliving_date" name="reliving_date"
                                           value="{{ $employee ? old('reliving_date', $employee->reliving_date) : old('reliving_date') }}">
                                    @error('reliving_date')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-1 col-md-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label for="username">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email"
                                           value="{{ $employee ? old('email', $employee->email) : old('email') }}">
                                    @error('email')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-1 col-lg-1 col-md-1"></div>

                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label for="password">Password @if(!$employee)<span class="text-danger">*</span>@endif</label>
                                    <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password"
                                           value="">
                                    @error('password')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-1 col-md-1"></div>
                        </div>

                    </div>
                    <div class="modal-footer shadow  custom_footer border-0 my-5 w-100 justify-content-center">
                        <a href="{{ route('employee.index') }}">
                            <button type="button" class="btn btn-primary-custom btn-sm px-4 mx-4">Cancel</button>
                        </a>
                        <button type="submit"
                                class="btn btn-add-primary btn-sm px-4">{{ $employee ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




