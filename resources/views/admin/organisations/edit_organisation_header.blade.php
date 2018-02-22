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