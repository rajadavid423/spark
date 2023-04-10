@extends('layouts.app')

@section('content')

    <div class="mt-5">
        <h1 class="mb-5">Laravel Yajra Datatables</h1>

        {{$dataTable->table()}}
    </div>

@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
