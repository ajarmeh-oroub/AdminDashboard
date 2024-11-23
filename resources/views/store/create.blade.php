@extends('layouts.layoutAdmin')

@section('title' ,'Add Store')

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

        .form-control , .form-select {
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
                            <h6 class="text-white text-capitalize ps-3"> Add new Store</h6>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{route('store.store')}}"  enctype="multipart/form-data" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Store Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="stock" class="form-label">Address</label>
                                <input type="text" class="form-control" id="stock" name="address" value="{{ old('address') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="price" class="form-label">Phone</label>
                                <input type="tel" step="0.01" class="form-control" id="price" name="phone" value="{{ old('phone') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="stock" class="form-label">Email</label>
                                <input type="email" class="form-control" id="stock" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="stock" class="form-label">Password</label>
                                <input type="password" class="form-control" id="stock" name="password" value="{{ old('password') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="owner_id" class="form-label">Assign an Owner</label>
                                <select class="form-select" id="searchableDropdown" name="owner_id" data-live-search="true"  required>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->first_name}}  {{$user->last_name}}</option>
                                    @endforeach
                                </select>
                                {{--                                <small style="color: #666 !important;font-size: x-small">Hold down the Ctrl (Windows) / Command (Mac) button to select multiple options.</small>--}}
                            </div>


                            <div class="form-group">
                                <label for="visible" class="form-label">Active</label>
                                <select class="form-select" id="visible" name="active" required>
                                    <option value="1">Activate</option>
                                    <option value="0">Deactivate</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            </div>


                            <button type="submit" class="btn btn-primary btn-large">Add Store</button>
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
        $(document).ready(function() {
            $('.selectpicker').selectpicker();
        });
    </script>

@endsection

