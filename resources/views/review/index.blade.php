@extends('layouts.layoutAdmin')
@section('title' ,'Manage Reviews')

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


            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Reviews</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Review Id</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $reviews as $review)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">

                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$review->id}}</h6>

                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex px-2 py-1">

                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$review->user->first_name}} {{$review->user->last_name}}</h6>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">

                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$review->product->name}}</h6>

                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if( $review->approved==1 )
                                    <span class="badge badge-sm bg-gradient-success">approved</span>
                                    @else
                                    <span class="badge badge-sm bg-gradient-danger">not approved</span>
                                    @endif
                                </td>
<td>
    <a href="{{ route('review.show', $review->id) }}">
        <button class="btn btn-info btn-large" data-toggle="tooltip" data-original-title="View product">
            <i class="material-symbols-rounded">visibility</i> View
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
