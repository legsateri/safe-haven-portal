
jQuery(document).ready(function() {

    // correction for responsive menu behavior
    $('#navbarResponsive').on('show.bs.collapse', function () {
        $('body').removeClass('sidenav-toggled');
    })

    if ( $('.org_account_cont').length != 0 ) { // if user my org page
        $('#tax_id').mask('00-0000000');
        $('#contact_phone_num').mask('000-000-0000');
        $('#zip').mask('00000');
    }

    if ( $('.user_account_cont').length != 0 ) { // if user my account page
        $('#phone').mask('000-000-0000');
        $('#zip').mask('00000');
    }

    if ( $('.sh_signup').length != 0 ) { // if sign up page

        $('input:checkbox').prop('checked', false); // browser remembers last checkbox state, clear it

        // mask for register form text input
        $('#tax_id').mask('00-0000000');
        $('#org_code').mask('00000');
        $('#org_phone_num').mask('000-000-0000');
        $('#contact_phone_num').mask('000-000-0000');

        $('.btn.signup_advocate, .btn.signup_shelter').click(function() { // sign up shelter or advocate

            var user_type_advocate = $(this).hasClass('signup_advocate');

            $('.signup_cards_row, .jumbotron_container').fadeOut("fast", function () { // animations, remove cards, show signup form
                $('.signup_form_row').css("display", "flex").hide().fadeIn("slow", function () {});

                if ( user_type_advocate ) {
                    $('.jumbotron-heading.signup_advocate').fadeIn("slow", function () {});
                    $('#sign_up_form_user_type').val('advocate');

                } else {
                    $('.jumbotron-heading.signup_shelter').fadeIn("slow", function () {});
                    $('#sign_up_form_user_type').val('shelter');
                }
            });
        });

        $("#already_with_org").change(function() { // animation hide/show inputs in form if checkbox checked

            if(this.checked) {

                $('#sign_up_org_name_half_row').fadeOut("fast", function () {
                    $('#sign_up_org_code_half_row').fadeIn("slow", function () {});
                });

                $('#sign_up_tax_id_row').fadeOut("fast", function () {
                });
                $('#org_name').val('');
                $('#org_name').removeAttr('required');
                $('#tax_id').val('');
                $('#tax_id').removeAttr('required');
                $('#org_phone_num').val('');
                $('#org_phone_num').removeAttr('required');
            } else {
                $('#sign_up_org_code_half_row').fadeOut("fast", function () {
                    $('#sign_up_org_name_half_row').fadeIn("slow", function () {

                    });
                    $('#sign_up_tax_id_row').fadeIn("slow", function () {
                    });
                    $('#org_code').val('');
                    $('#org_code').removeAttr('required');
                });
            }
        });

        $(function() {
            $("#user_pass_confirm").keyup(function() {
                var password = $("#user_pass").val();
                $("#passwordConfirmHelpBlock").html(password == $(this).val()
                    ? "Passwords match."
                    : "Passwords do not match!"
                );
            });
        });

        /*jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $( "#shn_register_form" ).validate({
            rules: {
                user_pass: "required",
                user_pass_confirm: {
                    equalTo: "#user_pass"
                }
            }
        });*/


    }

    if ( $('#accordion_client_new_application').length != 0 ) { // if client new application page

        $('.accordion_section_2 .card-header a, .accordion_section_3 .card-header a, .accordion_section_4 .card-header a').removeAttr('href', '#');

        // mask for register form text input
        /*$('#tax_id').mask('00-0000000');*/
        $('#contact_phone_num').mask('000-000-0000');
        $('#zip').mask('00000');
        /*$('#contact_phone_num').mask('000-000-0000');*/

        /*--------------- text/textarea input function for all starts --------------------*/

        /*$("input[type='text'], textarea, input[type='phone'], input[type='email']").blur(function (e) {*/
        $("input[type='text'], textarea, input[type='phone'], input[type='email']").on("blur", function() {

            var ajaxurl = '/application/new/ajax';
            var sh_input_id = $(this).attr('id');
            var sh_input_value = $(this).val();
            var token = $(this).closest('form').find('input[name="_token"]').val();

            var data = {
                action: 'validation_single',
                element_id: sh_input_id,
                input_value: sh_input_value,
                _token: token
            };

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: data,
                success: function (data, status, response) {

                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        if ( $('#' + sh_input_id).hasClass('is-invalid') ) {
                            $('#' + sh_input_id).removeClass('is-invalid').addClass('is-valid');
                        } else {
                            $('#' + sh_input_id).addClass('is-valid');
                        }
                    } else {

                        $('#' + sh_input_id).next('.invalid-feedback').html(obj.data.message);

                        if ( $('#' + sh_input_id).hasClass('is-valid') ) {
                            $('#' + sh_input_id).removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#' + sh_input_id).addClass('is-invalid');
                        }
                    }
                },
                error: function (xml, status, error) {
                },
                complete: function (xml, status) {
                }
            });
        });

        /*--------------- text/textarea input function for all starts --------------------*/

        /*--------------- select input function for all starts --------------------*/

        $("select").on('change', function () {

            var ajaxurl = '/application/new/ajax';
            var token = $(this).closest('form').find('input[name="_token"]').val();
            var sh_input_value = this.value;
            var sh_input_id = $(this).attr('id');

            var data = {
                action: 'validation_single',
                element_id: sh_input_id,
                input_value: sh_input_value,
                _token: token
            };

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: data,
                success: function (data, status, response) {
                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        if ( $('#' + sh_input_id).hasClass('is-invalid') ) {
                            $('#' + sh_input_id).removeClass('is-invalid').addClass('is-valid');
                        } else {
                            $('#' + sh_input_id).addClass('is-valid');
                        }
                    } else {

                        $('#' + sh_input_id).next('.invalid-feedback').html(obj.data.message);

                        if ( $('#' + sh_input_id).hasClass('is-valid') ) {
                            $('#' + sh_input_id).removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#' + sh_input_id).addClass('is-invalid');
                        }
                    }
                },
                error: function (xml, status, error) {
                },
                complete: function (xml, status) {
                }
            });
        })

        /*--------------- select input function for all ends --------------------*/

        /*--------------- radio input function for all starts --------------------*/

        /*$('input[type=radio]').change(function() {*/
        $('input[type=radio]').on("change", function() {

            var ajaxurl = '/application/new/ajax';

            var token = $(this).closest('form').find('input[name="_token"]').val();
            var sh_input_value = $(this).attr('id');
            var sh_input_id = $(this).attr('name'); // this is actually sh_group_input_name
            var clicked_radio = $(this);

            var data = {
                action: 'validation_single',
                element_id: sh_input_id,
                input_value: sh_input_value,
                _token: token
            };

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: data,
                success: function (data, status, response) {

                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        if ( clicked_radio.closest('.radio_custom_group').hasClass('is-invalid') ) {
                            clicked_radio.closest('.radio_custom_group').removeClass('is-invalid').addClass('is-valid');
                        } else {
                            clicked_radio.closest('.radio_custom_group').addClass('is-valid');
                        }
                    } else {

                        clicked_radio.closest('.radio_custom_group').next('.invalid-feedback').html(obj.data.message);

                        if ( clicked_radio.closest('.radio_custom_group').hasClass('is-valid') ) {
                            clicked_radio.closest('.radio_custom_group').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            clicked_radio.closest('.radio_custom_group').addClass('is-invalid');
                        }
                    }
                },
                error: function (xml, status, error) {
                },
                complete: function (xml, status) {
                }
            });
        });

        /*--------------- radio input function for all ends --------------------*/


        $('#next_step_1_2').click(function() { // step 1 to 2

            $('.spinner_form_1').css('display','inline');

            var new_client_app_form_data = $( '#new_client_app_form' ).serializeArray();
            var ajaxurl = '/application/new/ajax';

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: new_client_app_form_data,
                success: function (data, status, response) {

                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        $('.accordion_section_2 .card-header a').attr('href', '#collapseTwo');

                        setTimeout(function(){
                            $('.spinner_form_1').css('display','none');
                            $('.check_1').fadeIn("slow", function () {});
                            $('#collapseOne').collapse('hide');
                            $('#collapseTwo').collapse('show');
                        }, 2000);

                    } else {

                        jQuery.each(obj.data.message, function (index, value) {

                            value = value.replace(/\\/gi,""); // replace backslash

                            $('#' + index).next('.invalid-feedback').html(value);

                            if ( $('#' + index).hasClass('is-valid') ) {
                                $('#' + index).removeClass('is-valid').addClass('is-invalid');
                            } else {
                                $('#' + index).addClass('is-invalid');
                            }
                        });
                        $('.spinner_form_1').css('display','none');
                    }
                },
                error: function (xml, status, error) {
                },
                complete: function (xml, status) {
                }
            });
        });

        $('#next_step_2_3').click(function() { // step 2 to 3

            $('.spinner_form_2').css('display','inline');

            var new_pet_app_form_data = $( '#new_pet_app_form' ).serializeArray();
            console.log(new_pet_app_form_data);

            // multi pets per client
            var number_of_pets_applications = $('[class*="pet_application_"]').length;
            var number_of_pets = { name: "number_of_pets", value: number_of_pets_applications};

            new_pet_app_form_data.push(number_of_pets);
            console.log(new_pet_app_form_data);
            var ajaxurl = '/application/new/ajax';

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: new_pet_app_form_data,
                success: function (data, status, response) {

                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        $('.accordion_section_3 .card-header a').attr('href', '#collapseThree');
                        setTimeout(function(){
                            $('.spinner_form_2').css('display','none');
                            $('.check_2').fadeIn("slow", function () {});
                            $('#collapseTwo').collapse('hide');
                            $('#collapseThree').collapse('show');
                        }, 2000);
                    } else {

                        var element_not_valid;
                        jQuery.each(obj.data.message, function (index, value) {

                            if ( $('#' + index).length != 0  ) { // text inputs, textareas
                                element_not_valid = $('#' + index);
                            } else { // radios
                                element_not_valid = $('[name="' + index + '"]').closest('.radio_custom_group');
                            }

                            element_not_valid.next('.invalid-feedback').html(value);

                            if ( element_not_valid.hasClass('is-valid') ) {
                                element_not_valid.removeClass('is-valid').addClass('is-invalid');
                            } else {
                                element_not_valid.addClass('is-invalid');
                            }

                            /*$('#' + index).next('.invalid-feedback').html(value);

                            if ( $('#' + index).hasClass('is-valid') ) {
                                $('#' + index).removeClass('is-valid').addClass('is-invalid');
                            } else {
                                $('#' + index).addClass('is-invalid');
                            }*/

                        });
                        $('.spinner_form_2').css('display','none');
                    }
                },
                error: function (xml, status, error) {
                },
                complete: function (xml, status) {
                }
            });
        });

        $('#i_understand').click(function() { // step 3 to 4

            $('.spinner_form_3').css('display','inline');

            if ( $(this).hasClass('disabled') !== true ) {

                var clicked_button = $(this);
                var ajaxurl = '/application/new/ajax';
                var token = clicked_button.next('input[name="_token"]').val();

                var data = {
                    action: 'validation_single',
                    element_id: 'i_understand',
                    input_value: 'true',
                    _token: token
                };

                $('.spinner_form_3').css('display','none');
                $('.check_3').fadeIn("slow", function () {});
                clicked_button.addClass('disabled');
                $('#next_step_3_4').removeClass('disabled');

                /*jQuery.ajax({
                    method: "POST",
                    url: ajaxurl,
                    data: data,
                    success: function (data, status, response) {

                        console.log('are we here i understand');
                        var obj = response.responseJSON;
                        console.log('are we here1 i understand');

                        if ( typeof obj.data !== 'undefined' ) {
                            console.log('obj.message = ' + obj.data.message);
                            console.log('obj.global_answer_counts = ' + obj.data.global_answer_counts);
                            console.log('obj.current_answer_value = ' + obj.data.current_answer_value);
                        }
                        console.log('are we here2 i understand');

                        if ( obj.success == true ) {
                            console.log('super cool i understand');

                            $('.spinner_form_3').css('display','none');
                            clicked_button.addClass('disabled');
                            $('#next_step_3_4').removeClass('disabled');

                            /!*if ( $('#' + sh_input_id).hasClass('is-invalid') ) {
                                $('#' + sh_input_id).removeClass('is-invalid').addClass('is-valid');
                            } else {
                                $('#' + sh_input_id).addClass('is-valid');
                            }*!/
                        } else {
                            console.log('not cool');
                            console.log('sh_input_id = ' + sh_input_id);

                            // TODO support email change set
                            var tech_support_message = 'Please contact us at support@ztech.io';
                            $('.spinner_form_3').css('display','none');
                            alert(obj.data.message + '<br/>' + tech_support_message);

                            //$('#' + sh_input_id).next('.invalid-feedback').html(obj.data.message);

                            /!*if ( $('#' + sh_input_id).hasClass('is-valid') ) {
                                $('#' + sh_input_id).removeClass('is-valid').addClass('is-invalid');
                            } else {
                                $('#' + sh_input_id).addClass('is-invalid');
                            }*!/
                        }


                    }, // end success
                    error: function (xml, status, error) {
                        // do something if there was an error
                        //console.log('zzz6 - error');
                    },
                    complete: function (xml, status) {
                        // do something after success or error no matter what
                        // console.log('zzz6 - completed');
                    }
                }); // end ajax post*/

            }

        });

        $('#next_step_3_4').click(function() { // step 3 to 4

            if ( $(this).hasClass('disabled') !== true ) {
                $('.accordion_section_4 .card-header a').attr('href', '#collapseFour');
                $('#collapseThree').collapse('hide');
                $('#collapseFour').collapse('show');
            }
        });

        $('#add_another_pet').click(function() { // add another pet

            // calculate order number of the form to be added
            var latest_pet_cont_class = $('#pet_form_cont > div:last-child').attr('class');
            var new_pet_cont_class_id = parseInt(latest_pet_cont_class.replace("pet_application_", "")) + 1;

            // find all checked checkboxes, need to remember because it disappears on clone
            var original_form_template = $('#pet_form_cont > .pet_application_1');
            var original_checkbox_states = original_form_template.find('input[type="radio"]:checked');

            // clone original/template form and append it to form's container
            var new_form = original_form_template.clone(true, true);
            new_form.css('display','none').appendTo("#pet_form_cont");

            // set checkboxes again
            original_checkbox_states.prop('checked',true);

            // construct class of the new form with proper order number, add it to form
            var new_pet_cont_class = 'pet_application_' + new_pet_cont_class_id.toString();
            new_form.removeClass().addClass(new_pet_cont_class);

            // delete cloned content in new form, set checkboxes
            new_form.find('input[type="text"]').val('');
            new_form.find('textarea').val('');
            new_form.find('input[type="radio"]:checked').prop('checked', false);

            //prepare to generate ids, names and fors of new form inputs, with proper order number
            var elements_types = ['input[type="radio"]', 'input[type="text"]', 'textarea'];

            // iterate through each input type
            jQuery.each(elements_types, function (index_outer, element_type) {

                //get all ids and names of elements in new form
                var elements_ids = [];
                var elements_names = [];
                new_form.find(element_type).each(function(){
                    elements_ids.push($(this).attr("id"));
                    elements_names.push($(this).attr("name"));
                });

                // add new order number to all inputs ids in array
                var elements_numbered_ids = [];
                jQuery.each(elements_ids, function (index, value) {
                    elements_numbered_ids.push(elements_ids[index] + '-' + new_pet_cont_class_id);
                });

                // add new order number to all inputs names in array
                var elements_numbered_names = [];
                jQuery.each(elements_names, function (index, value) {
                    elements_numbered_names.push(elements_names[index] + '-' + new_pet_cont_class_id);
                });

                // place updated ids, names, fors back to inputs and labels
                new_form.find(element_type).each(function(index){

                    $(this).attr("id", elements_numbered_ids[index]);
                    if ( index_outer === 0 ) {
                        $(this).next('label').attr("for", elements_numbered_ids[index]);
                    } else {
                        $(this).prev('label').attr("for", elements_numbered_ids[index]);
                    }
                    $(this).attr("name", elements_numbered_names[index]);
                });
            });

            // show new form
            new_form.fadeIn("slow", function () {});

        });


        $('#client_new_application_submit').click(function() { // final submit of whole form

            var clicked_button = $(this);
            var new_client_app_form_data = $( '#new_client_app_form' ).serializeArray();
            var new_pet_app_form_data = $( '#new_pet_app_form' ).serializeArray();
            var assign_application_to_form_data = $( '#assign_application_to_form_data' ).serializeArray();
            full_form_array = new_client_app_form_data.concat(new_pet_app_form_data);
            full_form_array = full_form_array.concat(assign_application_to_form_data);

            // fix action key value
            var full_form_array_action = [];

            jQuery.each(full_form_array, function (index, value) {
                if ( full_form_array[index].name === "action" ) {
                    full_form_array[index].value = 'validation_multi_final';
                }
                full_form_array_action.push(full_form_array[index]);
            });

            var ajaxurl = '/application/new/ajax';

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: full_form_array,
                success: function (data, status, response) {
                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        setTimeout(function(){
                            $('#assign_to_me, #add_to_clients_in_need').prop('disabled', true);
                            clicked_button.addClass('disabled');
                            $('#client_new_application_start_another').fadeIn("slow", function () {});
                            $('.check_4').fadeIn("slow", function () {});
                            $('#client_new_application_submit').html('Application Submitted');
                        }, 1000);
                    } else {

                        // TODO support email change set
                        var tech_support_message = 'Please contact us at support@ztech.io';

                        alert(obj.message + '<br/>' + tech_support_message);
                    }

                },
                error: function (xml, status, error) {
                },
                complete: function (xml, status) {
                }
            });
        });
    }

    /*--------------- clients in need page starts --------------------*/

    if ( $('.clients_in_need_cont').length != 0 ) { // if clients in need page

        // forms' color fix for client with multi pets
        if ($('.scrollspy-example [id*="list-item-"] > form').length > 2) {

            $('.scrollspy-example [id*="list-item-"]').each(function(index){

                //$(this).css("background-color", '#ffffff');
                //$(this).attr("id", elements_numbered_ids[index]);
                /*if ( index_outer === 0 ) {
                    $(this).next('label').attr("for", elements_numbered_ids[index]);
                } else {
                    $(this).prev('label').attr("for", elements_numbered_ids[index]);
                }
                $(this).attr("name", elements_numbered_names[index]);*/
            });

        }

        $('.list-group-item').click(function() {
            $('#list-example').css('padding-top','4rem');
            $('[id*="list-item-"]').css('padding-top','4rem');
        });

       $('[id*="list-button-item-"]').click(function() {

            var client_id = $(this).attr('id');
            client_id = client_id.replace("list-button-item-", "");
            $('#exampleModal [type=\'hidden\']').val(client_id);
            $('#exampleModal').modal('show');
        });

        $('#confirm_accept_client').click(function() {

            $('.spinner_cont').css('display','inline');
            var modal_button_clicked = $(this);
            modal_button_clicked.addClass('disabled');

            var confirmed_accept_client_id = $('#exampleModal [type=\'hidden\']').val();
            console.log('confirmed_accept_client_id = ' + confirmed_accept_client_id);

            var ajaxurl = '/clients/accept/ajax';
            var token = $('[name="_token"]').val();

            var data = {
                action: 'accept_client_confirmed',
                client_id: confirmed_accept_client_id,
                _token: token
            };

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: data,
                success: function (data, status, response) {

                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        $('.spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});

                        $('.modal-body').html('Client has been successfully accepted.');

                        $('#list-example a[href="#list-item-' + confirmed_accept_client_id + '"]').fadeOut("fast", function () {});
                        $('.scrollspy-example #list-item-' + confirmed_accept_client_id).fadeOut("fast", function () {});
                    } else {

                        $('.spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});
                        $('.modal-body').html(obj.message);

                        $('.spinner_cont').css('display','none');
                    }
                },
                error: function (xml, status, error) {
                },
                complete: function (xml, status) {
                }
            });
        });

        $('#exampleModal').on('hidden.bs.modal', function (e) {
            $('.modal-body').html('Once a client is accepted, emails are sent to Shelters letting them know there are pets in need.' +
                '                        By clicking \'Confirm Accept Client\' below, your organization is agreeing to work with the Shelters' +
                '                        and Client to establish a temporary home for the pet or pets.');
            $('#confirm_accept_client').css('display','inline-block').removeClass('disabled');;
        })
    };

    /*--------------- clients in need page ends --------------------*/

    /*--------------- current clients page starts --------------------*/

    if ( $('.current_clients_cont').length != 0 ) { // if clients in need page

        $('.list-group-item').click(function() {
            $('#list-example').css('padding-top','4rem');
            $('[id*="list-item-"]').css('padding-top','4rem');
        });

        $('[id*="list-button-item-"]').click(function() {

            var client_id = $(this).attr('id');
            console.log(client_id);
            client_id = client_id.replace("list-button-item-", "");
            console.log(client_id);

            $('#currentClientsModal [type=\'hidden\']').val(client_id);
            $('#currentClientsModal #completed_type').prop('checked',true);

            $('#currentClientsModal').modal('show');
        });

        $('#confirm_release_client').click(function() {

            $('#currentClientsModal .spinner_cont').css('display','inline');

            var modal_button_clicked = $(this);
            modal_button_clicked.addClass('disabled');

            var confirmed_release_client_id = $('#currentClientsModal [type=\'hidden\']').val();
            var confirmed_release_reason = $('#currentClientsModal input:checked').val();

            var ajaxurl = '/client/release/ajax';
            var token = $('[name="_token"]').val();

            var data = {
                action: 'release_client_confirmed',
                client_id: confirmed_release_client_id,
                confirmed_release_reason: confirmed_release_reason,
                _token: token
            };

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: data,
                success: function (data, status, response) {

                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        $('#currentClientsModal .spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});

                        $('#currentClientsModal .modal-body .modal_body_text').html('Client has been successfully released');
                        $('#currentClientsModal .modal-body .modal_body_inputs').fadeOut("fast", function () {});

                        $('#list-example a[href="#list-item-' + confirmed_release_client_id + '"]').fadeOut("fast", function () {});
                        $('.scrollspy-example #list-item-' + confirmed_release_client_id).fadeOut("fast", function () {});

                    } else {

                        $('#currentClientsModal .spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});

                        $('#currentClientsModal .modal-body').html(obj.message);

                        $('.spinner_cont').css('display','none');
                    }
                },
                error: function (xml, status, error) {
                },
                complete: function (xml, status) {
                }
            });
        });

        $('#currentClientsModal').on('hidden.bs.modal', function (e) {
            $('#currentClientsModal .modal-body .modal_body_text').html('Please select the reason for release. A release announcement' +
                                                                'will be sent out to the appropriate Shelter and Safe Haven volunteers.');
            $('#currentClientsModal .modal-body .modal_body_inputs').css('display','block');
            $('#confirm_release_client').css('display','inline-block').removeClass('disabled');;
        });

        $('[id*="list-button-qa-item-"]').click(function() {

            //$('#currentClientsQAModal textarea').val('');

            var client_id = $(this).attr('id');
            client_id = client_id.replace("list-button-qa-item-", "");

            $('#currentClientsQAModal #client_qa_id').val(client_id);
            $('#currentClientsQAModal #currentClientsQAModalLabel span').html($(this).closest('a').find('h5').html());

            //var ajaxurl = '/client/get_thread/ajax';
            var ajaxurl = '/client/get_thread/ajax';
            var token = $('[name="_token"]').val();

            var data = {
                action: 'current_client_get_qa_thread',
                client_id: client_id,
                _token: token
            }

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: data,
                success: function (data, status, response) {
                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        $('#currentClientsQAModal .modal-body').html('');
                        console.log('super cool');
                        $('#currentClientsQAModal .modal-body').append(obj.data);

                        $('#currentClientsQAModal').modal('show');

                    } else {

                        $('#currentClientsQAModal .spinner_cont').css('display','none');
                        modal_button_clicked.removeClass('disabled');

                        $('#currentClientsQAModal .invalid-feedback').html(obj.message);
                        $('#currentClientsQAModal .invalid-feedback').fadeIn("slow", function () {});
                    }
                },
                error: function (xml, status, error) {
                },
                complete: function (xml, status) {
                }
            });
        });


        $('#currentClientsQAModal').on('click', '.client_qa_edit',function() {

           console.log('edit clicked');
            var container = $(this).closest('.card-body');
            var answer_content = container.find('.card-text').html();
            console.log('answer_content = ' + answer_content);

            container.find('.invalid-feedback').css('display','none');
            $(this).fadeOut("fast", function () {});
            container.find('.card-text').fadeOut("fast", function () {
                container.find('textarea').val(answer_content);
                container.find('.client_qa_edit_cancel').css('display','block');
                container.find('form').fadeIn("fast", function () {});
            });
        });

        $('#currentClientsQAModal').on('click', '.client_qa_edit_cancel',function() {

            var container = $(this).closest('.card-body');
            //var answer_content = container.find('.card-text').html();
            container.find('form').fadeOut("fast", function () {
                container.find('.card-text').fadeIn("fast", function () {});
                container.find('.client_qa_edit').fadeIn("fast", function () {});
            });
        });

        $('#currentClientsQAModal').on('click', '.send_client_qa_answer',function() {

            var modal_button_clicked = $(this);
            modal_button_clicked.next('.spinner_cont').css('display','inline');
            modal_button_clicked.addClass('disabled');

            var invalid_feedback_container = modal_button_clicked.closest('form').find('.invalid-feedback');
            invalid_feedback_container.fadeOut("fast", function () {});

            var client_id = $('#currentClientsQAModal #client_qa_id').val();

            var this_form = modal_button_clicked.closest('form');

            var client_current_qa_answer = this_form.find('textarea').val();

            var client_current_qa_id = this_form.find('.qa_id').val();

            var ajaxurl = '/client/send_answer/ajax';
            var token = $('[name="_token"]').val();

           // var organisation_id = $('#petsInNeedQAModal #organisation_id').val();

            var data = {
                action: 'current_client_answer_post',
                client_current_qa_id: client_current_qa_id,
                client_current_qa_answer: client_current_qa_answer,
                _token: token
            }

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: data,
                success: function (data, status, response) {

                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        console.log('super cool');

                        modal_button_clicked.next('.spinner_cont').css('display','none');
                        modal_button_clicked.removeClass('disabled');

                        var container = modal_button_clicked.closest('.card-body');
                        var answer_content = container.find('textarea').val();
                        container.find('.card-text').html(answer_content);
                        this_form.find('textarea').val('');
                        container.find('form').fadeOut("fast", function () {
                            container.find('.card-text').fadeIn("fast", function () {});
                            container.find('.client_qa_edit').fadeIn("fast", function () {});
                        });

                        //update Q&A button badge
                        if ( typeof obj.unanswered_count !== 'undefined' ) {

                            if ( parseInt(obj.unanswered_count) === 0 ){
                                $('#list-button-qa-item-' + client_id + ' .badge').fadeOut("fast", function () {});
                            } else {
                                $('#list-button-qa-item-' + client_id + ' .badge').html(obj.unanswered_count);
                            }
                        } else {
                        }

                    } else {

                        modal_button_clicked.next('.spinner_cont').css('display','none');
                        modal_button_clicked.removeClass('disabled');

                        invalid_feedback_container.html(obj.data.message);
                        invalid_feedback_container.fadeIn("slow", function () {});
                    }
                },
                error: function (xml, status, error) {
                },
                complete: function (xml, status) {
                }
            });
        });

    }

    /*--------------- current clients page ends --------------------*/

    /*--------------- pets in need page starts --------------------*/

    if ( $('.pets_in_need_cont').length != 0 ) {

        $('.list-group-item').click(function() {
            $('#list-example').css('padding-top','4rem');
            $('[id*="list-item-"]').css('padding-top','4rem');
        });

        $('[id*="list-button-item-"]').click(function() {

            var pet_id = $(this).attr('id');
            pet_id = pet_id.replace("list-button-item-", "");

            $('#petsInNeedModal [type=\'hidden\']').val(pet_id);

            $('#petsInNeedModal').modal('show');
        });

        $('#confirm_accept_pet').click(function() {

            $('.spinner_cont').css('display','inline');
            var modal_button_clicked = $(this);
            modal_button_clicked.addClass('disabled');

            var confirmed_accept_pet_id = $('#petsInNeedModal [type=\'hidden\']').val();

            var ajaxurl = '/pet/accept/ajax';
            var token = $('[name="_token"]').val();

            var data = {
                action: 'accept_pet_confirmed',
                client_id: confirmed_accept_pet_id,
                _token: token
            };

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: data,
                success: function (data, status, response) {

                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        $('.spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});

                        $('#petsInNeedModal .modal-body').html('Pet has been successfully accepted');

                        $('#list-example a[href="#list-item-' + confirmed_accept_pet_id + '"]').fadeOut("fast", function () {});
                        $('.scrollspy-example #list-item-' + confirmed_accept_pet_id).fadeOut("fast", function () {});

                    } else {

                        $('.spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});

                        $('#petsInNeedModal .modal-body').html(obj.message);

                        $('.spinner_cont').css('display','none');
                    }
                },
                error: function (xml, status, error) {
                },
                complete: function (xml, status) {
                }
            });
        });

        $('#petsInNeedModal').on('hidden.bs.modal', function (e) {
            $('#petsInNeedModal .modal-body').html('Once Pets are accepted, emails are sent to Advocates letting them know there is a Safe Haven waiting for them.' +
                                        'By clicking \'Accept Pet\' below, your organization is agreeing to work with the Advocate' +
                                        'and Client to establish a temporary home for the pet.');
            $('#confirm_accept_pet').css('display','inline-block').removeClass('disabled');;
        })

        $('[id*="list-button-qa-item-"]').click(function() {

            var pet_id = $(this).attr('id');
            pet_id = pet_id.replace("list-button-qa-item-", "");

            $('#petsInNeedQAModal #pet_qa_id').val(pet_id);
            $('#petsInNeedQAModal #petsInNeedQAModalLabel span').html($(this).closest('a').find('h5').html());

            var ajaxurl = '/pet/get_thread/ajax';
            var token = $('[name="_token"]').val();

            var data = {
                action: 'pet_in_need_get_qa_thread',
                pet_id: pet_id,
                _token: token
            }

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: data,
                success: function (data, status, response) {
                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        $('#petsInNeedQAModal .modal-body-inner-cont').html('');

                        $('#petsInNeedQAModal .modal-body-inner-cont').append(obj.data);

                        $('#petsInNeedQAModal').modal('show');

                        $('#list-button-qa-item-' + pet_id + ' .badge').fadeOut("fast", function () {});

                    } else {

                        /*$('#petsInNeedQAModal .spinner_cont').css('display','none');
                        modal_button_clicked.removeClass('disabled');

                        $('#petsInNeedQAModal .invalid-feedback').html(obj.message);
                        $('#petsInNeedQAModal .invalid-feedback').fadeIn("slow", function () {});*/
                    }
                },
                error: function (xml, status, error) {
                },
                complete: function (xml, status) {
                }
            });
        });

        $('#send_pet_qa').click(function() {

            $('#petsInNeedQAModal .spinner_cont').css('display','inline');

            var modal_button_clicked = $(this);
            modal_button_clicked.addClass('disabled');

            var pet_in_need_question = $('#petsInNeedQAModal textarea').val();

            var pet_in_need_qa_pet_id = $('#petsInNeedQAModal #pet_qa_id').val();

            var ajaxurl = '/pet/send_question/ajax';
            var token = $('[name="_token"]').val();

            var organisation_id = $('#petsInNeedQAModal #organisation_id').val();

            var data = {
                action: 'pet_in_need_question_post',
                pet_id: pet_in_need_qa_pet_id,
                organisation_id: organisation_id,
                pet_in_need_qa: pet_in_need_question,
                _token: token
            }

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: data,
                success: function (data, status, response) {

                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        $('#petsInNeedQAModal .spinner_cont').css('display','none');
                        modal_button_clicked.removeClass('disabled');
                        $('#petsInNeedQAModal textarea').val('');

                         var pet_qa_form = '<div class="qa_template_card card mb-2 d-none">\n' +
                             '                            <div class="card-body">\n' +
                             '                                <h5 class="card-title">\n' +
                             '                                </h5>\n' +
                             '                                <h6 class="card-subtitle shelter_name mb-2 text-muted d-inline-block"></h6> <span class="text-muted">-</span>\n' +
                             '                                <h6 class="card-subtitle mb-2 text-muted d-inline-block">today</h6>\n' +
                             '                                <p class="card-text">Not answered yet</p>\n' +
                             '                            </div>\n' +
                             '                        </div>';

                        $( ".pet_qa_form" ).after( pet_qa_form );
                        var pet_posted_question = $( ".pet_qa_form" ).next('.qa_template_card');

                        pet_posted_question.find('.card-title').html(pet_in_need_question);
                        pet_posted_question.find('.shelter_name').html($('.pet_qa_form').find('.shelter_name').html());
                        pet_posted_question.removeClass('d-none');

                    } else {

                        $('#petsInNeedQAModal .spinner_cont').css('display','none');
                        modal_button_clicked.removeClass('disabled');

                        $('#petsInNeedQAModal .invalid-feedback').html(obj.data.message);
                        $('#petsInNeedQAModal .invalid-feedback').fadeIn("slow", function () {});
                    }
                },
                error: function (xml, status, error) {
                },
                complete: function (xml, status) {
                }
            });
        });
    }

    /*--------------- pets in need page ends --------------------*/

    /*--------------- current pets page stars --------------------*/

    if ( $('.current_pets_cont').length != 0 ) {

        $('.list-group-item').click(function() {
            console.log('something');
            $('#list-example').css('padding-top','4rem');
            $('[id*="list-item-"]').css('padding-top','4rem');
        });

        $('[id*="list-button-item-"]').click(function() {

            var pet_id = $(this).attr('id');
            console.log(pet_id);
            pet_id = pet_id.replace("list-button-item-", "");
            console.log(pet_id);

            $('#currentPetsModal [type=\'hidden\']').val(pet_id);

            $('#currentPetsModal').modal('show');
        });

        $('#confirm_release_pet').click(function() {

            $('.spinner_cont').css('display','inline');
            var modal_button_clicked = $(this);
            modal_button_clicked.addClass('disabled');

            var confirmed_release_pet_id = $('#currentPetsModal [type=\'hidden\']').val();
            console.log('confirmed_release_pet_id = ' + confirmed_release_pet_id);

            var confirmed_release_pet_reason = $('#currentPetsModal input:checked').val();

            var ajaxurl = '/pet/release/ajax';
            var token = $('[name="_token"]').val();

            var data = {
                action: 'release_pet_confirmed',
                client_id: confirmed_release_pet_id,
                confirmed_release_pet_reason: confirmed_release_pet_reason,
                _token: token
            };

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: data,
                success: function (data, status, response) {

                    var obj = response.responseJSON;

                    if ( obj.success == true ) {

                        $('.spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});

                        $('#currentPetsModal .modal-body .modal_body_text').html('Pet has been successfully released');
                        $('#currentPetsModal .modal-body .modal_body_inputs').addClass('d-none');
                        $('#list-example a[href="#list-item-' + confirmed_release_pet_id + '"]').fadeOut("fast", function () {});
                        $('.scrollspy-example #list-item-' + confirmed_release_pet_id).fadeOut("fast", function () {});

                    } else {

                        $('.spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});

                        $('#petsInNeedModal .modal-body').html(obj.message);

                        $('.spinner_cont').css('display','none');

                    }

                },
                error: function (xml, status, error) {
                    // do something if there was an error
                },
                complete: function (xml, status) {
                    // do something after success or error no matter what
                    console.log('completed');

                }
            });

        });

        $('#currentPetsModal').on('hidden.bs.modal', function () {

            $('#currentPetsModal .modal-body .modal_body_text').html('Please select the reason for release. A release announcement ' +
                'will be sent out to the Advocate and Safe Haven volunteers.');
            $('#currentPetsModal .modal-body .modal_body_inputs').removeClass('d-none');
            $('#confirm_release_pet').css('display','inline-block').removeClass('disabled');
        })

    }

    /*--------------- current pets page ends --------------------*/

})