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
            <div class="row">
                <div class="col-md-5 col-sm-12 order-sm-2 order-2 order-md-1">
                    <div class="paginate_top">
                        {{ $dataEntries->links() }}
                    </div>
                </div>
                <div class="col-md-7 col-sm-12 order-sm-1 order-1 order-md-2 mb-2">
                    <?php 
                    /**
                     * listing filters
                     * (start)
                     */
                    ?>
                    <form   class="form-inline float-right"
                            action="{{ route('list-filters.submit', ['uenc' => base64_encode( route( Route::current()->getName() ) )]) }}"
                            method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="filter_name" value="clients_in_need">
                        <div class="form-group mr-2">
                            <label class="mr-2" for="order_by_select_type">Order by</label>
                            <select class="custom-select" 
                                    name="order_by" 
                                    id="order_by_select_type">
                                <option value="desc" selected>Latest</option>
                                <option value="asc">Oldest</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_by_answered"></label>
                            <select class="custom-select" 
                                    name="filter_by_answered" 
                                    id="filter_by_answered">
                                <option value="all" selected>Display All</option>
                                <option value="answered">Answered</option>
                                <option value="unanswered">Unanswered</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
                    </form>
                    <?php 
                    /**
                     * listing filters
                     * (end)
                     */
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div id="list-example" class="list-group">
                        <?php
                        /**
                         * generate left slection menu
                         * (code start)
                         */
                        ?>
                        @foreach( $dataEntries as $dataEntry )
                            <a  href="#list-item-{{ $dataEntry->application_id }}" 
                                class="list-group-item list-group-item-action flex-column align-items-start active">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $dataEntry->first_name }} {{ $dataEntry->last_name }}</h5>
                                    <small>{{ date('M/d/Y', strtotime($dataEntry->created_at)) }}</small>
                                </div>
                                <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                    <p class="mb-1">{{ $dataEntry->zip_code }}</p>
                                    <span class="badge badge-primary badge-pill">{{ $dataEntry->pets_count }}</span>
                                </div>
                                <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                    <small>{{ $dataEntry->city }}</small>
                                    <button id="list-button-item-{{ $dataEntry->application_id }}" type="button" class="btn-sm btn-primary">Accept Client</button>
                                </div>
                            </a>
                        @endforeach
                        <?php
                        /**
                         * generate left slection menu
                         * (code end)
                         */
                        ?>
                    </div>
                    <?php
                    /**
                     * pagination for list
                     */
                    ?>
                </div>
                <div class="col-9">
                    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
                        <?php
                        /**
                         * generate right side
                         * with client details
                         * (code start)
                         */
                        ?>
                        @foreach( $dataEntries as $dataEntry )
                            <div id="list-item-{{ $dataEntry->application_id }}" class="new_client_form_row">
                                <form id="new_client_app_form" action="{{ route('register') }}" method="post">
                                    {{ csrf_field() }}
                                    {{--<input name="action" value="validation_multi_client" type="hidden">--}}
                                    <input name="action" value="validation_multi" type="hidden">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="org_last_name">First Name</label>
                                            <input  type="text" class="form-control" id="org_first_name" maxlength="25" required=""
                                                    value="{{ $dataEntry->first_name }}"
                                                    name="first_name" placeholder="" disabled>
                                            <div class="invalid-feedback">
                                                Please enter your first name.
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="org_last_name">Last Name</label>
                                            <input  type="text" class="form-control" id="org_last_name" maxlength="25" required=""
                                                    value="{{ $dataEntry->last_name }}"
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
                                                    value="{{ $dataEntry->number }}"
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
                                                    @foreach( $phoneTypes as $phoneType )
                                                        <option value="{{$phoneType->value}}"
                                                            @if ($dataEntry->phone_type_id == $phoneType->id )
                                                                selected
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
                                                    value="{{ $dataEntry->email }}"
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
                                                    @foreach( $preferedContactMethods as $key => $value )
                                                        <option value="{{ $key }}"
                                                                @if ( $dataEntry->best_way_to_reach == $key )
                                                                selected
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
                                                    value="{{ $dataEntry->street }}"
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
                                                    value="{{ $dataEntry->city }}"
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
                                                    @foreach( $states as $state )
                                                        <option value="{{ $state->value }}"
                                                                @if ( $dataEntry->state == $state->name )
                                                                    selected
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
                                                    value="{{ $dataEntry->zip_code }}"
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
                                                <div class="form-group col-md-6">
                                                    <label for="">Pet Type</label>
                                                    <div style="display: block;" class="radio_custom_group">
                                                        @foreach ($petTypes as $petType)
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input  id="{{ $petType->value }}_type" 
                                                                        value="{{ $petType->value }}" 
                                                                        name="pet_type"
                                                                        @if ( $petType->id == $dataEntry->pet_type_id )
                                                                            checked=""
                                                                        @endif
                                                                        class="custom-control-input" type="radio" disabled>
                                                                <label class="custom-control-label" for="{{ $petType->value }}_type">{{$petType->label}}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="pet_name">Pet Name</label>
                                                    <input  type="text" class="form-control" id="pet_name" maxlength="25" required=""
                                                            value="{{ $dataEntry->name }}"
                                                            name="pet_name" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="breed">Breed</label>
                                                    <input  type="text" class="form-control" id="breed" maxlength="25" required=""
                                                            value="{{ $dataEntry->breed }}"
                                                            name="breed" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="weight">Weight</label>
                                                    <input  type="text" class="form-control" id="weight" maxlength="4" required=""
                                                            value="{{ $dataEntry->weight }}"
                                                            name="weight" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="age">Age</label>
                                                    <input  type="text" class="form-control" id="age" maxlength="3" required=""
                                                            value="{{ $dataEntry->age }}"
                                                            name="age" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" id="description" name="description" rows="1" disabled
                                                            >{{ $dataEntry->description }}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Is the pet spayed/neutered?</label>
                                                    <div style="display: block;" class="radio_custom_group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="spayed_yes" value="yes" name="pet_spayed"
                                                                    @if ( $dataEntry->sprayed == 1 )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="spayed_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="spayed_no" value="no" name="pet_spayed"
                                                                    @if ( $dataEntry->sprayed != 1 )
                                                                        checked
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
                                                                    @if ( $dataEntry->objection_to_spray == 1 )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="spay_object_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="spay_object_no" value="no" name="pet_spay_object"
                                                                    @if ( $dataEntry->objection_to_spray != 1 )
                                                                        checked
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
                                                                    @if ( $dataEntry->microchipped == 1 )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="chipped_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="chipped_no" value="no" name="pet_chipped"
                                                                    @if ( $dataEntry->microchipped != 1 )
                                                                        checked
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
                                                                    @if ( $dataEntry->vaccinations == 1 )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="vaccine_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="vaccine_no" value="no" name="pet_vaccined"
                                                                    @if ( $dataEntry->vaccinations != 1 )
                                                                        checked
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
                                                    <textarea class="form-control" id="dietary_needs" name="dietary_needs" rows="2" disabled
                                                        >{{ $dataEntry->dietary_needs }}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="veterinary_needs">Any special veterinary needs?</label>
                                                    <textarea class="form-control" id="veterinary_needs" name="veterinary_needs" rows="2" disabled
                                                        >{{ $dataEntry->vet_needs }}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="pets_behavior">Please describe the pets behavior and temperament</label>
                                                    <textarea class="form-control" id="pets_behavior" name="pets_behavior" rows="2" disabled
                                                        >{{ $dataEntry->temperament }}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Does the abuser have access or visit the pet?</label>
                                                    <div style="display: block;" class="radio_custom_group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="abuser_access_yes" value="yes" name="abuser_access"
                                                                    @if ( $dataEntry->abuser_visiting_access == 1 )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="abuser_access_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="abuser_access_no" value="no" name="abuser_access"
                                                                    @if ( $dataEntry->abuser_visiting_access != 1 )
                                                                        checked
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
                                                    <textarea class="form-control" id="pet_relevant_info" name="pet_relevant_info" rows="1" disabled
                                                    >{{ $dataEntry->aditional_info }}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            {{--<hr class="my-4">--}}

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="how_long">Approximately how long will temporary housing be required? (Please note that our program is currently limited to 30 day placement)</label>
                                                    <input  type="text" class="form-control" id="how_long" maxlength="3" required=""
                                                            value="{{ $dataEntry->estimated_lenght_of_housing }}"
                                                            name="how_long" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Are the police currently involved?</label>
                                                    <div style="display: block;" class="radio_custom_group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="police_involved_yes" value="yes" name="police_involved"
                                                                    @if ( $dataEntry->police_involved == 1 )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="police_involved_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="police_involved_no" value="no" name="police_involved"
                                                                    @if ( $dataEntry->police_involved != 1 )
                                                                        checked
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
                                                                    @if ( $dataEntry->protective_order == 1 )
                                                                        checked
                                                                    @endif
                                                                    name="protective_order" class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="protective_order_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="protective_order_no" value="no" name="protective_order"
                                                                    @if ( $dataEntry->protective_order != 1 )
                                                                        checked
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
                                                                    @if ( $dataEntry->pet_protective_order == 1 )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="pet_covered_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="pet_covered_no" value="no" name="pet_covered"
                                                                    @if ( $dataEntry->pet_protective_order != 1 )
                                                                        checked
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
                                                                    @if ( $dataEntry->client_legal_owner_of_pet == 1 )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="pet_paperwork_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="pet_paperwork_no" value="no" name="pet_paperwork"
                                                                    @if ( $dataEntry->client_legal_owner_of_pet != 1 )
                                                                        checked
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
                                                                    @if ( $dataEntry->abuser_legal_owner_of_pet == 1 )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="pet_abuser_paperwork_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="pet_abuser_paperwork_no" value="no" name="pet_abuser_paperwork"
                                                                    @if ( $dataEntry->abuser_legal_owner_of_pet != 1 )
                                                                        checked
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
                                                    <textarea class="form-control" id="abuser_details" name="abuser_details" rows="2" disabled
                                                        >{{ $dataEntry->abuser_notes }}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Has the client explored other boarding options? (i.e. friends, family, private vet or boarding)</label>
                                                    <div style="display: block;" class="radio_custom_group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="boarding_options_yes" value="yes" name="boarding_options"
                                                                    @if ( $dataEntry->explored_boarding_options == 1 )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="boarding_options_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="boarding_options_no" value="no" name="boarding_options"
                                                                    @if ( $dataEntry->explored_boarding_options != 1 )
                                                                        checked
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
                        @endforeach
                        <?php
                        /**
                         * generate right side
                         * with client details
                         * (code end)
                         */
                        ?>
                    </div>
                    <div class="paginate_bottom mt-4">
                        {{ $dataEntries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection