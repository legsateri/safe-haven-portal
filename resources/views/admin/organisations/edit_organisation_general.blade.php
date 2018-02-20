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
    <form   action="{{ route('admin.organisation.edit.submit.general', ['id' => $organisation->id, 'slug' => $organisation->slug]) }}" 
            method="post">
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

            <div class="form-group col-md-4 offset-md-2"> 
                <label for="tax_id">Tax ID</label>
                <input  type="text" class="form-control"
                        id="tax_id" name="tax_id" 
                        maxlength="40" 
                        @if( isset($organisation->tax_id) )
                            value="{{ $organisation->tax_id }}"
                        @endif
                        >
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

</div>
@endsection