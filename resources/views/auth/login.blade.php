@extends('layouts.app')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
      integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2"
        crossorigin="anonymous"></script>

<style>

    /*login page style*/
    .login_view_icon {
        background-color: white !important;
    }

    .login_card {
        background-color: inherit !important;
        border: 2px solid rgb(255 255 255) !important;
        position: inherit;
        top: 200px;
    }

    @media (max-width: 768px) {
        .login_card {
            background-color: inherit !important;
            border: 2px solid rgb(255 255 255) !important;
            position: inherit;
            top: 125px;
        }
    }

    .btn-login {
        color: #003a98;
        background-color: #ffffff;
        border-color: #ffffff;
    }

    .login_header {
        background-color: inherit !important;
    }
</style>

@section('content')
    <div class="container h-100" style="background: rgb(0,124,199);
background: linear-gradient(178deg, rgba(0,124,199,1) 0%, rgb(0,93,199) 50%, rgba(0,49,146,1) 100%);">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
                <div class="card login_card p-lg-4 p-md-3 p-1">
                    <div class="card-header border-0 login_header">
                        <h4 class="text-white">Step By Step Learning</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Email" name="email" value="{{ old('email') }}" required
                                           autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input id="password" type="password"
                                               class="form-control border-right-0 @error('password') is-invalid @enderror"
                                               placeholder="Password" name="password" required
                                               autocomplete="current-password"
                                               aria-label="Dollar amount (with dot and two decimal places)">
                                        <div class="input-group-append">
                                            <span class="input-group-text login_view_icon"><i toggle="#password"
                                                                                              class="fa fa-fw fa-eye toggle-password"></i></span>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12 text-center">
                                    <button type="submit"
                                            class="btn btn-login px-3 w-100 d-flex justify-content-between align-items-center">
                                        <span>&nbsp;</span> {{ __('Login') }}<i
                                            class="fa-solid fa-arrow-right pt-1"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".toggle-password").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endsection

