@extends('layouts.layoutAdmin')

@section('title', 'View Categories')

@section('content')

    <div class="action-buttons">
        <!-- Add Product Button -->
        <button class="btn btn-success btn-large" onclick="window.location.href='{{ route('era.create')}}'" data-toggle="tooltip" data-original-title="Add Category">
            <i class="material-symbols-rounded">add_circle</i> Add Era
        </button>
    </div>
    <div class="card my-4 mt-5">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Era</h6>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Era name</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Period</th>
                        <th class="text-secondary opacity-7">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($eras as $era)

                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">

                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{$era->era_name}}</h6>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">

                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{$era->start_year}}-{{$era->end_year}}</h6>

                                    </div>
                                </div>
                            </td>





                            <td class="align-middle">

                                <form action="{{ route('era.destroy', $era->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-large" data-toggle="tooltip" data-original-title="Delete product" onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="material-symbols-rounded">delete</i> Delete
                                    </button>
                                </form>


                                <a href="{{ route('era.edit' , $era->id)}}">
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

@endsection

