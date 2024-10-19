@extends('layouts.layout')

@section('content')
    <style>

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="titles p-1">
                    <h5>Open AI Text Classification</h5>
                </div>

                <hr class="mt-0">

                <form method="POST" class="form-validate" enctype="multipart/form-data" action="{{ route('open-ai.text-classification-api') }}">
                    @csrf
                    <div class="Employee_form mt-4">

                        <div class="row">
                            <div class="col-xl-8 col-lg-10 col-md-10">
                                <div class="form-group text-nowrap">
                                    <input type="text" required class="form-control form-control-sm" id="price" name="text" placeholder="search here..." value="{{ $text ?? '' }}">
                                </div>
                            </div>
                            <div class="col-xl-1 col-lg-1 col-md-1"></div>
                            <div class="col-xl-3 col-lg-1 col-md-1">
                                <button type="submit" class="btn btn-add-primary btn-sm px-4">Search</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div>
                     <label @if($data == 'Positive') style="color: green" @elseif($data == 'Neutral') style="color: blue" @elseif($data == 'Negative') style="color: red" @endif>{{ $data }}</label>
                </div>
            </div>
        </div>
    </div>
@endsection




