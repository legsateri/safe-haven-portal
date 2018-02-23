<div class="card-header">
    <i class="fa fa-area-chart"></i> Edit {{ $organisation->name }}
    <!-- Button trigger modal -->
    <button type="button" 
            class="btn 
            @if( $organisation->org_status_value == 'submitted' )
                btn-warning
            @elseif( $organisation->org_status_value == 'approved' )
                btn-success
            @elseif( $organisation->org_status_value == 'suspended' )
                btn-danger
            @endif
            " 
            data-toggle="modal" 
            data-target="#organisation_verification_modal"
            style="float:right;"
            >
            @if( $organisation->org_status_value == 'submitted' )
                Waiting for verification
            @elseif( $organisation->org_status_value == 'approved' )
                Organization is approved
            @elseif( $organisation->org_status_value == 'suspended' )
                Organization is suspended
            @endif
    </button>
</div>


<!-- Modal -->
<div class="modal fade" id="organisation_verification_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change organization status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        

        <!-- verify user email form -->
        <form action="{{ route('admin.organisation.edit.submit.status', ['id' => $organisation->id, 'slug' => $organisation->slug]) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="new_org_status_value" id="new_org_status_value"
                    @if( $organisation->org_status_value == 'approved' )
                        value="suspended"
                    @else
                        value="approved"
                    @endif
                >

                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            @if( $organisation->org_status_value == 'approved' )
                                Are you sure that you want to suspend <b>{{ $organisation->name }}</b> organization?<br>
                                This action will suspend all users related to this organization from future usage of this application.<br>
                                Please verify your action with your password.
                            @else
                                Are you sure that you want to approve <b>{{ $organisation->name }}</b> organization?<br>
                                You still need to activate users related to this organization.<br>
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
                                >@if( $organisation->org_status_value == 'approved' )
                                    Suspend organization
                                @else
                                    Approve organization
                                @endif</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- end modal -->