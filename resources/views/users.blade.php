@extends('layouts.layoutAdmin')
@section('title' ,'Manage users')

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
                            <h6 class="text-white text-capitalize ps-3">Users</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('assets/img/team-2.jpg')}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$user->first_name}} {{$user->last_name}}</h6>
                                                <p class="text-xs text-secondary mb-0">{{$user->email}}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        @if( $user->active==1 )
                                        <span class="badge badge-sm bg-gradient-success">activated</span>
                                            @else
                                            <span class="badge badge-sm bg-gradient-danger">deactivated</span>
                                        @endif
                                    </td>

                                    <td class="align-middle">


                                          @if( $user->active==1 )
                                              <a href="{{route('user.edit', ['id'=>$user->id , 'active'=>$user->active])}}" >
                                        <button type="submit" class="btn btn-danger btn-large" data-toggle="tooltip" data-original-title="Deactivate user">
                                            <i class="material-symbols-rounded">delete_forever</i> deactivate
                                        </button>
                                              </a>
                                          @else
                                            <a href="{{route('user.edit', ['id'=>$user->id , 'active'=>$user->active])}}" >
                                              <button type="submit" class="btn btn-success btn-large" data-toggle="tooltip" data-original-title="Deactivate user">
                                                  <i class="material-symbols-rounded">check_circle</i> activate
                                              </button>
                                              </a>
                                          @endif

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
