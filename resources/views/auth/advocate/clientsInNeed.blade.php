@extends('layouts.user-main')

@section('content')
    <div class="card mb-3 clients_in_need_cont">

        <!-- Button trigger modal -->
        {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
        </button>--}}

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Client Acceptance Acknowledgement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Once a client is accepted, emails are sent to Shelters letting them know there are pets in need.
                        By clicking 'Confirm Accept Client' below, your organization is agreeing to work with the Shelters
                        and Client to establish a temporary home for the pet or pets.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="confirm_accept_client" type="button" class="btn btn-primary">Confirm Accept Client</button>
                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                        <input type="hidden" value=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-header">
            <i class="fa fa-heart" aria-hidden="true"></i> Clients in Need</div>
        <div class="card-body">

            {{--<div class="table-responsive">
                <table class="table table-striped table-hover" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Application Date</th>
                        <th scope="col">Zip Code</th>
                        <th scope="col">Pet Count</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td><a href="">Client 1</a></td>
                            <td>07/12/2017</td>
                            <td>90025</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td><a href="">Client 2</a></td>
                            <td>08/12/2017</td>
                            <td>11000</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td><a href="">Client 3</a></td>
                            <td>07/11/2017</td>
                            <td>90026</td>
                            <td>1</td>
                        </tr>

                    </tbody>
                </table>
            </div>--}}


            {{--<div class="row">
                <div class="col-4">
                    <div id="list-example" class="list-group">
                        <a class="list-group-item list-group-item-action" href="#list-item-1">Item 1</a>
                        <a class="list-group-item list-group-item-action" href="#list-item-2">Item2</a>
                        <a class="list-group-item list-group-item-action active" href="#list-item-3">Item 3</a>
                        <a class="list-group-item list-group-item-action" href="#list-item-4">Item 4</a>
                    </div>
                </div>
                <div class="col-8">
                    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
                        <h4 id="list-item-1" style="">Item 1</h4>
                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco cillum consectetur ut et aute consectetur labore. Fugiat laborum incididunt tempor eu consequat enim dolore proident. Qui laborum do non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua officia quis et incididunt voluptate non anim reprehenderit adipisicing dolore ut consequat deserunt mollit dolore. Aliquip nulla enim veniam non fugiat id cupidatat nulla elit cupidatat commodo velit ut eiusmod cupidatat elit dolore.</p>
                        <h4 id="list-item-2" style="">Item 2</h4>
                        <p>Quis magna Lorem anim amet ipsum do mollit sit cillum voluptate ex nulla tempor. Laborum consequat non elit enim exercitation cillum aliqua consequat id aliqua. Esse ex consectetur mollit voluptate est in duis laboris ad sit ipsum anim Lorem. Incididunt veniam velit elit elit veniam Lorem aliqua quis ullamco deserunt sit enim elit aliqua esse irure. Laborum nisi sit est tempor laborum mollit labore officia laborum excepteur commodo non commodo dolor excepteur commodo. Ipsum fugiat ex est consectetur ipsum commodo tempor sunt in proident.</p>
                        <h4 id="list-item-3" style="">Item 3</h4>
                        <p>Quis anim sit do amet fugiat dolor velit sit ea ea do reprehenderit culpa duis. Nostrud aliqua ipsum fugiat minim proident occaecat excepteur aliquip culpa aute tempor reprehenderit. Deserunt tempor mollit elit ex pariatur dolore velit fugiat mollit culpa irure ullamco est ex ullamco excepteur.</p>
                        <h4 id="list-item-4" style="">Item 4</h4>
                        <p>Quis anim sit do amet fugiat dolor velit sit ea ea do reprehenderit culpa duis. Nostrud aliqua ipsum fugiat minim proident occaecat excepteur aliquip culpa aute tempor reprehenderit. Deserunt tempor mollit elit ex pariatur dolore velit fugiat mollit culpa irure ullamco est ex ullamco excepteur.</p>
                    </div>
                </div>
            </div>--}}

            <div class="row">
                <div class="col-3">
                    <div id="list-example" class="list-group">
                        {{--<a class="list-group-item list-group-item-action" href="#list-item-1">Item 1</a>--}}
                        <a href="#list-item-1" class="list-group-item list-group-item-action flex-column align-items-start active">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Client 1</h5>
                                <small>07/12/2017</small>
                            </div>
                            <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                <p class="mb-1">90025</p>
                                <span class="badge badge-primary badge-pill">1</span>
                            </div>
                            <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                <small>Chicago</small>
                                <button id="list-button-item-1" type="button" class="btn-sm btn-primary">Accept Client</button>
                            </div>
                        </a>
                        {{--<a class="list-group-item list-group-item-action" href="#list-item-2">Item2</a>--}}
                        <a href="#list-item-2" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Client 2</h5>
                                <small>07/12/2017</small>
                            </div>
                            <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                <p class="mb-1">90025</p>
                                <span class="badge badge-primary badge-pill">2</span>
                            </div>
                            <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                <small>Los Angeles</small>
                                <button id="list-button-item-2" type="button" class="btn-sm btn-primary">Accept Client</button>
                            </div>
                        </a>
                       {{-- <a class="list-group-item list-group-item-action active" href="#list-item-3">Item 3</a>--}}
                        <a href="#list-item-3" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Client 3</h5>
                                <small>07/12/2017</small>
                            </div>
                            <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                <p class="mb-1">90025</p>
                                <span class="badge badge-primary badge-pill">1</span>
                            </div>
                            <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                <small>Chicago</small>
                                <button id="list-button-item-3" type="button" class="btn-sm btn-primary">Accept Client</button>
                            </div>
                        </a>
                        {{--<a class="list-group-item list-group-item-action" href="#list-item-4">Item 4</a>--}}
                        <a href="#list-item-4" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Client 4</h5>
                                <small>07/12/2017</small>
                            </div>
                            <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                <p class="mb-1">90025</p>
                                <span class="badge badge-primary badge-pill">1</span>
                            </div>
                            <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                <small>Chicago</small>
                                <button id="list-button-item-4" type="button" class="btn-sm btn-primary">Accept Client</button>
                            </div>
                        </a>
                        {{--<a href="#list-item-4" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">List group item heading</h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                            <small class="text-muted">Donec id elit non mi porta.</small>
                        </a>--}}
                    </div>
                </div>
                <div class="col-9">
                    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
                        {{--<h4 id="list-item-1" style="">Item 1</h4>
                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco cillum consectetur ut et aute consectetur labore. Fugiat laborum incididunt tempor eu consequat enim dolore proident. Qui laborum do non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua officia quis et incididunt voluptate non anim reprehenderit adipisicing dolore ut consequat deserunt mollit dolore. Aliquip nulla enim veniam non fugiat id cupidatat nulla elit cupidatat commodo velit ut eiusmod cupidatat elit dolore.</p>
                       --}}
                        <div id="list-item-1" class="new_client_form_row">
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
                                                name="first_name" placeholder="" disabled>
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
                                                name="last_name" placeholder="" disabled>
                                        <div class="invalid-feedback">
                                            Please enter your last name.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="contact_phone_num">Phone Number (10 digits)</label>
                                        <input  type="phone" class="form-control" id="contact_phone_num" name="contact_phone_number" maxlength="10" pattern="^\d{3}\d{3}\d{4}$" placeholder="XXXXXXXXXX" required=""
                                                @if ( isset($tempData['client-phone-number']) )
                                                value="{{ $tempData['client-phone-number'] }}"
                                                @else
                                                value="{{ old('contact_phone_number') }}"
                                                @endif
                                                disabled>
                                        <div class="invalid-feedback">
                                            Please enter your phone number.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="phone_number_type">Type</label>
                                        <div class="input-group mb-3 invalid_message_correction">

                                            <select class="custom-select" name="phone_number_type" id="phone_number_type" disabled>
                                                <option value="" selected>Choose...</option>
                                                {{--@foreach( $phoneTypes as $phoneType )
                                                    <option value="{{$phoneType->value}}"
                                                            @if ( isset($tempData['client-phone-number-type']) )
                                                            @if ( $tempData['client-phone-number-type'] == $phoneType->value )
                                                            selected
                                                            @endif
                                                            @endif
                                                    >{{$phoneType->label}}</option>
                                                @endforeach--}}
                                                <option value="office">Office</option>
                                                <option value="home">Home</option>
                                                <option value="mobile">Mobile</option>
                                                <option value="other">Other</option>
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
                                                disabled>
                                        <div class="invalid-feedback">
                                            Please enter your email.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pref_contact_method">Preferred Contact method</label>

                                        <div class="input-group mb-3 invalid_message_correction">

                                            <select class="custom-select" name="pref_contact_method" id="pref_contact_method" disabled>
                                                <option value=""  selected>Choose...</option>
                                                {{--@foreach( $preferedContactMethods as $key => $value )
                                                    <option value="{{ $key }}"
                                                            @if ( isset( $tempData['client-prefered-contact-method'] ) )
                                                            @if ( $tempData['client-prefered-contact-method'] == $key )
                                                            selected
                                                            @endif
                                                            @endif
                                                    >{{ $value }}</option>
                                                @endforeach--}}
                                                <option value="phone">Phone</option>
                                                <option value="email">Email</option>
                                                <option value="text_message">Text message</option>
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
                                                name="address" placeholder="" disabled>
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
                                                name="city" placeholder="" disabled>
                                        <div class="invalid-feedback">
                                            Please enter your city.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="state">State</label>
                                        <div class="input-group mb-3 invalid_message_correction">
                                            <select class="custom-select" name="state" id="state" disabled>
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
                                                <option value="alabama">Alabama</option>
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
                                                name="zip" placeholder="XXXXX" disabled>
                                        <div class="invalid-feedback">
                                            Please enter your zip code.
                                        </div>
                                    </div>
                                </div>

                                {{--<div class="form-row">
                                    <div class="form-group col-md-12 text-right">
                                        <button id="next_step_1_2" type="button" class="btn btn-primary">Next Step</button>
                                        <div class="spinner_cont spinner_form_1"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                                    </div>
                                </div>--}}
                            </form>

                            <form id="new_pet_app_form" action="{{ route('register') }}" method="post">
                                {{ csrf_field() }}
                                <input name="action" value="validation_multi_pet" type="hidden">
                                <div id="pet_form_cont">
                                    <div id="pet_application_1">
                                        <div class="form-row">
                                            {{--<div class="form-group col-md-6">
                                                <label for="">Pet Type</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    @foreach( $petTypes as $petType )
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio"
                                                                    id="{{ $petType->value }}_type"
                                                                    value="{{ $petType->value }}"
                                                                    name="pet_type"
                                                                    class="custom-control-input"
                                                                    @if ( isset($tempData['pet-type']) )
                                                                    @if ( in_array($tempData['pet-type'], [$petType->value . "_type", $petType->value]) )
                                                                    checked
                                                                    @endif
                                                                    @endif
                                                            >
                                                            <label class="custom-control-label" for="{{ $petType->value }}_type">{{ $petType->label }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>--}}
                                            <div class="form-group col-md-6">
                                                <label for="">Pet Type</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="dog_type" value="dog" name="pet_type" class="custom-control-input" type="radio" disabled>
                                                        <label class="custom-control-label" for="dog_type">Dog</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="cat_type" value="cat" name="pet_type" class="custom-control-input" checked="" type="radio" disabled>
                                                        <label class="custom-control-label" for="cat_type">Cat</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="bird_type" value="bird" name="pet_type" class="custom-control-input" type="radio" disabled>
                                                        <label class="custom-control-label" for="bird_type">Bird</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="other_type" value="other" name="pet_type" class="custom-control-input" type="radio" disabled>
                                                        <label class="custom-control-label" for="other_type">Other</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="pet_name">Pet Name</label>
                                                <input  type="text" class="form-control" id="pet_name" maxlength="25" required=""
                                                        @if ( isset( $tempData['pet-name'] ) )
                                                        value="{{ $tempData['pet-name'] }}"
                                                        @else
                                                        value="{{ old('pet_name') }}"
                                                        @endif
                                                        name="pet_name" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="breed">Breed</label>
                                                <input  type="text" class="form-control" id="breed" maxlength="25" required=""
                                                        @if ( isset( $tempData['pet-breed'] ) )
                                                        value="{{ $tempData['pet-breed'] }}"
                                                        @else
                                                        value="{{ old('breed') }}"
                                                        @endif
                                                        name="breed" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="weight">Weight</label>
                                                <input  type="text" class="form-control" id="weight" maxlength="4" required=""
                                                        @if ( isset( $tempData['pet-weight'] ) )
                                                        value="{{ $tempData['pet-weight'] }}"
                                                        @else
                                                        value="{{ old('weight') }}"
                                                        @endif
                                                        name="weight" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="age">Age</label>
                                                <input  type="text" class="form-control" id="age" maxlength="3" required=""
                                                        @if ( isset( $tempData['pet-age'] ) )
                                                        value="{{ $tempData['pet-age'] }}"
                                                        @else
                                                        value="{{ old('age') }}"
                                                        @endif
                                                        name="age" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="1" disabled>
                                                    @if( isset( $tempData['pet-description'] ) )
                                                        {{ $tempData['pet-description'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Is the pet spayed/neutered?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spayed_yes" value="yes" name="pet_spayed"
                                                                @if ( isset( $tempData['pet-spayed'] ) )
                                                                @if ( in_array( $tempData['pet-spayed'], ['spayed_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spayed_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spayed_no" value="no" name="pet_spayed"
                                                                @if ( isset( $tempData['pet-spayed'] ) )
                                                                @if ( in_array( $tempData['pet-spayed'], ['spayed_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spayed_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">If not does the client object to having the pet spayed/neutered?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spay_object_yes" value="yes" name="pet_spay_object"
                                                                @if ( isset( $tempData['pet-spayed-object'] ) )
                                                                @if ( in_array( $tempData['pet-spayed-object'], ['spay_object_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spay_object_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spay_object_no" value="no" name="pet_spay_object"
                                                                @if ( isset( $tempData['pet-spayed-object'] ) )
                                                                @if ( in_array( $tempData['pet-spayed-object'], ['spay_object_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spay_object_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Is the pet microchipped?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="chipped_yes" value="yes" name="pet_chipped"
                                                                @if ( isset( $tempData['pet-chipped'] ) )
                                                                @if ( in_array( $tempData['pet-chipped'], ['chipped_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="chipped_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="chipped_no" value="no" name="pet_chipped"
                                                                @if ( isset( $tempData['pet-chipped'] ) )
                                                                @if ( in_array( $tempData['pet-chipped'], ['chipped_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="chipped_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Up to date with vaccinations?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="vaccine_yes" value="yes" name="pet_vaccined"
                                                                @if ( isset( $tempData['pet-vaccine'] ) )
                                                                @if ( in_array( $tempData['pet-vaccine'], ['vaccine_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="vaccine_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="vaccine_no" value="no" name="pet_vaccined"
                                                                @if ( isset( $tempData['pet-vaccine'] ) )
                                                                @if ( in_array( $tempData['pet-vaccine'], ['vaccine_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="vaccine_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="dietary_needs">Any special dietary needs?</label>
                                                <textarea class="form-control" id="dietary_needs" name="dietary_needs" rows="2" disabled>
                                                    @if ( isset( $tempData['pet-dietary-needs'] ) )
                                                        {{ $tempData['pet-dietary-needs'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="veterinary_needs">Any special veterinary needs?</label>
                                                <textarea class="form-control" id="veterinary_needs" name="veterinary_needs" rows="2" disabled>
                                                    @if ( isset( $tempData['pet-veterinary-needs'] ) )
                                                        {{ $tempData['pet-veterinary-needs'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="pets_behavior">Please describe the pets behavior and temperament</label>
                                                <textarea class="form-control" id="pets_behavior" name="pets_behavior" rows="2" disabled>
                                                    @if ( isset( $tempData['pet-behavior'] ) )
                                                        {{ $tempData['pet-behavior'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Does the abuser have access or visit the pet?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="abuser_access_yes" value="yes" name="abuser_access"
                                                                @if ( isset( $tempData['pet-abuser-access'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-access'], ['abuser_access_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="abuser_access_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="abuser_access_no" value="no" name="abuser_access"
                                                                @if ( isset( $tempData['pet-abuser-access'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-access'], ['abuser_access_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="abuser_access_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="pet_relevant_info">Any other relevant information for this pet?</label>
                                                <textarea class="form-control" id="pet_relevant_info" name="pet_relevant_info" rows="1" disabled>
                                                    @if ( isset( $tempData['pet-relevant-info'] ) )
                                                        {{ $tempData['pet-relevant-info'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        {{--<hr class="my-4">--}}

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="how_long">Approximately how long will temporary housing be required? (Please note that our program is currently limited to 30 day placement)</label>
                                                <input  type="text" class="form-control" id="how_long" maxlength="3" required=""
                                                        @if ( isset( $tempData['pet-how-long'] ) )
                                                        value="{{ $tempData['pet-how-long'] }}"
                                                        @else
                                                        value="{{ old('pet_name') }}"
                                                        @endif

                                                        name="how_long" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Are the police currently involved?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="police_involved_yes" value="yes" name="police_involved"
                                                                @if ( isset( $tempData['pet-police-involved'] ) )
                                                                @if ( in_array( $tempData['pet-police-involved'], ['police_involved_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="police_involved_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="police_involved_no" value="no" name="police_involved"
                                                                @if ( isset( $tempData['pet-police-involved'] ) )
                                                                @if ( in_array( $tempData['pet-police-involved'], ['police_involved_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="police_involved_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Does the client have a protective order?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="protective_order_yes" value="yes"
                                                                @if ( isset( $tempData['client-protective-order'] ) )
                                                                @if ( in_array( $tempData['client-protective-order'], ['protective_order_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                name="protective_order" class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="protective_order_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="protective_order_no" value="no" name="protective_order"
                                                                @if ( isset( $tempData['client-protective-order'] ) )
                                                                @if ( in_array( $tempData['client-protective-order'], ['protective_order_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="protective_order_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Is the pet covered in the protective order?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_covered_yes" value="yes" name="pet_covered"
                                                                @if ( isset( $tempData['pet-protective-order-covered'] ) )
                                                                @if ( in_array( $tempData['pet-protective-order-covered'], ['pet_covered_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_covered_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_covered_no" value="no" name="pet_covered"
                                                                @if ( isset( $tempData['pet-protective-order-covered'] ) )
                                                                @if ( in_array( $tempData['pet-protective-order-covered'], ['pet_covered_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_covered_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Does the client have any paperwork or evidence indicating ownership of the pet? (i.e. vet receipts, pictures, etc)</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_paperwork_yes" value="yes" name="pet_paperwork"
                                                                @if ( isset( $tempData['pet-client-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-client-paperwork'], ['pet_paperwork_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_paperwork_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_paperwork_no" value="no" name="pet_paperwork"
                                                                @if ( isset( $tempData['pet-client-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-client-paperwork'], ['pet_paperwork_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_paperwork_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Does the abuser have any paperwork or evidence indicating ownership of the pet? (i.e. vet receipts, pictures, etc)</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_abuser_paperwork_yes" value="yes" name="pet_abuser_paperwork"
                                                                @if ( isset( $tempData['pet-abuser-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-paperwork'], ['pet_abuser_paperwork_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_abuser_paperwork_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_abuser_paperwork_no" value="no" name="pet_abuser_paperwork"
                                                                @if ( isset( $tempData['pet-abuser-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-paperwork'], ['pet_abuser_paperwork_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_abuser_paperwork_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="abuser_details">Please add any details about the abuser that may be helpful for protection. (frequent locations, names of friends, phone numbers used, etc)</label>
                                                <textarea class="form-control" id="abuser_details" name="abuser_details" rows="2" disabled>
                                                    @if ( isset( $tempData['abuser-details'] ) )
                                                        {{ $tempData['abuser-details'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Has the client explored other boarding options? (i.e. friends, family, private vet or boarding)</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="boarding_options_yes" value="yes" name="boarding_options"
                                                                @if ( isset( $tempData['pet-boarding-options'] ) )
                                                                @if ( in_array( $tempData['pet-boarding-options'], ['boarding_options_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="boarding_options_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="boarding_options_no" value="no" name="boarding_options"
                                                                @if ( isset( $tempData['pet-boarding-options'] ) )
                                                                @if ( in_array( $tempData['pet-boarding-options'], ['boarding_options_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="boarding_options_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>


                        {{--<h4 id="list-item-2" style="">Item 2</h4>
                        <p>Quis magna Lorem anim amet ipsum do mollit sit cillum voluptate ex nulla tempor. Laborum consequat non elit enim exercitation cillum aliqua consequat id aliqua. Esse ex consectetur mollit voluptate est in duis laboris ad sit ipsum anim Lorem. Incididunt veniam velit elit elit veniam Lorem aliqua quis ullamco deserunt sit enim elit aliqua esse irure. Laborum nisi sit est tempor laborum mollit labore officia laborum excepteur commodo non commodo dolor excepteur commodo. Ipsum fugiat ex est consectetur ipsum commodo tempor sunt in proident.</p>
                        --}}

                        <div id="list-item-2" class="new_client_form_row">
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
                                                name="first_name" placeholder="" disabled>
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
                                                name="last_name" placeholder="" disabled>
                                        <div class="invalid-feedback">
                                            Please enter your last name.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="contact_phone_num">Phone Number (10 digits)</label>
                                        <input  type="phone" class="form-control" id="contact_phone_num" name="contact_phone_number" maxlength="10" pattern="^\d{3}\d{3}\d{4}$" placeholder="XXXXXXXXXX" required=""
                                                @if ( isset($tempData['client-phone-number']) )
                                                value="{{ $tempData['client-phone-number'] }}"
                                                @else
                                                value="{{ old('contact_phone_number') }}"
                                                @endif
                                                disabled>
                                        <div class="invalid-feedback">
                                            Please enter your phone number.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="phone_number_type">Type</label>
                                        <div class="input-group mb-3 invalid_message_correction">

                                            <select class="custom-select" name="phone_number_type" id="phone_number_type" disabled>
                                                <option value="" selected>Choose...</option>
                                                {{--@foreach( $phoneTypes as $phoneType )
                                                    <option value="{{$phoneType->value}}"
                                                            @if ( isset($tempData['client-phone-number-type']) )
                                                            @if ( $tempData['client-phone-number-type'] == $phoneType->value )
                                                            selected
                                                            @endif
                                                            @endif
                                                    >{{$phoneType->label}}</option>
                                                @endforeach--}}
                                                <option value="office">Office</option>
                                                <option value="home">Home</option>
                                                <option value="mobile">Mobile</option>
                                                <option value="other">Other</option>
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
                                                disabled>
                                        <div class="invalid-feedback">
                                            Please enter your email.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pref_contact_method">Preferred Contact method</label>

                                        <div class="input-group mb-3 invalid_message_correction">

                                            <select class="custom-select" name="pref_contact_method" id="pref_contact_method" disabled>
                                                <option value=""  selected>Choose...</option>
                                                {{--@foreach( $preferedContactMethods as $key => $value )
                                                    <option value="{{ $key }}"
                                                            @if ( isset( $tempData['client-prefered-contact-method'] ) )
                                                            @if ( $tempData['client-prefered-contact-method'] == $key )
                                                            selected
                                                            @endif
                                                            @endif
                                                    >{{ $value }}</option>
                                                @endforeach--}}
                                                <option value="phone">Phone</option>
                                                <option value="email">Email</option>
                                                <option value="text_message">Text message</option>
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
                                                name="address" placeholder="" disabled>
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
                                                name="city" placeholder="" disabled>
                                        <div class="invalid-feedback">
                                            Please enter your city.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="state">State</label>
                                        <div class="input-group mb-3 invalid_message_correction">
                                            <select class="custom-select" name="state" id="state" disabled>
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
                                                <option value="alabama">Alabama</option>
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
                                                name="zip" placeholder="XXXXX" disabled>
                                        <div class="invalid-feedback">
                                            Please enter your zip code.
                                        </div>
                                    </div>
                                </div>

                                {{--<div class="form-row">
                                    <div class="form-group col-md-12 text-right">
                                        <button id="next_step_1_2" type="button" class="btn btn-primary">Next Step</button>
                                        <div class="spinner_cont spinner_form_1"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                                    </div>
                                </div>--}}
                            </form>

                            <form id="new_pet_app_form" action="{{ route('register') }}" method="post">
                                {{ csrf_field() }}
                                <input name="action" value="validation_multi_pet" type="hidden">
                                <div id="pet_form_cont">
                                    <div id="pet_application_1">
                                        <div class="form-row">
                                            {{--<div class="form-group col-md-6">
                                                <label for="">Pet Type</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    @foreach( $petTypes as $petType )
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio"
                                                                    id="{{ $petType->value }}_type"
                                                                    value="{{ $petType->value }}"
                                                                    name="pet_type"
                                                                    class="custom-control-input"
                                                                    @if ( isset($tempData['pet-type']) )
                                                                    @if ( in_array($tempData['pet-type'], [$petType->value . "_type", $petType->value]) )
                                                                    checked
                                                                    @endif
                                                                    @endif
                                                            >
                                                            <label class="custom-control-label" for="{{ $petType->value }}_type">{{ $petType->label }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>--}}
                                            <div class="form-group col-md-6">
                                                <label for="">Pet Type</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="dog_type" value="dog" name="pet_type" class="custom-control-input" type="radio" disabled>
                                                        <label class="custom-control-label" for="dog_type">Dog</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="cat_type" value="cat" name="pet_type" class="custom-control-input" checked="" type="radio" disabled>
                                                        <label class="custom-control-label" for="cat_type">Cat</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="bird_type" value="bird" name="pet_type" class="custom-control-input" type="radio" disabled>
                                                        <label class="custom-control-label" for="bird_type">Bird</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="other_type" value="other" name="pet_type" class="custom-control-input" type="radio" disabled>
                                                        <label class="custom-control-label" for="other_type">Other</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="pet_name">Pet Name</label>
                                                <input  type="text" class="form-control" id="pet_name" maxlength="25" required=""
                                                        @if ( isset( $tempData['pet-name'] ) )
                                                        value="{{ $tempData['pet-name'] }}"
                                                        @else
                                                        value="{{ old('pet_name') }}"
                                                        @endif
                                                        name="pet_name" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="breed">Breed</label>
                                                <input  type="text" class="form-control" id="breed" maxlength="25" required=""
                                                        @if ( isset( $tempData['pet-breed'] ) )
                                                        value="{{ $tempData['pet-breed'] }}"
                                                        @else
                                                        value="{{ old('breed') }}"
                                                        @endif
                                                        name="breed" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="weight">Weight</label>
                                                <input  type="text" class="form-control" id="weight" maxlength="4" required=""
                                                        @if ( isset( $tempData['pet-weight'] ) )
                                                        value="{{ $tempData['pet-weight'] }}"
                                                        @else
                                                        value="{{ old('weight') }}"
                                                        @endif
                                                        name="weight" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="age">Age</label>
                                                <input  type="text" class="form-control" id="age" maxlength="3" required=""
                                                        @if ( isset( $tempData['pet-age'] ) )
                                                        value="{{ $tempData['pet-age'] }}"
                                                        @else
                                                        value="{{ old('age') }}"
                                                        @endif
                                                        name="age" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="1" disabled>
                                                    @if( isset( $tempData['pet-description'] ) )
                                                        {{ $tempData['pet-description'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Is the pet spayed/neutered?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spayed_yes" value="yes" name="pet_spayed"
                                                                @if ( isset( $tempData['pet-spayed'] ) )
                                                                @if ( in_array( $tempData['pet-spayed'], ['spayed_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spayed_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spayed_no" value="no" name="pet_spayed"
                                                                @if ( isset( $tempData['pet-spayed'] ) )
                                                                @if ( in_array( $tempData['pet-spayed'], ['spayed_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spayed_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">If not does the client object to having the pet spayed/neutered?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spay_object_yes" value="yes" name="pet_spay_object"
                                                                @if ( isset( $tempData['pet-spayed-object'] ) )
                                                                @if ( in_array( $tempData['pet-spayed-object'], ['spay_object_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spay_object_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spay_object_no" value="no" name="pet_spay_object"
                                                                @if ( isset( $tempData['pet-spayed-object'] ) )
                                                                @if ( in_array( $tempData['pet-spayed-object'], ['spay_object_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spay_object_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Is the pet microchipped?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="chipped_yes" value="yes" name="pet_chipped"
                                                                @if ( isset( $tempData['pet-chipped'] ) )
                                                                @if ( in_array( $tempData['pet-chipped'], ['chipped_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="chipped_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="chipped_no" value="no" name="pet_chipped"
                                                                @if ( isset( $tempData['pet-chipped'] ) )
                                                                @if ( in_array( $tempData['pet-chipped'], ['chipped_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="chipped_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Up to date with vaccinations?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="vaccine_yes" value="yes" name="pet_vaccined"
                                                                @if ( isset( $tempData['pet-vaccine'] ) )
                                                                @if ( in_array( $tempData['pet-vaccine'], ['vaccine_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="vaccine_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="vaccine_no" value="no" name="pet_vaccined"
                                                                @if ( isset( $tempData['pet-vaccine'] ) )
                                                                @if ( in_array( $tempData['pet-vaccine'], ['vaccine_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="vaccine_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="dietary_needs">Any special dietary needs?</label>
                                                <textarea class="form-control" id="dietary_needs" name="dietary_needs" rows="2" disabled>
                                                    @if ( isset( $tempData['pet-dietary-needs'] ) )
                                                        {{ $tempData['pet-dietary-needs'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="veterinary_needs">Any special veterinary needs?</label>
                                                <textarea class="form-control" id="veterinary_needs" name="veterinary_needs" rows="2" disabled>
                                                    @if ( isset( $tempData['pet-veterinary-needs'] ) )
                                                        {{ $tempData['pet-veterinary-needs'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="pets_behavior">Please describe the pets behavior and temperament</label>
                                                <textarea class="form-control" id="pets_behavior" name="pets_behavior" rows="2" disabled>
                                                    @if ( isset( $tempData['pet-behavior'] ) )
                                                        {{ $tempData['pet-behavior'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Does the abuser have access or visit the pet?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="abuser_access_yes" value="yes" name="abuser_access"
                                                                @if ( isset( $tempData['pet-abuser-access'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-access'], ['abuser_access_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="abuser_access_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="abuser_access_no" value="no" name="abuser_access"
                                                                @if ( isset( $tempData['pet-abuser-access'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-access'], ['abuser_access_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="abuser_access_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="pet_relevant_info">Any other relevant information for this pet?</label>
                                                <textarea class="form-control" id="pet_relevant_info" name="pet_relevant_info" rows="1" disabled>
                                                    @if ( isset( $tempData['pet-relevant-info'] ) )
                                                        {{ $tempData['pet-relevant-info'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        {{--<hr class="my-4">--}}

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="how_long">Approximately how long will temporary housing be required? (Please note that our program is currently limited to 30 day placement)</label>
                                                <input  type="text" class="form-control" id="how_long" maxlength="3" required=""
                                                        @if ( isset( $tempData['pet-how-long'] ) )
                                                        value="{{ $tempData['pet-how-long'] }}"
                                                        @else
                                                        value="{{ old('pet_name') }}"
                                                        @endif

                                                        name="how_long" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Are the police currently involved?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="police_involved_yes" value="yes" name="police_involved"
                                                                @if ( isset( $tempData['pet-police-involved'] ) )
                                                                @if ( in_array( $tempData['pet-police-involved'], ['police_involved_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="police_involved_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="police_involved_no" value="no" name="police_involved"
                                                                @if ( isset( $tempData['pet-police-involved'] ) )
                                                                @if ( in_array( $tempData['pet-police-involved'], ['police_involved_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="police_involved_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Does the client have a protective order?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="protective_order_yes" value="yes"
                                                                @if ( isset( $tempData['client-protective-order'] ) )
                                                                @if ( in_array( $tempData['client-protective-order'], ['protective_order_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                name="protective_order" class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="protective_order_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="protective_order_no" value="no" name="protective_order"
                                                                @if ( isset( $tempData['client-protective-order'] ) )
                                                                @if ( in_array( $tempData['client-protective-order'], ['protective_order_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="protective_order_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Is the pet covered in the protective order?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_covered_yes" value="yes" name="pet_covered"
                                                                @if ( isset( $tempData['pet-protective-order-covered'] ) )
                                                                @if ( in_array( $tempData['pet-protective-order-covered'], ['pet_covered_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_covered_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_covered_no" value="no" name="pet_covered"
                                                                @if ( isset( $tempData['pet-protective-order-covered'] ) )
                                                                @if ( in_array( $tempData['pet-protective-order-covered'], ['pet_covered_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_covered_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Does the client have any paperwork or evidence indicating ownership of the pet? (i.e. vet receipts, pictures, etc)</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_paperwork_yes" value="yes" name="pet_paperwork"
                                                                @if ( isset( $tempData['pet-client-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-client-paperwork'], ['pet_paperwork_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_paperwork_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_paperwork_no" value="no" name="pet_paperwork"
                                                                @if ( isset( $tempData['pet-client-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-client-paperwork'], ['pet_paperwork_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_paperwork_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Does the abuser have any paperwork or evidence indicating ownership of the pet? (i.e. vet receipts, pictures, etc)</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_abuser_paperwork_yes" value="yes" name="pet_abuser_paperwork"
                                                                @if ( isset( $tempData['pet-abuser-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-paperwork'], ['pet_abuser_paperwork_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_abuser_paperwork_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_abuser_paperwork_no" value="no" name="pet_abuser_paperwork"
                                                                @if ( isset( $tempData['pet-abuser-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-paperwork'], ['pet_abuser_paperwork_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_abuser_paperwork_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="abuser_details">Please add any details about the abuser that may be helpful for protection. (frequent locations, names of friends, phone numbers used, etc)</label>
                                                <textarea class="form-control" id="abuser_details" name="abuser_details" rows="2" disabled>
                                                    @if ( isset( $tempData['abuser-details'] ) )
                                                        {{ $tempData['abuser-details'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Has the client explored other boarding options? (i.e. friends, family, private vet or boarding)</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="boarding_options_yes" value="yes" name="boarding_options"
                                                                @if ( isset( $tempData['pet-boarding-options'] ) )
                                                                @if ( in_array( $tempData['pet-boarding-options'], ['boarding_options_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="boarding_options_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="boarding_options_no" value="no" name="boarding_options"
                                                                @if ( isset( $tempData['pet-boarding-options'] ) )
                                                                @if ( in_array( $tempData['pet-boarding-options'], ['boarding_options_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="boarding_options_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                        {{--<h4 id="list-item-3" style="">Item 3</h4>
                        <p>Quis anim sit do amet fugiat dolor velit sit ea ea do reprehenderit culpa duis. Nostrud aliqua ipsum fugiat minim proident occaecat excepteur aliquip culpa aute tempor reprehenderit. Deserunt tempor mollit elit ex pariatur dolore velit fugiat mollit culpa irure ullamco est ex ullamco excepteur.</p>
                        --}}

                        <div id="list-item-3" class="new_client_form_row">
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
                                                name="first_name" placeholder="" disabled>
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
                                                name="last_name" placeholder="" disabled>
                                        <div class="invalid-feedback">
                                            Please enter your last name.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="contact_phone_num">Phone Number (10 digits)</label>
                                        <input  type="phone" class="form-control" id="contact_phone_num" name="contact_phone_number" maxlength="10" pattern="^\d{3}\d{3}\d{4}$" placeholder="XXXXXXXXXX" required=""
                                                @if ( isset($tempData['client-phone-number']) )
                                                value="{{ $tempData['client-phone-number'] }}"
                                                @else
                                                value="{{ old('contact_phone_number') }}"
                                                @endif
                                                disabled>
                                        <div class="invalid-feedback">
                                            Please enter your phone number.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="phone_number_type">Type</label>
                                        <div class="input-group mb-3 invalid_message_correction">

                                            <select class="custom-select" name="phone_number_type" id="phone_number_type" disabled>
                                                <option value="" selected>Choose...</option>
                                                {{--@foreach( $phoneTypes as $phoneType )
                                                    <option value="{{$phoneType->value}}"
                                                            @if ( isset($tempData['client-phone-number-type']) )
                                                            @if ( $tempData['client-phone-number-type'] == $phoneType->value )
                                                            selected
                                                            @endif
                                                            @endif
                                                    >{{$phoneType->label}}</option>
                                                @endforeach--}}
                                                <option value="office">Office</option>
                                                <option value="home">Home</option>
                                                <option value="mobile">Mobile</option>
                                                <option value="other">Other</option>
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
                                                disabled>
                                        <div class="invalid-feedback">
                                            Please enter your email.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pref_contact_method">Preferred Contact method</label>

                                        <div class="input-group mb-3 invalid_message_correction">

                                            <select class="custom-select" name="pref_contact_method" id="pref_contact_method" disabled>
                                                <option value=""  selected>Choose...</option>
                                                {{--@foreach( $preferedContactMethods as $key => $value )
                                                    <option value="{{ $key }}"
                                                            @if ( isset( $tempData['client-prefered-contact-method'] ) )
                                                            @if ( $tempData['client-prefered-contact-method'] == $key )
                                                            selected
                                                            @endif
                                                            @endif
                                                    >{{ $value }}</option>
                                                @endforeach--}}
                                                <option value="phone">Phone</option>
                                                <option value="email">Email</option>
                                                <option value="text_message">Text message</option>
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
                                                name="address" placeholder="" disabled>
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
                                                name="city" placeholder="" disabled>
                                        <div class="invalid-feedback">
                                            Please enter your city.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="state">State</label>
                                        <div class="input-group mb-3 invalid_message_correction">
                                            <select class="custom-select" name="state" id="state" disabled>
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
                                                <option value="alabama">Alabama</option>
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
                                                name="zip" placeholder="XXXXX" disabled>
                                        <div class="invalid-feedback">
                                            Please enter your zip code.
                                        </div>
                                    </div>
                                </div>

                                {{--<div class="form-row">
                                    <div class="form-group col-md-12 text-right">
                                        <button id="next_step_1_2" type="button" class="btn btn-primary">Next Step</button>
                                        <div class="spinner_cont spinner_form_1"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                                    </div>
                                </div>--}}
                            </form>

                            <form id="new_pet_app_form" action="{{ route('register') }}" method="post">
                                {{ csrf_field() }}
                                <input name="action" value="validation_multi_pet" type="hidden">
                                <div id="pet_form_cont">
                                    <div id="pet_application_1">
                                        <div class="form-row">
                                            {{--<div class="form-group col-md-6">
                                                <label for="">Pet Type</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    @foreach( $petTypes as $petType )
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio"
                                                                    id="{{ $petType->value }}_type"
                                                                    value="{{ $petType->value }}"
                                                                    name="pet_type"
                                                                    class="custom-control-input"
                                                                    @if ( isset($tempData['pet-type']) )
                                                                    @if ( in_array($tempData['pet-type'], [$petType->value . "_type", $petType->value]) )
                                                                    checked
                                                                    @endif
                                                                    @endif
                                                            >
                                                            <label class="custom-control-label" for="{{ $petType->value }}_type">{{ $petType->label }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>--}}
                                            <div class="form-group col-md-6">
                                                <label for="">Pet Type</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="dog_type" value="dog" name="pet_type" class="custom-control-input" type="radio" disabled>
                                                        <label class="custom-control-label" for="dog_type">Dog</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="cat_type" value="cat" name="pet_type" class="custom-control-input" checked="" type="radio" disabled>
                                                        <label class="custom-control-label" for="cat_type">Cat</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="bird_type" value="bird" name="pet_type" class="custom-control-input" type="radio" disabled>
                                                        <label class="custom-control-label" for="bird_type">Bird</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="other_type" value="other" name="pet_type" class="custom-control-input" type="radio" disabled>
                                                        <label class="custom-control-label" for="other_type">Other</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="pet_name">Pet Name</label>
                                                <input  type="text" class="form-control" id="pet_name" maxlength="25" required=""
                                                        @if ( isset( $tempData['pet-name'] ) )
                                                        value="{{ $tempData['pet-name'] }}"
                                                        @else
                                                        value="{{ old('pet_name') }}"
                                                        @endif
                                                        name="pet_name" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="breed">Breed</label>
                                                <input  type="text" class="form-control" id="breed" maxlength="25" required=""
                                                        @if ( isset( $tempData['pet-breed'] ) )
                                                        value="{{ $tempData['pet-breed'] }}"
                                                        @else
                                                        value="{{ old('breed') }}"
                                                        @endif
                                                        name="breed" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="weight">Weight</label>
                                                <input  type="text" class="form-control" id="weight" maxlength="4" required=""
                                                        @if ( isset( $tempData['pet-weight'] ) )
                                                        value="{{ $tempData['pet-weight'] }}"
                                                        @else
                                                        value="{{ old('weight') }}"
                                                        @endif
                                                        name="weight" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="age">Age</label>
                                                <input  type="text" class="form-control" id="age" maxlength="3" required=""
                                                        @if ( isset( $tempData['pet-age'] ) )
                                                        value="{{ $tempData['pet-age'] }}"
                                                        @else
                                                        value="{{ old('age') }}"
                                                        @endif
                                                        name="age" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="1" disabled>
                                                    @if( isset( $tempData['pet-description'] ) )
                                                        {{ $tempData['pet-description'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Is the pet spayed/neutered?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spayed_yes" value="yes" name="pet_spayed"
                                                                @if ( isset( $tempData['pet-spayed'] ) )
                                                                @if ( in_array( $tempData['pet-spayed'], ['spayed_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spayed_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spayed_no" value="no" name="pet_spayed"
                                                                @if ( isset( $tempData['pet-spayed'] ) )
                                                                @if ( in_array( $tempData['pet-spayed'], ['spayed_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spayed_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">If not does the client object to having the pet spayed/neutered?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spay_object_yes" value="yes" name="pet_spay_object"
                                                                @if ( isset( $tempData['pet-spayed-object'] ) )
                                                                @if ( in_array( $tempData['pet-spayed-object'], ['spay_object_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spay_object_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spay_object_no" value="no" name="pet_spay_object"
                                                                @if ( isset( $tempData['pet-spayed-object'] ) )
                                                                @if ( in_array( $tempData['pet-spayed-object'], ['spay_object_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spay_object_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Is the pet microchipped?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="chipped_yes" value="yes" name="pet_chipped"
                                                                @if ( isset( $tempData['pet-chipped'] ) )
                                                                @if ( in_array( $tempData['pet-chipped'], ['chipped_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="chipped_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="chipped_no" value="no" name="pet_chipped"
                                                                @if ( isset( $tempData['pet-chipped'] ) )
                                                                @if ( in_array( $tempData['pet-chipped'], ['chipped_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="chipped_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Up to date with vaccinations?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="vaccine_yes" value="yes" name="pet_vaccined"
                                                                @if ( isset( $tempData['pet-vaccine'] ) )
                                                                @if ( in_array( $tempData['pet-vaccine'], ['vaccine_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="vaccine_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="vaccine_no" value="no" name="pet_vaccined"
                                                                @if ( isset( $tempData['pet-vaccine'] ) )
                                                                @if ( in_array( $tempData['pet-vaccine'], ['vaccine_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="vaccine_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="dietary_needs">Any special dietary needs?</label>
                                                <textarea class="form-control" id="dietary_needs" name="dietary_needs" rows="2" disabled>
                                                    @if ( isset( $tempData['pet-dietary-needs'] ) )
                                                        {{ $tempData['pet-dietary-needs'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="veterinary_needs">Any special veterinary needs?</label>
                                                <textarea class="form-control" id="veterinary_needs" name="veterinary_needs" rows="2" disabled>
                                                    @if ( isset( $tempData['pet-veterinary-needs'] ) )
                                                        {{ $tempData['pet-veterinary-needs'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="pets_behavior">Please describe the pets behavior and temperament</label>
                                                <textarea class="form-control" id="pets_behavior" name="pets_behavior" rows="2" disabled>
                                                    @if ( isset( $tempData['pet-behavior'] ) )
                                                        {{ $tempData['pet-behavior'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Does the abuser have access or visit the pet?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="abuser_access_yes" value="yes" name="abuser_access"
                                                                @if ( isset( $tempData['pet-abuser-access'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-access'], ['abuser_access_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="abuser_access_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="abuser_access_no" value="no" name="abuser_access"
                                                                @if ( isset( $tempData['pet-abuser-access'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-access'], ['abuser_access_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="abuser_access_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="pet_relevant_info">Any other relevant information for this pet?</label>
                                                <textarea class="form-control" id="pet_relevant_info" name="pet_relevant_info" rows="1" disabled>
                                                    @if ( isset( $tempData['pet-relevant-info'] ) )
                                                        {{ $tempData['pet-relevant-info'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        {{--<hr class="my-4">--}}

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="how_long">Approximately how long will temporary housing be required? (Please note that our program is currently limited to 30 day placement)</label>
                                                <input  type="text" class="form-control" id="how_long" maxlength="3" required=""
                                                        @if ( isset( $tempData['pet-how-long'] ) )
                                                        value="{{ $tempData['pet-how-long'] }}"
                                                        @else
                                                        value="{{ old('pet_name') }}"
                                                        @endif

                                                        name="how_long" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Are the police currently involved?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="police_involved_yes" value="yes" name="police_involved"
                                                                @if ( isset( $tempData['pet-police-involved'] ) )
                                                                @if ( in_array( $tempData['pet-police-involved'], ['police_involved_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="police_involved_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="police_involved_no" value="no" name="police_involved"
                                                                @if ( isset( $tempData['pet-police-involved'] ) )
                                                                @if ( in_array( $tempData['pet-police-involved'], ['police_involved_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="police_involved_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Does the client have a protective order?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="protective_order_yes" value="yes"
                                                                @if ( isset( $tempData['client-protective-order'] ) )
                                                                @if ( in_array( $tempData['client-protective-order'], ['protective_order_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                name="protective_order" class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="protective_order_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="protective_order_no" value="no" name="protective_order"
                                                                @if ( isset( $tempData['client-protective-order'] ) )
                                                                @if ( in_array( $tempData['client-protective-order'], ['protective_order_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="protective_order_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Is the pet covered in the protective order?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_covered_yes" value="yes" name="pet_covered"
                                                                @if ( isset( $tempData['pet-protective-order-covered'] ) )
                                                                @if ( in_array( $tempData['pet-protective-order-covered'], ['pet_covered_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_covered_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_covered_no" value="no" name="pet_covered"
                                                                @if ( isset( $tempData['pet-protective-order-covered'] ) )
                                                                @if ( in_array( $tempData['pet-protective-order-covered'], ['pet_covered_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_covered_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Does the client have any paperwork or evidence indicating ownership of the pet? (i.e. vet receipts, pictures, etc)</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_paperwork_yes" value="yes" name="pet_paperwork"
                                                                @if ( isset( $tempData['pet-client-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-client-paperwork'], ['pet_paperwork_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_paperwork_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_paperwork_no" value="no" name="pet_paperwork"
                                                                @if ( isset( $tempData['pet-client-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-client-paperwork'], ['pet_paperwork_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_paperwork_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Does the abuser have any paperwork or evidence indicating ownership of the pet? (i.e. vet receipts, pictures, etc)</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_abuser_paperwork_yes" value="yes" name="pet_abuser_paperwork"
                                                                @if ( isset( $tempData['pet-abuser-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-paperwork'], ['pet_abuser_paperwork_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_abuser_paperwork_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_abuser_paperwork_no" value="no" name="pet_abuser_paperwork"
                                                                @if ( isset( $tempData['pet-abuser-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-paperwork'], ['pet_abuser_paperwork_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_abuser_paperwork_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="abuser_details">Please add any details about the abuser that may be helpful for protection. (frequent locations, names of friends, phone numbers used, etc)</label>
                                                <textarea class="form-control" id="abuser_details" name="abuser_details" rows="2" disabled>
                                                    @if ( isset( $tempData['abuser-details'] ) )
                                                        {{ $tempData['abuser-details'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Has the client explored other boarding options? (i.e. friends, family, private vet or boarding)</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="boarding_options_yes" value="yes" name="boarding_options"
                                                                @if ( isset( $tempData['pet-boarding-options'] ) )
                                                                @if ( in_array( $tempData['pet-boarding-options'], ['boarding_options_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="boarding_options_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="boarding_options_no" value="no" name="boarding_options"
                                                                @if ( isset( $tempData['pet-boarding-options'] ) )
                                                                @if ( in_array( $tempData['pet-boarding-options'], ['boarding_options_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="boarding_options_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                        {{--<h4 id="list-item-4" style="">Item 4</h4>
                        <p>Quis anim sit do amet fugiat dolor velit sit ea ea do reprehenderit culpa duis. Nostrud aliqua ipsum fugiat minim proident occaecat excepteur aliquip culpa aute tempor reprehenderit. Deserunt tempor mollit elit ex pariatur dolore velit fugiat mollit culpa irure ullamco est ex ullamco excepteur.</p>
                    --}}

                        <div id="list-item-4" class="new_client_form_row">
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
                                                name="first_name" placeholder="" disabled>
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
                                                name="last_name" placeholder="" disabled>
                                        <div class="invalid-feedback">
                                            Please enter your last name.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="contact_phone_num">Phone Number (10 digits)</label>
                                        <input  type="phone" class="form-control" id="contact_phone_num" name="contact_phone_number" maxlength="10" pattern="^\d{3}\d{3}\d{4}$" placeholder="XXXXXXXXXX" required=""
                                                @if ( isset($tempData['client-phone-number']) )
                                                value="{{ $tempData['client-phone-number'] }}"
                                                @else
                                                value="{{ old('contact_phone_number') }}"
                                                @endif
                                                disabled>
                                        <div class="invalid-feedback">
                                            Please enter your phone number.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="phone_number_type">Type</label>
                                        <div class="input-group mb-3 invalid_message_correction">

                                            <select class="custom-select" name="phone_number_type" id="phone_number_type" disabled>
                                                <option value="" selected>Choose...</option>
                                                {{--@foreach( $phoneTypes as $phoneType )
                                                    <option value="{{$phoneType->value}}"
                                                            @if ( isset($tempData['client-phone-number-type']) )
                                                            @if ( $tempData['client-phone-number-type'] == $phoneType->value )
                                                            selected
                                                            @endif
                                                            @endif
                                                    >{{$phoneType->label}}</option>
                                                @endforeach--}}
                                                <option value="office">Office</option>
                                                <option value="home">Home</option>
                                                <option value="mobile">Mobile</option>
                                                <option value="other">Other</option>
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
                                                disabled>
                                        <div class="invalid-feedback">
                                            Please enter your email.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pref_contact_method">Preferred Contact method</label>

                                        <div class="input-group mb-3 invalid_message_correction">

                                            <select class="custom-select" name="pref_contact_method" id="pref_contact_method" disabled>
                                                <option value=""  selected>Choose...</option>
                                                {{--@foreach( $preferedContactMethods as $key => $value )
                                                    <option value="{{ $key }}"
                                                            @if ( isset( $tempData['client-prefered-contact-method'] ) )
                                                            @if ( $tempData['client-prefered-contact-method'] == $key )
                                                            selected
                                                            @endif
                                                            @endif
                                                    >{{ $value }}</option>
                                                @endforeach--}}
                                                <option value="phone">Phone</option>
                                                <option value="email">Email</option>
                                                <option value="text_message">Text message</option>
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
                                                name="address" placeholder="" disabled>
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
                                                name="city" placeholder="" disabled>
                                        <div class="invalid-feedback">
                                            Please enter your city.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="state">State</label>
                                        <div class="input-group mb-3 invalid_message_correction">
                                            <select class="custom-select" name="state" id="state" disabled>
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
                                                <option value="alabama">Alabama</option>
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
                                                name="zip" placeholder="XXXXX" disabled>
                                        <div class="invalid-feedback">
                                            Please enter your zip code.
                                        </div>
                                    </div>
                                </div>

                                {{--<div class="form-row">
                                    <div class="form-group col-md-12 text-right">
                                        <button id="next_step_1_2" type="button" class="btn btn-primary">Next Step</button>
                                        <div class="spinner_cont spinner_form_1"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                                    </div>
                                </div>--}}
                            </form>

                            <form id="new_pet_app_form" action="{{ route('register') }}" method="post">
                                {{ csrf_field() }}
                                <input name="action" value="validation_multi_pet" type="hidden">
                                <div id="pet_form_cont">
                                    <div id="pet_application_1">
                                        <div class="form-row">
                                            {{--<div class="form-group col-md-6">
                                                <label for="">Pet Type</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    @foreach( $petTypes as $petType )
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio"
                                                                    id="{{ $petType->value }}_type"
                                                                    value="{{ $petType->value }}"
                                                                    name="pet_type"
                                                                    class="custom-control-input"
                                                                    @if ( isset($tempData['pet-type']) )
                                                                    @if ( in_array($tempData['pet-type'], [$petType->value . "_type", $petType->value]) )
                                                                    checked
                                                                    @endif
                                                                    @endif
                                                            >
                                                            <label class="custom-control-label" for="{{ $petType->value }}_type">{{ $petType->label }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>--}}
                                            <div class="form-group col-md-6">
                                                <label for="">Pet Type</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="dog_type" value="dog" name="pet_type" class="custom-control-input" type="radio" disabled>
                                                        <label class="custom-control-label" for="dog_type">Dog</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="cat_type" value="cat" name="pet_type" class="custom-control-input" checked="" type="radio" disabled>
                                                        <label class="custom-control-label" for="cat_type">Cat</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="bird_type" value="bird" name="pet_type" class="custom-control-input" type="radio" disabled>
                                                        <label class="custom-control-label" for="bird_type">Bird</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input id="other_type" value="other" name="pet_type" class="custom-control-input" type="radio" disabled>
                                                        <label class="custom-control-label" for="other_type">Other</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="pet_name">Pet Name</label>
                                                <input  type="text" class="form-control" id="pet_name" maxlength="25" required=""
                                                        @if ( isset( $tempData['pet-name'] ) )
                                                        value="{{ $tempData['pet-name'] }}"
                                                        @else
                                                        value="{{ old('pet_name') }}"
                                                        @endif
                                                        name="pet_name" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="breed">Breed</label>
                                                <input  type="text" class="form-control" id="breed" maxlength="25" required=""
                                                        @if ( isset( $tempData['pet-breed'] ) )
                                                        value="{{ $tempData['pet-breed'] }}"
                                                        @else
                                                        value="{{ old('breed') }}"
                                                        @endif
                                                        name="breed" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="weight">Weight</label>
                                                <input  type="text" class="form-control" id="weight" maxlength="4" required=""
                                                        @if ( isset( $tempData['pet-weight'] ) )
                                                        value="{{ $tempData['pet-weight'] }}"
                                                        @else
                                                        value="{{ old('weight') }}"
                                                        @endif
                                                        name="weight" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="age">Age</label>
                                                <input  type="text" class="form-control" id="age" maxlength="3" required=""
                                                        @if ( isset( $tempData['pet-age'] ) )
                                                        value="{{ $tempData['pet-age'] }}"
                                                        @else
                                                        value="{{ old('age') }}"
                                                        @endif
                                                        name="age" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="1" disabled>
                                                    @if( isset( $tempData['pet-description'] ) )
                                                        {{ $tempData['pet-description'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Is the pet spayed/neutered?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spayed_yes" value="yes" name="pet_spayed"
                                                                @if ( isset( $tempData['pet-spayed'] ) )
                                                                @if ( in_array( $tempData['pet-spayed'], ['spayed_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spayed_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spayed_no" value="no" name="pet_spayed"
                                                                @if ( isset( $tempData['pet-spayed'] ) )
                                                                @if ( in_array( $tempData['pet-spayed'], ['spayed_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spayed_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">If not does the client object to having the pet spayed/neutered?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spay_object_yes" value="yes" name="pet_spay_object"
                                                                @if ( isset( $tempData['pet-spayed-object'] ) )
                                                                @if ( in_array( $tempData['pet-spayed-object'], ['spay_object_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spay_object_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="spay_object_no" value="no" name="pet_spay_object"
                                                                @if ( isset( $tempData['pet-spayed-object'] ) )
                                                                @if ( in_array( $tempData['pet-spayed-object'], ['spay_object_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="spay_object_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Is the pet microchipped?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="chipped_yes" value="yes" name="pet_chipped"
                                                                @if ( isset( $tempData['pet-chipped'] ) )
                                                                @if ( in_array( $tempData['pet-chipped'], ['chipped_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="chipped_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="chipped_no" value="no" name="pet_chipped"
                                                                @if ( isset( $tempData['pet-chipped'] ) )
                                                                @if ( in_array( $tempData['pet-chipped'], ['chipped_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="chipped_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Up to date with vaccinations?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="vaccine_yes" value="yes" name="pet_vaccined"
                                                                @if ( isset( $tempData['pet-vaccine'] ) )
                                                                @if ( in_array( $tempData['pet-vaccine'], ['vaccine_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="vaccine_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="vaccine_no" value="no" name="pet_vaccined"
                                                                @if ( isset( $tempData['pet-vaccine'] ) )
                                                                @if ( in_array( $tempData['pet-vaccine'], ['vaccine_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="vaccine_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="dietary_needs">Any special dietary needs?</label>
                                                <textarea class="form-control" id="dietary_needs" name="dietary_needs" rows="2" disabled>
                                                    @if ( isset( $tempData['pet-dietary-needs'] ) )
                                                        {{ $tempData['pet-dietary-needs'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="veterinary_needs">Any special veterinary needs?</label>
                                                <textarea class="form-control" id="veterinary_needs" name="veterinary_needs" rows="2" disabled>
                                                    @if ( isset( $tempData['pet-veterinary-needs'] ) )
                                                        {{ $tempData['pet-veterinary-needs'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="pets_behavior">Please describe the pets behavior and temperament</label>
                                                <textarea class="form-control" id="pets_behavior" name="pets_behavior" rows="2" disabled>
                                                    @if ( isset( $tempData['pet-behavior'] ) )
                                                        {{ $tempData['pet-behavior'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Does the abuser have access or visit the pet?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="abuser_access_yes" value="yes" name="abuser_access"
                                                                @if ( isset( $tempData['pet-abuser-access'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-access'], ['abuser_access_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="abuser_access_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="abuser_access_no" value="no" name="abuser_access"
                                                                @if ( isset( $tempData['pet-abuser-access'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-access'], ['abuser_access_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="abuser_access_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="pet_relevant_info">Any other relevant information for this pet?</label>
                                                <textarea class="form-control" id="pet_relevant_info" name="pet_relevant_info" rows="1" disabled>
                                                    @if ( isset( $tempData['pet-relevant-info'] ) )
                                                        {{ $tempData['pet-relevant-info'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        {{--<hr class="my-4">--}}

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="how_long">Approximately how long will temporary housing be required? (Please note that our program is currently limited to 30 day placement)</label>
                                                <input  type="text" class="form-control" id="how_long" maxlength="3" required=""
                                                        @if ( isset( $tempData['pet-how-long'] ) )
                                                        value="{{ $tempData['pet-how-long'] }}"
                                                        @else
                                                        value="{{ old('pet_name') }}"
                                                        @endif

                                                        name="how_long" placeholder="" disabled>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Are the police currently involved?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="police_involved_yes" value="yes" name="police_involved"
                                                                @if ( isset( $tempData['pet-police-involved'] ) )
                                                                @if ( in_array( $tempData['pet-police-involved'], ['police_involved_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="police_involved_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="police_involved_no" value="no" name="police_involved"
                                                                @if ( isset( $tempData['pet-police-involved'] ) )
                                                                @if ( in_array( $tempData['pet-police-involved'], ['police_involved_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="police_involved_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Does the client have a protective order?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="protective_order_yes" value="yes"
                                                                @if ( isset( $tempData['client-protective-order'] ) )
                                                                @if ( in_array( $tempData['client-protective-order'], ['protective_order_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                name="protective_order" class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="protective_order_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="protective_order_no" value="no" name="protective_order"
                                                                @if ( isset( $tempData['client-protective-order'] ) )
                                                                @if ( in_array( $tempData['client-protective-order'], ['protective_order_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="protective_order_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Is the pet covered in the protective order?</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_covered_yes" value="yes" name="pet_covered"
                                                                @if ( isset( $tempData['pet-protective-order-covered'] ) )
                                                                @if ( in_array( $tempData['pet-protective-order-covered'], ['pet_covered_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_covered_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_covered_no" value="no" name="pet_covered"
                                                                @if ( isset( $tempData['pet-protective-order-covered'] ) )
                                                                @if ( in_array( $tempData['pet-protective-order-covered'], ['pet_covered_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_covered_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Does the client have any paperwork or evidence indicating ownership of the pet? (i.e. vet receipts, pictures, etc)</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_paperwork_yes" value="yes" name="pet_paperwork"
                                                                @if ( isset( $tempData['pet-client-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-client-paperwork'], ['pet_paperwork_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_paperwork_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_paperwork_no" value="no" name="pet_paperwork"
                                                                @if ( isset( $tempData['pet-client-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-client-paperwork'], ['pet_paperwork_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_paperwork_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Does the abuser have any paperwork or evidence indicating ownership of the pet? (i.e. vet receipts, pictures, etc)</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_abuser_paperwork_yes" value="yes" name="pet_abuser_paperwork"
                                                                @if ( isset( $tempData['pet-abuser-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-paperwork'], ['pet_abuser_paperwork_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_abuser_paperwork_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="pet_abuser_paperwork_no" value="no" name="pet_abuser_paperwork"
                                                                @if ( isset( $tempData['pet-abuser-paperwork'] ) )
                                                                @if ( in_array( $tempData['pet-abuser-paperwork'], ['pet_abuser_paperwork_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="pet_abuser_paperwork_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="abuser_details">Please add any details about the abuser that may be helpful for protection. (frequent locations, names of friends, phone numbers used, etc)</label>
                                                <textarea class="form-control" id="abuser_details" name="abuser_details" rows="2" disabled>
                                                    @if ( isset( $tempData['abuser-details'] ) )
                                                        {{ $tempData['abuser-details'] }}
                                                    @endif
                                                </textarea>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Has the client explored other boarding options? (i.e. friends, family, private vet or boarding)</label>
                                                <div style="display: block;" class="radio_custom_group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="boarding_options_yes" value="yes" name="boarding_options"
                                                                @if ( isset( $tempData['pet-boarding-options'] ) )
                                                                @if ( in_array( $tempData['pet-boarding-options'], ['boarding_options_yes', 'yes'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="boarding_options_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  type="radio" id="boarding_options_no" value="no" name="boarding_options"
                                                                @if ( isset( $tempData['pet-boarding-options'] ) )
                                                                @if ( in_array( $tempData['pet-boarding-options'], ['boarding_options_no', 'no'] ) )
                                                                checked
                                                                @endif
                                                                @endif
                                                                class="custom-control-input" disabled>
                                                        <label class="custom-control-label" for="boarding_options_no">No</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">More example invalid feedback text</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

            {{--<div class="list-group">
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">List group item heading</h5>
                        <small>3 days ago</small>
                    </div>
                    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    <small>Donec id elit non mi porta.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">List group item heading</h5>
                        <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    <small class="text-muted">Donec id elit non mi porta.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">List group item heading</h5>
                        <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    <small class="text-muted">Donec id elit non mi porta.</small>
                </a>
            </div>--}}


        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
    {{--<div class="row">
        <div class="col-lg-8">
            <!-- Example Bar Chart Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-bar-chart"></i> Bar Chart Example</div>
                <div class="card-body">
                    <canvas id="myBarChart" width="100" height="50"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- Example Pie Chart Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-pie-chart"></i> Pie Chart Example</div>
                <div class="card-body">
                    <canvas id="myPieChart" width="100%" height="100"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>
    </div>--}}
@endsection