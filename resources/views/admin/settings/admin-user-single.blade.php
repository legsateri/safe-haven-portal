<?php
/**
 * page for displaying single admin user data
 * with forms for editing data
 */
?>
@extends('admin.layout.main')

@section('content')

<!--general success message -->
@if (session('success-general'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success-general') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!--password success message -->
@if (session('success-password'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success-password') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- activation 0 success message -->
@if (session('success-active0'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('success-active0') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- activation 1 success message -->
@if (session('success-active1'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success-active1') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- activation admin password error message -->
@if (session('error-admin-password-ban'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error-admin-password-ban') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- activation admin password error message -->
@if ($errors->has('password_ban'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first('password_ban') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <i class="fa fa-area-chart"></i> Edit Admin User {{ $admin->name }}
                </div>
                <div class="col-lg-6 col-md-6">
                    <button type="button"
                            class="btn_admin_active btn
                            @if( $admin->active == 1 )
                                btn-success
                            @else
                                btn-warning
                            @endif
                            "
                            data-toggle="modal"
                            data-target="#admin_active_status_modal"
                            style="float:right;"
                            >
                            @if( $admin->active == 1 )
                                Admin user active. Click to unset.
                            @else
                                Admin user not active. Click to activate.
                            @endif
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">


            <?php
            /**
             * admin user edit general information form
             */
            ?>
            <form action="{{ route('admin.settings.admin-user.update-general.submit', ['id' => $admin->id]) }}" method="post">
                {{ csrf_field() }}

                <div class="form row">
                    <div class="form-group col-md-8 offset-md-2">
                        <h4>Update general information</h4>
                        <hr> 
                    </div>
                </div>

                <div class="form row">

                    <div class="form-group col-md-4 offset-md-2"> 
                        <label for="name">Name</label>
                        <input  type="text" class="form-control"
                                id="name" name="name" 
                                maxlength="40"
                                placeholder="new admin name"
                                value="{{ $admin->name }}">
                        <!-- error message -->
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input  type="email" class="form-control"
                                id="email" name="email" 
                                maxlength="40" 
                                placeholder="email"
                                value="{{ $admin->email }}">

                        <!-- error messages -->
                        @if ($errors->has('email'))
                            <div class="text-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif

                        @if (session('email-error-general'))
                            <div class="text-danger">
                                {{ session('email-error-general') }}
                            </div>
                        @endif

                    </div>

                </div>

                <div class="form row">

                    <div class="form-group col-md-4 offset-md-2"> 
                        <label for="your_password">Your Password</label>
                        <input  type="password" class="form-control"
                                id="your_password" name="password_general" 
                                maxlength="40"
                                placeholder="Your password" 
                                >
                        <!-- error messages -->
                        @if (session('password-error-general'))
                            <div class="text-danger">
                                {{ session('password-error-general') }}
                            </div>
                        @endif

                        @if ($errors->has('password_general'))
                            <div class="text-danger">
                                {{ $errors->first('password_general') }}
                            </div>
                        @endif
                    </div>

                </div>

                <div class="form row">
                    <div class="form-group col-md-4 offset-md-2">
                        <button type="submit" class="sh_save_btn btn btn-primary">Update general</button>
                    </div>
                </div>

            </form>

            <?php
            /**
             * admin user edit password form
             */
            ?>
            <br>
            <form action="{{ route('admin.settings.admin-user.update-password.submit', ['id' => $admin->id]) }}" method="post">
                {{ csrf_field() }}

                <div class="form row">
                    <div class="form-group col-md-8 offset-md-2">
                        <h4>Reset password</h4>
                        <hr> 
                    </div>
                </div>


                <div class="form row">

                    <div class="form-group col-md-4 offset-md-2"> 
                        <label for="new_password">New password</label>
                        <input  type="password" class="form-control"
                                id="new_password" name="new_password" 
                                maxlength="40"
                                placeholder="new admin password" 
                                >
                        <!-- error message -->
                        @if ($errors->has('new_password'))
                            <div class="text-danger">
                                {{ $errors->first('new_password') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="repeat_password">Repeat password</label>
                        <input  type="password" class="form-control"
                                id="repeat_password" name="repeat_password" 
                                maxlength="40" 
                                placeholder="Repeat password"
                                >
                        <!-- error message -->
                        @if ($errors->has('repeat_password'))
                            <div class="text-danger">
                                {{ $errors->first('repeat_password') }}
                            </div>
                        @endif
                    </div>

                </div>

                <div class="form row">
                    <div class="form-group col-md-4 offset-md-2"> 
                        <label for="your_password">Your Password</label>
                        <input  type="password" class="form-control"
                                id="your_password" name="admin_password" 
                                maxlength="40"
                                placeholder="Your password" 
                                >
                        <!-- error messages -->
                        @if ($errors->has('admin_password'))
                            <div class="text-danger">
                                {{ $errors->first('admin_password') }}
                            </div>
                        @endif

                        @if ( session('error-admin-password'))
                            <div class="text-danger">
                                {{ session('error-admin-password') }}
                            </div>
                        @endif

                    </div>

                </div>

                <div class="form row">
                    <div class="form-group col-md-4 offset-md-2">
                        <button type="submit" class="sh_save_btn btn btn-primary">Update password</button>
                    </div>
                </div>

            </form>

            <!-- Modal -->
            <div class="modal fade" id="admin_active_status_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change admin user active status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- user ban form -->
                    <form action="{{ route('admin.settings.admin-user.update-active-status.submit', ['id' => $admin->id]) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="new_active_value" id="new_active_value"
                                @if( $admin->active == 1 )
                                    value="0"
                                @else
                                    value="1"
                                @endif
                            >
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        @if( $admin->active == 1 )
                                            Are you sure that you want to deactivate <b>{{ $admin->name }}</b>?<br>
                                            Please verify your action with your password.
                                        @else
                                            Are you sure that you want to activate <b>{{ $admin->name }}</b>?<br>
                                            Please verify your action with your password.
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group modal_password_cont">
                                    <label for="password">Your password</label>
                                    <input type="password" class="form-control"
                                    id="your_password" name="password_ban" 
                                    maxlength="40" 
                                    value="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-block"         
                                            >@if( $admin->active == 1 )
                                                Set admin user as inactive
                                            @else
                                                Set admin user as active
                                            @endif</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- end modal -->



        </div>
    </div>
@endsection