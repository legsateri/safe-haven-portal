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
<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title">Question 4 vestibulum tincidunt, lacus finibus ultrices dictum, quam massa dapibus ligula,
            feugiat sollicitudin nisi enim et ante?
        </h5>
        <h6 class="card-subtitle mb-2 text-muted d-inline-block">Shelter 2</h6> <span class="text-muted">-</span>
        <h6 class="card-subtitle mb-2 text-muted d-inline-block">01/02/2018</h6>
        <p class="card-text">Morbi tempor augue nec nisi luctus commodo. Fusce a nisl lacus.</p>
    </div>
</div>
<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title">Question 3 vestibulum tincidunt, lacus finibus ultrices dictum, quam massa dapibus ligula,
            feugiat sollicitudin nisi enim et ante?
        </h5>
        <h6 class="card-subtitle mb-2 text-muted d-inline-block">Shelter 2</h6> <span class="text-muted">-</span>
        <h6 class="card-subtitle mb-2 text-muted d-inline-block">01/02/2018</h6>
        <p class="card-text">Morbi tempor augue nec nisi luctus commodo. Fusce a nisl lacus.</p>
    </div>
</div>
<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title">Question 2 integer varius eu odio in ultricies?</h5>
        <h6 class="card-subtitle mb-2 text-muted d-inline-block">Shelter 1</h6> <span class="text-muted">-</span>
        <h6 class="card-subtitle mb-2 text-muted d-inline-block">10/01/2018</h6>
        <p class="card-text">Fusce viverra aliquet tristique.</p>
    </div>
</div>
<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title">Question 1 in accumsan sit amet magna congue faucibus?</h5>
        <h6 class="card-subtitle mb-2 text-muted d-inline-block">Shelter 3</h6> <span class="text-muted">-</span>
        <h6 class="card-subtitle mb-2 text-muted d-inline-block">09/01/2018</h6>
        <p class="card-text">Suspendisse vitae aliquet lectus. Aenean ullamcorper commodo feugiat.</p>
    </div>
</div>
