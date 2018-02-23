<div class="card-header">
    <i class="fa fa-user"></i> Edit {{ $user->first_name }} {{ $user->last_name }}
    
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
            data-target="#user_ban_modal"
            style="float:right;"
            >
            @if( $user->banned == 0 )
                Account is active
            @else
                Account is suspended
            @endif
    </button>

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
            data-target="#email_verification_modal"
            style="float:right;"
            >
            @if( $user->verified == 1 )
                User email is verified
            @else
                User email is not verified
            @endif
    </button>

</div>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a  class="nav-link
            @if( Route::current()->getName() == 'admin.user.edit.general.page' )
                active
            @endif" 
            href="{{ route('admin.user.edit.general.page', ['id' => $user->id, 'slug' => $user->slug]) }}">General</a>
    </li>
    <li class="nav-item">
        <a  class="nav-link
            @if( Route::current()->getName() == 'admin.user.edit.contact.page' )
                active
            @endif" 
            href="{{ route('admin.user.edit.contact.page', ['id' => $user->id, 'slug' => $user->slug]) }}">Contact</a>
    </li>
    <li class="nav-item">
        <a  class="nav-link
            @if( Route::current()->getName() == 'admin.user.edit.password.page' )
                active
            @endif" 
            href="{{ route('admin.user.edit.password.page', ['id' => $user->id, 'slug' => $user->slug]) }}">Password</a>
    </li>
</ul>

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
        

        <!-- verify user email form -->
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
                        <label for="admin_password_verify">Your password</label>
                        <input  type="password" class="form-control"
                                id="admin_password_verify" name="admin_password_verify" 
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

<!-- Modal -->
<div class="modal fade" id="user_ban_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" 
                    id="exampleModalLabel">
                @if( $user->banned == 1 )
                    Activate {{ $user->first_name }} {{ $user->last_name }}?
                @else
                    Suspend {{ $user->first_name }} {{ $user->last_name }}?
                @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- User ban form -->
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
                                Are you sure that you want to activate <b>{{ $user->first_name }} {{ $user->last_name }}</b>?<br>
                                Please verify your action with your password.
                            @else
                                Are you sure that you want to suspend <b>{{ $user->first_name }} {{ $user->last_name }}</b>?<br>
                                Please verify your action with your password.
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="admin-password">Your password</label>
                        <input  type="password" class="form-control"
                                id="admin-password" name="admin_password_ban" 
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
                                    Activate
                                @else
                                    Suspend
                                @endif</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- end modal -->








