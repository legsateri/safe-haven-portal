@extends('admin.layout.main')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> My Account</div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-5">
                    <form method="post" action="{{ route('admin.settings.account.update.info') }}">
                        {{ csrf_field() }}

                        @if (session('message0'))
                            {{ session('message0') }}
                        @endif

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your username" value="{{ $admin['name'] }}">
                        </div>     
                        <div class="form-group">
                            <label for="user_email">Email address</label>
                            <input type="email" class="form-control" id="user_email" name="email" aria-describedby="emailHelp" placeholder="Enter your email" value="{{ $admin['email'] }}">
                            @if (session('message'))
                                {{ session('message') }}
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mb-2">Update information</button>
                        </div>
                    </form>
                </div>
                
                
                <div class="col-lg-5">
                    <form method="post" action="{{ route('admin.settings.account.update.password') }}">
                        {{ csrf_field() }}
                        
                        @if (session('message1'))
                            {{ session('message1') }}
                        @endif                
                        
                        <div class="form-group">
                            <label for="old_pass">Old password</label>
                            <input type="password" class="form-control" id="old_pass" name="old_password" aria-describedby="passHelp" placeholder="Enter old password">
                            @if (session('message2'))
                            {{ session('message2') }}
                            @elseif (session('message3'))
                            {{ session('message3') }}
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="new_pass">New password</label>
                            <input type="password" class="form-control" id="new_pass" name="new_password" placeholder="Enter new password">
                            @if (session('message4'))
                            {{ session('message4') }}
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="new_pass2" class="sr-only">New Password</label>
                            <input type="password" class="form-control" id="new_pass2" name="new_password2" placeholder="Repeat new password">
                            @if (session('message5'))
                            {{ session('message5') }}
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mb-2">Change password</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>        
@endsection