<?php
/**
 * page for displaying single admin user data
 * with forms for editing data
 */
?>
@extends('admin.layout.main')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> Edit Admin User {{ $admin->name }}
            <button type="button" 
                    class="btn 
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
                        Admin user is active
                    @else
                        Admin user is not active
                    @endif
            </button>    
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
                        <!-- error message -->
                        @if ($errors->has('email'))
                            <div class="text-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                </div>

                <div class="form row">

                    <div class="form-group col-md-4 offset-md-2"> 
                        <label for="your_password">Your Password</label>
                        <input  type="password" class="form-control"
                                id="your_password" name="your_password" 
                                maxlength="40"
                                placeholder="Your password" 
                                >
                        <!-- error message -->
                        @if ($errors->has('your_password'))
                            <div class="text-danger">
                                {{ $errors->first('your_password') }}
                            </div>
                        @elseif ( session('your_password_error') != null)
                            <div class="text-danger">
                                {{ session('your_password_error') }}
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
                        @if ($errors->has('password'))
                            <div class="text-danger">
                                {{ $errors->first('password') }}
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
                                id="your_password" name="your_password" 
                                maxlength="40"
                                placeholder="Your password" 
                                >
                        <!-- error message -->
                        @if ($errors->has('your_password'))
                            <div class="text-danger">
                                {{ $errors->first('your_password') }}
                            </div>
                        @elseif ( session('your_password_error') != null)
                            <div class="text-danger">
                                {{ session('your_password_error') }}
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
                                <div class="form-group col-md-12">
                                    <label for="password">Your password</label>
                                    <input type="password" class="form-control"
                                    id="your_password" name="your_password" 
                                    maxlength="40" 
                                    value="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-sm">
                                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col-sm">
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