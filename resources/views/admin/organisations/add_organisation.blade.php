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
    <i class="fa fa-area-chart"></i> Add Organization</div>
<div class="card-body">
    <form action="{{ route('admin.organisation.add.submit') }}" method="post">
        {{ csrf_field() }}

        <div class="form row">
            <div class="form-group col-md-8 offset-md-2">
                <h4>General information</h4>
                <hr> 
            </div>
        </div>


        <div class="form row">

            <div class="form-group col-md-4 offset-md-2"> 
                <label for="name">Name</label>
                <input  type="text" class="form-control"
                        id="name" name="name" 
                        maxlength="40"
                        placeholder="organization name" 
                        value="{{ old('name') }}">
                <!-- error message -->
                @if ($errors->has('name'))
                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="organisation_code">Organization code <small>(optional)</small></label>
                <input  type="text" class="form-control"
                        id="organisation_code" name="organisation_code" 
                        maxlength="40" 
                        placeholder="organization code"
                        value="{{ old('organisation_code') }}">
                <!-- error message -->
                @if ($errors->has('organisation_code'))
                    <div class="text-danger">
                        {{ $errors->first('organisation_code') }}
                    </div>
                @endif
            </div>

        </div>

        <div class="form row">
            <div class="form-group col-md-4  offset-md-2">
                <label for="tax_id">Tax id <small>(optional)</small></label>
                <input  type="text" class="form-control"
                        id="tax_id" name="tax_id" 
                        maxlength="40" 
                        placeholder="e.g. 12-1234567"
                        value="{{ old('tax_id') }}">
                <!-- error message -->
                @if ($errors->has('tax_id'))
                    <div class="text-danger">
                        {{ $errors->first('tax_id') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4  offset-md-2">
                <label for="organisation_type">Organisation type</label>
                <br>
                <select name="organisation_type" id="organisation_type">
                    <option value="">Select type</option>
                    @foreach ( $organisationTypes as $organisationType )
                        <option value="{{ $organisationType->id }}"
                            @if ( old('organisation_type') == $organisationType->id )
                                selected
                            @endif
                        >
                            {{ $organisationType->label }} 
                        </option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('organisation_type'))
                <div class="text-danger">
                    {{ $errors->first('organisation_type') }}
                </div>
            @endif
        </div>

        <div class="form row">
            <div class="form-group col-md-8 offset-md-2">
                <h4>Contact information</h4> 
                <hr>
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="email">Email <small>(optional)</small></label>
                <input  type="email" class="form-control"
                        id="email" name="email" 
                        maxlength="45" 
                        placeholder="e.g. example@organization.com"
                        value="{{ old('email') }}">
                <!-- error message -->
                @if ($errors->has('email'))
                    <div class="text-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="phone">Office Phone <small>(optional)</small></label>
                <input  type="text" class="form-control"
                        id="phone" name="phone" 
                        maxlength="40" 
                        placeholder="phone number"
                        value="{{ old('phone') }}">
                <!-- error message -->
                @if ($errors->has('phone'))
                    <div class="text-danger">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>
        </div>


        <div class="form row">
            <div class="form-group col-md-5 offset-md-2">
                <label for="city">City <small>(optional)</small></label>
                <input  type="text" class="form-control"
                        id="city" name="city" 
                        maxlength="40"
                        placeholder="city name"
                        value="{{ old('city') }}"
                        >
                <!-- error message -->
                @if ($errors->has('city'))
                    <div class="text-danger">
                        {{ $errors->first('city') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="zip_code">Zip <small>(optional)</small></label>
                <input  type="text" class="form-control"
                        id="zip_code" name="zip_code" 
                        maxlength="40" 
                        placeholder="e.g. 12345"
                        value="{{ old('zip_code') }}"
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
                <label for="street">Street <small>(optional)</small></label>
                <input  type="text" class="form-control"
                        id="street" name="street" 
                        maxlength="100" 
                        placeholder="street nad number"
                        value="{{ old('street') }}"
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
                <label for="state">State <small>(optional)</small></label>
                <br>
                <select name="state" id="state">
                    <option value="">Select state</option>
                    @foreach( $states as $state )
                        <option value="{{ $state->name }}"
                            @if( old('state') == $state->name )
                                selected
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
                <button type="submit" class="sh_save_btn btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection