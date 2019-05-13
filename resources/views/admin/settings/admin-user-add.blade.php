<?php
/**
 * page for displaying form for adding admin user
 */
?>
@extends('admin.layout.main')

@section('content')

    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> Add Admin User</div>
        <div class="card-body">
            
            <form action="{{ route('admin.settings.admin-user.add.submit') }}" method="post">
                {{ csrf_field() }}

                <div class="form row">
                    <div class="form-group col-md-8 offset-md-2">
                        <h4>New Admin user information</h4>
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
                                value="{{ old('name') }}">
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
                                value="{{ old('email') }}">
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
                        <label for="password">Password</label>
                        <input  type="password" class="form-control"
                                id="password" name="password" 
                                maxlength="40"
                                placeholder="new admin password" 
                                >
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

                    <div class="form-group col-md-4">
                        <label for="repeat_password">Repeat password</label>
                        <input  type="password" class="form-control"
                                id="repeat_password" name="repeat_password" 
                                maxlength="40" 
                                placeholder="Repeat password"
                                >
                        <small id="passwordConfirmHelpBlock" class="form-text text-muted">
                        </small>
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
                        <button type="submit" class="sh_save_btn btn btn-primary">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection