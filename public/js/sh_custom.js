
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

})