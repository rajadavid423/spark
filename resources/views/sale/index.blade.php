@extends('layouts.layout')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="titles d-flex justify-content-between">
                        <div class="mr-auto"><h5>Sale List</h5></div>
                            <a href="{{route('sale.create') }}" type="button"
                               class="btn btn-add-primary btn-sm px-4">
                                Add New
                            </a>
                    </div>
                </div>

                <div class="container-fluid mt-3">
                    <div class="table-responsive">
                        <table class="table text-center border rounded display text-nowrap" id="list_table">
                            <thead class="thead-light">
                            <tr>
                                <th>S.No</th>
                                <th>Invoice Number</th>
                                <th>Customer Name</th>
                                <th>Invoice Amount (₹)</th>
                                <th>Pending Amount (₹)</th>
                                <th>Due Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="small">
                            </tbody>
                            <tfoot>
                            <tr class="borderless">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            </tfoot>
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
                lengthMenu: [[10, 25, 50, 100, -1], ['10', '25', '50', '100', 'All']],
                ajax: {
                    url: '{{ route("sale.index") }}',
                    type: 'GET'
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'invoice_number'},
                    {data: 'customer'},
                    {data: 'total_amount'},
                    {data: 'pending_amount'},
                    {data: 'payment_due_date'},
                    {data: 'action', orderable: false},
                ],
                footerCallback: function () {
                    var api = this.api();
                    console.log(api)
                    var json = api.ajax.json();
                    console.log(json)

                    // converting to integer to find total
                    var intVal = function (i) {
                        return typeof i === 'string' ? (i.replace(/[\$,]/g, '') * 1) : (typeof i === 'number' ? i : 0);
                    };

                    // computing column Total of the complete result
                    var currentPageInvoiceAmount = api.column(3).data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var currentPagePendingAmount = api.column(4).data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    $(api.column(2).footer()).html('Total');
                    $(api.column(3).footer()).html((currentPageInvoiceAmount).toFixed(2) + ' of ' + json.total_sale_amount);
                    $(api.column(4).footer()).html((currentPagePendingAmount).toFixed(2) + ' of ' + json.total_pending_amount);
                },
            });
        });
    </script>
@endsection
