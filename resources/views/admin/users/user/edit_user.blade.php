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

<!--contact success message -->
@if (session('success-contact'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success-contact') }}
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

<!-- verify 1 success message -->
@if (session('success-verify1'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success-verify1') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- verify 0 success message -->
@if (session('success-verify0'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('success-verify0') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- ban 1 success message -->
@if (session('success-ban1'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('success-ban1') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- ban 0 success message -->
@if (session('success-ban0'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success-ban0') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- verify admin password error message -->
@if ($errors->has('admin_password_verify'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first('admin_password_verify') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- verify admin password error message -->
@if (session('error-admin-password-verify'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error-admin-password-verify') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- ban admin password error message -->
@if ($errors->has('admin_password_ban'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first('admin_password_ban') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- ban admin password error message -->
@if (session('error-admin-password-ban'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error-admin-password-ban') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


<div class="card mb-3">
<div class="card-header">
    <i class="fa fa-user"></i> Edit {{ $user->first_name }} {{ $user->last_name }}</div>
<div class="card-body">
    <?php
    /**
     * update general information form
     */
    ?>
    <div class="form row">
        <div class="form-group col-md-8 offset-md-2"> 
            <h5>General information</h5>
            <hr>
        </div>
    </div>
    <form action="{{ route('admin.user.edit.submit.general', ['id' => $user->id, 'slug' => $user->slug]) }}" method="post">
        {{ csrf_field() }}

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2"> 
                <label for="first_name">First Name</label>
                <input  type="text" class="form-control"
                        id="first_name" name="first_name" 
                        maxlength="40" 
                        value="{{ $user->first_name }}">
                <!-- error message -->
                @if ($errors->has('first_name'))
                    <div class="text-danger">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="last_name">Last Name</label>
                <input  type="text" class="form-control"
                        id="last_name" name="last_name" 
                        maxlength="40" 
                        value="{{ $user->last_name }}">
                <!-- error message -->
                @if ($errors->has('last_name'))
                    <div class="text-danger">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="email">Email</label>
                <input  type="email" class="form-control"
                        id="email" name="email" 
                        maxlength="40" 
                        value="{{ $user->email }}">
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
                <label for="organisation">Organisation</label>
                <select name="organisation" id="organsation">
                    <option value="">Select organisation</option>
                    @foreach( $organisations as $organisation )
                        <option value="{{ $organisation->id }}"
                            @if ( $user->organisation_id == $organisation->id )
                                selected
                            @endif
                        >
                            {{ $organisation->name }}
                        </option>
                    @endforeach
                </select>
                <!-- error message -->
                @if ($errors->has('organsation'))
                    <div class="text-danger">
                        {{ $errors->first('organsation') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <button type="submit" class="sh_save_btn btn btn-primary">Update general information</button>
            </div>
        </div>
    </form>

    <?php
    /**
     * update contact information form
     */
    ?>
    <br>
    <div class="form row">
        <div id="contact" class="form-group col-md-8 offset-md-2"> 
            <h5>Contact information</h5>
            <hr>
        </div>
    </div>
    <form action="{{ route('admin.user.edit.submit.contact', ['id' => $user->id, 'slug' => $user->slug]) }}" method="post">
        {{ csrf_field() }}

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="phone_type">Phone type</label>
                <select name="phone_type" id="phone_type">
                    <option value="">Select</option>
                    @foreach( $phoneTypes as $phoneType )
                        <option value="{{ $phoneType->id }}"
                        @if ( isset($userPhone->phone_type_id) )
                            @if ( $userPhone->phone_type_id == $phoneType->id )
                                selected
                            @endif
                        @endif
                        >
                            {{ $phoneType->label }}
                        </option>
                    @endforeach
                </select>
                <!-- error message -->
                @if ($errors->has('phone_type'))
                    <div class="text-danger">
                        {{ $errors->first('phone_type') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="phone">Phone number</label>
                <input  type="text" class="form-control"
                        id="phone_number" name="phone_number" 
                        maxlength="40" 
                        @if ( isset($userPhone->number) )
                            value="{{ $userPhone->number }}"
                        @endif
                        >
                <!-- error message -->
                @if ($errors->has('phone_number'))
                    <div class="text-danger">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="address">Address type</label>
                <select name="address_type" id="address">
                    <option value="">Select</option>
                    @foreach( $addressTypes as $addressType )
                        <option value="{{ $addressType->id }}"
                            @if( isset($userAddress->address_type_id) )
                                @if( $userAddress->address_type_id == $addressType->id )
                                    selected
                                @endif
                            @endif
                        >
                            {{ $addressType->label }}
                        </option>
                    @endforeach
                </select>
                <!-- error message -->
                @if ($errors->has('address_type'))
                    <div class="text-danger">
                        {{ $errors->first('address_type') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-5 offset-md-2">
                <label for="city">City</label>
                <input  type="text" class="form-control"
                        id="city" name="city" 
                        maxlength="40"
                        @if( isset($userAddress->city) )
                            value="{{ $userAddress->city }}"
                        @endif
                        >
                <!-- error message -->
                @if ($errors->has('city'))
                    <div class="text-danger">
                        {{ $errors->first('city') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="zip_code">Zip</label>
                <input  type="text" class="form-control"
                        id="zip_code" name="zip_code" 
                        maxlength="40" 
                        @if( isset($userAddress->zip_code) )
                            value="{{ $userAddress->zip_code }}"
                        @endif
                        >
                <!-- error message -->
                @if ($errors->has('zip_code'))
                    <div class="text-danger">
                        {{ $errors->first('zip_code') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-5 offset-md-2">
                <label for="street">Street</label>
                <input  type="text" class="form-control"
                        id="street" name="street" 
                        maxlength="100" 
                        @if( isset($userAddress->street) )
                            value="{{ $userAddress->street }}"
                        @endif
                        >
                <!-- error message -->
                @if ($errors->has('street'))
                    <div class="text-danger">
                        {{ $errors->first('street') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="state">State</label>
                <select name="state" id="state">
                    <option value="">Select</option>
                    @foreach( $states as $state )
                        <option value="{{ $state->id }}"
                        @if( isset($userAddress->state) )
                            @if( $userAddress->state == $state->name )
                                selected
                            @endif
                        @endif
                        >
                            {{ $state->name }}
                        </option>
                    @endforeach
                </select>
                <!-- error message -->
                @if ($errors->has('state'))
                    <div class="text-danger">
                        {{ $errors->first('state') }}
                    </div>
                @endif
            </div>
        </div>


        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <button type="submit" class="sh_save_btn btn btn-primary">Update contact information</button>
            </div>
        </div>
    </form>


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
        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="new_password">New User Password</label>
                <input  type="password" class="form-control"
                        id="new_password" name="new_password" 
                        maxlength="40" 
                        value="">
                <!-- error message -->
                @if ($errors->has('new_password'))
                    <div class="text-danger">
                        {{ $errors->first('new_password') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="repeat_new_password">Repeat Password</label>
                <input  type="password" class="form-control"
                        id="repeat_new_password"  name="repeat_new_password" 
                        maxlength="40"
                        value="">
                <!-- error message -->
                @if ($errors->has('repeat_new_password'))
                    <div class="text-danger">
                        {{ $errors->first('repeat_new_password') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="admin_password">Your password</label>
                <input  type="password" class="form-control"
                        id="admin_password" name="admin_password" 
                        maxlength="40" 
                        value="">

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

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <button type="submit" class="sh_save_btn btn btn-primary">Reset password</button>
            </div>
        </div>
    </form>

    <?php
    /**
     * service actions on user profile
     */
    ?>
    <br>
    
    <div class="form row">
        <div class="form-group col-md-8 offset-md-2"> 
            <h5>Services</h5>
            <hr>
            
            <!-- Button trigger modal -->
            <button type="button" 
                    class="btn 
                    @if( $user->verified == 1 )
                        btn-success
                    @else
                        btn-warning
                    @endif
                    " 
                    data-toggle="modal" 
                    data-target="#email_verification_modal">
                    @if( $user->verified == 1 )
                        User email is verified
                    @else
                        User email is not verified
                    @endif
            </button>

            <!-- Modal -->
            <div class="modal fade" id="email_verification_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User email verification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    

                    <!-- verify user email form -->
                    <form action="{{ route('admin.user.edit.submit.verified', ['id' => $user->id, 'slug' => $user->slug]) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="new_verified_value" id="new_verified_value"
                                @if( $user->verified == 1 )
                                    value="0"
                                @else
                                    value="1"
                                @endif
                            >
            
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        @if( $user->verified == 1 )
                                            Are you sure that you want to unset verified email for {{ $user->first_name }} {{ $user->last_name }}?<br>
                                            Please verify your action with your password.
                                        @else
                                            Are you sure that you want to set email to verified for {{ $user->first_name }} {{ $user->last_name }}?<br>
                                            Please verify your action with your password.
                                        @endif
                                    </div>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="admin_password_verify">Your password</label>
                                    <input  type="password" class="form-control"
                                            id="admin_password_verify" name="admin_password_verify" 
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
                                            >@if( $user->verified == 1 )
                                                Set user as not verified
                                            @else
                                                Set user as verified
                                            @endif</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- end modal -->

            <!-- Button trigger modal -->
            <button type="button" 
                    class="btn 
                    @if( $user->banned == 1 )
                        btn-danger
                    @else
                        btn-success
                    @endif
                    " 
                    data-toggle="modal" 
                    data-target="#user_ban_modal">
                    @if( $user->banned == 0 )
                        Account is active
                    @else
                        Account is banned
                    @endif
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="user_ban_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" 
                                id="exampleModalLabel">
                            @if( $user->banned == 1 )
                                Remove ban for {{ $user->first_name }} {{ $user->last_name }}?
                            @else
                                Ban {{ $user->first_name }} {{ $user->last_name }}?
                            @endif
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- User ban form -->
                        <form action="{{ route('admin.user.edit.submit.ban', ['id' => $user->id, 'slug' => $user->slug]) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="new_ban_value" id="new_ban_value"
                                @if( $user->banned == 1 )
                                    value="0"
                                @else
                                    value="1"
                                @endif
                            >
            
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        @if( $user->banned == 1 )
                                            Are you sure that you want to remove ban for {{ $user->first_name }} {{ $user->last_name }}?<br>
                                            Please verify your action with your password.
                                        @else
                                            Are you sure that you want to ban {{ $user->first_name }} {{ $user->last_name }}?<br>
                                            Please verify your action with your password.
                                        @endif
                                    </div>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="admin-password">Your password</label>
                                    <input  type="password" class="form-control"
                                            id="admin-password" name="admin_password_ban" 
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
                                            >@if( $user->banned == 1 )
                                                Remove ban
                                            @else
                                                Ban user
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
</div>
@endsection