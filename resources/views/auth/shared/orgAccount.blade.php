@extends('layouts.user-main')

@section('content')
    <div class="card mb-3 org_account_cont">
        <div class="card-header">
            <i class="fa fa-university"></i> My Organization</div>
        <div class="card-body">
            <div class="container-fluid">
            <div class="row signup_form_row">
                <div class="col-lg-2 col-md-2">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('register') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div id="sign_up_org_name_half_row" class="form-group col-md-6">
                                <label for="org_name">Organization Name</label>
                                <input type="text" class="form-control" id="org_name" maxlength="40" name="org_name" value="{{ old('org_name') }}">
                            </div>
                            <div id="sign_up_org_code_half_row" class="form-group col-md-6">
                                <label for="org_code">Organization Code</label>
                                <input type="text" class="form-control" id="org_code" placeholder="" name="organization_code" value="{{ old('organization_code') }}">
                            </div>
                        </div>
                        <div id="sign_up_tax_id_row" class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tax_id">Tax ID (EIN) - (9 digits)</label>
                                <input type="text" class="form-control" id="tax_id" maxlength="10" name="tax_id" pattern="^\d{2}-\d{7}$" value="{{ old('tax_id') }}" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="org_services">Services offered</label>
                                <input type="text" class="form-control" id="org_services" maxlength="50" required="" value="{{ old('org_services') }}" name="services" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Office Hours</label>
                                <div style="display: block;" class="radio_custom_group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input  type="radio" id="org_office_hours" value="yes" name="org_office_hours"
                                                {{--@if ( isset( $tempData['pet-spayed'] ) )
                                                @if ( in_array( $tempData['pet-spayed'], ['spayed_yes', 'yes'] ) )
                                                checked
                                                @endif
                                                @endif--}}
                                                class="custom-control-input">
                                        <label class="custom-control-label" for="org_office_hours">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input  type="radio" id="org_office_hours_no" value="no" name="org_office_hours"
                                                {{--@if ( isset( $tempData['pet-spayed'] ) )
                                                @if ( in_array( $tempData['pet-spayed'], ['spayed_no', 'no'] ) )
                                                checked
                                                @endif
                                                @endif--}}
                                                class="custom-control-input">
                                        <label class="custom-control-label" for="org_office_hours">No</label>
                                    </div>
                                </div>
                                <div class="invalid-feedback">More example invalid feedback text</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="org_website_url">Website URL</label>
                                <input type="text" class="form-control" id="org_website_url" maxlength="25" required="" value="{{ old('org_website_url') }}" name="website_url" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="org_geo_service_area">Geographic Service Area</label>
                                <input type="text" class="form-control" id="org_geo_service_area" maxlength="25" required="" value="{{ old('org_geo_service_area') }}" name="geo_service_area" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="org_admin">Organization Admin</label>
                                <input type="text" class="form-control" id="org_admin" maxlength="25" required="" value="{{ old('org_admin') }}" name="org_admin" placeholder="">
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="contact_phone_num">Contact Phone Number</label>
                                <input type="phone" class="form-control" id="contact_phone_num" name="contact_phone_number" maxlength="10" pattern="^\d{3}\d{3}\d{4}$" placeholder="XXXXXXXXXX" required="" value="{{ old('contact_phone_number') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" maxlength="45" class="form-control" id="inputEmail4" name="email" placeholder="e.g. yourname@yourmail.com" required="" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="address">Address</label>
                                <input  type="text" class="form-control" id="address" maxlength="50" required=""
                                        @if ( isset($tempData['client-address']) )
                                        value="{{ $tempData['client-address'] }}"
                                        @else
                                        value="{{ old('address') }}"
                                        @endif
                                        name="address" placeholder="">
                                <div class="invalid-feedback">
                                    Please enter your address.
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="city">City</label>
                                <input  type="text" class="form-control" id="city" maxlength="25" required=""
                                        @if ( isset( $tempData['client-city'] ) )
                                        value="{{ $tempData['client-city'] }}"
                                        @else
                                        value="{{ old('city') }}"
                                        @endif
                                        name="city" placeholder="">
                                <div class="invalid-feedback">
                                    Please enter your city.
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="state">State</label>
                                <div class="input-group mb-3 invalid_message_correction">
                                    <select class="custom-select" name="state" id="state">
                                        <option value="" selected>Choose...</option>
                                        {{--@foreach( $states as $state )
                                            <option value="{{ $state->value }}"
                                                    @if ( isset( $tempData['client-state'] ) )
                                                    @if ( $tempData['client-state'] == $state->value )
                                                    selected
                                                    @endif
                                                    @endif
                                            >{{ $state->name }}</option>
                                        @endforeach--}}
                                        <option value="" selected="">Choose...</option>
                                        <option value="alabama">Alabama</option>
                                        <option value="alaska">Alaska</option>
                                        <option value="arizona">Arizona</option>
                                        <option value="arkansas">Arkansas</option>
                                        <option value="california">California</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please enter your state.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="zip">Zip (5 digits)</label>
                                <input  type="text" class="form-control" id="zip" maxlength="5" required=""
                                        @if ( isset( $tempData['client-city'] ) )
                                        value="{{ $tempData['client-zip'] }}"
                                        @else
                                        value="{{ old('zip') }}"
                                        @endif
                                        name="zip" placeholder="XXXXX">
                                <div class="invalid-feedback">
                                    Please enter your zip code.
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="sh_save_btn btn btn-primary float-right">Save</button>
                    </form>
                </div>
                <div class="col-lg-2 col-md-2">
                </div>
            </div>
            </div>
        </div>
    </div>

@endsection