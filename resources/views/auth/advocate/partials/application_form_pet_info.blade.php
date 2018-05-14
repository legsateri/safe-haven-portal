<?php
/**
 * partial for 
 * add new application form
 * form for new pet data
 */

/**
 * create element ID sufix
 */
$sufix = "";
$classSufix = "_1";
if ( $counter > 1 )
{
    $sufix = "-" . (string)$counter;
    $classSufix = "_" . (string)$counter;
}
?>
<div class="pet_application{{$classSufix}}">
    <div class="new_app_pet_form_close"><i class="fa fa-times" aria-hidden="true"></i></div>
    <div class="form-row">
        <?php
        /**
         * field
         * Pet Type
         */
        ?>
        <div class="form-group col-md-6">
            <label for="">Pet Type</label>
            <div style="display: block;" class="radio_custom_group">
                @foreach( $petTypes as $petType )
                    <div class="custom-control custom-radio custom-control-inline">
                        <input  type="radio" 
                                id="{{ $petType->value }}_type{{ $sufix }}"
                                value="{{ $petType->value }}"
                                name="pet_type{{ $sufix }}" 
                                class="custom-control-input"
                                @if ( isset($tempData['pet'][$counter]['pet-type']) )
                                    @if ( in_array($tempData['pet'][$counter]['pet-type'], [$petType->value . "_type" . $sufix, $petType->value]) )
                                        checked
                                    @endif
                                @endif
                                >
                        <label class="custom-control-label" for="{{ $petType->value }}_type{{ $sufix }}">{{ $petType->label }}</label>
                    </div>
                @endforeach
            </div>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>

        <?php
        /**
         * field
         * Pet Name
         */
        ?>
        <div class="form-group col-md-6">
            <label for="pet_name{{ $sufix }}">Pet Name</label>
            <input  type="text" class="form-control" id="pet_name{{ $sufix }}" maxlength="25" required="" 
                    @if ( isset( $tempData['pet'][$counter]['pet-name'] ) )
                        value="{{ $tempData['pet'][$counter]['pet-name'] }}" 
                    @else
                        value="{{ old('pet_name').$sufix }}" 
                    @endif
                    name="pet_name{{ $sufix }}" placeholder="">
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>
    </div>

    <?php
    /**
     * field
     * Breed
     */
    ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="breed{{ $sufix }}">Breed</label>
            <input  type="text" class="form-control" id="breed{{ $sufix }}" maxlength="25" required="" 
                    @if ( isset( $tempData['pet'][$counter]['pet-breed'] ) )
                        value="{{ $tempData['pet'][$counter]['pet-breed'] }}" 
                    @else
                        value="{{ old('breed').$sufix }}" 
                    @endif
                    name="breed{{ $sufix }}" placeholder="">
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>

        <?php
        /**
         * field
         * Weight
         */
        ?>
        <div class="form-group col-md-3">
            <label for="weight{{ $sufix }}">Weight (lb)</label>
            <input  type="text" class="form-control weight" id="weight{{ $sufix }}" maxlength="5" required=""
                    @if ( isset( $tempData['pet'][$counter]['pet-weight'] ) )
                        value="{{ $tempData['pet'][$counter]['pet-weight'] }}" 
                    @else
                        value="{{ old('weight').$sufix }}" 
                    @endif
                    name="weight{{ $sufix }}" placeholder="XXX.X">
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>

        <?php
        /**
         * field
         * Age
         */
        ?>
        <div class="form-group col-md-3">
            <label for="age{{ $sufix }}">Age</label>
            <input  type="text" class="form-control age" id="age{{ $sufix }}" maxlength="3" required=""
                    @if ( isset( $tempData['pet'][$counter]['pet-age'] ) )
                        value="{{ $tempData['pet'][$counter]['pet-age'] }}" 
                    @else
                        value="{{ old('age').$sufix }}" 
                    @endif
                    name="age{{ $sufix }}" placeholder="XXX">
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>
    </div>

    <?php
    /**
     * field
     * Description
     */
    ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="description{{ $sufix }}">Description</label>
            <textarea class="form-control" id="description{{ $sufix }}" name="description{{ $sufix }}" rows="1"
                >@if( isset( $tempData['pet'][$counter]['pet-description'] ) ){{ $tempData['pet'][$counter]['pet-description'] }}@endif</textarea>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>
    </div>

    <?php
    /**
     * field
     * Is the pet spayed/neutered?
     */
    ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="">Is the pet spayed/neutered?</label>
            <div style="display: block;" class="radio_custom_group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="spayed_yes{{ $sufix }}" value="yes" name="pet_spayed{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-spayed'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-spayed'], ['spayed_yes'.$sufix, 'yes'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="spayed_yes{{ $sufix }}">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="spayed_no{{ $sufix }}" value="no" name="pet_spayed{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-spayed'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-spayed'], ['spayed_no'.$sufix, 'no'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="spayed_no{{ $sufix }}">No</label>
                </div>
            </div>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>

        <?php
        /**
         * field
         * If not does the client object to having the pet spayed/neutered?
         */
        ?>
        <div class="form-group col-md-6">
            <label for="">If not does the client object to having the pet spayed/neutered?</label>
            <div style="display: block;" class="radio_custom_group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="spay_object_yes{{ $sufix }}" value="yes" name="pet_spay_object{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-spayed-object'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-spayed-object'], ['spay_object_yes'.$sufix, 'yes'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="spay_object_yes{{ $sufix }}">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="spay_object_no{{ $sufix }}" value="no" name="pet_spay_object{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-spayed-object'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-spayed-object'], ['spay_object_no'.$sufix, 'no'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="spay_object_no{{ $sufix }}">No</label>
                </div>
            </div>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>
    </div>

    <div class="form-row">

        <?php
        /**
         * field
         * Is the pet microchipped?
         */
        ?>
        <div class="form-group col-md-6">
            <label for="">Is the pet microchipped?</label>
            <div style="display: block;" class="radio_custom_group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="chipped_yes{{ $sufix }}" value="yes" name="pet_chipped{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-chipped'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-chipped'], ['chipped_yes'.$sufix, 'yes'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="chipped_yes{{ $sufix }}">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="chipped_no{{ $sufix }}" value="no" name="pet_chipped{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-chipped'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-chipped'], ['chipped_no'.$sufix, 'no'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="chipped_no{{ $sufix }}">No</label>
                </div>
            </div>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>

        <?php
        /**
         * field
         * Up to date with vaccinations?
         */
        ?>
        <div class="form-group col-md-6">
            <label for="">Up to date with vaccinations?</label>
            <div style="display: block;" class="radio_custom_group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="vaccine_yes{{ $sufix }}" value="yes" name="pet_vaccined{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-vaccine'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-vaccine'], ['vaccine_yes'.$sufix, 'yes'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="vaccine_yes{{ $sufix }}">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="vaccine_no{{ $sufix }}" value="no" name="pet_vaccined{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-vaccine'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-vaccine'], ['vaccine_no'.$sufix, 'no'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="vaccine_no{{ $sufix }}">No</label>
                </div>
            </div>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>
    </div>

    <div class="form-row">

        <?php
        /**
         * field
         * Any special dietary needs?
         */
        ?>
        <div class="form-group col-md-6">
            <label for="dietary_needs{{ $sufix }}">Any special dietary needs?</label>
            <textarea class="form-control" id="dietary_needs{{ $sufix }}" name="dietary_needs{{ $sufix }}" rows="2"
                >@if ( isset( $tempData['pet'][$counter]['pet-dietary-needs'] ) ){{ $tempData['pet'][$counter]['pet-dietary-needs'] }}@endif</textarea>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>

        <?php
        /**
         * field
         * Any special veterinary needs?
         */
        ?>
        <div class="form-group col-md-6">
            <label for="veterinary_needs{{ $sufix }}">Any special veterinary needs?</label>
            <textarea class="form-control" id="veterinary_needs{{ $sufix }}" name="veterinary_needs{{ $sufix }}" rows="2"
                >@if ( isset( $tempData['pet'][$counter]['pet-veterinary-needs'] ) ){{ $tempData['pet'][$counter]['pet-veterinary-needs'] }}@endif</textarea>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>
    </div>

    <div class="form-row">

        <?php
        /**
         * field
         * Please describe the pets behavior and temperament
         */
        ?>
        <div class="form-group col-md-6">
            <label for="pets_behavior{{ $sufix }}">Please describe the pets behavior and temperament</label>
            <textarea class="form-control" id="pets_behavior{{ $sufix }}" name="pets_behavior{{ $sufix }}" rows="2"
                >@if ( isset( $tempData['pet'][$counter]['pet-behavior'] ) ){{ $tempData['pet'][$counter]['pet-behavior'] }}@endif</textarea>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>

        <?php
        /**
         * field
         * Does the abuser have access or visit the pet?
         */
        ?>
        <div class="form-group col-md-6">
            <label for="">Does the abuser have access or visit the pet?</label>
                <div style="display: block;" class="radio_custom_group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="abuser_access_yes{{ $sufix }}" value="yes" name="abuser_access{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-abuser-access'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-abuser-access'], ['abuser_access_yes'.$sufix, 'yes'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="abuser_access_yes{{ $sufix }}">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="abuser_access_no{{ $sufix }}" value="no" name="abuser_access{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-abuser-access'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-abuser-access'], ['abuser_access_no'.$sufix, 'no'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="abuser_access_no{{ $sufix }}">No</label>
                </div>
            </div>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>
    </div>

    <div class="form-row">
        <?php
        /**
         * field
         * Any other relevant information for this pet?
         */
        ?>
        <div class="form-group col-md-12">
            <label for="pet_relevant_info{{ $sufix }}">Any other relevant information for this pet?</label>
            <textarea class="form-control" id="pet_relevant_info{{ $sufix }}" name="pet_relevant_info{{ $sufix }}" rows="1"
                >@if ( isset( $tempData['pet'][$counter]['pet-relevant-info'] ) ){{ $tempData['pet'][$counter]['pet-relevant-info'] }}@endif</textarea>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>
    </div>

    <hr class="my-4">
    <div class="form-row">

        <?php
        /**
         * field
         * Approximately how long will temporary housing be required?
         */
        ?>
        <div class="form-group col-md-6">
            <label for="how_long{{ $sufix }}">Approximately how long will temporary housing be required? (Please note that our program is currently limited to 30 day placement)</label>
            <input  type="text" class="form-control how_long" id="how_long{{ $sufix }}" maxlength="3" required=""
                    @if ( isset( $tempData['pet'][$counter]['pet-how-long'] ) )
                        value="{{ $tempData['pet'][$counter]['pet-how-long'] }}" 
                    @else
                        value="{{ old('pet_name').$sufix }}" 
                    @endif
                    
                    name="how_long{{ $sufix }}" placeholder="XX">
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>

        <?php
        /**
         * field
         * Are the police currently involved?
         */
        ?>
        <div class="form-group col-md-6">
            <label for="">Are the police currently involved?</label>
            <div style="display: block;" class="radio_custom_group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="police_involved_yes{{ $sufix }}" value="yes" name="police_involved{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-police-involved'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-police-involved'], ['police_involved_yes'.$sufix, 'yes'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="police_involved_yes{{ $sufix }}">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="police_involved_no{{ $sufix }}" value="no" name="police_involved{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-police-involved'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-police-involved'], ['police_involved_no'.$sufix, 'no'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="police_involved_no{{ $sufix }}">No</label>
                </div>
            </div>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>
    </div>

    <div class="form-row">

        <?php
        /**
         * field
         * Does the client have a protective order?
         */
        ?>    
        <div class="form-group col-md-6">
            <label for="">Does the client have a protective order?</label>
            <div style="display: block;" class="radio_custom_group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="protective_order_yes{{ $sufix }}" value="yes" 
                            @if ( isset( $tempData['pet'][$counter]['client-protective-order'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['client-protective-order'], ['protective_order_yes'.$sufix, 'yes'] ) )
                                    checked
                                @endif
                            @endif
                            name="protective_order{{ $sufix }}" class="custom-control-input">
                    <label class="custom-control-label" for="protective_order_yes{{ $sufix }}">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="protective_order_no{{ $sufix }}" value="no" name="protective_order{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['client-protective-order'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['client-protective-order'], ['protective_order_no'.$sufix, 'no'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="protective_order_no{{ $sufix }}">No</label>
                </div>
            </div>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>

        <?php
        /**
         * field
         * Is the pet covered in the protective order?
         */
        ?>   
        <div class="form-group col-md-6">
            <label for="">Is the pet covered in the protective order?</label>
            <div style="display: block;" class="radio_custom_group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="pet_covered_yes{{ $sufix }}" value="yes" name="pet_covered{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-protective-order-covered'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-protective-order-covered'], ['pet_covered_yes'.$sufix, 'yes'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="pet_covered_yes{{ $sufix }}">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="pet_covered_no{{ $sufix }}" value="no" name="pet_covered{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-protective-order-covered'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-protective-order-covered'], ['pet_covered_no'.$sufix, 'no'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="pet_covered_no{{ $sufix }}">No</label>
                </div>
            </div>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>
    </div>

    <div class="form-row">

        <?php
        /**
         * field
         * Does the client have any paperwork or evidence indicating ownership of the pet?
         */
        ?>   
        <div class="form-group col-md-6">
            <label for="">Does the client have any paperwork or evidence indicating ownership of the pet? (i.e. vet receipts, pictures, etc)</label>
            <div style="display: block;" class="radio_custom_group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="pet_paperwork_yes{{ $sufix }}" value="yes" name="pet_paperwork{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-client-paperwork'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-client-paperwork'], ['pet_paperwork_yes'.$sufix, 'yes'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="pet_paperwork_yes{{ $sufix }}">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="pet_paperwork_no{{ $sufix }}" value="no" name="pet_paperwork{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-client-paperwork'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-client-paperwork'], ['pet_paperwork_no'.$sufix, 'no'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="pet_paperwork_no{{ $sufix }}">No</label>
                </div>
            </div>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>

        <?php
        /**
         * field
         * Does the abuser have any paperwork or evidence indicating ownership of the pet? 
         */
        ?>         
        <div class="form-group col-md-6">
            <label for="">Does the abuser have any paperwork or evidence indicating ownership of the pet? (i.e. vet receipts, pictures, etc)</label>
            <div style="display: block;" class="radio_custom_group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="pet_abuser_paperwork_yes{{ $sufix }}" value="yes" name="pet_abuser_paperwork{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-abuser-paperwork'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-abuser-paperwork'], ['pet_abuser_paperwork_yes'.$sufix, 'yes'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="pet_abuser_paperwork_yes{{ $sufix }}">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="pet_abuser_paperwork_no{{ $sufix }}" value="no" name="pet_abuser_paperwork{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-abuser-paperwork'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-abuser-paperwork'], ['pet_abuser_paperwork_no'.$sufix, 'no'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="pet_abuser_paperwork_no{{ $sufix }}">No</label>
                </div>
            </div>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>
    </div>

    <div class="form-row">

        <?php
        /**
         * field
         * Please add any details about the abuser that may be helpful for protection.
         */
        ?>   
        <div class="form-group col-md-12">
            <label for="abuser_details{{ $sufix }}">Please add any details about the abuser that may be helpful for protection. (frequent locations, names of friends, phone numbers used, etc)</label>
            <textarea class="form-control" id="abuser_details{{ $sufix }}" name="abuser_details{{ $sufix }}" rows="2"
                >@if ( isset( $tempData['pet'][$counter]['abuser-details'] ) ){{ $tempData['pet'][$counter]['abuser-details'] }}@endif</textarea>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>
    </div>

    <div class="form-row">

        <?php
        /**
         * field
         * Has the client explored other boarding options?
         */
        ?>   
        <div class="form-group col-md-6">
            <label for="">Has the client explored other boarding options? (i.e. friends, family, private vet or boarding)</label>
            <div style="display: block;" class="radio_custom_group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="boarding_options_yes{{ $sufix }}" value="yes" name="boarding_options{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-boarding-options'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-boarding-options'], ['boarding_options_yes'.$sufix, 'yes'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="boarding_options_yes{{ $sufix }}">Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input  type="radio" id="boarding_options_no{{ $sufix }}" value="no" name="boarding_options{{ $sufix }}" 
                            @if ( isset( $tempData['pet'][$counter]['pet-boarding-options'] ) )
                                @if ( in_array( $tempData['pet'][$counter]['pet-boarding-options'], ['boarding_options_no'.$sufix, 'no'] ) )
                                    checked
                                @endif
                            @endif
                            class="custom-control-input">
                    <label class="custom-control-label" for="boarding_options_no{{ $sufix }}">No</label>
                </div>
            </div>
            <div class="invalid-feedback">More example invalid feedback text</div>
        </div>
        <div class="form-group col-md-6">
        </div>
    </div>
</div>