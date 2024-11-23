
@extends('layouts.layoutAdmin')
@section('title' ,'Manage products')

@section('style')
    <style>
        .btn-large {
            padding: 6px 12px !important; /* Adjust padding */
            font-size: 12px !important;   /* Font size */
            line-height: 1.3 !important;  /* Adjust line height */
        }

        .btn {
            margin-right: 5px; /* Add spacing between buttons */
        }

        .btn-info, .btn-warning, .btn-danger {
            min-width: 100px; /* Set minimum width for consistency */
        }

        .action-buttons {
            margin-bottom: 15px; /* Add some space between buttons and table */
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="action-buttons">
                    <!-- Add Product Button -->
                    <button class="btn btn-success btn-large" onclick="window.location.href='{{ route('product.create')}}'" data-toggle="tooltip" data-original-title="Add Product">
                        <i class="material-symbols-rounded">add_circle</i> Add Product
                    </button>

                    <!-- View Categories Button -->

                    <button class="btn btn-primary btn-large" onclick="window.location.href='{{route('category.index')}}'" data-toggle="tooltip" data-original-title="View Categories">
                        <i class="material-symbols-rounded">category</i> View Categories
                    </button>

                    <!-- View Eras Button -->
                    <button class="btn btn-secondary btn-large" onclick="window.location.href='{{route('era.index')}}'" data-toggle="tooltip" data-original-title="View Eras">
                        <i class="material-symbols-rounded">timeline</i> View Eras
                    </button>
                </div>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Products</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">product</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">

                                            @foreach($product->images as $image)
                                                <img src="{{ asset('storage/' . $image->image) }}" alt="Product Image - {{ $image->view }}" class="avatar avatar-sm me-3 border-radius-lg">
                                            @endforeach

{{--                                            <h6 class="mb-0 text-sm text-danger">{{$productimage}}</h6>--}}
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$product->name}}</h6>
                                                <p class="text-xs text-secondary mb-0">{{$product->store->name}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            @if($product->stock <=10)
                                            <h6 class="mb-0 text-sm text-danger">{{$product->stock}}</h6>
                                            @else
                                                <h6 class="mb-0 text-sm">{{$product->stock}}</h6>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$product->price}}JOD</h6> </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        @if( $product->visible==1 )
                                            <span class="badge badge-sm bg-gradient-success">activated</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-danger">deactivated</span>
                                        @endif
                                    </td>

                                    <td class="align-middle">
                                        <a href="{{ route('product.Status', ['id' => $product->id, 'visible' => $product->visible]) }}">
                                            <button
                                                class="btn btn-{{ $product->visible ? 'danger' : 'success' }} btn-large"
                                                data-toggle="tooltip"
                                                data-original-title="{{ $product->visible ? 'Deactivate product' : 'Activate product' }}">
                                                <i class="material-symbols-rounded">
                                                    {{ $product->visible ? 'block' : 'check_circle' }}
                                                </i>
                                                {{ $product->visible ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </a>

                                        <a href="{{ route('product.show', $product->id) }}">
                                            <button class="btn btn-info btn-large" data-toggle="tooltip" data-original-title="View product">
                                                <i class="material-symbols-rounded">visibility</i> View
                                            </button>
                                        </a>

                                        <a href="{{ route('product.edit', $product->id) }}">
                                            <button class="btn btn-warning btn-large" data-toggle="tooltip" data-original-title="Edit product">
                                                <i class="material-symbols-rounded">edit</i> Edit
                                            </button>
                                        </a>
                                    </td>

                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
@endsection
