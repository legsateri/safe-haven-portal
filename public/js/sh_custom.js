
jQuery(document).ready(function() {

    if ( $('.sh_signup').length != 0 ) { // if sign up page

        $('input:checkbox').prop('checked', false); // browser remembers last checkbox state, clear it

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
            } else {
                $('#sign_up_org_code_half_row').fadeOut("fast", function () {
                    $('#sign_up_org_name_half_row').fadeIn("slow", function () {

                    });
                    $('#sign_up_tax_id_row').fadeIn("slow", function () {
                    });
                });
            }
        });

    }

    if ( $('#accordion_client_new_application').length != 0 ) { // if client new application page
        console.log('in accordion');

        $('.accordion_section_2 .card-header a, .accordion_section_3 .card-header a, .accordion_section_4 .card-header a').removeAttr('href', '#');

        /*--------------- text/textarea input function for all starts --------------------*/

        $("input[type='text'], textarea, input[type='phone'], input[type='email']").blur(function (e) {
            //alert('blur');

            var ajaxurl = '/application/new/ajax';
            var sh_input_id = $(this).attr('id');
            var sh_input_value = $(this).val();
            var token = $(this).closest('form').find('input[name="_token"]').val();
            console.log('token = ' + token);

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

                    //jQuery(".survey-element-" + element_id + " input").siblings("img").css('display', 'none');

                    console.log('are we here');
                    var obj = response.responseJSON;
                    console.log('are we here1');
                    if ( typeof obj.data !== 'undefined' ) {
                        console.log('obj.message = ' + obj.data.message);
                        console.log('obj.global_answer_counts = ' + obj.data.global_answer_counts);
                        console.log('obj.current_answer_value = ' + obj.data.current_answer_value);
                    }
                    console.log('are we here2');

                    if ( obj.success == true ) {
                        console.log('super cool');

                        if ( $('#' + sh_input_id).hasClass('is-invalid') ) {
                            $('#' + sh_input_id).removeClass('is-invalid').addClass('is-valid');
                        } else {
                            $('#' + sh_input_id).addClass('is-valid');
                        }
                    } else {
                        console.log('not cool');
                        console.log('sh_input_id = ' + sh_input_id);

                        $('#' + sh_input_id).next('.invalid-feedback').html(obj.data.message);

                        //$('#' + sh_input_id).addClass('is-invalid');
                        if ( $('#' + sh_input_id).hasClass('is-valid') ) {
                            $('#' + sh_input_id).removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#' + sh_input_id).addClass('is-invalid');
                        }
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
            }); // end ajax post

        });

        /*--------------- text/textarea input function for all starts --------------------*/

        /*--------------- select input function for all starts --------------------*/

        $("select").on('change', function () {

            var ajaxurl = '/application/new/ajax';

            var token = $(this).closest('form').find('input[name="_token"]').val();
            var sh_input_value = this.value;
            console.log('sh_input_value = ' + sh_input_value);
            var sh_input_id = $(this).attr('id');
            console.log('sh_input_id = ' + sh_input_id);

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

                    console.log('are we here');
                    var obj = response.responseJSON;
                    console.log('are we here1');

                    if ( typeof obj.data !== 'undefined' ) {
                        console.log('obj.message = ' + obj.data.message);
                        console.log('obj.global_answer_counts = ' + obj.data.global_answer_counts);
                        console.log('obj.current_answer_value = ' + obj.data.current_answer_value);
                    }
                    console.log('are we here2');

                    if ( obj.success == true ) {
                        console.log('super cool');

                        if ( $('#' + sh_input_id).hasClass('is-invalid') ) {
                            $('#' + sh_input_id).removeClass('is-invalid').addClass('is-valid');
                        } else {
                            $('#' + sh_input_id).addClass('is-valid');
                        }
                    } else {
                        console.log('not cool');
                        console.log('sh_input_id = ' + sh_input_id);

                        $('#' + sh_input_id).next('.invalid-feedback').html(obj.data.message);

                        if ( $('#' + sh_input_id).hasClass('is-valid') ) {
                            $('#' + sh_input_id).removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#' + sh_input_id).addClass('is-invalid');
                        }
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
            }); // end ajax post

        })

        /*--------------- select input function for all ends --------------------*/

        /*--------------- radio input function for all starts --------------------*/

        $('input[type=radio]').change(function() {

            var ajaxurl = '/application/new/ajax';

            var token = $(this).closest('form').find('input[name="_token"]').val();
            var sh_input_value = $(this).attr('id');
            console.log('sh_input_value = ' + sh_input_value);
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

                    console.log('are we here');
                    var obj = response.responseJSON;
                    console.log('are we here1');
                    if ( typeof obj.data !== 'undefined' ) {
                        console.log('obj.message = ' + obj.data.message);
                        console.log('obj.global_answer_counts = ' + obj.data.global_answer_counts);
                        console.log('obj.current_answer_value = ' + obj.data.current_answer_value);
                    }
                    console.log('are we here2');

                    if ( obj.success == true ) {
                        console.log('super cool');

                        if ( clicked_radio.closest('.radio_custom_group').hasClass('is-invalid') ) {
                            clicked_radio.closest('.radio_custom_group').removeClass('is-invalid').addClass('is-valid');
                        } else {
                            clicked_radio.closest('.radio_custom_group').addClass('is-valid');
                        }
                    } else {
                        console.log('not cool');
                        console.log('sh_input_id = ' + sh_input_id);

                        clicked_radio.closest('.radio_custom_group').next('.invalid-feedback').html(obj.data.message);

                        if ( clicked_radio.closest('.radio_custom_group').hasClass('is-valid') ) {
                            clicked_radio.closest('.radio_custom_group').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            console.log('in 4. branch');
                            console.log('$(this) = ' + clicked_radio);
                            /*clicked_radio.css('border','1px solid red');
                            clicked_radio.closest('.radio_custom_group').css('border','1px solid red');*/
                            clicked_radio.closest('.radio_custom_group').addClass('is-invalid');
                        }
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
            }); // end ajax post

            /*if (this.value == 'allot') {
                alert("Allot Thai Gayo Bhai");
            }
            else if (this.value == 'transfer') {
                alert("Transfer Thai Gayo");
            }*/
        });

        /*--------------- radio input function for all ends --------------------*/


        $('#next_step_1_2').click(function() { // step 1 to 2
            console.log('accordion next clicked');

            $('.spinner_form_1').css('display','inline');

            var new_client_app_form_data = $( '#new_client_app_form' ).serializeArray();
            //console.log('new_client_app_form_data = ' + new_client_app_form_data);
            console.log("object: %o", new_client_app_form_data)
            var ajaxurl = '/application/new/ajax';

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: new_client_app_form_data,
                success: function (data, status, response) {
                    console.log('are we here');
                    var obj = response.responseJSON;
                    console.log('are we here1');
                    if ( typeof obj.data !== 'undefined' ) {
                        console.log('obj.message = ' + obj.data.message);
                        console.log('obj.global_answer_counts = ' + obj.data.global_answer_counts);
                        console.log('obj.current_answer_value = ' + obj.data.current_answer_value);
                    }
                    console.log('are we here2');


                    /*if ( obj.success == true ) {
                        console.log('if true');
                        $('#collapseOne').collapse('hide');
                        $('#collapseTwo').collapse('show');
                    } else {

                        jQuery.each(obj.data.message, function (index, value) {
                            //jQuery('.survey-element-' + value).delay((index + 1) * 200).fadeIn("slow", function () {});
                            console.log('value = ' + value);
                            console.log('index = ' + index);

                            $('#' + index).
                        });
                    }*/

                    if ( obj.success == true ) {
                        console.log('super cool');

                        /*if ( $('#' + sh_input_id).hasClass('is-invalid') ) {
                            $('#' + sh_input_id).removeClass('is-invalid').addClass('is-valid');
                        } else {
                            $('#' + sh_input_id).addClass('is-valid');
                        }*/
                        $('.accordion_section_2 .card-header a').attr('href', '#collapseTwo');
                        setTimeout(function(){
                            $('.spinner_form_1').css('display','none');
                            $('.check_1').fadeIn("slow", function () {});
                            $('#collapseOne').collapse('hide');
                            $('#collapseTwo').collapse('show');
                        }, 2000);


                    } else {
                        console.log('not cool');
                        //console.log('sh_input_id = ' + sh_input_id);

                        jQuery.each(obj.data.message, function (index, value) {
                            //jQuery('.survey-element-' + value).delay((index + 1) * 200).fadeIn("slow", function () {});
                            console.log('value = ' + value);
                            console.log('index = ' + index);

                            $('#' + index).next('.invalid-feedback').html(value);

                            if ( $('#' + index).hasClass('is-valid') ) {
                                $('#' + index).removeClass('is-valid').addClass('is-invalid');
                            } else {
                                $('#' + index).addClass('is-invalid');
                            }

                        });
                        $('.spinner_form_1').css('display','none');
                        //$('#' + sh_input_id).next('.invalid-feedback').html(obj.data.message);

                        //$('#' + sh_input_id).addClass('is-invalid');
                        /*if ( $('#' + sh_input_id).hasClass('is-valid') ) {
                            $('#' + sh_input_id).removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#' + sh_input_id).addClass('is-invalid');
                        }*/
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

            /*if ( client_info_form_valid() === true ) {*/
            /*if ( true ) {
                console.log('if true');/!*
                $('#collapseTwo').collapse({
                    toggle: true
                })*!/
                $('#collapseOne').collapse('hide');
                $('#collapseTwo').collapse('show');
            } else {

            }*/
        });

        $('#next_step_2_3').click(function() { // step 2 to 3

            $('.spinner_form_2').css('display','inline');

            console.log("next_step_2_3");
            var new_pet_app_form_data = $( '#new_pet_app_form' ).serializeArray();
            //console.log('new_client_app_form_data = ' + new_client_app_form_data);
            console.log("object: %o", new_pet_app_form_data)
            var ajaxurl = '/application/new/ajax';

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: new_pet_app_form_data,
                success: function (data, status, response) {
                    console.log('are we here');
                    var obj = response.responseJSON;
                    console.log('are we here1');
                    if ( typeof obj.data !== 'undefined' ) {
                        console.log('obj.message = ' + obj.data.message);
                        console.log('obj.global_answer_counts = ' + obj.data.global_answer_counts);
                        console.log('obj.current_answer_value = ' + obj.data.current_answer_value);
                    }
                    console.log('are we here2');


                    if ( obj.success == true ) {
                        console.log('super cool');

                        $('.accordion_section_3 .card-header a').attr('href', '#collapseThree');

                        setTimeout(function(){
                            $('.spinner_form_2').css('display','none');
                            $('.check_2').fadeIn("slow", function () {});
                            $('#collapseTwo').collapse('hide');
                            $('#collapseThree').collapse('show');
                        }, 2000);


                    } else {
                        console.log('not cool');
                        //console.log('sh_input_id = ' + sh_input_id);

                        jQuery.each(obj.data.message, function (index, value) {
                            //jQuery('.survey-element-' + value).delay((index + 1) * 200).fadeIn("slow", function () {});
                            console.log('value = ' + value);
                            console.log('index = ' + index);

                            $('#' + index).next('.invalid-feedback').html(value);

                            if ( $('#' + index).hasClass('is-valid') ) {
                                $('#' + index).removeClass('is-valid').addClass('is-invalid');
                            } else {
                                $('#' + index).addClass('is-invalid');
                            }

                        });
                        $('.spinner_form_2').css('display','none');
                        //$('#' + sh_input_id).next('.invalid-feedback').html(obj.data.message);

                        //$('#' + sh_input_id).addClass('is-invalid');
                        /*if ( $('#' + sh_input_id).hasClass('is-valid') ) {
                            $('#' + sh_input_id).removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#' + sh_input_id).addClass('is-invalid');
                        }*/
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

            console.log('accordion next clicked');
            /*if ( pet_info_form_valid() === true ) {*/
            if ( true ) {
                console.log('if true');
                /*$('#collapseTwo').collapse({
                    toggle: true
                })*/
                /*$('#collapseTwo').collapse('hide');
                $('#collapseThree').collapse('show');*/
            } else {

            }
        });

        $('#i_understand').click(function() { // step 3 to 4

            $('.spinner_form_3').css('display','inline');
            //$(this).attr('disabled','disabled');

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
            console.log('$(\'#i_understand\').attr(\'disabled\') = ' + $('#i_understand').attr('disabled'));

            if ( $(this).hasClass('disabled') !== true ) {
                $('.accordion_section_4 .card-header a').attr('href', '#collapseFour');
                $('#collapseThree').collapse('hide');
                $('#collapseFour').collapse('show');

            }

            /*if ( pet_info_form_valid() === true ) {*/
            //if ( $('#i_understand').attr('disabled') === 'disabled' ) {
                console.log('if true');
                /*$('#collapseTwo').collapse({
                    toggle: true
                })*/

            /*} else {

            }*/
        });

        $('#add_another_pet').click(function() { // add another pet
            /*$(this).css('border','1px solid red');
            $(this).closest('.form-row').css('border','1px solid red');
            $(this).closest('.form-row').prev().css('border','1px solid red');*/
            var latest_pet_id = $(this).closest('.form-row').prev().find('#pet_application_1').last().attr('id');
            console.log('latest_pet_id = ' + latest_pet_id);

            /*$(this).css('border','1px solid red');
            $(this).closest('.form-row').css('border','1px solid red');
            $(this).closest('.form-row').prev().css('border','1px solid red');
            $(this).closest('.form-row').prev().find('#pet_application_1').css('border','1px solid red');*/
            $(this).closest('.form-row').prev().find('#pet_application_1').clone().appendTo("#pet_form_cont");

        });


        $('#client_new_application_submit').click(function() { // final submit of whole form

            var clicked_button = $(this);

            //var new_client_app_form_data = $( '#new_client_app_form' ).find('input[name!=_token]').serializeArray();
            var new_client_app_form_data = $( '#new_client_app_form' ).serializeArray();
            //var new_pet_app_form_data = $( '#new_pet_app_form' ).find('input[name!=_token]').serializeArray();
            var new_pet_app_form_data = $( '#new_pet_app_form' ).serializeArray();

            full_form_array = new_client_app_form_data.concat(new_pet_app_form_data);

           // console.log(full_form_array);

            // fix action key value
            var full_form_array_action = [];

            jQuery.each(full_form_array, function (index, value) {
                if ( full_form_array[index].name === "action" ) {
                    full_form_array[index].value = 'validation_multi_final';
                }
                full_form_array_action.push(full_form_array[index]);
            });

            //console.log(full_form_array_action);

            var ajaxurl = '/application/new/ajax';

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: full_form_array,
                success: function (data, status, response) {
                    console.log('are we here final');
                    var obj = response.responseJSON;
                    console.log('are we here1 final');
                    if ( typeof obj.data !== 'undefined' ) {
                        console.log('obj.message = ' + obj.data.message);
                        console.log('obj.global_answer_counts = ' + obj.data.global_answer_counts);
                        console.log('obj.current_answer_value = ' + obj.data.current_answer_value);
                    }
                    console.log('are we here2 final');


                    if ( obj.success == true ) {
                        console.log('super cool');

                        setTimeout(function(){
                            /*$('#collapseTwo').collapse('hide');
                            $('#collapseThree').collapse('show');*/

                            clicked_button.addClass('disabled');
                            $('#client_new_application_start_another').fadeIn("slow", function () {});

                            $('.check_4').fadeIn("slow", function () {});
                            $('#client_new_application_submit').html('Application Submitted');
                            //alert('Final Submit successful');


                        }, 1000);


                    } else {
                        console.log('not cool');


                        // TODO support email change set
                        var tech_support_message = 'Please contact us at support@ztech.io';

                        alert(obj.data.message + '<br/>' + tech_support_message);
                        //console.log('sh_input_id = ' + sh_input_id);

                        //to be used
                        /*jQuery.each(obj.data.message, function (index, value) {
                            //jQuery('.survey-element-' + value).delay((index + 1) * 200).fadeIn("slow", function () {});
                            console.log('value = ' + value);
                            console.log('index = ' + index);

                            $('#' + index).next('.invalid-feedback').html(value);

                            if ( $('#' + index).hasClass('is-valid') ) {
                                $('#' + index).removeClass('is-valid').addClass('is-invalid');
                            } else {
                                $('#' + index).addClass('is-invalid');
                            }

                        });*/

                        //$('#' + sh_input_id).next('.invalid-feedback').html(obj.data.message);

                        //$('#' + sh_input_id).addClass('is-invalid');
                        /*if ( $('#' + sh_input_id).hasClass('is-valid') ) {
                            $('#' + sh_input_id).removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#' + sh_input_id).addClass('is-invalid');
                        }*/
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
    }

    if ( $('.clients_in_need_cont').length != 0 ) { // if clients in need page
        /*$('.scrollspy-example').scrollspy({ target: '#list-example' })
        $('.scrollspy-example').scrollspy({ offset: 150 });*/

        $('.list-group-item').click(function() {
            console.log('something');
            $('#list-example').css('padding-top','4rem');
            $('[id*="list-item-"]').css('padding-top','4rem');
        });

       $('[id*="list-button-item-"]').click(function() {

            var client_id = $(this).attr('id');
            console.log(client_id);
            client_id = client_id.replace("list-button-item-", "");
            console.log(client_id);

            $('#exampleModal [type=\'hidden\']').val(client_id);

            $('#exampleModal').modal('show');
        });

        $('#confirm_accept_client').click(function() {

            $('.spinner_cont').css('display','inline');
            var modal_button_clicked = $(this);
            modal_button_clicked.addClass('disabled');

            var confirmed_accept_client_id = $('#exampleModal [type=\'hidden\']').val();
            console.log('confirmed_accept_client_id = ' + confirmed_accept_client_id);

            var ajaxurl = '/application/new/ajax';
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
                    console.log('are we here accept_client_confirmed');
                    var obj = response.responseJSON;
                    console.log('are we here accept_client_confirmed 1');
                    if ( typeof obj.data !== 'undefined' ) {
                        console.log('obj.message = ' + obj.data.message);
                        console.log('obj.global_answer_counts = ' + obj.data.global_answer_counts);
                        console.log('obj.current_answer_value = ' + obj.data.current_answer_value);
                    }
                    console.log('are we here2');


                    if ( obj.success == true ) {
                        console.log('super cool');

                        //setTimeout(function(){
                        $('.spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});

                        $('.modal-body').html('Client has been successfully released');

                        console.log('client with id ' + confirmed_accept_client_id + ' to remove;');

                        $('#list-example a[href="#list-item-' + confirmed_accept_client_id + '"]').fadeOut("fast", function () {});
                        $('.scrollspy-example #list-item-' + confirmed_accept_client_id).fadeOut("fast", function () {});

                        //}, 2000);


                    } else {
                        console.log('not cool');

                        $('.spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});

                        $('.modal-body').html(obj.data.message);

                        //console.log('sh_input_id = ' + sh_input_id);

                        /*jQuery.each(obj.data.message, function (index, value) {
                            //jQuery('.survey-element-' + value).delay((index + 1) * 200).fadeIn("slow", function () {});
                            console.log('value = ' + value);
                            console.log('index = ' + index);

                            $('#' + index).next('.invalid-feedback').html(value);

                            if ( $('#' + index).hasClass('is-valid') ) {
                                $('#' + index).removeClass('is-valid').addClass('is-invalid');
                            } else {
                                $('#' + index).addClass('is-invalid');
                            }

                        });*/
                        $('.spinner_cont').css('display','none');
                        //$('#' + sh_input_id).next('.invalid-feedback').html(obj.data.message);

                        //$('#' + sh_input_id).addClass('is-invalid');
                        /*if ( $('#' + sh_input_id).hasClass('is-valid') ) {
                            $('#' + sh_input_id).removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#' + sh_input_id).addClass('is-invalid');
                        }*/
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

            //$('#exampleModal').modal('show');
        });

        $('#exampleModal').on('hidden.bs.modal', function (e) {
            $('.modal-body').html('Once a client is accepted, emails are sent to Shelters letting them know there are pets in need.' +
                '                        By clicking \'Confirm Accept Client\' below, your organization is agreeing to work with the Shelters' +
                '                        and Client to establish a temporary home for the pet or pets.');
            $('#confirm_accept_client').css('display','inline-block').removeClass('disabled');;
        })

    };

    if ( $('.current_clients_cont').length != 0 ) { // if clients in need page

        $('.list-group-item').click(function() {
            console.log('something');
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
            console.log('confirmed_release_client_id = ' + confirmed_release_client_id);

            var ajaxurl = '/application/new/ajax';
            var token = $('[name="_token"]').val();

            var data = {
                action: 'release_client_confirmed',
                client_id: confirmed_release_client_id,
                _token: token
            };

            jQuery.ajax({
                method: "POST",
                url: ajaxurl,
                data: data,
                success: function (data, status, response) {
                    console.log('are we here release_client_confirmed');
                    var obj = response.responseJSON;
                    console.log('are we here release_client_confirmed 1');
                    if ( typeof obj.data !== 'undefined' ) {
                        console.log('obj.message = ' + obj.data.message);
                        console.log('obj.global_answer_counts = ' + obj.data.global_answer_counts);
                        console.log('obj.current_answer_value = ' + obj.data.current_answer_value);
                    }
                    console.log('are we here2');

                    if ( obj.success == true ) {
                        console.log('super cool');

                        $('#currentClientsModal .spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});

                        $('#currentClientsModal .modal-body .modal_body_text').html('Client has been successfully released');
                        $('#currentClientsModal .modal-body .modal_body_inputs').fadeOut("fast", function () {});

                        console.log('client with id ' + confirmed_release_client_id + ' to remove;');

                        $('#list-example a[href="#list-item-' + confirmed_release_client_id + '"]').fadeOut("fast", function () {});
                        $('.scrollspy-example #list-item-' + confirmed_release_client_id).fadeOut("fast", function () {});

                    } else {
                        console.log('not cool');

                        $('#currentClientsModal .spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});

                        $('#currentClientsModal .modal-body').html(obj.data.message);

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

        $('#exampleModal').on('hidden.bs.modal', function (e) {
            $('#exampleModal .modal-body').html('Once a client is accepted, emails are sent to Shelters letting them know there are pets in need.' +
                '                        By clicking \'Confirm Accept Client\' below, your organization is agreeing to work with the Shelters' +
                '                        and Client to establish a temporary home for the pet or pets.');
            $('#confirm_release_client').css('display','inline-block').removeClass('disabled');;
        })

        $('#currentClientsModal').on('hidden.bs.modal', function (e) {
            $('#currentClientsModal .modal-body .modal_body_text').html('Please select the reason for release. A release announcement' +
                                                                'will be sent out to the appropriate Shelter and Safe Haven volunteers.');
            $('#currentClientsModal .modal-body .modal_body_inputs').css('display','block');
            $('#confirm_release_client').css('display','inline-block').removeClass('disabled');;
        })

    }

    if ( $('.pets_in_need_cont').length != 0 ) {

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

            $('#petsInNeedModal [type=\'hidden\']').val(pet_id);

            $('#petsInNeedModal').modal('show');
        });

        $('#confirm_accept_pet').click(function() {

            $('.spinner_cont').css('display','inline');
            var modal_button_clicked = $(this);
            modal_button_clicked.addClass('disabled');

            var confirmed_accept_pet_id = $('#petsInNeedModal [type=\'hidden\']').val();
            console.log('confirmed_accept_pet_id = ' + confirmed_accept_pet_id);

            var ajaxurl = '/application/new/ajax';
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
                    console.log('are we here accept_pet_confirmed');
                    var obj = response.responseJSON;
                    console.log('are we here accept_pet_confirmed 1');
                    if ( typeof obj.data !== 'undefined' ) {
                        console.log('obj.message = ' + obj.data.message);
                        console.log('obj.global_answer_counts = ' + obj.data.global_answer_counts);
                        console.log('obj.current_answer_value = ' + obj.data.current_answer_value);
                    }
                    console.log('are we here2');


                    if ( obj.success == true ) {
                        console.log('super cool');


                        $('.spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});

                        $('#petsInNeedModal .modal-body').html('Pet has been successfully accepted');

                        console.log('client with id ' + confirmed_accept_pet_id + ' to remove;');

                        $('#list-example a[href="#list-item-' + confirmed_accept_pet_id + '"]').fadeOut("fast", function () {});
                        $('.scrollspy-example #list-item-' + confirmed_accept_pet_id).fadeOut("fast", function () {});



                    } else {
                        console.log('not cool');

                        $('.spinner_cont').css('display','none');
                        modal_button_clicked.fadeOut("fast", function () {});

                        $('#petsInNeedModal .modal-body').html(obj.data.message);

                        //console.log('sh_input_id = ' + sh_input_id);

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

        $('#petsInNeedModal').on('hidden.bs.modal', function (e) {
            $('#petsInNeedModal .modal-body').html('Once Pets are accepted, emails are sent to Advocates letting them know there is a Safe Haven waiting for them.' +
                                        'By clicking \'Accept Pet\' below, your organization is agreeing to work with the Advocate' +
                                        'and Client to establish a temporary home for the pet.');
            $('#confirm_accept_pet').css('display','inline-block').removeClass('disabled');;
        })

        $('[id*="list-button-qa-item-"]').click(function() {

            var pet_id = $(this).attr('id');
            console.log(pet_id);
            pet_id = pet_id.replace("list-button-qa-item-", "");
            console.log(pet_id);

            $('#petsInNeedQAModal [type=\'hidden\']').val(pet_id);
            $('#petsInNeedQAModal #petsInNeedQAModalLabel span').html($(this).closest('a').find('h5').html());


            $('#petsInNeedQAModal').modal('show');
        });

    }

})