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
<div class="card-body">
    <form action="" method="post">
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
                        @if( isset($organisation->name) )
                            value="{{ $organisation->name }}"
                        @endif
                        >
                <!-- error message -->
                @if ($errors->has('name'))
                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="organisation_code">Organization code</label>
                <input  type="text" class="form-control"
                        id="organisation_code" name="organisation_code" 
                        maxlength="40" 
                        @if( isset($organisation->code) )
                            value="{{ $organisation->code }}"
                        @endif
                        >
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
                <label for="organisation_type">Organisation type</label>
                <select name="organisation_type" id="organisation_type">
                    <option value="">Select type</option>
                    @foreach ( $organisationTypes as $organisationType )
                        <option value="{{ $organisationType->id }}"
                            @if( $organisationType->id == $organisation->type_id )
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
            <div class="form-group col-md-4 offset-md-2">
                <button type="submit" class="sh_save_btn btn btn-primary">Update General Information</button>
            </div>
        </div>
    </form>


    <form action="" method="post">
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
                        value="{{ old('email') }}"
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
                        value="{{ old('phone') }}"
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
            <div class="form-group col-md-5 offset-md-2">
                <label for="city">City</label>
                <input  type="text" class="form-control"
                        id="city" name="city" 
                        maxlength="40"
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
                <label for="zip_code">Zip</label>
                <input  type="text" class="form-control"
                        id="zip_code" name="zip_code" 
                        maxlength="40" 
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
                <label for="street">Street</label>
                <input  type="text" class="form-control"
                        id="street" name="street" 
                        maxlength="100" 
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
                <button type="submit" class="sh_save_btn btn btn-primary">Update Contact Information</button>
            </div>
        </div>
    </form>


    <form action="" method="post">
        {{ csrf_field() }}


        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <button type="submit" class="sh_save_btn btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection