@extends('layouts.layoutAdmin')

@section('title', 'Edit Product')

@section('style')
    <style>
        .btn-large {
            padding: 8px 16px !important; /* Adjust padding */
            font-size: 14px !important;   /* Font size */
            line-height: 1.4 !important;  /* Adjust line height */
        }

        .btn {
            margin-right: 5px; /* Add spacing between buttons */
        }

        .form-group {
            margin-bottom: 20px !important;
        }

        .form-control, .form-select {
            border-radius: 5px !important;
            border: 1px solid #ccc !important; /* Added border */
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
            border: 1px solid #ccc !important; /* Added border to image preview */
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
                            <h6 class="text-white text-capitalize ps-3"> Edit Product</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('product.update', $product->id) }}"  method="POST">
                            @csrf
                            @method('Put') <!-- PATCH method for updating the resource -->

                            <div class="form-group">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="stock" class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id}}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="store_id" class="form-label">Store</label>
                                <select class="form-select" id="store_id" name="store_id" required>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}" {{ $product->store_id == $store->id ? 'selected' : '' }}>{{ $store->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="era_id" class="form-label">Era</label>
                                <select class="form-select" id="era_id" name="era_id" required>
                                    @foreach($eras as $era)
                                        <option value="{{ $era->id }}" {{ $product->era_id == $era->id ? 'selected' : '' }}>{{ $era->start_year }} - {{ $era->end_year }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="visible" class="form-label">Visibility</label>
                                <select class="form-select" id="visible" name="visible" required>
                                    <option value="1" {{ $product->visible == 1 ? 'selected' : '' }}>Visible</option>
                                    <option value="0" {{ $product->visible == 0 ? 'selected' : '' }}>Not Visible</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="front_image" class="form-label">Front Image</label>
                                <input type="file" class="form-control" id="front_image" name="front_image" accept="image/*" onchange="previewImage(event, 'frontPreview')">
                                <img id="frontPreview" class="image-preview" src="{{ asset('storage/'.$product->images->where('view', 'front')->first()->image) }}" alt="Front Image Preview" style="display:block;" />
                                <small style="color: #666;font-size: x-small">Please upload a valid image file (JPG, PNG, etc.).</small>
                            </div>

                            <div class="form-group">
                                <label for="side_image" class="form-label">Side Image</label>
                                <input type="file" class="form-control" id="side_image" name="side_image" accept="image/*" onchange="previewImage(event, 'sidePreview')">
                                <img id="sidePreview" class="image-preview" src="{{ asset('storage/'.$product->images->where('view', 'side')->first()->image) }}" alt="Side Image Preview" style="display:block;" />
                                <small style="color: #666;font-size: x-small">Please upload a valid image file (JPG, PNG, etc.).</small>
                            </div>

                            <div class="form-group">
                                <label for="back_image" class="form-label">Back Image</label>
                                <input type="file" class="form-control" id="back_image" name="back_image" accept="image/*" onchange="previewImage(event, 'backPreview')">
                                <img id="backPreview" class="image-preview" src="{{ asset('storage/'.$product->images->where('view', 'back')->first()->image) }}" alt="Back Image Preview" style="display:block;" />
                                <small style="color: #666;font-size: x-small">Please upload a valid image file (JPG, PNG, etc.).</small>
                            </div>

                            <button type="submit" class="btn btn-primary btn-large">Update Product</button>
                            <a href="{{ route('product.index')}}">
                                <button class="btn btn-outline-secondary btn-large">Cancel</button>
                            </a>
                        </form>
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
