@extends('dashboard')

@section('css')


@endsection

@section('title', 'Profile')




@section('breadcrumb')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Home</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="">Profile</a>
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
                <h4 class="card-title">Profile setting</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6 border-right">
                        <form action="" method="GET">
                            @csrf
                            <div class="form-group text-center">
                                <img src="{{ asset(Auth::user()->profile_photo_path ?? 'default/default_user.jpg') }}" class="mr-75" height="100" width="100" alt="">
                            </div>
                            <div class="form-group">
                                <label for="avater">Avater</label>
                                <div class="custom-file">
                                    <input required type="file" name="avater" class="custom-file-input" id="avater">
                                    <label class="custom-file-label" for="avater">Choose file</label>
                                </div>
                                @if ($errors->has('avater'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('avater') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input required type="text" class="form-control" id="name" name="name" placeholder="John Doe" value="{{ Auth::user()->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>  

                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input required type="email" class="form-control" id="email" name="email" placeholder="john@example.com" value="{{ Auth::user()->email }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>            

                            <div class="form-group">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input required type="phone" class="form-control" id="phone" name="phone" placeholder="john@example.com" value="{{ Auth::user()->phone }}">
                                @if ($errors->has('phone'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>

                    <div class="col-sm-12 col-md-6" style="margin-top: 190px;">
                        <form action="" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="old_password" class="form-label">Current Password <span class="text-danger">*</span></label>

                                <div class="input-group input-group-merge form-password-toggle">
                                    <input required type="password" class="form-control form-control-merge" id="old_password" name="old_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="3" />
                                    <div class="input-group-append">
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>

                                @if ($errors->has('old_password'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>

                                <div class="input-group input-group-merge form-password-toggle">
                                    <input required type="password" class="form-control form-control-merge" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="3" />
                                    <div class="input-group-append">
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>

                                @if ($errors->has('password'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>

                                <div class="input-group input-group-merge form-password-toggle">
                                    <input required type="password" class="form-control form-control-merge" id="password_confirmation" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="3" />
                                    <div class="input-group-append">
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>

                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@section('js')

    
@endsection