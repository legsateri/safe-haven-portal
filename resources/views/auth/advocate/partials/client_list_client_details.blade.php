
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
