@extends('admin.layout.main')

@section('content')

@include('admin.users.user.edit_user_notifications_partial')
<div class="card mb-3">

@include('admin.users.user.edit_user_header_partial')
<div class="card-body">
    <?php
    /**
     * reset user password form
     */
    ?>
    <br>
    <div class="form row">
        <div class="form-group col-md-8 offset-md-2"> 
            <h5>Reset password</h5>
            <hr>
        </div>
    </div>
    
    <form action="{{ route('admin.user.edit.submit.password', ['id' => $user->id, 'slug' => $user->slug]) }}" method="post">
        {{ csrf_field() }}

        <div class="form-row">
            <div class="col-lg-3 col-md-3"></div>
        
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="new_password">New User Password</label>
                        <input  type="password" class="form-control" id="new_password" name="new_password" maxlength="40" value="" required="">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Your password must be 8-20 characters long and contain at least one upper-case letter and one number.
                        </small>
                        <!-- error message -->
                        @if ($errors->has('new_password'))
                            <div class="text-danger">
                                {{ $errors->first('new_password') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="repeat_new_password">Repeat Password</label>
                        <input  type="password" class="form-control" id="repeat_new_password" name="repeat_new_password" maxlength="40" value="" required="">
                        <small id="passwordConfirmHelpBlock" class="form-text text-muted">
                        </small>
                        @if (session('message5'))
                        {{ session('message5') }}
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="admin_password">Your password</label>
                        <input  type="password" class="form-control" id="admin_password" name="admin_password" maxlength="40" value="" required="">
                        <!-- error messages -->
                        @if ($errors->has('admin_password'))
                            <div class="text-danger">
                                {{ $errors->first('admin_password') }}
                            </div>
                        @endif
                        @if (session('error-admin-password'))
                            <div class="text-danger">
                                {{ session('error-admin-password') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <button type="submit" id="admin_change_user_password" class="sh_save_btn btn btn-primary">Reset password</button>
                    </div>
                </div>      
            </div>
            <div class="col-lg-3 col-md-3"></div>
        </div>
    </form>
</div>
@endsection