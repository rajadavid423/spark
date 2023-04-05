@extends('layouts.layout')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="titles d-flex justify-content-between">
                        <div class="mr-auto"><h6>Customer List</h6></div>
                        @can('Create Customer')
                            <a href="{{route('customer.create') }}" type="button" class="btn btn-add-primary btn-sm px-4">
                                Add Customer
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="container-fluid mt-3">
                    <div class="table-responsive">
                        <table class="table text-center border rounded display text-nowrap" id="list_table">
                            <thead class="thead-light">
                            <tr>
                                <th>S.No</th>
                                <th>Customer&nbsp;Code</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="small">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(function () {
            $('#list_table').DataTable({
                 "columnDefs": [
                     {"className": "dt-center", "targets": "_all"}
                 ],
                 processing: true,
                 serverSide: true,
                ajax: {
                    url: '{{ route("customer.index") }}',
                    type: 'GET'
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'customer_code'},
                    {data: 'name'},
                    {data: 'mobile'},
                    {data: 'action', orderable: false},
                ]
            });
        });
    </script>
@endsection
