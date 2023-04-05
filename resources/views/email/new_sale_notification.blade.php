<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
    <h1>New Sale Notification - Sparkout Tech Interview Task</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-xl-9 col-lg-12 col-md-12">
            <div class="Employee_form mt-4">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="form-group">
                            <label for=""><b>Invoice Number : </b></label>
                            <label class="form-control">{{ $data['invoice_number'] ?? '-' }}</label>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="form-group">
                            <label for="service_date"><b>Invoice Date : </b></label>
                            <label for="service_date"> {{ $data['date'] ?? '-' }}</label>
                        </div>
                    </div>

                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="form-group">
                            <label for="customer"><b>Customer : </b></label>
                            <label class="form-control">{{ $data['customer'] ? $data['customer']->name : '-' }}</label>
                        </div>
                    </div>

                    <div class="col-xl-1 col-lg-1 col-md-1"></div>

                    <div class="col-xl-4 col-lg-5 col-md-5">

                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="Employee_form mt-4">
                <div class="d-flex justify-content-between">
                    <div class=""><h3>Product Details</h3></div>
                    <div class=""></div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table" style="width: 100%; border: 1px solid black">
                    <thead>
                    <tr>
                        <th style="width: 20%">Category</th>
                        <th style="width: 20%">Product</th>
                        <th style="width: 20%">Quantity</th>
                        <th style="width: 20%">Rate (₹)</th>
                        <th style="width: 20%">Amount (₹)</th>
                    </tr>
                    @foreach($data['saleDetails'] as $product)
                        <tr>
                            <th>{{ $product->category ? $product->category->name : '-'  }}</th>
                            <th>{{ $product->product ? $product->product->name : '-'  }}</th>
                            <th>{{$product->quantity}}</th>
                            <th>{{$product->price}}</th>
                            <th>{{$product->amount}}</th>
                        </tr>
                    @endforeach
                    </thead>

                </table>
            </div>
        </div>
        <br>
        <div class="col-md-9">
            <div class="Employee_form mt-4">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="form-group">
                            <label for="material_cost"><b>Total Amount (₹) : </b> </label>
                            <label>{{ $data['total_amount'] ?? '-' }}</label>
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

</body>
</html>
