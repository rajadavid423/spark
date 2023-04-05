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


    </style>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="titles p-1">
                    <h5>{{ $sale ? 'Edit ' : 'Add' }} Sale Bill</h5>
                </div>

                <hr class="mt-0">

                <form method="POST" class="form-validate" enctype="multipart/form-data"
                      action="{{ $sale ? route('sale.update', $sale->id) : route('sale.store') }}">
                    @csrf
                    @if($sale) @method('PUT') @endif
                    <div class="row">
                        <div class="col-xl-9 col-lg-12 col-md-12">
                            <div class="Employee_form mt-4">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-5 col-md-5">
                                        <div class="form-group">
                                            <label for="invoice_number">Invoice Number</label>
                                            <input type="text"
                                                   class="form-control @error('invoice_number') is-invalid @enderror"
                                                   id="invoice_number" name="invoice_number"
                                                   value="{{ $sale ? old('invoice_number', $sale->invoice_number) : $sequenceNo }}"
                                                   readonly @if($sale) disabled @endif>
                                            @error('invoice_number')
                                            <span class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-1 col-lg-1 col-md-1"></div>

                                    <div class="col-xl-4 col-lg-5 col-md-5">
                                        <div class="form-group">
                                            <label for="date">Invoice Date</label>
                                            <input type="date" required
                                                   class="form-control @error('date') is-invalid @enderror"
                                                   id="date" name="date"
                                                   value="{{ $sale ? old('date', $sale->date) : (old('date') ?? now()->format('Y-m-d')) }}">
                                            @error('date')
                                            <span class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-1 col-md-1"></div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-4 col-lg-5 col-md-5">
                                        <div class="form-group">
                                            <label for="customer_id">Customer</label>
                                            <select class="form-control select2 @error('customer_id') is-invalid @enderror"  style="width: 100%;" required id="customer_id" name="customer_id">
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ (old('customer_id') == $customer->id || ($sale && $sale->customer_id == $customer->id)) ? 'selected' :  '' }}>{{ ucfirst($customer->name) }}</option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                            <span class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-1 col-lg-1 col-md-1"></div>

                                    <div class="col-xl-4 col-lg-5 col-md-5">
                                        <div class="form-group">
                                            <label for="employee_id">Employee</label>
                                            <select class="form-control select2 @error('employee_id') is-invalid @enderror"  style="width: 100%;" required id="employee_id" name="employee_id">
                                                @foreach($employees as $employee)
                                                    <option value="{{ $employee->id }}" {{ (old('employee_id') == $employee->id || ($sale && $sale->employee_id == $employee->id)) ? 'selected' :  '' }}>{{ ucfirst($employee->name) }}</option>
                                                @endforeach
                                            </select>
                                            @error('employee_id')
                                            <span class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-1 col-md-1"></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="Employee_form mt-4">
                                <div class="d-flex justify-content-between">
                                    <div class=""><h5>Product Details</h5></div>
                                    <div class="">
                                        <button type="button"
                                                class="btn btn-primary-custom  btn-sm px-4 float-left"
                                                id="appendButton">
                                            Add New Row
                                        </button>
                                    </div>
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
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="appendInputContent">
                                    @if($sale && $sale->saleDetails)
                                        @php $i = 0; @endphp
                                        @foreach($sale->saleDetails as $product)
                                            <tr class='appendedDivContent'>
                                                <td>
                                                    <select class="form-control product_category_name" style="width: 100%;" name="product_details[{{$i}}][product_category_id]" required>
                                                        <option></option>
                                                        @foreach($categories as $category)
                                                            <option data="{{ json_encode($category) }}" value="{{$category->id}}" @if($category->id == $product->product_category_id) selected @endif>{{snakeCaseToTitleCase($category->name)}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control product_name" style="width: 100%;" name="product_details[{{$i}}][product_id]" required>
                                                        <option></option>
                                                        @foreach(collect($products)->where('product_category_id', $product->product_category_id) as $productDetails)
                                                            <option value="{{$productDetails->id}}" price="{{ $productDetails->price }}" @if($productDetails->id == $product->product_id) selected @endif>{{snakeCaseToTitleCase($productDetails->name)}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" step="any" class="form-control quantity"
                                                           name="product_details[{{$i}}][quantity]" onchange="amountCalculation();" value="{{$product->quantity}}" required>
                                                </td>
                                                <td>
                                                    <input type="number" step="any" class="form-control rate"
                                                           name="product_details[{{$i}}][price]" onchange="amountCalculation();" value="{{$product->price}}" required>
                                                </td>
                                                <td>
                                                    <input type="number" step="any" class="form-control total"
                                                           name="product_details[{{$i}}][amount]" value="{{$product->amount}}" required readonly>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" style="border-radius:50%;padding: 4px 10px;" onclick="removeRow(this)">
                                                        <i class="fa-solid fa-minus" ></i></button>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-12 col-md-12">
                            <div class="Employee_form mt-4">

                                <div class="row">
                                    <div class="col-xl-4 col-lg-5 col-md-5">
                                        <div class="form-group">
                                            <label for="total_amount">Total Amount (₹)</label>
                                            <input type="number" step="any" required onchange="amountCalculation();"
                                                   class="form-control  @error('total_amount') is-invalid @enderror"
                                                   id="total_amount" name="total_amount" value="{{ $sale ? old('total_amount', $sale->total_amount) : old('total_amount') }}">
                                            @error('total_amount')
                                            <span class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-1 col-lg-1 col-md-1"></div>

                                    <div class="col-xl-4 col-lg-5 col-md-5">
                                        <div class="form-group">
                                            <label for="paid_amount">Paid Amount (₹)</label>
                                            <input type="number" step="any" required onchange="amountCalculation();"
                                                   class="form-control  @error('paid_amount') is-invalid @enderror"
                                                   id="paid_amount" name="paid_amount" value="{{ $sale ? old('paid_amount', $sale->paid_amount) : old('paid_amount') }}">
                                            @error('paid_amount')
                                            <span class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-1 col-md-1"></div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-4 col-lg-5 col-md-5">
                                        <div class="form-group">
                                            <label for="pending_amount">Pending Amount (₹)</label>
                                            <input type="number" step="any" required onchange="amountCalculation();"
                                                   class="form-control  @error('pending_amount') is-invalid @enderror"
                                                   id="pending_amount" name="pending_amount" value="{{ $sale ? old('pending_amount', $sale->pending_amount) : old('pending_amount') }}">
                                            @error('pending_amount')
                                            <span class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-1 col-lg-1 col-md-1"></div>

                                    <div class="col-xl-4 col-lg-5 col-md-5">
                                        <div class="form-group">
                                            <label for="payment_mode">Payment Mode</label>
                                            <select class="form-control select2 @error('payment_mode') is-invalid @enderror"
                                                    style="width: 100%;"
                                                    id="payment_mode" name="payment_mode">
                                                @foreach(PAYMENT_MODE as $type)
                                                    <option
                                                        value="{{$type}}" {{ (old('payment_mode') == $type || ($sale && $sale->payment_mode == $type)) ? 'selected' :  '' }}>{{snakeCaseToTitleCase($type)}}</option>
                                                @endforeach
                                            </select>
                                            @error('payment_mode')
                                            <span class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-1 col-md-1"></div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-4 col-lg-5 col-md-5">
                                        <div class="form-group">
                                            <label for="payment_due_date"> Payment Due Date </label>
                                            <input type="date" required
                                                   class="form-control  @error('payment_due_date') is-invalid @enderror"
                                                   id="payment_due_date" name="payment_due_date" value="{{ $sale ? old('payment_due_date', $sale->payment_due_date) : old('payment_due_date') }}">
                                            @error('payment_due_date')
                                            <span class="error invalid-feedback">{{$message}}</span>
                                            @enderror
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
                <button type="submit" class="btn btn-add-primary btn-sm px-4">Save
                </button>
            </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        var index = document.getElementById("appendInputContent").rows.length;
        $("#appendButton").click(function () {
            var appendInputContent = `<tr class='appendedDivContent'>
            <td>
                <select class="form-control select2 product_category_name" style="width: 100%;" id="status" name="product_details[` + index + `][product_category_id]" required>
                    <option></option>
                    @foreach($categories as $category)
                        <option data="{{ json_encode($category) }}" value="{{$category->id}}">{{snakeCaseToTitleCase($category->name)}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control select2 product_name" style="width: 100%;" id="product" name="product_details[` + index + `][product_id]" required>
                    <option></option>
                </select>
            </td>
            <td><input type="number" step="any" class="form-control quantity" onchange="amountCalculation();" name="product_details[` + index + `][quantity]" value="1" required></td>
            <td><input type="number" step="any" class="form-control rate" onchange="amountCalculation();" name="product_details[` + index + `][price]" value="" required></td>
            <td><input type="number" step="any" class="form-control total" name="product_details[` + index + `][amount]" value="" required readonly></td>
             <td> <button type="button" class="btn btn-danger my-1" style="border-radius:50%;padding: 2px 7px;" onclick="removeRow(this)"> <i class="fa-solid fa-minus" ></i></button></td> </tr>`;
            $('#appendInputContent').append(appendInputContent);
            index++;
        });

        function removeRow(thiss) {
            $(thiss).closest('.appendedDivContent').remove();
            amountCalculation();
        }

        $(document).on("change", ".product_name", function () {
            var price = $(this).find(':selected').attr('price');
            $(this).closest('tr').find('.rate').val(price);
            amountCalculation();
        });

        $(document).on("change", ".product_category_name", function () {
            let categoryId = $(this).closest('tr').find('.product_category_name').val();
            var html = '';
            const productSelect = $(this).closest('tr').find('.product_name');
            productSelect.empty();
            $(this).closest('tr').find('.rate').val('');
            if (categoryId) {
                $.ajax({
                    type: "GET",
                    url: '{{url('/get-product-list')}}/' + categoryId,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (response) {
                        var products = response.products;
                        html += '<option value="" selected ></option>';
                        for (i = 0; i < products.length; i++) {
                            html += '<option value="' + products[i]['id'] + '"  price="' + products[i]['price'] + '">' + products[i]['name'] + '</option>';
                        }
                        productSelect.append(html);
                        amountCalculation();
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            } else {
                amountCalculation();
            }
        });

        function amountCalculation() {
            $(".quantity").each(function () {
                if (!$(this).val()) {
                    $(this).val(1);
                }
                if (!$(this).closest('tr').find('.rate').val()) {
                    $(this).closest('tr').find('.rate').val(0);
                }
                let price = $(this).closest('tr').find('.rate').val();
                let quantity = $(this).val();
                let total = (parseFloat(price) * parseFloat(quantity)).toFixed(2);
                $(this).closest('tr').find('.total').val(total);

            });

            let total_amount = 0;
            $(".total").each(function () {
                if ($(this).val()) {
                    total_amount += parseFloat($(this).val());
                }
            });

            $('#total_amount').val(total_amount);

            if(!$('#paid_amount').val()) $('#paid_amount').val(0);

            let pendingAmount = total_amount - parseFloat($("#paid_amount").val());
            $("#pending_amount").val(pendingAmount);
        }
    </script>
@endsection




