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

    <div class="card mb-3 org_account_cont">
        
        <div class="card-header">
            <i class="fa fa-university"></i> My Organization
        </div>

        <div class="card-body">            
            <div class="container-fluid">           
                <div class="row signup_form_row">
                    
                    <div class="col-lg-2 col-md-2"></div>
                    
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        
                        <form   @if(isset($checkOrganisationAdmin->id))
                                    action="{{ route('user.organisation.update.info') }}" method="post"
                                @endif >
                        
                            @if(isset($checkOrganisationAdmin->id))
                                {{ csrf_field() }}
                            @endif

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="org_name">Organization Name</label>
                                    <input  type="text" class="form-control" id="org_name" name="name" maxlength="40" required
                                            value="<?php if (isset($organisation->name)) {echo $organisation->name;} ?>"
                                            @if(!isset($checkOrganisationAdmin->id))
                                                disabled
                                            @endif
                                            >
                                    <!-- error message -->
                                    @if ($errors->has('name'))
                                        <div class="text-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="org_code">Organization Code</label>
                                    @if(isset($checkOrganisationAdmin->id))
                                        <input  type="text" class="form-control" id="org_code" name="code" placeholder="" 
                                                value="<?php if (isset($organisation->code)) {echo $organisation->code;} ?>">
                                    @else
                                        <input  type="text" class="form-control" id="org_code" name="code" placeholder="" value="For organization code contact your admin" disabled>

                                    @endif
                                    <!-- error message -->
                                    @if ($errors->has('code'))
                                        <div class="text-danger">
                                            {{ $errors->first('code') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tax_id">Tax ID (EIN) - (9 digits)</label>
                                    <input  type="text" class="form-control" id="tax_id" name="tax_id" maxlength="10" pattern="^\d{2}-\d{7}$" placeholder="XX-XXXXXXX" required
                                            value="<?php if (isset($organisation->tax_id)) {echo $organisation->tax_id;} ?>"
                                            @if(!isset($checkOrganisationAdmin->id))
                                                disabled
                                            @endif
                                            >
                                    <!-- error message -->
                                    @if ($errors->has('tax_id'))
                                        <div class="text-danger">
                                            {{ $errors->first('tax_id') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="org_services">Services offered</label>
                                    <input  type="text" class="form-control" id="org_services" name="services" maxlength="50" placeholder=""
                                            value="<?php if (isset($organisation->services)) {echo $organisation->services;} ?>"
                                                    @if(!isset($checkOrganisationAdmin->id))
                                                        disabled
                                                    @endif
                                                    >
                                    <!-- error message -->
                                    @if ($errors->has('services'))
                                        <div class="text-danger">
                                            {{ $errors->first('services') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="office_hours">Office Hours</label>
                                    <textarea   name="office_hours" id="office_hours" rows="2" class="form-control"
                                                @if(!isset($checkOrganisationAdmin->id))
                                                    disabled
                                                @endif
                                    >{{ $organisation->office_hours }}</textarea>
                                    <!-- error message -->
                                    @if ($errors->has('office_hours'))
                                        <div class="text-danger">
                                            {{ $errors->first('office_hours') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="org_website_url">Website URL</label>
                                    <input  type="text" class="form-control" id="org_website_url" name="website" maxlength="25" placeholder=""
                                            value="<?php if (isset($organisation->website)) {echo $organisation->website;} ?>"
                                                    @if(!isset($checkOrganisationAdmin->id))
                                                        disabled
                                                    @endif
                                                    >
                                    <!-- error message -->
                                    @if ($errors->has('website'))
                                        <div class="text-danger">
                                            {{ $errors->first('website') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="org_geo_service_area">Geographic Service Area</label>
                                    <input  type="text" class="form-control" id="org_geo_service_area" name="geographic_area_served" maxlength="25" placeholder=""
                                            value="<?php if (isset($organisation->geographic_area_served)) {echo $organisation->geographic_area_served;} ?>"
                                                    @if(!isset($checkOrganisationAdmin->id))
                                                        disabled
                                                    @endif
                                                    >
                                    <!-- error message -->
                                    @if ($errors->has('geographic_area_served'))
                                        <div class="text-danger">
                                            {{ $errors->first('geographic_area_served') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="org_admin">Organization Admins</label>
                                    @foreach( $organisationAdmins as $organisationAdmin )
                                    <input  type="text" class="form-control" id="org_admin" name="org_admin" value="{{ $organisationAdmin->first_name }} {{ $organisationAdmin->last_name }}: {{ $organisationAdmin->email }}" disabled>
                                    @endforeach
                                    <!-- error message -->
                                    @if ($errors->has('org_admin'))
                                        <div class="text-danger">
                                            {{ $errors->first('org_admin') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <hr class="my-4">
                        
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="contact_phone_num">Contact Phone Number</label>
                                    <input  type="phone" class="form-control" id="contact_phone_num" name="phone_number" maxlength="12" pattern="^\d{3}-\d{3}-\d{4}$" placeholder="XXX-XXX-XXXX" required
                                            value="<?php if (isset($organisationPhone->number)) {echo $organisationPhone->number;} ?>"
                                            @if(!isset($checkOrganisationAdmin->id))
                                                disabled
                                            @endif
                                            >
                                    <!-- error message -->
                                    @if ($errors->has('phone_number'))
                                        <div class="text-danger">
                                            {{ $errors->first('phone_number') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email</label>
                                    <input  type="email" class="form-control" id="inputEmail4" name="email" placeholder="e.g. yourname@yourmail.com" maxlength="45" required
                                            value="<?php if (isset($organisation->email)) {echo $organisation->email;} ?>"
                                            @if(!isset($checkOrganisationAdmin->id))
                                                disabled
                                            @endif
                                            >
                                    <!-- error message -->
                                    @if ($errors->has('email'))
                                        <div class="text-danger">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input  type="text" class="form-control" id="address" name="street" maxlength="50"
                                            value="<?php if (isset($organisationAddress->street)) {echo $organisationAddress->street;} ?>"
                                                    @if(!isset($checkOrganisationAdmin->id))
                                                        disabled
                                                    @endif
                                                    >
                                    <!-- error message -->
                                    @if ($errors->has('street'))
                                        <div class="text-danger">
                                            {{ $errors->first('street') }}
                                        </div>
                                    @endif                                        
                                </div>
                                <div class="form-group col-md-6"></div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="city">City</label>
                                    <input  type="text" class="form-control" id="city" name="city" maxlength="25"
                                            value="<?php if (isset($organisationAddress->city)) {echo $organisationAddress->city;} ?>"
                                                    @if(!isset($checkOrganisationAdmin->id))
                                                        disabled
                                                    @endif
                                                    >
                                    <!-- error message -->
                                    @if ($errors->has('city'))
                                        <div class="text-danger">
                                            {{ $errors->first('city') }}
                                        </div>
                                    @endif
                                </div>
                                
                                @if ( ($organisationAddress['state'] != "" || $organisationAddress['state'] != null) || isset($checkOrganisationAdmin->id) )
                                <div class="form-group col-md-4">
                                    <label for="state">State</label>
                                    <select class="form-control" id="state" name="state"
                                            @if(!isset($checkOrganisationAdmin->id))
                                                disabled
                                            @endif
                                            >
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                        <option value="{{$state->name}}"
                                                @if($state->name == $organisationAddress['state'])
                                                selected
                                                @endif                                               
                                                >{{$state->name}}
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
                                @endif

                                <div class="form-group col-md-2">
                                    <label for="zip">Zip (5 digits)</label>
                                    <input  type="text" class="form-control" id="zip" name="zip_code" pattern="^\d{5}$" maxlength="5" placeholder="XXXXX" 
                                            value="<?php if (isset($organisationAddress['zip_code'])) {echo $organisationAddress['zip_code'];} ?>"
                                                    @if(!isset($checkOrganisationAdmin->id))
                                                        disabled
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
                            <br>
                            @if(isset($checkOrganisationAdmin->id))
                                <button type="submit" class="sh_save_btn btn btn-outline-primary float-right">Save</button>
                            @endif
                        </form>
                    </div>
                    <div class="col-lg-2 col-md-2">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection