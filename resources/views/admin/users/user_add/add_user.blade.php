@extends('admin.layout.main')

@section('content')
<div class="card mb-3">
<div class="card-header">
    <i class="fa fa-area-chart"></i> Add User</div>
<div class="card-body">
    <form action="{{ route('admin.users.user_add.submit') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col-md-4 offset-md-2"> 
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" maxlength="40" name="first_name" value="{{ old('first_name') }}">
            </div>
            <div class="form-group col-md-4">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" maxlength="40" name="last_name" value="{{ old('last_name') }}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4  offset-md-2">
                <label for="user_type">User type</label>
                <select name="user_type" id="user_type">
                    <option value="">Select type</option>
                    @foreach ( $userTypes as $userType )
                        <option value="{{ $userType->id }}">{{ $userType->label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" maxlength="40" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group col-md-4">
                <label for="phone">Office Phone</label>
                <input type="text" class="form-control" id="phone" maxlength="40" name="phone" value="{{ old('phone') }}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="password">New User Password</label>
                <input type="password" class="form-control" id="password" maxlength="40" name="password" value="">
            </div>
            <div class="form-group col-md-4">
                <label for="repeat-password">Repeat Password</label>
                <input type="password" class="form-control" id="repeat-password" maxlength="40" name="repeat-password" value="">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="organisation">Organisation</label>
                <select name="organisation" id="organsation">
                    <option value="">Select organisation</option>
                    @foreach( $organisations as $organisation )
                        <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4 offset-md-2">
                <input type="submit" value="Save">
            </div>
        </div>
    </form>
</div>
@endsection