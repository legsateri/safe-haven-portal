@extends('layouts.user-main')

@section('content')
    <div class="card mb-3 pets_in_need_cont">

        <!-- Modal -->
        <div class="modal fade" id="petsInNeedModal" tabindex="-1" role="dialog" aria-labelledby="petsInNeedModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="petsInNeedModalLabel">Pet Acceptance Acknowledgement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Once Pets are accepted, emails are sent to Advocates letting them know there is a Safe Haven waiting for them.
                        By clicking 'Accept Pet' below, your organization is agreeing to work with the Advocate
                        and Client to establish a temporary home for the pet.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="confirm_accept_pet" type="button" class="btn btn-primary">Confirm Accept Pet</button>
                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                        <input type="hidden" value=""/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Q&A-->
        <div class="modal fade" id="petsInNeedQAModal" tabindex="-1" role="dialog" aria-labelledby="petsInNeedQAModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="petsInNeedQAModalLabel"><span></span> - Questions and Answers </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-2 pet_qa_form">
                            <div class="card-body">
                                <h5 class="card-title">Post a questions to  pet's advocate.</h5>
                                <h6 class="card-subtitle shelter_name mb-2 text-muted d-inline-block">{{ $currentShelter->name }}</h6>
                                <span class="text-muted">-</span>
                                <h6 class="card-subtitle mb-2 text-muted d-inline-block">today</h6>
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">   
                                            <textarea class="form-control" id="pet_qa" name="pet_qa" rows="1"></textarea>                                                                                                    </textarea>
                                            <div class="invalid-feedback">More example invalid feedback text</div>
                                            <input id="organisation_id" type="hidden" value="{{Auth::user()->organisation_id}}"/>
                                            <input id="pet_qa_id" type="hidden" value=""/>
                                        </div>
                                    </div>
                                    <div class="pet_qa_form_buttons_cont">
                                        <button id="send_pet_qa" type="button" class="btn btn-primary">Send</button>
                                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="modal-body-inner-cont"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{--<button id="confirm_accept_pet_qa" type="button" class="btn btn-primary">Send</button>--}}
                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                        <input type="hidden" value=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-header">
            <i class="fa fa-heart"></i> Pets in Need</div>
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
                        <input type="hidden" name="filter_name" value="pets_in_need">
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
                         * generate left selection menu
                         * (code start)
                         */
                        ?>
                        @foreach( $dataEntries as $dataEntry )
                            <a href="#list-item-{{$dataEntry->id}}" class="list-group-item list-group-item-action flex-column align-items-start active">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{$dataEntry->name}}</h5>
                                    <small>{{ date('M/d/Y', strtotime($dataEntry->created_at)) }}</small>
                                </div>
                                <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                    <p class="mb-1"><span class="mr-1">{{$dataEntry->zip_code}}</span><small>{{$dataEntry->city}}</small></p>
                                </div>
                                <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                    <button id="list-button-qa-item-{{$dataEntry->id}}" type="button" class="btn-sm btn-primary">
                                        Q & A
                                        @if( $qa_badge[$dataEntry->id] > 0 )
                                            <span class="badge badge-light ml-1">{{$qa_badge[$dataEntry->id]}}</span><span class="sr-only">unanswered messages</span>
                                        @endif
                                    </button>
                                    <button id="list-button-item-{{$dataEntry->id}}" type="button" class="btn-sm btn-primary">Accept Pet</button>
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
                <div class="col-9">
                    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
                        <?php
                        /**
                         * generate right side
                         * with pet details
                         * (code start)
                         */
                        ?>
                        @foreach( $dataEntries as $dataEntry )
                            <div id="list-item-{{$dataEntry->id}}" class="new_client_form_row">
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
                                                                        @if ( $petType->id == $dataEntry->pet_type_id )
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
                                                            value="{{$dataEntry->name}}"
                                                            name="pet_name" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="breed">Breed</label>
                                                    <input  type="text" class="form-control" id="breed" maxlength="25" required=""
                                                            value="{{$dataEntry->breed}}"
                                                            name="breed" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="weight">Weight</label>
                                                    <input  type="text" class="form-control" id="weight" maxlength="4" required=""
                                                            value="{{$dataEntry->weight}}"
                                                            name="weight" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="age">Age</label>
                                                    <input  type="text" class="form-control" id="age" maxlength="3" required=""
                                                            value="{{$dataEntry->age}}"
                                                            name="age" placeholder="" disabled>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" id="description" name="description" rows="1" disabled
                                                        >{{$dataEntry->description}}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Is the pet spayed/neutered?</label>
                                                    <div style="display: block;" class="radio_custom_group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="spayed_yes" value="yes" name="pet_spayed"
                                                                    @if ( $dataEntry->sprayed == 1 ) )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="spayed_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="spayed_no" value="no" name="pet_spayed"
                                                                    @if ( $dataEntry->sprayed != 1 ) )
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
                                                                    @if ( $dataEntry->objection_to_spray == 1 ) )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="spay_object_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="spay_object_no" value="no" name="pet_spay_object"
                                                                    @if ( $dataEntry->objection_to_spray != 1 ) )
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
                                                                    @if ( $dataEntry->microchipped == 1 ) )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="chipped_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="chipped_no" value="no" name="pet_chipped"
                                                                    @if ( $dataEntry->microchipped != 1 ) )
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
                                                                    @if ( $dataEntry->vaccinations == 1 ) )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="vaccine_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="vaccine_no" value="no" name="pet_vaccined"
                                                                    @if ( $dataEntry->vaccinations != 1 ) )
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
                                                        >{{$dataEntry->dietary_needs}}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="veterinary_needs">Any special veterinary needs?</label>
                                                    <textarea class="form-control" id="veterinary_needs" name="veterinary_needs" rows="2" disabled
                                                        >{{$dataEntry->vet_needs}}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="pets_behavior">Please describe the pets behavior and temperament</label>
                                                    <textarea class="form-control" id="pets_behavior" name="pets_behavior" rows="2" disabled
                                                        >{{$dataEntry->temperament}}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Does the abuser have access or visit the pet?</label>
                                                    <div style="display: block;" class="radio_custom_group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="abuser_access_yes" value="yes" name="abuser_access"
                                                                    @if ( $dataEntry->abuser_visiting_access == 1 ) )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="abuser_access_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="abuser_access_no" value="no" name="abuser_access"
                                                                    @if ( $dataEntry->abuser_visiting_access != 1 ) )
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
                                                        >{{$dataEntry->aditional_info}}</textarea>
                                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                                </div>
                                            </div>

                                            {{--<hr class="my-4">--}}

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="how_long">Approximately how long will temporary housing be required? (Please note that our program is currently limited to 30 day placement)</label>
                                                    <input  type="text" class="form-control" id="how_long" maxlength="3" required=""
                                                            value="{{$dataEntry->estimated_lenght_of_housing }}"
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
                                                                    @if ( $dataEntry->pet_protective_order == 1 ) )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="pet_covered_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="pet_covered_no" value="no" name="pet_covered"
                                                                    @if ( $dataEntry->pet_protective_order != 1 ) )
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
                                                                    @if ( $dataEntry->client_legal_owner_of_pet == 1 ) )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="pet_paperwork_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="pet_paperwork_no" value="no" name="pet_paperwork"
                                                                    @if ( $dataEntry->client_legal_owner_of_pet != 1 ) )
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
                                                                    @if ( $dataEntry->abuser_legal_owner_of_pet == 1 ) )
                                                                        checked
                                                                    @endif
                                                                    class="custom-control-input" disabled>
                                                            <label class="custom-control-label" for="pet_abuser_paperwork_yes">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input  type="radio" id="pet_abuser_paperwork_no" value="no" name="pet_abuser_paperwork"
                                                                    @if ( $dataEntry->abuser_legal_owner_of_pet != 1 ) )
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