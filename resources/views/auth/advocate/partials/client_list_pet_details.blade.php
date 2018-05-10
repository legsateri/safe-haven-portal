
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

{{-- multipet per client - following is another pet form for the same client --}}

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