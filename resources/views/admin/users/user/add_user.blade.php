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

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


<div class="card mb-3">
<div class="card-header">
    <i class="fa fa-area-chart"></i> Add User</div>
<div class="card-body">
    <form action="{{ route('admin.users.user_add.submit') }}" method="post">
        {{ csrf_field() }}

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2"> 
                <label for="first_name">First Name</label>
                <input  type="text" class="form-control"
                        id="first_name" name="first_name" 
                        maxlength="40" 
                        value="{{ old('first_name') }}">
            </div>

            <div class="form-group col-md-4">
                <label for="last_name">Last Name</label>
                <input  type="text" class="form-control"
                        id="last_name" name="last_name" 
                        maxlength="40" 
                        value="{{ old('last_name') }}">
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4  offset-md-2">
                <label for="user_type">User type</label>
                <select name="user_type" id="user_type">
                    <option value="">Select type</option>
                    @foreach ( $userTypes as $userType )
                        <option value="{{ $userType->id }}">
                            {{ $userType->label }} 
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="email">Email</label>
                <input  type="email" class="form-control"
                        id="email" name="email" 
                        maxlength="40" 
                        value="{{ old('email') }}">
            </div>
            <div class="form-group col-md-4">
                <label for="phone">Office Phone</label>
                <input  type="text" class="form-control"
                        id="phone" name="phone" 
                        maxlength="40" 
                        value="{{ old('phone') }}">
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="password">New User Password</label>
                <input type="password" class="form-control"
                id="password" name="password" 
                maxlength="40" 
                value="">
            </div>

            <div class="form-group col-md-4">
                <label for="repeat-password">Repeat Password</label>
                <input type="password" class="form-control"
                id="repeat-password"  name="repeat-password" 
                maxlength="40"
                value="">
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="organisation">Organisation</label>
                <select name="organisation" id="organsation">
                    <option value="">Select organisation</option>
                    @foreach( $organisations as $organisation )
                        <option value="{{ $organisation->id }}">
                            {{ $organisation->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <button type="submit" class="sh_save_btn btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection