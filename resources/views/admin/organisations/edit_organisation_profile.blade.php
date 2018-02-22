@extends('admin.layout.main')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card mb-3">
@include('admin.organisations.edit_organisation_header')
@include('admin.organisations.edit_organisation_submenu_partial')

<div class="card-body">
    <form   action="{{ route('admin.organisation.edit.submit.profile', ['id' => $organisation->id, 'slug' => $organisation->slug]) }}" 
            method="post">
        {{ csrf_field() }}

        <div class="form row">
            <div class="form-group col-md-8 offset-md-2">   
                <h4>Profile information</h4>
                <hr> 
            </div>
        </div>


        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="services">Services</label>
                    <textarea   name="services" 
                                id="services"
                                rows="2"
                                class="form-control"
                        >@if( isset( $organisation->services ) )
                            {{ $organisation->services }}
                        @else
                            {{ old('services') }}
                        @endif</textarea>
                <!-- error message -->
                @if ($errors->has('email'))
                    <div class="text-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="office_hours">Office hours</label>
                <textarea   name="office_hours" 
                            id="office_hours"
                            rows="2"
                            class="form-control"
                    >@if( isset( $organisation->have_office_hours ) )
                        {{ $organisation->have_office_hours }}
                    @else
                        {{ old('office_hours') }}
                    @endif</textarea>
                <!-- error message -->
                @if ($errors->has('office_hours'))
                    <div class="text-danger">
                        {{ $errors->first('office_hours') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="website">Website</label>
                <input  type="text" class="form-control"
                        id="website" name="website" 
                        maxlength="40"
                        @if( isset( $address->website ) )
                            value="{{ $address->website }}"
                        @else
                            value="{{ old('website') }}"
                        @endif
                        >
                <!-- error message -->
                @if ($errors->has('website'))
                    <div class="text-danger">
                        {{ $errors->first('website') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="geographic_area_served">geographic_area_served</label>
                <textarea   name="geographic_area_served" 
                            id="geographic_area_served"
                            rows="2"
                            class="form-control"
                    >@if( isset( $organisation->geographic_area_served ) )
                        {{ $organisation->geographic_area_served }}
                    @else
                        {{ old('geographic_area_served') }}
                    @endif</textarea>
                <!-- error message -->
                @if ($errors->has('geographic_area_served'))
                    <div class="text-danger">
                        {{ $errors->first('geographic_area_served') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <button type="submit" class="sh_save_btn btn btn-primary">Update Profile Information</button>
            </div>
        </div>
    </form>


</div>
@endsection