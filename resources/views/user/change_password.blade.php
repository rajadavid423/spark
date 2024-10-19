@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="titles text-center bg-emp-title p-2">
                    <h6>Change Password</h6>
                </div>

                <hr class="mt-0 title_hr">
                {{--Employee Basic Details form--}}
                <div class="Employee_form mt-4">
                    <form action="{{ route('password-update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group row">
                                    <label for="current_password" class="col-lg-6">Old Password :</label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                               class="form-control form-control-sm list-group-item-Employee-secondary @error('current_password') is-invalid @enderror"
                                               placeholder="Enter Old Password" id="current_password" name="current_password"
                                               value="{{ old('current_password') }}">
                                        @error('current_password')
                                        <span class="error invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group row">
                                    <label for="new_password" class="col-lg-6">New Password :</label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                               class="form-control form-control-sm list-group-item-Employee-secondary @error('new_password') is-invalid @enderror"
                                               placeholder="Enter New Password" id="new_password" name="new_password"
                                               value="{{ old('new_password') }}">
                                        @error('new_password')
                                        <span class="error invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group row">
                                    <label for="new_confirm_password" class="col-lg-6">Confirm Password :</label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                               class="form-control form-control-sm list-group-item-Employee-secondary @error('new_confirm_password') is-invalid @enderror"
                                               placeholder="Enter Confirm Password" id="new_confirm_password" name="new_confirm_password"
                                               value="{{ old('new_confirm_password') }}">
                                        @error('new_confirm_password')
                                        <span class="error invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer border-0 mt-5 w-100 justify-content-center">
                            <a href="{{ route('home') }}">
                                <button type="button" class="btn btn-primary-custom btn-sm px-4 mx-4">Cancel</button>
                            </a>
                            <button type="submit" class="btn btn-add-primary btn-sm px-4">Update</button>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

