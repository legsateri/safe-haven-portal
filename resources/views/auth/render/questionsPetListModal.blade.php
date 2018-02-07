<?php
/**
 * html for modal window
 * for Q&A on pets listing pages
 */
?>
<div class="card mb-2 pet_qa_form">
    <div class="card-body">
        <h5 class="card-title">Post a questions to  pet's advocate.</h5>
        <h6 class="card-subtitle shelter_name mb-2 text-muted d-inline-block">Shelter 2{{--TODO Milos - pass shelter name to blade here--}}</h6>
        <span class="text-muted">-</span>
        <h6 class="card-subtitle mb-2 text-muted d-inline-block">today</h6>
        <form>
            <div class="form-row">
                <div class="form-group col-md-12">   
                    <textarea class="form-control" id="pet_qa" name="pet_qa" rows="1"></textarea>                                                                                                    </textarea>
                    <div class="invalid-feedback">More example invalid feedback text</div>
                    <input id="organisation_id" type="hidden" value="{{Auth::user()->organisation_id}}"/>
                    <input id="pet_qa_id" type="hidden" value=""/>
                </div>
            </div>
            <div class="pet_qa_form_buttons_cont">
                <button id="send_pet_qa" type="button" class="btn btn-primary">Send</button>
                <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
            </div>
        </form>
    </div>
</div>
<?php
/**
 * display conversations
 */
?>
@foreach( $conversations as $conversation )
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{ $conversation->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted d-inline-block">{{ $conversation->organisation_name }}</h6> <span class="text-muted">-</span>
            <h6 class="card-subtitle mb-2 text-muted d-inline-block">{{ date('M/d/Y', strtotime($conversation->answer_date)) }}</h6>
            <p class="card-text">{{ $conversation->message }}</p>
        </div>
    </div>
@endforeach
