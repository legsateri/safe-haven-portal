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

<div class="card mb-3 admin_edit_org_general_page">
@include('admin.organisations.edit_organisation_header')
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
                <label for="code">Organization code</label>
                <input  type="text" class="form-control"
                        id="code" name="code"
                        maxlength="40"
                        @if( isset($organisation->code) )
                            value="{{ $organisation->code }}"
                        @endif
                        >
                <!-- error message -->
                @if ($errors->has('code'))
                    <div class="text-danger">
                        {{ $errors->first('code') }}
                    </div>
                @endif
            </div>

        </div>

        <div class="form row">

            <div class="form-group col-md-4 offset-md-2">
                <label for="tax_id">Tax ID</label>
                <input  type="text" class="form-control"
                        id="tax_id" name="tax_id"
                        maxlength="10" pattern="^\d{2}-\d{7}$" placeholder="XX-XXXXXXX"
                        @if( isset($organisation->tax_id) )
                            value="{{ $organisation->tax_id }}"
                        @endif
                        placeholder="e.g. 12-1234567"
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
                <label for="type">Organization type</label>
                <select name="type" id="type">
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
            @if ($errors->has('type'))
                <div class="text-danger">
                    {{ $errors->first('type') }}
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
