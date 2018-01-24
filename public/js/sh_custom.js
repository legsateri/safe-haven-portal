
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

                    var obj = response.responseJSON;

                    /*if ( obj.success == true ) {

                        // success, form valid, email sent to admin
                        if (obj.data.message === 'true' || obj.data.message === 'false') {

                            $('.single-print-share .section_order_form form').fadeOut("fast", function () {

                                $('.section_order_form_thank_you').fadeOut("fast", function () {});
                                $('.section_order_form_not_sent').fadeOut("fast", function () {});
                                $('.section_order_form_title').fadeOut("fast", function () {});

                                $('.section_order_form_thank_you').fadeIn("slow", function () {});
                            });

                        } else { // form not valid

                            $('.section_order_form_thank_you').fadeOut("fast", function () {});
                            $('.section_order_form_not_sent').fadeOut("fast", function () {});

                            $('.section_order_form_not_sent span').html(obj.data.message);
                            $('.section_order_form_not_sent').fadeIn("slow", function () {});

                        }

                    } else if ( obj.success == false ) { // form valid, email not sent, show error message to user

                        $('.section_order_form_thank_you').fadeOut("fast", function () {});
                        $('.section_order_form_not_sent').fadeOut("fast", function () {});

                        $('.section_order_form_not_sent span').html(obj.data.message);
                        $('.section_order_form_not_sent').fadeIn("slow", function () {});
                    }*/

                },
                error: function (xml, status, error) {
                    // do something if there was an error
                },
                complete: function (xml, status) {
                    // do something after success or error no matter what
                    /*$('.bg_for_spinner').fadeOut("fast", function () {});
                    $('.order_print_share_form_spinner').fadeOut("fast", function () {});*/
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