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

.form-control{
    border: 0;
}
    </style>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="titles p-1">
                    <div class="d-flex justify-content-between">
                        <div><h5>View Sale Bill</h5></div>
                    </div>
                </div>

                <hr class="mt-0">

                <div class="row">
                    <div class="col-xl-9 col-lg-12 col-md-12">
                        <div class="Employee_form mt-4">
                            <div class="row">
                                <div class="col-xl-4 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="">Invoice Number</label>
                                        <label class="form-control">{{ $sale->invoice_number ?? '-' }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                                <div class="col-xl-4 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="service_date">Invoice Date</label>
                                        <input type="date" disabled class="form-control" value="{{ $sale->date ?? '-' }}">
                                    </div>
                                </div>

                                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                            </div>

                            <div class="row">
                                <div class="col-xl-4 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="customer">Customer</label>
                                        <label class="form-control">{{ $sale->customer ? $sale->customer->name : '-' }}</label>
                                    </div>
                                </div>

                                <div class="col-xl-1 col-lg-1 col-md-1"></div>

                                <div class="col-xl-4 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="employee_name">Employee Name</label>
                                        <label class="form-control">{{ $sale->employee ? $sale->employee->name : '-' }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="Employee_form mt-4">
                            <div class="d-flex justify-content-between">
                                <div class=""><h5>Product Details</h5></div>
                                <div class=""></div>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-borderless text-nowrap">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Rate (₹)</th>
                                    <th>Amount (₹)</th>
                                </tr>
                                </thead>
                                <tbody id="appendInputContent">
                                @if($sale && $sale->saleDetails)
                                    @foreach($sale->saleDetails as $product)
                                        <tr class='appendedDivContent'>
                                            <td>{{ $product->category ? $product->category->name : '-'  }}</td>
                                            <td>{{ $product->product ? $product->product->name : '-'  }}</td>
                                            <td>{{$product->quantity}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->amount}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="Employee_form mt-4">
                            <div class="row">
                                <div class="col-xl-4 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="material_cost">Total Amount (₹)</label>
                                        <input type="text" step="any" disabled class="form-control"
                                               value="{{ $sale->total_amount ?? '-' }}">
                                    </div>
                                </div>

                                <div class="col-xl-1 col-lg-1 col-md-1"></div>

                                <div class="col-xl-4 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="paid_amount">Paid Amount (₹)</label>
                                        <input type="text" step="any" disabled class="form-control"
                                               value="{{ $sale->paid_amount ?? '-' }}">
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-1 col-md-1"></div>
                            </div>

                            <div class="row">
                                <div class="col-xl-4 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="pending_amount">Pending Amount (₹)</label>
                                        <input type="text" step="any" disabled class="form-control"
                                               value="{{ $sale->pending_amount ?? '-' }}">
                                    </div>
                                </div>

                                <div class="col-xl-1 col-lg-1 col-md-1"></div>

                                <div class="col-xl-4 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="payment_mode">Payment Mode</label>
                                        <label class="form-control">{{ $sale->payment_mode ?? '-' }}</label>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-1 col-md-1"></div>
                            </div>

                            <div class="row">
                                <div class="col-xl-4 col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="payment_due_date"> Payment Due Date </label>
                                        <input type="date" step="any" disabled class="form-control"
                                               value="{{ $sale->payment_due_date ?? '-' }}">
                                    </div>
                                </div>

                                <div class="col-xl-1 col-lg-1 col-md-1"></div>

                                <div class="col-xl-4 col-lg-5 col-md-5">

                                </div>

                                <div class="col-xl-3 col-lg-1 col-md-1"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer shadow  custom_footer border-0 my-5 w-100 justify-content-center">
                <a href="{{ route('sale.index') }}">
                    <button type="button" class="btn btn-primary-custom btn-sm px-4 mx-5">Cancel</button>
                </a>
                <a href="{{ route('sale.edit', $sale->id) }}"><button type="submit"
                        class="btn btn-add-primary btn-sm px-4">Edit
                    </button></a>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection




