@extends('layouts.user-main')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    <!-- My Account -->
    <div class="card mb-3 user_account_cont">
        <div class="card-header"><i class="fa fa-user-o"></i> My Account</div>
        
        <div class="card-body">

            <!-- Update user's info -->
            <form  method="post" action="{{ route('user.account.update.info') }}" style="margin: 5px 30px">
                {{ csrf_field() }}

                <div class="form row">
                    <div class="col-lg-2 col-md-2"></div>

                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">                                                                                   
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="first-name">First Name</label>
                                <input  type="text" class="form-control" id="first-name" name="first_name" placeholder="Enter first name"
                                        value="<?php if (isset($currentUser->first_name)) {echo $currentUser->first_name;} ?>"
                                        required>
                                <!-- error message -->
                                @if ($errors->has('first_name'))
                                    <div class="text-danger">
                                        {{ $errors->first('first_name') }}
                                    </div>
                                @endif
                                        
                            </div>
                                    
                            <div class="col-md-6 mb-3">
                                <label for="last-name">Last Name</label>
                                <input  type="text" class="form-control" id="last-name" name="last_name" placeholder="Enter last name"
                                        value="<?php if (isset($currentUser->last_name)) {echo $currentUser->last_name;} ?>"
                                        required>
                                <!-- error message -->
                                @if ($errors->has('last_name'))
                                    <div class="text-danger">
                                        {{ $errors->first('last_name') }}
                                    </div>
                                @endif
                            </div>
                        </div> 
                                            
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="email">Email address</label>
                                <input  type="email" class="form-control" id="email" name="email" placeholder="email@example.com"
                                        value="<?php if (isset($currentUser->email)) {echo $currentUser->email;} ?>">
                                <!-- error message -->
                                @if ($errors->has('email'))
                                    <div class="text-danger">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                                        
                            <div class="col-md-4 mb-3">
                                <label for="phone">Phone Number</label>
                                <input  type="text" class="form-control" id="phone" name="phone_number" maxlength="12" pattern="^\d{3}-\d{3}-\d{4}$" placeholder="XXX-XXX-XXXX"
                                        value="<?php if (isset($userPhone->number)) {echo $userPhone->number;} ?>"
                                        required>
                                 <!-- error message -->
                                @if ($errors->has('phone_number'))
                                    <div class="text-danger">
                                        {{ $errors->first('phone_number') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="phone">Type</label>
                                <select class="custom-select" name="phone_number_type" id="phone_number_type">
                                                <option value="" selected>Choose...</option>
                                                @foreach($phoneTypes as $phoneType)
                                                <option value="{{$phoneType->id}}"                                                    
                                                    @if($phoneType->id == $userPhone['phone_type_id'])
                                                    selected
                                                    @endif                                               
                                                    >{{$phoneType->label}}
                                                </option>
                                                @endforeach
                                </select>
                                <!-- error message -->
                                @if ($errors->has('phone_number_type'))
                                    <div class="text-danger">
                                        {{ $errors->first('phone_number_type') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                                
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="street">Address</label>
                                <input  type="text" class="form-control" id="street" name="street" placeholder="Enter your address"
                                        value="<?php if (isset($userAddress->street)) {echo $userAddress->street;} ?>">
                                <!-- error message -->
                                @if ($errors->has('street'))
                                    <div class="text-danger">
                                        {{ $errors->first('street') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3"></div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="state">State</label>
                                <select class="form-control" id="state" name="state">
                                    <option>Select State</option>
                                    @foreach($states as $state)
                                    <option value="{{$state->name}}"
                                            @if($state->name == $userAddress['state'])
                                            selected
                                            @endif                                               
                                            >{{$state->name}}
                                    </option>
                                    @endforeach                           
                                </select>
                                <!-- error message -->
                                @if ($errors->has('street'))
                                    <div class="text-danger">
                                        {{ $errors->first('street') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="number">City</label>
                                    <input  type="text" class="form-control" id="city" name="city" placeholder="City"
                                            value="<?php if (isset($userAddress->city)) {echo $userAddress->city;} ?>">
                                <!-- error message -->
                                @if ($errors->has('city'))
                                    <div class="text-danger">
                                        {{ $errors->first('city') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="zip">Zip/Postal Code</label>
                                <input  type="text" class="form-control" id="zip" name="zip_code" pattern="^\d{5}$" maxlength="5" placeholder="XXXXX"
                                        value="<?php if (isset($userAddress->zip_code)) {echo $userAddress->zip_code;} ?>">
                                <!-- error message -->
                                @if ($errors->has('zip_code'))
                                    <div class="text-danger">
                                        {{ $errors->first('zip_code') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <br>

                        <div class="form-row">
                            <button type="submit" class="sh_save_btn btn btn-outline-primary float-right">Save</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2"></div>
            </form>
        </div>      
    </div>

    <?php /*   
        <div class="card-footer small text-muted">
            Last updated on {{ Carbon\Carbon::parse($currentUser->updated_at)->format('m/d/Y, i:s') }}
        </div>*/
    ?>
    


    <!-- Password -->
    <div class="card mb-3">
        <div class="card-header"><i class="fa fa-user-o"></i> Change password </div>
        
        <div class="card-body">
            
            <!-- Update password -->
            <form id="update_password_form" method="post" action="{{ route('user.account.update.password') }}" style="margin: 5px 30px">
                {{ csrf_field() }}

                <div class="form row">
                    <div class="col-lg-3 col-md-3"></div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="old_pass">Old password</label>
                                <input  type="password" class="form-control" id="old_pass" name="old_password" placeholder="Enter old password" required>
                                <!-- error message -->
                                @if ($errors->has('old_password'))
                                    <div class="text-danger">
                                        {{ $errors->first('old_password') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="new_pass">New password</label>
                                <input  type="password" minlength="8" maxlength="20" class="form-control" id="new_pass" name="new_password" placeholder="Enter new password" required="" aria-describedby="passwordHelpBlock">
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
                                <label for="repeat_new_pass">Repeat new password</label>
                                <input  type="password" minlength="8" maxlength="20" class="form-control" id="repeat_new_pass" name="repeat_new_password" placeholder="Repeat new password" aria-describedby="passwordConfirmHelpBlock" required>
                                <small id="passwordConfirmHelpBlock" class="form-text text-muted">
                                </small>
                                <!-- error message -->
                                @if ($errors->has('repeat_new_password'))
                                    <div class="text-danger">
                                        {{ $errors->first('repeat_new_password') }}
                                    </div>
                                @endif
                            </div>
                        </div>  
                        <br>

                        <div class="form-row" >
                            <button type="submit" id="save_new_password" class="sh_save_btn btn btn-outline-primary float-right">Save</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3"></div>
            </form>
            
            <?php /*
                <div class="card-footer small text-muted">
                    Last updated on {{ Carbon\Carbon::parse($currentUser->updated_at)->format('m/d/Y, i:s') }}
                </div> */
            ?>
            
        </div>
    </div>

@endsection