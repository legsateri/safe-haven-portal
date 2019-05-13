@extends('admin.layout.main')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card mb-3 admin_add_user_page">
<div class="card-header">
    <i class="fa fa-area-chart"></i> Add User</div>
<div class="card-body">
    
    <form action="{{ route('admin.users.user_add.submit') }}" method="post">
        {{ csrf_field() }}

        <div class="form-row">
            <div class="col-lg-2 col-md-2"></div>
    
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="form-row">
                    <div class="form-group col-md-6 mb-3"> 
                        <label for="first_name">First Name</label>
                        <input  type="text" class="form-control" id="first_name" name="first_name" maxlength="40" value="{{ old('first_name') }}" required="">
                        <!-- error message -->
                        @if ($errors->has('first_name'))
                            <div class="text-danger">
                                {{ $errors->first('first_name') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="last_name">Last Name</label>
                        <input  type="text" class="form-control" id="last_name" name="last_name" maxlength="40" value="{{ old('last_name') }}" required="">
                        <!-- error message -->
                        @if ($errors->has('last_name'))
                            <div class="text-danger">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="user_type">User type</label>
                        <select name="user_type" id="user_type" required="">
                            <option value="">Select type</option>
                            @foreach ( $userTypes as $userType )
                                <option value="{{ $userType->id }}">
                                    {{ $userType->label }} 
                                </option>
                            @endforeach
                        </select>
                        <!-- error message -->
                        @if ($errors->has('user_type'))
                            <div class="text-danger">
                                {{ $errors->first('user_type') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="text-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="40" value="{{ old('email') }}" required="">
                        <!-- error message -->
                        @if ($errors->has('email'))
                            <div class="text-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="phone">Office Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" maxlength="12" pattern="^\d{3}-\d{3}-\d{4}$" placeholder="XXX-XXX-XXXX" value="{{ old('phone') }}"required="">
                        <!-- error message -->
                        @if ($errors->has('phone'))
                            <div class="text-danger">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="user_password">New User Password</label>
                        <input  type="password" class="form-control" id="user_password" name="password" maxlength="40" value="" required="">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Your password must be 8-20 characters long and contain at least one upper-case letter and one number.
                        </small>
                        <!-- error message -->
                        @if ($errors->has('password'))
                            <div class="text-danger">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="repeat-password">Repeat Password</label>
                        <input  type="password" class="form-control" id="repeat-password"  name="repeat-password" maxlength="40" value="" required="">
                        <small id="passwordConfirmHelpBlock" class="form-text text-muted">
                        </small>
                        <!-- error message -->
                        @if ($errors->has('repeat-password'))
                            <div class="text-danger">
                                {{ $errors->first('repeat-password') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="organisation">Organization</label>
                        <select name="organisation" id="organsation" required="">
                            <option value="">Select organization</option>
                            @foreach( $organisations as $organisation )
                                <option value="{{ $organisation->id }}">
                                    {{ $organisation->name }}
                                </option>
                            @endforeach
                        </select>
                        <!-- error messages -->
                        @if ($errors->has('organisation'))
                            <div class="text-danger">
                                {{ $errors->first('organisation') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="text-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <button type="submit" id="add_user" class="sh_save_btn btn btn-primary">Save</button>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3"></div>
            </div>
        </div>
    </form>
</div>
@endsection