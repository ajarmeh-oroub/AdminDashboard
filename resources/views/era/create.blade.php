@extends('layouts.layoutAdmin')

@section('title', 'Create Category')

@section('style')
    <style>
        .btn-large {
            padding: 8px 16px !important; /* Adjust padding */
            font-size: 14px !important;   /* Font size */
            line-height: 1.4 !important;  /* Adjust line height */
        }

        .btn {
            margin-left: 12px !important; /* Add spacing between buttons */
        }

        .form-group {
            margin-bottom: 20px !important;
            margin-left: 12px !important;
            margin-right: 12px !important;
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
    <!-- Add Category Button -->

    <div class="card my-4 mt-5">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Create Era</h6>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
                <!-- Form to create category -->
                <form action="{{ route('era.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="name" class="form-label">Era Name</label>
                        <input type="text" class="form-control" id="name" name="era_name" placeholder="Enter Era Name" value="{{ old('era_name') }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="name" class="form-label">Era Start Year</label>
                        <input type="number" class="form-control" id="name" name="start_year" placeholder="Enter Start Year" value="{{ old('start_year' ) }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="name" class="form-label">Era End Year</label>
                        <input type="number" class="form-control" id="name" name="end_year" placeholder="Enter End Year" value="{{ old('end_year') }}" required>
                    </div>



                    <button type="submit" class="btn btn-primary">Create Era</button>

                    <a href="{{route('era.index')}}" class="btn btn-outline-secondary" >
                    Cancel
                    </a>

                </form>
            </div>
        </div>
    </div>

    <!-- Script to preview image -->

@endsection
@section('scripts')
    <script>
        document.getElementById('image').addEventListener('change', function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            reader.onload = function (event) {
                var imagePreview = document.getElementById('imagePreview');
                imagePreview.style.display = 'block';
                imagePreview.src = event.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection


