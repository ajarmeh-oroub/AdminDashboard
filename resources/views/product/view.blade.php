@extends('layouts.layoutAdmin')

@section('title', isset($product) ? 'View Product Details' : 'Add Product')

@section('style')
    <style>
        .btn-large {
            padding: 8px 16px !important;
            font-size: 14px !important;
            line-height: 1.4 !important;
        }

        .btn {
            margin-right: 5px;
        }

        .form-group {
            margin-bottom: 20px !important;
        }

        .form-control, .form-select {
            border-radius: 5px !important;
            border: 1px solid #ccc !important;
            padding: 8px 14px !important;
        }

        .card-body {
            padding: 30px !important;
        }

        .image-preview {
            max-width: 150px !important;
            max-height: 150px !important;
            object-fit: cover !important;
            margin-top: 10px !important;
            border: 1px solid #ccc !important;
            padding: 5px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">
                                {{ isset($product) ? 'View Product Details' : 'Add New Product' }}
                            </h6>
                        </div>
                    </div>
                    <div class="card-body">

                            <div class="form-group">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $product->name ?? old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="category_id" class="form-label">Description</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $product->description ?? old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price"
                                       value="{{ $product->price ?? old('price') }}"
                                       {{ isset($product) ? 'readonly' : '' }} required>
                            </div>

                            <div class="form-group">
                                <label for="stock" class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" id="stock" name="stock"
                                       value="{{ $product->stock ?? old('stock') }}"
                                       {{ isset($product) ? 'readonly' : '' }} required>
                            </div>

                            <div class="form-group">
                                <label for="category_id" class="form-label">Category</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $categories->name ?? old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="category_id" class="form-label">Store</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $store->name ?? old('name') }}" required>
                            </div>
                            <!-- For images -->
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="front_image" class="form-label">Front Image</label>
                                    @if(isset($product) && $product->images->where('view', 'front')->first()->image)
                                        <img class="image-preview" src="{{ asset('storage/' . $product->images->where('view', 'front')->first()->image) }}" alt="Front Image">
                                    @else
                                        <input type="file" class="form-control" id="front_image" name="front_image" accept="image/*" onchange="previewImage(event, 'frontPreview')" required>
                                        <img id="frontPreview" class="image-preview" src="#" alt="Front Image Preview" style="display:none;">
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <label for="side_image" class="form-label">Side Image</label>
                                    @if(isset($product) && $product->images->where('view', 'side')->first()->image)
                                        <img class="image-preview" src="{{ asset('storage/' . $product->images->where('view', 'side')->first()->image) }}" alt="Side Image">
                                    @else
                                        <input type="file" class="form-control" id="side_image" name="side_image" accept="image/*" onchange="previewImage(event, 'sidePreview')" required>
                                        <img id="sidePreview" class="image-preview" src="#" alt="Side Image Preview" style="display:none;">
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <label for="back_image" class="form-label">Back Image</label>
                                    @if(isset($product) && $product->images->where('view', 'back')->first()->image)
                                        <img class="image-preview" src="{{ asset('storage/' . $product->images->where('view', 'back')->first()->image) }}" alt="Back Image">
                                    @else
                                        <input type="file" class="form-control" id="back_image" name="back_image" accept="image/*" onchange="previewImage(event, 'backPreview')" required>
                                        <img id="backPreview" class="image-preview" src="#" alt="Back Image Preview" style="display:none;">
                                    @endif
                                </div>
                            </div>


                            <a href="{{ route('product.index')}}">
                                <button class="btn btn-primary btn-large">Go back to Products</button>
                         </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Image preview function
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
                document.getElementById(previewId).style.display = "block";
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
