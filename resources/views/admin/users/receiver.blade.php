@extends('dashboard')

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/vendors/css/forms/select/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/css/components.css') }}">

@endsection

@section('title', 'Receivers')
@section('admin.user.list', 'active')




@section('breadcrumb')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Home</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="">Receivers</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
    


@section('content')


<div class="row" id="table-contextual">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Receivers</h4>
                <button class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"><i data-feather='plus-square'></i> Add User</button>

                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Add new Receivers</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="avater">User Avater</label>
                                        <div class="custom-file">
                                            <input type="file" name="avater" class="custom-file-input" id="avater">
                                            <label class="custom-file-label" for="avater">Choose file</label>
                                        </div>
                                        @if ($errors->has('avater'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('avater') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Select a role <span class="text-danger">*</span></label>
                                        <select class="form-control select2" id="role" name="role">
                                            <option selected value="receiver">Receiver</option>
                                        </select>
                                    </div> 

                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}">
                                    </div>  

                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com" value="{{ old('email') }}">
                                    </div>            

                                    <div class="form-group">
                                        <label for="phone">Phone <span class="text-danger">*</span></label>
                                        <input type="phone" class="form-control" id="phone" name="phone" placeholder="john@example.com" value="{{ old('phone') }}">
                                    </div>

                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input required type="password" class="form-control form-control-merge"
                                                id="password" name="password" tabindex="2" placeholder="****"
                                                aria-describedby="login-password" />
                                            <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer">
                                                    <i data-feather="eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">

                                        <div class="d-flex justify-content-between">
                                            <label for="password_confirmation">Confirm password <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input required type="password" class="form-control form-control-merge" id="password_confirmation" name="password_confirmation" tabindex="2" placeholder="****" aria-describedby="login-password" />
                                            <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer">
                                                    <i data-feather="eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                               
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">
                   <form action="{{ route('admin.receiver.list') }}" method="GET">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="Name/Email/Phone" value="{{ request()->search ?? '' }}">
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <input type="text" id="start_date" class="form-control flatpickr-basic" placeholder="Start Date" />
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <input type="text" id="end_date" class="form-control flatpickr-basic" placeholder="End Date" />
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <button class="btn btn-primary" >Search</button>
                                @if (request()->search || request()->start_date || request()->end_date)
                                    <a class="btn btn-danger" href="{{ route('admin.receiver.list') }}" >Clear filter</a>
                                @endif
                            </div>

                        </div>
                   </form>
                </p>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr class="table-default">
                                <td>
                                    {{-- <img src="{{ asset($user->profile_photo_path) }}" class="mr-75" height="20" width="20" alt="Figma" /> --}}
                                    <span class="font-weight-bold">{{ $user->name }}</span>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class='badge badge-pill badge-light-info mr-1'>{{ $user->fund }} /-</span>
                                </td>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" data-toggle="modal" data-target="#edit_modal{{ $user->id }}" >
                                                <i data-feather="edit-2" class="mr-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                                <i data-feather="trash" class="mr-50"></i>
                                                <span>Delete</span>
                                            </a>

                                            <form action="{{ route('admin.user.delete',$user->id) }}" id="delete-form-{{ $user->id }}" method="post">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>


                            <div class="modal fade" id="edit_modal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Update Receivers</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.user.update',$user->id) }}" method="POST" enctype="multipart/form-data" >
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group text-center">
                                                    <img src="{{ asset($user->profile_photo_path ?? 'default/default_user.jpg') }}" class="mr-75" height="100" width="100" alt="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="avater">Receivers Avater</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="avater" class="custom-file-input" id="avater">
                                                        <label class="custom-file-label" for="avater">Choose file</label>
                                                    </div>
                                                    @if ($errors->has('avater'))
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $errors->first('avater') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
            
                                                <div class="form-group">
                                                    <label for="role">Select a role <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="role" name="role">
                                                        <option selected value="receiver">Receiver</option>
                                                    </select>
                                                </div> 
            
                                                <div class="form-group">
                                                    <label for="name">Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" value="{{ $user->name }}">
                                                </div>  
            
                                                <div class="form-group">
                                                    <label for="email">Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com" value="{{ $user->email }}">
                                                </div>            
            
                                                <div class="form-group">
                                                    <label for="phone">Phone <span class="text-danger">*</span></label>
                                                    <input type="phone" class="form-control" id="phone" name="phone" placeholder="john@example.com" value="{{ $user->phone }}">
                                                </div>
                                           
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                     
                    </tbody>

                    {{-- <div class="pagination">

                        {{ $users->links() }}
                    </div> --}}
                </table>
                <hr>
                {{ $users->links() }}
               
            </div>
        </div>
    </div>
</div>

@endsection



@section('js')

    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/forms/form-select2.js') }}"></script>

    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/pagination/jquery.bootpag.min.js')}}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/pagination/jquery.twbsPagination.min.js')}}"></script>

    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pagination/components-pagination.js') }}"></script>

    

    
@endsection