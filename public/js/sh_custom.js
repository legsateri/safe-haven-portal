
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
                    console.log('obj.message = ' + obj.data.message);
                    console.log('obj.global_answer_counts = ' + obj.data.global_answer_counts);
                    console.log('obj.current_answer_value = ' + obj.data.current_answer_value);
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
                    console.log('obj.message = ' + obj.data.message);
                    console.log('obj.global_answer_counts = ' + obj.data.global_answer_counts);
                    console.log('obj.current_answer_value = ' + obj.data.current_answer_value);
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
                    console.log('obj.message = ' + obj.data.message);
                    console.log('obj.global_answer_counts = ' + obj.data.global_answer_counts);
                    console.log('obj.current_answer_value = ' + obj.data.current_answer_value);
                    console.log('are we here2');



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
            if ( true ) {
                console.log('if true');/*
                $('#collapseTwo').collapse({
                    toggle: true
                })*/
                $('#collapseOne').collapse('hide');
                $('#collapseTwo').collapse('show');
            } else {

            }
        });

        $('#next_step_2_3').click(function() { // step 2 to 3
            console.log('accordion next clicked');
            /*if ( pet_info_form_valid() === true ) {*/
            if ( true ) {
                console.log('if true');
                /*$('#collapseTwo').collapse({
                    toggle: true
                })*/
                $('#collapseTwo').collapse('hide');
                $('#collapseThree').collapse('show');
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