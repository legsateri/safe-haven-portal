@foreach( $questions as $question )
    <div class="card mb-2">
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-muted d-inline-block">{{ $question->shelter_name }}</h6> <span class="text-muted">-</span>
            <h6 class="card-subtitle mb-2 text-muted d-inline-block">{{ date('M/d/Y', strtotime($question->question_time)) }}</h6>
            <h5 class="card-title">{{ $question->question }}</h5>
            @if (  $question->answer == null )
                <p class="card-text"></p>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea class="form-control" name="client_qa" rows="1" placeholder="Not answered yet"></textarea>                                                                                                    </textarea>
                            <div class="invalid-feedback">More example invalid feedback text</div>
                            <input class="qa_id" type="hidden" value="{{ $question->id }}"/>
                        </div>
                    </div>
                    <div class="pet_qa_form_buttons_cont">
                        <button type="button" style="display: none;" class="btn btn-primary mr-2 client_qa_edit_cancel">Cancel</button>
                        <button type="button" class="send_client_qa_answer btn btn-primary">Send</button>
                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                    </div>
                </form>
                <button type="button" style="display: none;" class="client_qa_edit btn btn-primary float-right">Edit Answer</button>    
            @else
                <p class="card-text">{{ $question->answer }}</p>
                <form style="display: none;">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea class="form-control" name="client_qa" rows="1" placeholder="Not answered yet"></textarea>                                                                                                    </textarea>
                            <div class="invalid-feedback">More example invalid feedback text</div>
                            <input class="qa_id" type="hidden" value="{{ $question->id }}"/>
                        </div>
                    </div>
                    <div class="client_qa_form_buttons_cont">
                        <button type="button" class="btn btn-primary mr-2 client_qa_edit_cancel">Cancel</button>
                        <button type="button" class="send_client_qa_answer btn btn-primary">Send</button>
                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                    </div>
                </form>
                <button type="button" class="client_qa_edit btn btn-primary float-right">Edit Answer</button>
            @endif
        </div>
    </div>
@endforeach
