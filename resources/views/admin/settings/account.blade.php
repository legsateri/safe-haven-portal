@extends('admin.layout.main')

@section('content')
    <div class="card mb-3">
        <div class="card-header"><i class="fa fa-area-chart"></i>My Account</div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-1"></div>

                <div class="admin-update-info col-lg-5">                    
                    
                    <form method="post" action="{{ route('admin.settings.account.update.info') }}">
                        {{ csrf_field() }}

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $admin['name'] }}" placeholder="Enter your name" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="user_email">Email address</label>
                                <input type="email" class="form-control" id="user_email" name="email" aria-describedby="emailHelp" placeholder="Enter your email" value="{{ $admin['email'] }}">
                                @if (session('email-error'))                                    
                                <div class="text-danger">
                                    {{ session('email-error') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <button type="submit" id="admin_update_info" class="btn btn-primary mb-2">Update information</button>
                            </div>
                        </div>
                    </form>
                </div>
                                
                <div class="admin-update-password col-lg-5">
                    
                    <form method="post" action="{{ route('admin.settings.account.update.password') }}">
                        {{ csrf_field() }}
                        
                        @if (session('password-success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('password-success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif                
                        
                        <div class="form-row">        
                            <div class="col-md-12 mb-3">
                                <label for="old_pass">Old password</label>
                                <input type="password" class="form-control" id="old_pass" name="old_password" placeholder="Enter old password" required>
                                @if (session('old-password-error'))
                                <div class="text-danger">
                                    {{ session('old-password-error') }}
                                </div>
                                @elseif (session('old-password-validation-error'))
                                <div class="text-danger">
                                    {{ session('old-password-validation-error') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="new_admin_pass">New password</label>
                                <input type="password" class="form-control" id="new_admin_pass" name="new_password" placeholder="Enter new password" aria-describedby="passwordHelpBlock" required>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Your password must be 8-20 characters long and contain at least one upper-case letter and one number.
                                </small>
                                @if (session('new-password-validation-error'))
                                <div class="text-danger">
                                    {{ session('new-password-validation-error') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="repeat_new_admin_pass" class="sr-only">Repeat Password</label>
                                <input type="password" class="form-control" id="repeat_new_admin_pass" name="new_password2" placeholder="Repeat new password" aria-describedby="passwordConfirmHelpBlock" required>
                                <small id="passwordConfirmHelpBlock" class="form-text text-muted">
                                </small>
                                @if (session('repeat-password-validation-error'))
                                <div class="text-danger">
                                    {{ session('repeat-password-validation-error') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <button type="submit" id="admin_change_pass" class="btn btn-primary mb-2">Change password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>        
@endsection