@extends('layouts.user-main')

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('success') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

    <div class="card mb-3">
        <div class="card-header"><i class="fa fa-user-o"></i> My Account</div>
        <div class="card-body">
            <!-- Update user's info -->
            <form method="post" action="{{ route('user.account.update.info') }}" style="margin: 5px 30px">
                {{ csrf_field() }}
        
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="first-name">First name</label>
                        <input  type="text" class="form-control"
                                id="first-name" name="first_name"
                                placeholder="Enter first name" value="{{ $currentUser->first_name }}"
                                required>
                    </div>
                        
                    <div class="col-md-6 mb-3">
                        <label for="last-name">Last name</label>
                        <input  type="text" class="form-control"
                                id="last-name" name="last_name"
                                placeholder="Enter last name" value="{{ $currentUser->last_name }}"
                                required>
                    </div>
                </div>
                                   
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="email">Email address</label>
                        <input  type="email" class="form-control"
                                id="email" name="email"
                                placeholder="email@example.com" value="{{ $currentUser->email }}">
                    </div>
                            
                    <div class="col-md-6 mb-3">
                        <label for="phone">Contact Phone Number</label>
                        <input  type="text" class="form-control"
                                id="phone" name="phone_number"
                                placeholder="XXXXXXXXXX"
                                value="{{ $userPhone->number }}"
                                required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-row">
                                    <label><h6> Address </h6></label>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-9 mb-3">
                                        <label for="street">Street</label>
                                        <input  type="text" class="form-control"
                                                id="street" name="street"
                                                placeholder="Street"
                                                value="{{ $userAddress['street'] }}">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="number">Number</label>
                                        <input  type="text" class="form-control"
                                                id="number" name="number"
                                                placeholder="Number"
                                                value="{{ $userAddress['number'] }}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="number">City</label>
                                        <input  type="text" class="form-control"
                                                id="city" name="city"
                                                placeholder="City"
                                                value="{{ $userAddress['city'] }}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="state">State</label>
                                        <select class="form-control" id="state" name="state">
                                            <option>Select state</option>
                                            @foreach($states as $state)
                                            <option value="{{$state->id}}"
                                                @if($state->id == $userAddress['state'])
                                                selected
                                                @endif                                               
                                            >{{$state->name}}</option>
                                            @endforeach                           
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="zip">Zip/Postal Code</label>
                                        <input  type="text" class="form-control"
                                                id="zip" name="zip_code"
                                                placeholder="Zip/Postal Code"
                                                value="{{ $userAddress['zip_code'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>   
                </div>

                <div class="form-row">
                    <button class="btn btn-outline-primary" type="submit">Update</button>
                </div>
            </form>      
        </div>

        <?php /*   
        <div class="card-footer small text-muted">
            Last updated on {{ Carbon\Carbon::parse($currentUser->updated_at)->format('m/d/Y, i:s') }}
        </div>*/
        ?>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <!-- Password reset-->
            <div class="card mb-3">
                <div class="card-header"><i class="fa fa-key"></i> Change password </div>
                <div class="card-body">
                    <form method="post" action="{{ route('user.account.update.password') }}" style="margin: 5px 30px">
                        {{ csrf_field() }}
                
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="old_pass">Old password</label>
                                <input  type="password" class="form-control"
                                        id="old_pass" name="old_password"
                                        aria-describedby="passHelp"
                                        placeholder="Enter old password"
                                        required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="new_pass">New password</label>
                                <input  type="password" class="form-control"
                                        id="new_pass" name="new_password"
                                        aria-describedby="passHelp"
                                        placeholder="Enter new password"
                                        required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="repeat_new_pass">New password</label>
                                <input  type="password" class="form-control"
                                        id="repeat_new_pass" name="repeat_new_password"
                                        aria-describedby="passHelp"
                                        placeholder="Repeat new password"
                                        required>
                            </div>
                        </div>               
                        <button class="btn btn-outline-primary" type="submit">Change password</button>
                    </form>
                </div>
                <?php /*
                <div class="card-footer small text-muted">
                    Last updated on {{ Carbon\Carbon::parse($currentUser->updated_at)->format('m/d/Y, i:s') }}
                </div> */
                ?>
            </div>
        </div>
    </div>
@endsection