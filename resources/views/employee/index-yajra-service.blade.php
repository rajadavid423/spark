@extends('layouts.layout')

@section('content')

    <div>
        <h5 class="mb-3">Employees - Laravel Yajra Datatables</h5>

        {{$dataTable->table(['class' => 'table table-bordered'], true)}}
    </div>

@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
