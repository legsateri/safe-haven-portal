@extends('admin.layout.main')

@section('content')

@include('admin.users.user.edit_user_notifications_partial')
<div class="card mb-3">

@include('admin.users.user.edit_user_header_partial')
<div class="card-body admin_edit_user_page">
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
                        maxlength="12" pattern="^\d{3}-\d{3}-\d{4}$" placeholder="XXX-XXX-XXXX"
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
                        maxlength="5" placeholder="XXXXX"
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

</div>
@endsection