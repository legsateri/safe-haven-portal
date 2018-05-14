@extends('layouts.user-main')

@section('content')
    <div class="card mb-3 current_clients_cont">

        <div class="modal fade" id="currentClientsModal" tabindex="-1" role="dialog" aria-labelledby="currentClientsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="currentClientsModalLabel">Client Release</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row mb-3 modal_body_text">
                                Please select the reason for release. A release announcement will be sent out to the appropriate
                                Shelter and Safe Haven volunteers.
                            </div>
                            <div class="row modal_body_inputs">
                                <div class="form-group col-md-12">
                                    <div style="display: block;" class="radio_custom_group">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input id="completed_type" value="completed" name="release_type" class="custom-control-input" type="radio">
                                            <label class="custom-control-label" for="completed_type">Services Completed</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input id="not_provided_type" value="not_provided" name="release_type" class="custom-control-input" checked="" type="radio">
                                            <label class="custom-control-label" for="not_provided_type">Services Not Provided</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input id="no_longer_needed_type" value="no_longer_needed" name="release_type" class="custom-control-input" type="radio">
                                            <label class="custom-control-label" for="no_longer_needed_type">Services No Longer Needed</label>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="confirm_release_client" type="button" class="btn btn-primary">Confirm Release Client</button>
                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                        <input type="hidden" value=""/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Q&A-->
        <div class="modal fade" id="currentClientsQAModal" tabindex="-1" role="dialog" aria-labelledby="currentClientsQAModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="currentClientsQAModalLabel"><span></span> - Questions and Answers </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <?php /*
                        <!-- NOTE to Milos - type 1 template - not answered yet - starts -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted d-inline-block">Nino Shelter 1</h6> <span class="text-muted">-</span>
                                <h6 class="card-subtitle mb-2 text-muted d-inline-block">Feb/07/2018</h6>
                                <h5 class="card-title">nJMJd Fo8s4q27uz7Y mXVW1wAcWaVJyoTC?</h5>
                                <p class="card-text"></p>
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" name="client_qa" rows="1" placeholder="Not answered yet"></textarea>                                                                                                    </textarea>
                                            <div class="invalid-feedback">More example invalid feedback text</div>
                                            {{--<input id="organisation_id" type="hidden" value="{{Auth::user()->organisation_id}}"/>--}}
                                            <input class="qa_id" type="hidden" value="1"/>
                                        </div>
                                    </div>
                                    <div class="pet_qa_form_buttons_cont">
                                        <button type="button" style="display: none;" class="btn btn-primary mr-2 client_qa_edit_cancel">Cancel</button>
                                        <button type="button" class="send_client_qa_answer btn btn-primary">Send</button>
                                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                                    </div>
                                </form>
                                <button type="button" style="display: none;" class="client_qa_edit btn btn-primary float-right">Edit Answer</button>
                            </div>
                        </div>
                        <!-- NOTE to Milos - type 1 template - not answered yet - ends -->
                        <!-- NOTE to Milos - type 1 template - not answered yet - just a copy - starts -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted d-inline-block">Nino Shelter 2</h6> <span class="text-muted">-</span>
                                <h6 class="card-subtitle mb-2 text-muted d-inline-block">Feb/05/2018</h6>
                                <h5 class="card-title">nJMJd Fo8s4q27uz7Y mXVW1wAcWaVJyoTC?</h5>
                                <p class="card-text"></p>
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" name="client_qa" rows="1" placeholder="Not answered yet"></textarea>                                                                                                    </textarea>
                                            <div class="invalid-feedback">More example invalid feedback text</div>
                                            {{--<input id="organisation_id" type="hidden" value="{{Auth::user()->organisation_id}}"/>--}}
                                            <input class="qa_id" type="hidden" value="2"/>
                                        </div>
                                    </div>
                                    <div class="client_qa_form_buttons_cont">
                                        <button type="button" style="display: none;" class="btn btn-primary mr-2 client_qa_edit_cancel">Cancel</button>
                                        <button type="button" class="send_client_qa_answer btn btn-primary">Send</button>
                                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                                    </div>
                                </form>
                                <button type="button" style="display: none;" class="client_qa_edit btn btn-primary float-right">Edit Answer</button>
                            </div>
                        </div>
                        <!-- NOTE to Milos - type 1 template - not answered yet - just a copy - ends -->
                        <!-- NOTE to Milos - type 2 template - already answered - starts -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted d-inline-block">Nino Shelter 2</h6> <span class="text-muted">-</span>
                                <h6 class="card-subtitle mb-2 text-muted d-inline-block">Feb/04/2018</h6>
                                <h5 class="card-title">nJMJd Fo8s4q27uz7Y mXVW1wAcWaVJyoTC?</h5>
                                <p class="card-text">GS5bY2mY i8UIfxLS7A 3WQOvOCElF08esu</p>
                                <form style="display: none;">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" name="client_qa" rows="1" placeholder="Not answered yet"></textarea>                                                                                                    </textarea>
                                            <div class="invalid-feedback">More example invalid feedback text</div>
                                            {{--<input id="organisation_id" type="hidden" value="{{Auth::user()->organisation_id}}"/>--}}
                                            <input class="qa_id" type="hidden" value="3"/>
                                        </div>
                                    </div>
                                    <div class="client_qa_form_buttons_cont">
                                        <button type="button" class="btn btn-primary mr-2 client_qa_edit_cancel">Cancel</button>
                                        <button type="button" class="send_client_qa_answer btn btn-primary">Send</button>
                                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                                    </div>
                                </form>
                                <button type="button" class="client_qa_edit btn btn-primary float-right">Edit Answer</button>
                            </div>
                        </div>
                        <!-- NOTE to Milos - type 2 template - already answered - ends -->
                        <!-- NOTE to Milos - type 2 template - already answered - just a copy - starts -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted d-inline-block">Nino Shelter 1</h6> <span class="text-muted">-</span>
                                <h6 class="card-subtitle mb-2 text-muted d-inline-block">Feb/03/2018</h6>
                                <h5 class="card-title">nJMJd Fo8s4q27uz7Y mXVW1wAcWaVJyoTC?</h5>
                                <p class="card-text">GS5bY2mY i8UIfxLS7A 3WQOvOCElF08esu</p>
                                <form style="display: none;">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" name="client_qa" rows="1" placeholder="Not answered yet"></textarea>                                                                                                    </textarea>
                                            <div class="invalid-feedback">More example invalid feedback text</div>
                                            {{--<input id="organisation_id" type="hidden" value="{{Auth::user()->organisation_id}}"/>--}}
                                            <input class="qa_id" type="hidden" value="4"/>
                                        </div>
                                    </div>
                                    <div class="client_qa_form_buttons_cont">
                                        <button type="button" class="btn btn-primary mr-2 client_qa_edit_cancel">Cancel</button>
                                        <button type="button" class="send_client_qa_answer btn btn-primary">Send</button>
                                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                                    </div>
                                </form>
                                <button type="button" class="client_qa_edit btn btn-primary float-right">Edit Answer</button>
                            </div>
                        </div>
                        <!-- NOTE to Milos - type 2 template - already answered - just a copy - ends -->
                        */ ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{--<button id="confirm_accept_pet_qa" type="button" class="btn btn-primary">Send</button>--}}
                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                        <input id="client_qa_id" type="hidden" value=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-header">
            <i class="fa fa-users" aria-hidden="true"></i> Current Clients</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5 col-sm-12 order-sm-2 order-2 order-md-1">
                    <div class="paginate_top">
                        {{ $dataEntries->links() }}
                    </div>
                </div>
                <div class="col-md-7 col-sm-12 order-sm-1 order-1 order-md-2 mb-2">
                    <?php 
                    /**
                     * listing filters
                     * (start)
                     */
                    ?>
                    <form   class="form-inline float-right"
                            action="{{ route('list-filters.submit', ['uenc' => base64_encode( route( Route::current()->getName() ) )]) }}"
                            method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="filter_name" value="current_clients">
                        <div class="form-group mr-2">
                            <label class="mr-2" for="order_by_select_type">Order by</label>
                            <select class="custom-select" 
                                    name="order_by" 
                                    id="order_by_select_type">
                                <option value="desc"
                                        @if( isset( $filter_rules['order_by'] ) )
                                            @if ( $filter_rules['order_by'] == 'desc' )
                                                selected
                                            @endif
                                        @endif
                                >Latest</option>
                                <option value="asc"
                                        @if( isset( $filter_rules['order_by'] ) )
                                            @if ( $filter_rules['order_by'] == 'asc' )
                                                selected
                                            @endif
                                        @endif
                                >Oldest</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="filter_by_answered"></label>
                            <select class="custom-select" 
                                    name="filter_by_answered" 
                                    id="filter_by_answered">
                                <option value="all"
                                        @if( isset( $filter_rules['filter_by_answered'] ) )
                                            @if ( $filter_rules['filter_by_answered'] == 'all' )
                                                selected
                                            @endif
                                        @endif
                                >Display All</option>
                                <option value="answered"
                                        @if( isset( $filter_rules['filter_by_answered'] ) )
                                            @if ( $filter_rules['filter_by_answered'] == 'answered' )
                                                selected
                                            @endif
                                        @endif
                                >Answered</option>
                                <option value="unanswered"
                                        @if( isset( $filter_rules['filter_by_answered'] ) )
                                            @if ( $filter_rules['filter_by_answered'] == 'unanswered' )
                                                selected
                                            @endif
                                        @endif
                                >Unanswered</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
                    </form>
                    <?php 
                    /**
                     * listing filters
                     * (end)
                     */
                    ?>
                </div>
            </div>
            <div class="row main_cont">
                <div class="col-xl-3 col-lg-4 col-md-4 col-5">
                    <div id="list-example" class="list-group">
                        <?php
                        /**
                         * generate left slection menu
                         * (code start)
                         */
                        ?>
                        @foreach( $dataEntries as $dataEntry )
                            <a  href="#list-item-{{ $dataEntry->application_id }}" 
                                class="list-group-item list-group-item-action flex-column align-items-start active">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $dataEntry->first_name }} {{ $dataEntry->last_name }}</h5>
                                    <small>{{ date('M/d/Y', strtotime($dataEntry->created_at)) }}</small>
                                </div>
                                <div class="justify-content-between d-flex zip_pet_number_cont mt-3">
                                    <p class="mb-1">{{ $dataEntry->zip_code }}</p>
                                    <small>{{ $dataEntry->city }}</small>
                                    {{--<span class="badge badge-primary badge-pill">{{ $dataEntry->pets_count }}</span>--}}
                                </div>
                                <div class="justify-content-between d-flex city_pet_number_cont mt-3">
                                     {{--TODO Milos check blade vars--}}
                                    <button id="list-button-qa-item-{{$dataEntry->application_id}}" type="button" class="btn-sm btn-primary">
                                        Q & A 
                                        @if( $qa_badge[$dataEntry->id] > 0 )
                                            <span class="badge badge-light ml-1">{{$qa_badge[$dataEntry->id]}}</span><span class="sr-only">unanswered messages</span>
                                        @endif
                                    </button>
                                    <button id="list-button-item-{{ $dataEntry->application_id }}" type="button" class="btn-sm btn-primary">Release Client</button>
                                </div>
                            </a>
                        @endforeach
                        <?php
                        /**
                         * generate left slection menu
                         * (code end)
                         */
                        ?>
                    </div>
                    <?php
                    /**
                     * pagination for list
                     */
                    ?>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-8 col-7">
                    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
                        <?php
                        /**
                         * generate right side
                         * with client details
                         * (code start)
                         */
                        ?>
                        @foreach( $dataEntries as $dataEntry )
                                @if ($loop->iteration == 1)
                                    @php ($color_class = 'multi_form_color_blue')
                                    {{--<div id="list-item-{{ $dataEntry->application_id }}" class="new_client_form_row multi_form_color">--}}
                                @elseif ($loop->iteration == 2)
                                    @php ($color_class = 'multi_form_color_red')
                                @elseif ($loop->iteration == 3)
                                    @php ($color_class = 'multi_form_color_yellow')
                                @elseif ($loop->iteration == 4)
                                    @php ($color_class = 'multi_form_color_green')
                                @else
                                    {{--<div id="list-item-{{ $dataEntry->application_id }}" class="new_client_form_row">--}}
                                    @php ($color_class = '')
                                @endif
                                <div id="list-item-{{ $dataEntry->application_id }}" class="new_client_form_row {{$color_class}}">
                            <?php 
                            /**
                             * client details
                             */
                            ?>
                            @include('auth.advocate.partials.client_list_current_details')
                            <?php  
                            /**
                             * pets details partial load
                             */
                            ?>
                            @foreach( $dataEntriesPets[$dataEntry->id] as $petEntry )
                                @include('auth.advocate.partials.client_list_pet_details')
                            @endforeach
                                </div>
                        @endforeach
                        <?php
                        /**
                         * generate right side
                         * with client details
                         * (code end)
                         */
                        ?>
                    </div>
                    <div class="paginate_bottom mt-4">
                        {{ $dataEntries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection