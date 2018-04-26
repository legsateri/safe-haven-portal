
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

});