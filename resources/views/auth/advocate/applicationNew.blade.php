<?php
/**
 * new application form
 */
?>
@extends('layouts.user-main')

@section('content')

    <div id="accordion_client_new_application" role="tablist">
        <div class="card accordion_section_1">
            <div class="card-header" role="tab" id="headingOne">
                <h5 class="mb-0">
                    <a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
                        New Client application - Step 1
                    </a>
                    <i class="check_1 fa fa-check" aria-hidden="true"></i>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">

                    <div class="row new_client_form_row">
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
                            <form id="new_client_app_form" action="{{ route('register') }}" method="post">
                                {{ csrf_field() }}
                                {{--<input name="action" value="validation_multi_client" type="hidden">--}}
                                <input name="action" value="validation_multi" type="hidden">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="org_last_name">First Name</label>
                                        <input  type="text" class="form-control" id="org_first_name" maxlength="25" required="" 
                                                @if ( isset($tempData['client-first-name']) )
                                                    value="{{ $tempData['client-first-name'] }}" 
                                                @else
                                                    value="{{ old('first_name') }}" 
                                                @endif
                                                name="first_name" placeholder="">
                                        <div class="invalid-feedback">
                                            Please enter your first name.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="org_last_name">Last Name</label>
                                        <input  type="text" class="form-control" id="org_last_name" maxlength="25" required="" 
                                                @if ( isset($tempData['client-last-name']) )
                                                    value="{{ $tempData['client-last-name'] }}"
                                                @else
                                                    value="{{ old('last_name') }}" 
                                                @endif
                                                name="last_name" placeholder="">
                                        <div class="invalid-feedback">
                                            Please enter your last name.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="contact_phone_num">Phone Number (10 digits)</label>
                                        <input  type="phone" class="form-control" id="contact_phone_num" name="contact_phone_number" maxlength="10" pattern="^\d{3}-\d{3}-\d{4}$" placeholder="XXX-XXX-XXXX" required=""
                                                @if ( isset($tempData['client-phone-number']) )
                                                    value="{{ $tempData['client-phone-number'] }}"
                                                @else
                                                    value="{{ old('contact_phone_number') }}"
                                                @endif
                                                >
                                        <div class="invalid-feedback">
                                            Please enter your phone number.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="phone_number_type">Type</label>
                                        <div class="input-group mb-3 invalid_message_correction">

                                            <select class="custom-select" name="phone_number_type" id="phone_number_type">
                                                <option value="" selected>Choose...</option>
                                                @foreach( $phoneTypes as $phoneType )
                                                    <option value="{{$phoneType->value}}"
                                                        @if ( isset($tempData['client-phone-number-type']) )
                                                            @if ( $tempData['client-phone-number-type'] == $phoneType->value )
                                                                selected
                                                            @endif
                                                        @endif
                                                    >{{$phoneType->label}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select your phone number type.
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Email</label>
                                        <input  type="email" maxlength="45" class="form-control" id="inputEmail4" name="email" placeholder="e.g. yourname@yourmail.com" required="" 
                                                @if ( isset($tempData['client-email']) )
                                                    value="{{ $tempData['client-email'] }}"
                                                @else
                                                    value="{{ old('email') }}".
                                                @endif
                                                >
                                        <div class="invalid-feedback">
                                            Please enter your email.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pref_contact_method">Preferred Contact method</label>

                                        <div class="input-group mb-3 invalid_message_correction">

                                            <select class="custom-select" name="pref_contact_method" id="pref_contact_method">
                                                <option value=""  selected>Choose...</option>
                                                @foreach( $preferedContactMethods as $key => $value )
                                                    <option value="{{ $key }}"
                                                        @if ( isset( $tempData['client-prefered-contact-method'] ) )
                                                            @if ( $tempData['client-prefered-contact-method'] == $key )
                                                                selected
                                                            @endif
                                                        @endif
                                                    >{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please enter your preferred contact method.
                                            </div>
                                        </div>

                                    </div>
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
                                                @foreach( $states as $state )
                                                    <option value="{{ $state->value }}"
                                                        @if ( isset( $tempData['client-state'] ) )
                                                            @if ( $tempData['client-state'] == $state->value )
                                                                selected
                                                            @endif
                                                        @endif
                                                    >{{ $state->name }}</option>
                                                @endforeach
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

                                <div class="form-row">
                                    <div class="form-group col-md-12 text-right">
                                        <button id="next_step_1_2" type="button" class="btn btn-primary">Next Step</button>
                                        <div class="spinner_cont spinner_form_1"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-2 col-md-2">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card accordion_section_2">
            <div class="card-header" role="tab" id="headingTwo">
                <h5 class="mb-0">
                    <a class="collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                        Add Pet - Step 2
                    </a>
                    <i class="check_2 fa fa-check" aria-hidden="true"></i>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">

                    <div class="row new_client_form_row">
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
                           <form id="new_pet_app_form" action="{{ route('register') }}" method="post">
                                {{ csrf_field() }}
                                <input name="action" value="validation_multi_pet" type="hidden">
                                <div id="pet_form_cont">

                                    <?php
                                    /**
                                     * load pet details form partial
                                     */
                                    ?>
                                    <?php $counter = 0; ?>
                                    <?php $newPetFormLoad = false; ?>
                                    <?php if( isset( $tempData['pet'] ) ): ?>
                                        <?php if ( count( $tempData['pet'] ) > 0 ): ?>
                                            <?php foreach( $tempData['pet'] as $tempPet ): ?>
                                                <?php $counter++; ?>
                                                <?php if ( isset( $tempData['pet'][$counter] ) ): ?>
                                                    @include('auth.advocate.partials.application_form_pet_info')
                                                    <?php $newPetFormLoad = true; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($newPetFormLoad == false): ?>
                                        @include('auth.advocate.partials.application_form_pet_info')
                                    <?php endif; ?>

                                </div>
                            </form>
                                <div class="form-row new_client_form_button_row mt-3">

                                    <div class="form-group col-md-12 text-right">
                                        <button id="add_another_pet" type="button" class="btn btn-primary">Add Another Pet</button>
                                        <button id="next_step_2_3" type="button" class="btn btn-primary">Next Step</button>
                                        <div class="spinner_cont spinner_form_2"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                                    </div>
                                </div>

                            </div>
                        <div class="col-lg-2 col-md-2">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card accordion_section_3">
            <div class="card-header" role="tab" id="headingThree">
                <h5 class="mb-0">
                    <a class="collapsed" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">
                        Application Review - Step 3
                    </a>
                    <i class="check_3 fa fa-check" aria-hidden="true"></i>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    <div class="row understand_row">
                        <div class="col-lg-2 col-md-2">
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="row text-center mb-3">
                                I understand that this application will be reviewed by The Safe Haven Network's partner Safe Haven Providers,
                                which includes animal shelters and foster homes. I understand that these Safe Haven Providers are
                                independent programs that may require additional information from me and may have different guidelines for admission.
                            </div>
                            <div class="row text-center">
                                <div class="i_understand_button_cont">
                                    <button id="i_understand" type="button" class="btn btn-primary mx-auto">I understand</button>
                                    <div class="spinner_cont spinner_form_3"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                                    {{ csrf_field() }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12 text-right">

                            <button id="next_step_3_4" type="button" class="btn btn-primary disabled">Next Step</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card accordion_section_4">
            <div class="card-header" role="tab" id="headingThree">
                <h5 class="mb-0">
                    <a class="collapsed" data-toggle="collapse" href="#collapseFour" role="button" aria-expanded="false" aria-controls="collapseFour">
                        Submit Application - Step 4
                    </a>
                    {{--<span class="form_submitted_successfully">Your application has been successfully submitted.</span>--}}
                    <i class="check_4 fa fa-check" aria-hidden="true"></i>
                </h5>
            </div>
            <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-12 text-center">
                            <form id="assign_application_to_form_data">
                                <label for="">Assign Application</label>
                                <div style="display: block;" class="radio_custom_group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input  type="radio" id="assign_to_me" value="assign_to_me" name="assign_application_to"
                                                {{--@if ( isset( $tempData['pet-spayed'] ) )
                                                @if ( in_array( $tempData['pet-spayed'], ['spayed_yes', 'yes'] ) )
                                                checked
                                                @endif
                                                @endif--}}
                                                class="custom-control-input">
                                        <label class="custom-control-label" for="assign_to_me">Assign this Client to me</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input  type="radio" id="add_to_clients_in_need" value="add_to_clients_in_need" name="assign_application_to"
                                                {{--@if ( isset( $tempData['pet-spayed'] ) )
                                                @if ( in_array( $tempData['pet-spayed'], ['spayed_no', 'no'] ) )
                                                checked
                                                @endif
                                                @endif--}}
                                                class="custom-control-input">
                                        <label class="custom-control-label" for="add_to_clients_in_need">Add Client to Clients in Need List</label>
                                    </div>
                                </div>
                                <div class="invalid-feedback">More example invalid feedback text</div>
                            </form>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 text-center">

                            <button id="client_new_application_submit" type="button" class="btn btn-primary">Submit Application</button>
                            <a href="/application/new" id="client_new_application_start_another" type="button" class="btn btn-primary">Start another Application</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection