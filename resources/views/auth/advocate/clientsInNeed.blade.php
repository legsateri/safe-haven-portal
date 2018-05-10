@extends('layouts.user-main')

@section('content')
    <div class="card mb-3 clients_in_need_cont">

        <!-- Button trigger modal -->
        {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
        </button>--}}

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Client Acceptance Acknowledgement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Once a client is accepted, emails are sent to Shelters letting them know there are pets in need.
                        By clicking 'Confirm Accept Client' below, your organization is agreeing to work with the Shelters
                        and Client to establish a temporary home for the pet or pets.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="confirm_accept_client" type="button" class="btn btn-primary">Confirm Accept Client</button>
                        <div class="spinner_cont spinner_modal"><i class="fa fa-spinner fa-pulse fa-2x" aria-hidden="true"></i></div>
                        <input type="hidden" value=""/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-header">
            <i class="fa fa-heart" aria-hidden="true"></i> Clients in Need</div>
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
                        <input type="hidden" name="filter_name" value="clients_in_need">
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
                                    <?php /*<span class="badge badge-primary badge-pill">{{ $dataEntry->pets_count }}</span>*/ ?>
                                </div>
                                <div class="justify-content-between d-flex city_pet_number_cont mt-3">
                                    <small>{{ $dataEntry->city }}</small>
                                    <button id="list-button-item-{{ $dataEntry->application_id }}" type="button" class="btn-sm btn-primary">Accept Client</button>
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
                            {{-- For Milos, in next div there is class multi_form_color --}}
                            {{-- It should be placed there, only if this client has multi pets --}}

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

                                @include('auth.advocate.partials.client_list_client_details')
                                <?php  
                                /**
                                 * pets details part
                                 * start
                                 */
                                ?>


                                <?php  
                                /**
                                 * pets details part
                                 * end
                                 */
                                ?>




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