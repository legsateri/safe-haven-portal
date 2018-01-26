
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

                        setTimeout(function(){
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

                        setTimeout(function(){
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

            $(this).attr('disabled','disabled');
        });

        $('#next_step_3_4').click(function() { // step 3 to 4
            console.log('$(\'#i_understand\').attr(\'disabled\') = ' + $('#i_understand').attr('disabled'));
            /*if ( pet_info_form_valid() === true ) {*/
            if ( $('#i_understand').attr('disabled') === 'disabled' ) {
                console.log('if true');
                /*$('#collapseTwo').collapse({
                    toggle: true
                })*/
                $('#collapseThree').collapse('hide');
                $('#collapseFour').collapse('show');
            } else {

            }
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
    }

})