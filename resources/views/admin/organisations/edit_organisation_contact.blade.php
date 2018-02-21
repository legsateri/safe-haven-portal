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

<div class="card mb-3">
<div class="card-header">
    <i class="fa fa-area-chart"></i> Edit {{ $organisation->name }}</div>

@include('admin.organisations.edit_organisation_submenu_partial')

<div class="card-body">

    <form   action="{{ route('admin.organisation.edit.submit.contact', ['id' => $organisation->id, 'slug' => $organisation->slug]) }}" 
            method="post">
        {{ csrf_field() }}

        <div class="form row">
            <div class="form-group col-md-8 offset-md-2">
                <h4>Contact information</h4> 
                <hr>
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="email">Email</label>
                <input  type="email" class="form-control"
                        id="email" name="email" 
                        maxlength="40" 
                        @if( isset( $organisation->email ) )
                            value="{{ $organisation->email }}"
                        @else
                            value="{{ old('email') }}"
                        @endif
                        >
                <!-- error message -->
                @if ($errors->has('email'))
                    <div class="text-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="phone">Office Phone</label>
                <input  type="text" class="form-control"
                        id="phone" name="phone" 
                        maxlength="40" 
                        @if( isset( $phone->number ) )
                            value="{{ $phone->number }}"
                        @else
                            value="{{ old('phone') }}"
                        @endif
                        >
                <!-- error message -->
                @if ($errors->has('phone'))
                    <div class="text-danger">
                        {{ $errors->first('phone') }}
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
                        <option value="{{ $state->name }}"
                        @if( isset($address->state) )
                            @if( $address->state == $state->name )
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
            <div class="form-group col-md-5 offset-md-2">
                <label for="city">City</label>
                <input  type="text" class="form-control"
                        id="city" name="city" 
                        maxlength="40"
                        @if( isset( $address->city ) )
                            value="{{ $address->city }}"
                        @else
                            value="{{ old('city') }}"
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
                        @if( isset( $address->zip_code ) )
                            value="{{ $address->zip_code }}"
                        @else
                            value="{{ old('zip_code') }}"
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
                        @if( isset( $address->street ) )
                            value="{{ $address->street }}"
                        @else
                            value="{{ old('street') }}"
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
                <button type="submit" class="sh_save_btn btn btn-primary">Update Contact Information</button>
            </div>
        </div>
    </form>

</div>
@endsection