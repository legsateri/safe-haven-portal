
jQuery(document).ready(function() {

    if ( $('.admin_add_user_page').length != 0 ) {
        $('#phone').mask('000-000-0000');
    }

    if ( $('.admin_edit_user_page').length != 0 ) {
        $('#phone_number').mask('000-000-0000');
        $('#zip_code').mask('00000');
    }

    if ( $('.admin_add_org_page').length != 0 ) {
        $('#tax_id').mask('00-0000000');
        $('#phone').mask('000-000-0000');
        $('#zip_code').mask('00000');
    }

    if ( $('.admin_edit_org_general_page').length != 0 ) {
        $('#tax_id').mask('00-0000000');
    }

    if ( $('.admin_edit_org_contact_page').length != 0 ) {
        $('#phone').mask('000-000-0000');
        $('#zip_code').mask('00000');
    }
    
    if ( $('.edit_admin_user_cont').length != 0 ) {

        $(function() {
            $("#repeat_password").keyup(function() {
                var password = $("#new_password").val();
                $("#passwordConfirmHelpBlock").html(password == $(this).val()
                    ? "Passwords match."
                    : "Passwords do not match!"
                );
            });
        });
    }

    $(function() {
        $("#repeat_password").keyup(function() {
            var password = $("#password").val();
            $("#passwordConfirmHelpBlock").html(password == $(this).val()
                ? "Passwords match."
                : "Passwords do not match!"
            );
        });
    });

    //admin change password
    $(function() {
        $("#repeat_new_admin_pass").keyup(function() {
            var password = $("#new_admin_pass").val();
            $("#passwordConfirmHelpBlock").html(password == $(this).val()
                ? "Passwords match."
                : "Passwords do not match!"
            );
        });
    });

    $(function(){
        $("#admin_change_pass").click(function validateAdminChangePassword() {
            if ($("#new_admin_pass").val() != $("#repeat_new_admin_pass").val()) {
                $("#repeat_new_admin_pass").get(0).setCustomValidity('Passwords do not match!');
            } else {
                $("#repeat_new_admin_pass").get(0).setCustomValidity('');
            }
        });
    });

    // admin change user password
    $(function() {
        $("#repeat_new_password").keyup(function() {
            var password = $("#new_password").val();
            $("#passwordConfirmHelpBlock").html(password == $(this).val()
                ? "Passwords match."
                : "Passwords do not match!"
            );
        });
    });

    $(function(){
        $("#admin_change_user_password").click(function validateAdminChangeUserPassword() {
            if ($("#new_password").val() != $("#repeat_new_password").val()) {
                $("#repeat_new_password").get(0).setCustomValidity('Passwords do not match!');
            } else {
                $("#repeat_new_password").get(0).setCustomValidity('');
            }
        });
    });

    // admin add user
    $(function() {
        $("#repeat-password").keyup(function() {
            var password = $("#user_password").val();
            $("#passwordConfirmHelpBlock").html(user_password == $(this).val()
                ? "Passwords match."
                : "Passwords do not match!"
            );
        });
    });

    $(function(){
        $("#add_user").click(function validateAddUser() {
            if ($("#user_password").val() != $("#repeat-password").val()) {
                $("#repeat-password").get(0).setCustomValidity('Passwords do not match!');
            } else {
                $("#repeat-password").get(0).setCustomValidity('');
            }
        });
    });

    // alert fade out
    $(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    });

    $(function() {
        window.setTimeout(function() {
            $(".text-danger").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    });

    $('#admin_update_user_contact_info').click(function() {

        $( "#contact .text-danger-custom" ).fadeOut("fast", function () {});

        var serialized_form = $("#admin_edit_user_contact_info_form").serialize();

        if(serialized_form.indexOf('=&') > -1 || serialized_form.substr(serialized_form.length - 1) == '='){
            $( "#contact .text-danger-custom" ).fadeIn("slow", function () {});;
        } else {
            $( "#admin_edit_user_contact_info_form" ).submit();
        }
    });
});