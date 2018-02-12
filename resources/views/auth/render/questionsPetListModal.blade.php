<?php
/**
 * html for modal window
 * for Q&A on pets listing pages
 */
?>
@foreach( $conversations as $conversation )
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{ $conversation->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted d-inline-block">{{ $conversation->organisation_name }}</h6> <span class="text-muted">-</span>
            @if ( $conversation->message != null )
                <h6 class="card-subtitle mb-2 text-muted d-inline-block">{{ date('M/d/Y', strtotime($conversation->answer_date)) }}</h6>
                <p class="card-text">{{ $conversation->message }}</p>
            @endif
        </div>
    </div>
@endforeach
