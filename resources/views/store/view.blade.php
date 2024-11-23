@extends('layouts.layoutAdmin')

@section('title', isset($store) ? 'View Store Details' : 'Add Store')

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
                                {{ isset($store) ? 'View Product Details' : 'Add New Product' }}
                            </h6>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name" class="form-label">Store Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ $store->name ?? old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id" class="form-label">Description</label>
                            <input type="text" class="form-control" id="name" name="description"
                                   value="{{ $store->description ?? old('description') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-label">Address</label>
                            <input type="text" step="0.01" class="form-control" id="price" name="address"
                                   value="{{ $store->address ?? old('address') }}"
                                   {{ isset($store) ? 'readonly' : '' }} required>
                        </div>

                        <div class="form-group">
                            <label for="stock" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="stock" name="phone"
                                   value="{{ $store->phone ?? old('phone') }}"
                                   {{ isset($store) ? 'readonly' : '' }} required>
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="form-label">Owner</label>
                            <input type="text" class="form-control" id="name" name="owner_name"
                                   value="{{ $store->users->first_name ?? old('first_name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="form-label">Store Email</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ $store->email ?? old('name') }}" required>
                        </div>


                        <a href="{{ route('store.index')}}">
                            <button class="btn btn-primary btn-large">Go back to Stores</button>
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
