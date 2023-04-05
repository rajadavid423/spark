@extends('layouts.layout')

@section('content')
    <style>

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="titles p-1">
                    <h5>{{ $product ? 'Edit ' : 'Create' }} Customer</h5>
                </div>

                <hr class="mt-0">

                <form method="POST" class="form-validate" enctype="multipart/form-data"
                      action="{{ $product ? route('product.update', $product->id) : route('product.store') }}">
                    @csrf
                    @if($product) @method('PUT') @endif
                    <div class="Employee_form mt-4">
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label for="product_category_id">Product Category <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm select2 @error('product_category_id') is-invalid @enderror"  style="width: 100%;" required id="product_category_id" name="product_category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ (old('product_category_id') == $category->id || ($product && $product->product_category_id == $category->id)) ? 'selected' :  '' }}>{{ ucfirst($category->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_category_id')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-1 col-lg-1 col-md-1"></div>

                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group text-nowrap">
                                    <label for="name">Product Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                           id="name" name="name"
                                           class="form-control form-control-sm @error('name') is-invalid @enderror"
                                           value="{{ $product ? old('name', $product->name) : old('name') }}"
                                           required>
                                    @error('name')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-1 col-md-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group text-nowrap">
                                    <label for="price">Price <span class="text-danger">*</span></label>
                                    <input type="number" required
                                           class="form-control form-control-sm @error('price') is-invalid @enderror"
                                           id="price" name="price"
                                           value="{{ $product ? old('price', $product->price) : old('price') }}">
                                    @error('price')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-1 col-lg-1 col-md-1"></div>

                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <div class="form-group text-nowrap">
                                    <label for="date">Date</label>
                                    <input type="date"
                                           class="form-control form-control-sm select2 @error('date') is-invalid @enderror"
                                           id="date" name="date"
                                           value="{{ $product ? old('date', $product->date) : (old('date') ?? now()->format('Y-m-d')) }}">
                                    @error('date')
                                    <span class="error invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-1 col-md-1"></div>
                        </div>
                    </div>

                    <div class="modal-footer shadow  custom_footer border-0 my-5 w-100 justify-content-center">
                        <a href="{{ route('product.index') }}">
                            <button type="button" class="btn btn-primary-custom btn-sm px-4">Cancel</button>
                        </a>
                        <button type="submit" class="btn btn-add-primary btn-sm px-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




