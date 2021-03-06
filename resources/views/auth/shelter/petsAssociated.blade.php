@extends('layouts.user-main')

@section('content')
    <div class="card mb-3 current_pets_cont">

        <!-- Modal -->
        <div class="modal fade" id="currentPetsModal" tabindex="-1" role="dialog" aria-labelledby="currentPetsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="currentPetsModalLabel">Client Release</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row mb-3 modal_body_text">
                                Please select the reason for release. A release announcement will be sent out to the Advocate and Safe Haven volunteers.
                            </div>
                            <div class="row modal_body_inputs">
                                <div class="form-group col-md-12">
                                    <div style="display: block;" class="radio_custom_group">
                                        <div class="custom-control custom-radio custom-control-inline d-block">
                                            <input id="pet_released_to_owner_type" value="pet_released_to_owner" name="pet_release_type" class="custom-control-input" checked="" type="radio">
                                            <label class="custom-control-label" for="pet_released_to_owner_type">Released To Owner</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline d-block">
                                            <input id="pet_services_not_provided_type" value="pet_services_not_provided" name="pet_release_type" class="custom-control-input" type="radio">
                                            <label class="custom-control-label" for="pet_services_not_provided_type">Client Chose Not to Proceed</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline d-block">
                                            <input id="pet_released_to_adoption_pool_type" value="pet_released_to_adoption_pool" name="pet_release_type" class="custom-control-input" type="radio">
                                            <label class="custom-control-label" for="pet_released_to_adoption_pool_type">Released to Adoption Pool</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline d-block">
                                            <input id="pet_not_admitted_type" value="pet_not_admitted" name="pet_release_type" class="custom-control-input" type="radio">
                                            <label class="custom-control-label" for="pet_not_admitted_type">Pet Not Admitted</label>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="confirm_release_pet" type="button" class="btn btn-primary">Confirm Release Pet</button>
                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                        <input type="hidden" value=""/>
                    </div>

                </div>
            </div>
        </div>

        <div class="card-header">
            <i class="fa fa-home"></i> Currently Accepted Pets</div>
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
                        <input type="hidden" name="filter_name" value="accepted_pets">
                        <div class="form-group mr-2">
                            <label class="mr-2" for="order_by_select_type">Order by</label>
                            <select class="custom-select" 
                                    name="order_by" 
                                    id="order_by_select_type">
                                <option value="desc"
                                        @if( isset( $filter_rules['order_by'] ) )
                                            @if ( $filter_rules['order_by'] == 'desc' )
                                                selected
                                            @endif
                                        @endif
                                >Latest</option>
                                <option value="asc"
                                        @if( isset( $filter_rules['order_by'] ) )
                                            @if ( $filter_rules['order_by'] == 'asc' )
                                                selected
                                            @endif
                                        @endif
                                >Oldest</option>
                            </select>
                        </div>
                        <?php /*
                        <div class="form-group mr-2">
                            <select class="custom-select" 
                                    name="pet_type" 
                                    id="filter_by_pet_type">
                                <option value="all"
                                    @if( isset( $filter_rules['pet_type'] ) )
                                        @if ( $filter_rules['pet_type'] == 'all' )
                                            selected
                                        @endif
                                    @endif
                                >All pet types</option>
                                @foreach ( $petTypes as $petType )
                                    <option value="{{$petType->id}}"
                                        @if( isset( $filter_rules['pet_type'] ) )
                                            @if ( $filter_rules['pet_type'] == $petType->id )
                                                selected
                                            @endif
                                        @endif
                                    >{{$petType->label}}</option>
                                @endforeach
                            </select>
                        </div>
                        */ ?>
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
            <div class="row main_cont">
                <div class="col-xl-3 col-lg-4 col-md-4 col-5">
                    <div id="list-example" class="list-group">

                        <?php
                        /**
                         * generate left selection menu
                         * (code start)
                         */
                        ?>
                        @foreach( $dataEntries as $dataEntry )
                            <a href="#list-item-{{$dataEntry->id}}" class="list-group-item list-group-item-action flex-column align-items-start active">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">
                                        @foreach( $dataEntriesPets[$dataEntry->id] as $tempPet )
                                            {{$tempPet->name}}
                                        @endforeach
                                    </h5>
                                    <small>{{ date('M/d/Y', strtotime($dataEntry->created_at)) }}</small>
                                </div>
                                <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                    <p class="mb-1"><span class="mr-1">{{$dataEntry->zip_code}}</span></p>
                                </div>
                                <div class="justify-content-between d-flex city_pet_number_cont mt-3">
                                    <small>{{$dataEntry->city}}</small>
                                    <button id="list-button-item-{{$dataEntry->id}}" type="button" class="btn-sm btn-primary">Release Pet</button>
                                </div>
                            </a>
                        @endforeach
                        <?php
                        /**
                         * generate left selection menu
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
                <div class="col-xl-9 col-lg-8 col-md-8 col-7">
                    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
                        <?php
                        /**
                         * generate right side
                         * with pet details
                         * (code start)
                         */
                        ?>
                        @foreach( $dataEntries as $dataEntry )
                            @if ($loop->iteration == 1)
                                @php ($color_class = 'multi_form_color_blue')
                                {{--<div id="list-item-{{ $dataEntry->application_id }}" class="new_client_form_row multi_form_color">--}}
                            @elseif ($loop->iteration == 2)
                                @php ($color_class = 'multi_form_color_red')
                            @elseif ($loop->iteration == 3)
                                @php ($color_class = 'multi_form_color_yellow')
                            @elseif ($loop->iteration == 4)
                                @php ($color_class = 'multi_form_color_green')
                            @else
                                {{--<div id="list-item-{{ $dataEntry->application_id }}" class="new_client_form_row">--}}
                                @php ($color_class = '')
                            @endif
                            <div id="list-item-{{$dataEntry->id}}" class="new_client_form_row {{$color_class}}">
                            @foreach( $dataEntriesPets[$dataEntry->id] as $tempPet )
                                <form id="new_pet_app_form" action="{{ route('register') }}" method="post">
                                    {{ csrf_field() }}
                                    <input name="action" value="validation_multi_pet" type="hidden">
                                    <div id="pet_form_cont">
                                        <div id="pet_application_{{$dataEntry->id}}">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Pet Type</label>
                                                    <div style="display: block;" class="radio_custom_group">
                                                        @foreach( $petTypes as $petType )
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input  type="radio"
                                                                        id="{{ $petType->value }}_type"
                                                                        value="{{ $petType->value }}"
                                                                        name="pet_type"
                                                                        class="custom-control-input"
                                                                        @if ( $petType->id == $tempPet->pet_type_id )
                                                                        checked=""
                                                                        @endif
                                                                >
                                                                <label class="custom-control-label" for="{{ $petType->value }}_type">{{ $petType->label }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="pet_name">Pet Name</label>
                                                    <input  type="text" class="form-control" id="pet_name" maxlength="25" required=""
                                                            value="{{$tempPet->name}}"
                                                            name="pet_name" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="breed">Breed</label>
                                                    <input  type="text" class="form-control" id="breed" maxlength="25" required=""
                                                            value="{{$tempPet->breed}}"
                                                            name="breed" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="weight">Weight</label>
                                                    <input  type="text" class="form-control" id="weight" maxlength="4" required=""
                                                            value="{{$tempPet->weight}}"
                                                            name="weight" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="age">Age</label>
                                                    <input  type="text" class="form-control" id="age" maxlength="3" required=""
                                                            value="{{$tempPet->age}}"
                                                            name="age" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" id="description" name="description" rows="1" disabled
                                                    >{{$tempPet->description}}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Is the pet spayed/neutered?</label>
                                                    <div style="display: block;" class="radio_custom_group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="spayed_yes" value="yes" name="pet_spayed"
                                                                    @if ( $tempPet->sprayed == 1 ) )
                                                                    checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="spayed_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="spayed_no" value="no" name="pet_spayed"
                                                                    @if ( $tempPet->sprayed != 1 ) )
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
                                                                    @if ( $tempPet->objection_to_spray == 1 ) )
                                                                    checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="spay_object_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="spay_object_no" value="no" name="pet_spay_object"
                                                                    @if ( $tempPet->objection_to_spray != 1 ) )
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
                                                                    @if ( $tempPet->microchipped == 1 ) )
                                                                    checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="chipped_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="chipped_no" value="no" name="pet_chipped"
                                                                    @if ( $tempPet->microchipped != 1 ) )
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
                                                                    @if ( $tempPet->vaccinations == 1 ) )
                                                                    checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="vaccine_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="vaccine_no" value="no" name="pet_vaccined"
                                                                    @if ( $tempPet->vaccinations != 1 ) )
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
                                                    >{{$tempPet->dietary_needs}}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="veterinary_needs">Any special veterinary needs?</label>
                                                    <textarea class="form-control" id="veterinary_needs" name="veterinary_needs" rows="2" disabled
                                                    >{{$tempPet->vet_needs}}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="pets_behavior">Please describe the pets behavior and temperament</label>
                                                    <textarea class="form-control" id="pets_behavior" name="pets_behavior" rows="2" disabled
                                                    >{{$tempPet->temperament}}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Does the abuser have access or visit the pet?</label>
                                                    <div style="display: block;" class="radio_custom_group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="abuser_access_yes" value="yes" name="abuser_access"
                                                                    @if ( $tempPet->abuser_visiting_access == 1 ) )
                                                                    checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="abuser_access_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="abuser_access_no" value="no" name="abuser_access"
                                                                    @if ( $tempPet->abuser_visiting_access != 1 ) )
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
                                                    >{{$tempPet->aditional_info}}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            {{--<hr class="my-4">--}}

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="how_long">Approximately how long will temporary housing be required? (Please note that our program is currently limited to 30 day placement)</label>
                                                    <input  type="text" class="form-control" id="how_long" maxlength="3" required=""
                                                            value="{{$tempPet->estimated_lenght_of_housing }}"
                                                            name="how_long" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Are the police currently involved?</label>
                                                    <div style="display: block;" class="radio_custom_group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="police_involved_yes" value="yes" name="police_involved"
                                                                    @if ( $dataEntry->police_involved == 1 ) )
                                                                    checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="police_involved_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="police_involved_no" value="no" name="police_involved"
                                                                    @if ( $dataEntry->police_involved != 1 ) )
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
                                                                    @if ( $dataEntry->protective_order == 1 ) )
                                                                    checked
                                                                    @endif
                                                                    name="protective_order" class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="protective_order_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="protective_order_no" value="no" name="protective_order"
                                                                    @if ( $dataEntry->protective_order != 1 ) )
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
                                                                    @if ( $tempPet->pet_protective_order == 1 ) )
                                                                    checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="pet_covered_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="pet_covered_no" value="no" name="pet_covered"
                                                                    @if ( $tempPet->pet_protective_order != 1 ) )
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
                                                                    @if ( $tempPet->client_legal_owner_of_pet == 1 ) )
                                                                    checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="pet_paperwork_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="pet_paperwork_no" value="no" name="pet_paperwork"
                                                                    @if ( $tempPet->client_legal_owner_of_pet != 1 ) )
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
                                                                    @if ( $tempPet->abuser_legal_owner_of_pet == 1 ) )
                                                                    checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="pet_abuser_paperwork_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="pet_abuser_paperwork_no" value="no" name="pet_abuser_paperwork"
                                                                    @if ( $tempPet->abuser_legal_owner_of_pet != 1 ) )
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
                                                    >{{$dataEntry->abuser_notes}}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Has the client explored other boarding options? (i.e. friends, family, private vet or boarding)</label>
                                                    <div style="display: block;" class="radio_custom_group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="boarding_options_yes" value="yes" name="boarding_options"
                                                                    @if ( $dataEntry->explored_boarding_options == 1 ) )
                                                                    checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="boarding_options_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="boarding_options_no" value="no" name="boarding_options"
                                                                    @if ( $dataEntry->explored_boarding_options != 1 ) )
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
                            @endforeach
                            </div>
                        @endforeach
                        <?php
                        /**
                         * generate right side
                         * with pet details
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