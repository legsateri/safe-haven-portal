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
    <i class="fa fa-area-chart"></i> Edit {{ $user->first_name }} {{ $user->last_name }}</div>
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
            <div class="form-group col-md-4 offset-md-2">
                <label for="email">Email</label>
                <input  type="email" class="form-control"
                        id="email" name="email" 
                        maxlength="40" 
                        value="{{ old('email') }}">
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
                <button type="submit" class="sh_save_btn btn btn-primary">Update general information</button>
            </div>
        </div>
    </form>
    <?php
    /**
     * update contact information form
     */
    ?>
    <br>
    <div class="form row">
        <div class="form-group col-md-8 offset-md-2"> 
            <h5>Contact information</h5>
            <hr>
        </div>
    </div>
    <form action="{{ route('admin.user.edit.submit.contact', ['id' => $user->id, 'slug' => $user->slug]) }}" method="post">
        {{ csrf_field() }}

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="organisation">Phone type</label>
                <select name="organisation" id="organsation">
                    <option value="">Select</option>
                    @foreach( $phoneTypes as $phoneType )
                        <option value="{{ $phoneType->id }}">
                            {{ $phoneType->label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="phone">Phone number</label>
                <input  type="text" class="form-control"
                        id="phone" name="phone" 
                        maxlength="40" 
                        value="">
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="organisation">Address type</label>
                <select name="organisation" id="organsation">
                    <option value="">Select</option>
                    @foreach( $addressTypes as $addressType )
                        <option value="{{ $addressType->id }}">
                            {{ $addressType->label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <button type="submit" class="sh_save_btn btn btn-primary">Update contact information</button>
            </div>
        </div>
    </form>
    <?php
    /**
     * reset user password form
     */
    ?>
    <br>
    <div class="form row">
        <div class="form-group col-md-8 offset-md-2"> 
            <h5>Reset password</h5>
            <hr>
        </div>
    </div>
    <form action="{{ route('admin.user.edit.submit.password', ['id' => $user->id, 'slug' => $user->slug]) }}" method="post">
        {{ csrf_field() }}
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
                <label for="your_password">Your password</label>
                <input type="your_password" class="form-control"
                id="your_password" name="your_password" 
                maxlength="40" 
                value="">
            </div>
        </div>
        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <button type="submit" class="sh_save_btn btn btn-primary">Reset password</button>
            </div>
        </div>
    </form>
    <?php
    /**
     * service actions on user profile
     */
    ?>
    <br>
    <div class="form row">
        <div class="form-group col-md-8 offset-md-2"> 
            <h5>Services</h5>
            <hr>
            <!-- Button trigger modal -->
            <button type="button" 
                    class="btn 
                    @if( $user->verified == 1 )
                        btn-success
                    @else
                        btn-warning
                    @endif
                    " 
                    data-toggle="modal" 
                    data-target="#email_verification_modal">
                    @if( $user->verified == 1 )
                        User email is verified
                    @else
                        User email is not verified
                    @endif
            </button>
            <!-- Modal -->
            <div class="modal fade" id="email_verification_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User email verification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.user.edit.submit.verified', ['id' => $user->id, 'slug' => $user->slug]) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="new_verified_value" id="new_verified_value"
                                @if( $user->verified == 1 )
                                    value="0"
                                @else
                                    value="1"
                                @endif
                            >
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        @if( $user->verified == 1 )
                                            Are you sure that you want to unset verified email for {{ $user->first_name }} {{ $user->last_name }}?<br>
                                            Please verify your action with your password.
                                        @else
                                            Are you sure that you want to set email to verified for {{ $user->first_name }} {{ $user->last_name }}?<br>
                                            Please verify your action with your password.
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="your_password">Your password</label>
                                    <input type="your_password" class="form-control"
                                    id="your_password" name="your_password" 
                                    maxlength="40" 
                                    value="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-sm">
                                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col-sm">
                                        <button type="submit" class="btn btn-primary btn-block"         
                                            >@if( $user->verified == 1 )
                                                Set user as not verified
                                            @else
                                                Set user as verified
                                            @endif</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- end modal -->
            <!-- Button trigger modal -->
            <button type="button" 
                    class="btn 
                    @if( $user->banned == 1 )
                        btn-danger
                    @else
                        btn-success
                    @endif
                    " 
                    data-toggle="modal" 
                    data-target="#user_ban_modal">
                    @if( $user->banned == 0 )
                        Account is active
                    @else
                        Account is banned
                    @endif
            </button>
            <!-- Modal -->
            <div class="modal fade" id="user_ban_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" 
                                id="exampleModalLabel">
                            @if( $user->banned == 1 )
                                Remove ban for {{ $user->first_name }} {{ $user->last_name }}?
                            @else
                                Ban {{ $user->first_name }} {{ $user->last_name }}?
                            @endif
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.user.edit.submit.ban', ['id' => $user->id, 'slug' => $user->slug]) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="new_ban_value" id="new_ban_value"
                                @if( $user->banned == 1 )
                                    value="0"
                                @else
                                    value="1"
                                @endif
                            >
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        @if( $user->banned == 1 )
                                            Are you sure that you want to remove ban for {{ $user->first_name }} {{ $user->last_name }}?<br>
                                            Please verify your action with your password.
                                        @else
                                            Are you sure that you want to ban {{ $user->first_name }} {{ $user->last_name }}?<br>
                                            Please verify your action with your password.
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="your_password">Your password</label>
                                    <input type="your_password" class="form-control"
                                    id="your_password" name="your_password" 
                                    maxlength="40" 
                                    value="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-sm">
                                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col-sm">
                                        <button type="submit" class="btn btn-primary btn-block"         
                                            >@if( $user->banned == 1 )
                                                Remove ban
                                            @else
                                                Ban user
                                            @endif</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- end modal -->

        </div>
    </div>
</div>
@endsection