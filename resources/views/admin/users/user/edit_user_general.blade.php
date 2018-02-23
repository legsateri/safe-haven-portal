@extends('admin.layout.main')

@section('content')

@include('admin.users.user.edit_user_notifications_partial')
<div class="card mb-3">

@include('admin.users.user.edit_user_header_partial')
<div class="card-body">
    <?php
    /**
     * update general information form
     */
    ?>
    <div class="form row">
        <div class="form-group col-md-8 offset-md-2"> 
            <h5>General information</h5>
            <hr>
        </div>
    </div>
    <form action="{{ route('admin.user.edit.submit.general', ['id' => $user->id, 'slug' => $user->slug]) }}" method="post">
        {{ csrf_field() }}

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2"> 
                <label for="first_name">First Name</label>
                <input  type="text" class="form-control"
                        id="first_name" name="first_name" 
                        maxlength="40" 
                        value="{{ $user->first_name }}">
                <!-- error message -->
                @if ($errors->has('first_name'))
                    <div class="text-danger">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="last_name">Last Name</label>
                <input  type="text" class="form-control"
                        id="last_name" name="last_name" 
                        maxlength="40" 
                        value="{{ $user->last_name }}">
                <!-- error message -->
                @if ($errors->has('last_name'))
                    <div class="text-danger">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="email">Email</label>
                <input  type="email" class="form-control"
                        id="email" name="email" 
                        maxlength="40" 
                        value="{{ $user->email }}">
                <!-- error messages -->
                @if ($errors->has('email'))
                    <div class="text-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                
                @if (session('email-error-general'))
                    <div class="text-danger">
                        {{ session('email-error-general') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="organisation">Organisation</label>
                <select name="organisation" id="organsation">
                    <option value="">Select organisation</option>
                    @foreach( $organisations as $organisation )
                        <option value="{{ $organisation->id }}"
                            @if ( $user->organisation_id == $organisation->id )
                                selected
                            @endif
                        >
                            {{ $organisation->name }}
                        </option>
                    @endforeach
                </select>
                <!-- error message -->
                @if ($errors->has('organsation'))
                    <div class="text-danger">
                        {{ $errors->first('organsation') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <button type="submit" class="sh_save_btn btn btn-primary">Update general information</button>
            </div>
        </div>
    </form>

</div>
@endsection