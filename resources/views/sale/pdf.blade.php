@extends('layouts.layout')

@section('content')
    <style>
        .redcolor {
            color: red;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #preview img {
            width: 150px;
        }

        .form-control {
            border: 0px;
        }
    </style>
    <div class="container-fluid">.
        <button type="button" class="btn btn-danger btn-sm px-4 mx-4 float-right" onclick="printDiv()">Print</button>
        <div class="row">
            <div class="col-md-12" id="divName">
                <h4 class="text-center">SERVICE BILL</h4>
                <table class="table table-bordered">
                    <tr>
                        <td class="w-50">
                            <h6>{{$companyProfile->company_name}}</h6>
                            <p>{{$companyProfile->company_address}}</p>
                            <p>GSTIN/UIN {{$companyProfile->company_gst_number}}</p>
                            <p>EMAIL {{$companyProfile->company_email_id}}</p>
                        </td>
                        <td class="w-50" style="border-bottom-style: hidden!important;">
                            <table class="table" style="border-style: hidden;" >
                                <tr>
                                    <td>
                                        <h6>Service Number.</h6>
                                        <p>{{$service->service_number}}</p>
                                    </td>
                                    <td style="border-style: hidden!important;" >
                                        <h6>Service Date</h6>
                                        <p>{{$service->date}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="border-style: hidden!important;" >
                                        <h6>Payment Mode:</h6>
                                        <p>{{$service->payment_mode}}</p>
                                    </td>
                                    <td style="border-style: hidden!important;" >
                                        <h6> Payment Due Date </h6>
                                        <p>{{ $service->payment_due_date ?? '-' }}</p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td class="w-50">
                            <h6>Bill To : </h6>
                            <p>{{$customerDetails->company_name}}</p>
                            <p>{{$customerDetails->company_phone}}</p>
                            <p>{{$customerDetails->company_phone}}</p>
                            <p>{{$customerDetails->door_number}}{{$customerDetails->strret_name}}{{$customerDetails->city}}{{$customerDetails->locality}}{{$customerDetails->district}}{{$customerDetails->state}}{{$customerDetails->pin_code}}</p>
                        </td>
                        <td class="w-50">
                        </td>
                    </tr>
                </table>
                <table class=" table  table-bordered text-nowrap text-center" id="family_det">
                    <thead>
                    <th width="55%">Particulars</th>
                    <th width="15%">HSN Code</th>
                    <th width="5">Quantity</th>
                    <th width="10%">Rate (₹)</th>
                    <th width="15%">Total Amount (₹)</th>
                    </thead>
                    <tbody>
                    @if($service && $service->product_details)
                        @foreach($service->product_details as $product)
                            <tr class='appendedDivContent'>
                                <td>{{ optional(collect($products)->where('id', $product->product_name)->first())->name }}</td>
                                <td>{{$product->hsn_code}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->rate}}</td>
                                <td>{{$product->total}}</td>
                            </tr>
                        @endforeach
                    @endif
                    <tr>
                        <th colspan="4" class="text-right">Total Amount</th>
                        <td>{{ $service->material_cost ?? '-' }}</td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <td class="w-50">
                            <table class="table" style="border-style: hidden;" >
                                <tr>
                                    <td><h6>Material Cost (₹)</h6>
                                        <p>{{ $service->material_cost ?? '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="border-style: hidden!important;" ><h6>Discount (₹)</h6>
                                        <p>{{ $service->discount ?? '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="border-style: hidden!important;" ><h6>Total Invoice Value</h6>
                                        <p>{{ $service->total_invoice_amount ?? '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="border-style: hidden!important;" ><h6>Paid Amount (₹)</h6>
                                        <p>{{ $service->paid_amount ?? '-' }}</p></td>
                                </tr>
                            </table>
                        </td>
                        <td class="w-50">
                            <table class="table" style="border-style: hidden;" >
                                <tr>
                                    <td style="border-style: hidden!important;" ><h6>Service Charge (₹)</h6>
                                        <p>{{ $service->service_charge ?? '-' }}</p></td>

                                </tr>
                                <tr>
                                    <td><h6>GST Amount (₹)</h6>
                                        <p>{{ $service->gst_amount ?? '-' }}</p></td>
                                </tr>
                                <tr>
                                    <td style="border-style: hidden!important;" ><h6>Advanced Amount (₹)</h6>
                                        <p>{{ $service->advance_amount ?? '-' }}</p></td>
                                </tr>

                                <tr>
                                    <td colspan="1" style="border-style: hidden!important;" ><h6>Pending Amount (₹)</h6>
                                        <p>{{ $service->pending_amount ?? '-' }}</p></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <td class="w-50">Recd. in Good Condition
                        </td>
                        <td class="float-right w-50" style="border-left-style: hidden!important;" >for FUTURE INTELLIGENTS
                            <br>
                            <br>
                            Authorised Signatory
                        </td>
                    </tr>
                </table>
                <p class="text-center">This is a Computer Generated Document</p>
            </div>

            <div class="modal-footer shadow  custom_footer border-0 my-5 w-100 justify-content-center">
                <a href="{{ route('service.index') }}">
                    <button type="button" class="btn btn-primary-custom btn-sm px-4 mx-4">Cancel</button>
                </a>
                <a href="{{ route('service.edit', $service->id) }}">
                    <button type="submit" class="btn btn-add-primary btn-sm px-4">Edit
                    </button>
                </a>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('script')
    <script >
        function printDiv() {
            var printContents = document.getElementById('divName').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection


