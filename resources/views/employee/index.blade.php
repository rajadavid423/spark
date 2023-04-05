@extends('layouts.layout')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="titles d-flex justify-content-between">
                        <div class="mr-auto"><h6>Employee List</h6></div>
                            <a href="{{ route('employee.create') }}" type="button"
                               class="btn btn-add-primary btn-sm px-4">
                                Add Employee
                            </a>
                    </div>
                </div>

                <div class="container-fluid mt-3">
                    <div class="table-responsive">
                        <table class="table text-center border rounded display text-nowrap" id="list_table">
                            <thead class="thead-light">
                            <tr>
                                <th>S.No</th>
                                <th>Employee Code</th>
                                <th>Employee Name</th>
                                <th>Phone Number</th>
                                <th>Date of Joining</th>
                                <th>Role</th>
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
                    url: '{{ route("employee.index") }}',
                    type: 'GET'
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'employee_code'},
                    {data: 'name'},
                    {data: 'phone'},
                    {data: 'date_of_joining'},
                    {data: 'role'},
                    {data: 'action', orderable: false},
                ]
            });
        });
    </script>
@endsection
