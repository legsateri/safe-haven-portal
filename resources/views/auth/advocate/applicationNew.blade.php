@extends('layouts.user-main')

@section('content')
    {{--<div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> New Application</div>
        <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>--}}

    <div id="accordion" role="tablist">
        <div class="card">
            <div class="card-header" role="tab" id="headingOne">
                <h5 class="mb-0">
                    <a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
                        New Client application - Step 1
                    </a>
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
                            <form action="{{ route('register') }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="org_last_name">First Name</label>
                                        <input type="text" class="form-control" id="org_first_name" maxlength="25" required="" value="{{ old('first_name') }}" name="first_name" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="org_last_name">Last Name</label>
                                        <input type="text" class="form-control" id="org_last_name" maxlength="25" required="" value="{{ old('last_name') }}" name="last_name" placeholder="">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="contact_phone_num">Phone Number (10 digits)</label>
                                        <input type="phone" class="form-control" id="contact_phone_num" name="contact_phone_number" maxlength="10" pattern="^\d{3}\d{3}\d{4}$" placeholder="XXXXXXXXXX" required="" value="{{ old('contact_phone_number') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Email</label>
                                        <input type="email" maxlength="45" class="form-control" id="inputEmail4" name="email" placeholder="e.g. yourname@yourmail.com" required="" value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pref_contact_method">Preferred Contact method</label>
                                       {{-- <input type="text" class="form-control" id="org_first_name" maxlength="25" required="" value="{{ old('first_name') }}" name="first_name" placeholder="">
                                    --}}

                                        <div class="input-group mb-3">
                                            {{--<div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                            </div>--}}
                                            <select class="custom-select" id="pref_contact_method">
                                                <option selected>Choose...</option>
                                                <option value="1">Phone</option>
                                                <option value="2">Email</option>
                                                <option value="3">Text message</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" maxlength="50" required="" value="{{ old('address') }}" name="address" placeholder="">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" maxlength="25" required="" value="{{ old('city') }}" name="city" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="org_last_name">State</label>
                                        <div class="input-group mb-3">
                                            <select class="custom-select" id="pref_contact_method">
                                                <option selected>Choose...</option>
                                                <option value="1">Alaska</option>
                                                <option value="2">California</option>
                                                <option value="3">Michigan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="zip">Zip (5 digits)</label>
                                        <input type="text" class="form-control" id="zip" maxlength="5" required="" value="{{ old('zip') }}" name="zip" placeholder="XXXXX">
                                    </div>
                                </div>

                                {{--<div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="custom-control custom-checkbox mt-4">
                                            <input type="checkbox" id="already_with_org" class="custom-control-input" name="already_with_org"
                                                   @if( old('already_with_org') == 'on' )
                                                   checked
                                                    @endif
                                            >
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Already with an organization?</span>
                                        </label>
                                    </div>
                                    <div id="sign_up_org_name_half_row" class="form-group col-md-6">
                                        <label for="org_name">Organization Name</label>
                                        <input type="text" class="form-control" id="org_name" maxlength="40" name="org_name" value="{{ old('org_name') }}">
                                    </div>
                                    <div id="sign_up_org_code_half_row" class="form-group col-md-6">
                                        <label for="org_code">Organization Code</label>
                                        <input type="text" class="form-control" id="org_code" placeholder="XXXXXX" name="organization_code" value="{{ old('organization_code') }}">
                                    </div>
                                </div>--}}
                                {{--<div id="sign_up_tax_id_row" class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="tax_id">Tax ID (EIN) - (9 digits)</label>
                                        <input type="text" class="form-control" id="tax_id" maxlength="10" name="tax_id" pattern="^\d{2}-\d{7}$" value="{{ old('tax_id') }}" placeholder="XX-XXXXXXX">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="org_phone_num">Organization Phone Number - (10 digits)</label>
                                        <input type="phone" class="form-control" id="org_phone_num" maxlength="10" name="org_phone_number" pattern="^\d{3}\d{3}\d{4}$" value="{{ old('org_phone_number') }}" placeholder="XXXXXXXXXX">
                                    </div>
                                </div>--}}


                                {{--<div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="user_pass">Password</label>
                                        <input type="password" minlength="6" maxlength="20" class="form-control" id="user_pass" name="password" required="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="user_pass_confirm">Confirm Password</label>
                                        <input type="password" class="form-control" id="user_pass_confirm" name="password_confirmation" minlength="6" maxlength="20" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="terms_of_use" id="terms_of_use"
                                               @if( old('terms_of_use') == 'on' )
                                               checked
                                                @endif
                                        >
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">
                                    I agree to the
                                    <a class="terms-link" data-toggle="modal" data-target="#sh_terms_of_use" href="#">Terms of Use</a>
                                </span>
                                    </label>
                                </div>--}}
                                {{--<input id="sign_up_form_user_type" type="hidden" name="sign_up_form_user_type" value="">
                                <button type="submit" class="sh_sign_btn btn btn-primary">Sign up</button>--}}
                            </form>
                        </div>
                        <div class="col-lg-2 col-md-2">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" role="tab" id="headingTwo">
                <h5 class="mb-0">
                    <a class="collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                        Add Pet - Step 2
                    </a>
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
                            <form action="{{ route('register') }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="org_last_name">First Name</label>
                                        <input type="text" class="form-control" id="org_first_name" maxlength="25" required="" value="{{ old('first_name') }}" name="first_name" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="org_last_name">Last Name</label>
                                        <input type="text" class="form-control" id="org_last_name" maxlength="25" required="" value="{{ old('last_name') }}" name="last_name" placeholder="">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="contact_phone_num">Phone Number (10 digits)</label>
                                        <input type="phone" class="form-control" id="contact_phone_num" name="contact_phone_number" maxlength="10" pattern="^\d{3}\d{3}\d{4}$" placeholder="XXXXXXXXXX" required="" value="{{ old('contact_phone_number') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Email</label>
                                        <input type="email" maxlength="45" class="form-control" id="inputEmail4" name="email" placeholder="e.g. yourname@yourmail.com" required="" value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pref_contact_method">Preferred Contact method</label>

                                        <div class="input-group mb-3">

                                            <select class="custom-select" id="pref_contact_method">
                                                <option selected>Choose...</option>
                                                <option value="1">Phone</option>
                                                <option value="2">Email</option>
                                                <option value="3">Text message</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" maxlength="50" required="" value="{{ old('address') }}" name="address" placeholder="">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" maxlength="25" required="" value="{{ old('city') }}" name="city" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="org_last_name">State</label>
                                        <div class="input-group mb-3">
                                            <select class="custom-select" id="pref_contact_method">
                                                <option selected>Choose...</option>
                                                <option value="1">Alaska</option>
                                                <option value="2">California</option>
                                                <option value="3">Michigan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="zip">Zip (5 digits)</label>
                                        <input type="text" class="form-control" id="zip" maxlength="5" required="" value="{{ old('zip') }}" name="zip" placeholder="XXXXX">
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
        <div class="card">
            <div class="card-header" role="tab" id="headingThree">
                <h5 class="mb-0">
                    <a class="collapsed" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">
                        Application Review - Step 3
                    </a>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" role="tab" id="headingThree">
                <h5 class="mb-0">
                    <a class="collapsed" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">
                        Submit Application - Step 4
                    </a>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
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