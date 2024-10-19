@extends('layouts.app')

@section('content')

    <div class="mt-3">
        <h5 class="mb-3">Sales - Laravel Yajra Datatables</h5>

        {{$dataTable->table(['class' => 'table table-bordered'], true)}}
    </div>

@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
