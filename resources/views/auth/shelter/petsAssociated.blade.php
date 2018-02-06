@extends('layouts.user-main')

@section('content')
    <div class="card mb-3 current_pets_cont">

        <div class="modal fade" id="currentPetsModal" tabindex="-1" role="dialog" aria-labelledby="currentClientsModalLabel" aria-hidden="true">
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
                                    {{--<label for="">Pet Type</label>--}}
                                    <div style="display: block;" class="radio_custom_group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input id="pet_released_to_owner_type" value="pet_released_to_owner" name="pet_release_type" class="custom-control-input" type="radio">
                                            <label class="custom-control-label" for="pet_released_to_owner_type">Released To Owner</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input id="pet_services_not_provided_type" value="pet_services_not_provided" name="pet_release_type" class="custom-control-input" checked="" type="radio">
                                            <label class="custom-control-label" for="pet_services_not_provided_type">Services Not Provided</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input id="pet_released_to_adoption_pool_type" value="pet_released_to_adoption_pool" name="pet_release_type" class="custom-control-input" type="radio">
                                            <label class="custom-control-label" for="pet_released_to_adoption_pool_type">Released to Adoption Pool</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
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
                        <button id="confirm_release_client" type="button" class="btn btn-primary">Confirm Release Client</button>
                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                        <input type="hidden" value=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-header">
            <i class="fa fa-home"></i> Currently Accepted Pets</div>
        <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

@endsection