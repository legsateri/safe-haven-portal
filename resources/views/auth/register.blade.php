@extends('layouts.app')

@section('content')

    <!-- Modal Terms of use -->
    <div class="modal fade" id="sh_terms_of_use" tabindex="-1" role="dialog" aria-labelledby="ModalTermsTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalTermsTitle">Terms and Conditions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>PLEASE READ THESE TERMS AND CONDITIONS CAREFULLY BEFORE USING THIS SITE</p><h3>1. Terms
                        of Use for All Information and Services on the Site</h3><p>The Safe Haven Network offers this Web site, including
                        all information, software, products and services available from this Web site or offered as part of or in
                        conjunction with this Web site (the “Web site”), to you, the "user", conditioned upon your acceptance of all of the
                        terms, conditions, policies and notices stated here. The Safe Haven Network reserves the right to make changes to
                        these Terms and Conditions immediately by posting the changed Terms and Conditions in this location.</p><p>Your
                        continued use of the Web site constitutes your agreement to all such terms, conditions and notices, and any changes
                        to the Terms and Conditions made by The Safe Haven Network.</p><p>The term ‘The Safe Haven Network’ or ‘us’ or ‘we’
                        refers to the owner or owners of safehavennetwork.org and related sites and services. The term ‘you’ refers to the
                        user or viewer of our website.</p><p>"Site" means and includes any and all websites maintained by The Safe Haven
                        Network, which includes www.thesafehavennetwork.org and secure.thesafehavennetwork.org.</p><p>The use of this
                        website is subject to the following terms of use:</p><p>Use the website at your own risk. This website is provided
                        to you “as is,” without warranty of any kind either express or implied. Neither The Safe Haven Network nor its
                        employees, agents, third-party information providers, merchants, licensors or the like warrant that the Web site or
                        its operation will be accurate, reliable, uninterrupted or error-free. No agent or representative has the authority
                        to create any warranty regarding the Web site on behalf of The Safe Haven Network. The Safe Haven Network reserves
                        the right to change or discontinue at any time any aspect or feature of the Web site.</p><h3>2. Exclusion of
                        Liability</h3><p>The content of the pages of this website is for your general information and use only. It is
                        subject to change without notice.</p><p>Neither we nor any third parties provide any warranty or guarantee as to the
                        accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on
                        this website for any particular purpose. You acknowledge that such information and materials may contain
                        inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent
                        permitted by law.</p><h3>3. Indemnification</h3><p>Your use of any information or materials on this website is
                        entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any
                        products, services or information available through this website meet your specific requirements.</p><p>This website
                        contains material which is owned by or licensed to us. This material includes, but is not limited to, the design,
                        layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright
                        notice, which forms part of these terms and conditions.</p><p>All trade marks reproduced in this website which are
                        not the property of, or licensed to, the operator are acknowledged on the website.</p><p>Unauthorized use of this
                        website may give rise to a claim for damages and/or be a criminal offense.</p><p>From time to time this website may
                        also include links to other websites. These links are provided for your convenience to provide further information.
                        They do not signify that we endorse the website(s). We have no responsibility for the content of the linked
                        website(s).</p><h3>4. Copyright</h3><p>Except for material in the public domain under United States copyright law,
                        all material contained on the Web site (including all software, HTML code, Java applets, Active X controls and other
                        code) is protected by United States and foreign copyright laws. Except as otherwise expressly provided in these
                        terms and conditions, you may not copy, distribute, transmit, display, perform, reproduce, publish, license, modify,
                        rewrite, create derivative works from, transfer, or sell any material contained on the Web site without the prior
                        consent of the copyright owner.</p><p>None of the material contained on The Safe Haven Network may be
                        reverse-engineered, disassembled, decompiled, transcribed, stored in a retrieval system, translated into any
                        language or computer language, retransmitted in any form or by any means (electronic, mechanical, photo
                        reproduction, recordation or otherwise), resold or redistributed without the prior written consent of The Safe Haven
                        Network. Violation of this provision may result in severe civil and criminal penalties.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <section class="jumbotron text-center sh_signup">
        <div class="container">
            <div class="jumbotron_container">
                <h1 class="jumbotron-heading">What type of organization are you?</h1>
                <p class="lead">
                    PLEASE NOTE: The Safe Haven Network Referral Program is based in Chicago and is currently only available to clients in Chicago
                    and the surrounding suburbs. If you require services outside the Chicago area, please
                    <a href="http://www.awionline.org/safe-havens">click here</a> to find a safe haven in your area.
                    You may subscribe to The Safe Haven Network's e-newsletter <a href="http://eepurl.com/4kdfX">here</a> to learn about
                    future expansions of The Safe Haven Network's Referral
                    Program.
                </p>
            </div>
            <h1 class="jumbotron-heading signup_advocate">Advocate sign up</h1>
            <h1 class="jumbotron-heading signup_shelter">Shelter sign up</h1>
            <div class="row signup_cards_row">
                <div class="col-xl-2 col-lg-2 col-md-1">
                </div>
                <div class="col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12">
                    <div class="card-deck">
                        <div class="card">
                            <i class="fa fa-home"></i>
                            <div class="card-body">
                                <h4 class="card-title">Shelter</h4>
                                <p class="card-text">Shelters help place pets in to great temporary foster homes!</p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-primary signup_shelter">Sign up</a>
                            </div>
                        </div>
                        <div class="card">
                            <i class="fa fa-balance-scale"></i>
                            <div class="card-body">
                                <h4 class="card-title">Advocate</h4>
                                <p class="card-text">Advocates work with clients and shelters to place pets!</p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-primary signup_advocate">Sign up</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-1">
                </div>
            </div>
            <div class="row signup_form_row">
                <div class="col-lg-2 col-md-2">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <form action="/register" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="custom-control custom-checkbox mt-4">
                                    <input type="checkbox" id="already_with_org" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Already with an organization?</span>
                                </label>
                            </div>
                            <div id="sign_up_org_name_half_row" class="form-group col-md-6">
                                <label for="org_name">Organization Name</label>
                                <input type="text" class="form-control" id="org_name" maxlength="40" name="org_name" value="">
                            </div>
                            <div id="sign_up_org_code_half_row" class="form-group col-md-6">
                                <label for="org_code">Organization Code</label>
                                <input type="text" class="form-control" id="org_code" placeholder="XXXXXX" name="organization_code" value="">
                            </div>
                        </div>
                        <div id="sign_up_tax_id_row" class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tax_id">Tax ID (EIN) - (9 digits)</label>
                                <input type="text" class="form-control" id="tax_id" maxlength="10" name="tax_id" pattern="^\d{2}-\d{7}$" value="" placeholder="XX-XXXXXXX">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="org_phone_num">Organization Phone Number - (10 digits)</label>
                                <input type="phone" class="form-control" id="org_phone_num" maxlength="10" name="org_phone_number" pattern="^\d{3}\d{3}\d{4}$" value="" placeholder="XXXXXXXXXX">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="org_last_name">First Name</label>
                                <input type="text" class="form-control" id="org_first_name" maxlength="25" required="" value="" name="first_name" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="org_last_name">Last Name</label>
                                <input type="text" class="form-control" id="org_last_name" maxlength="25" required="" value="" name="last_name" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" maxlength="45" class="form-control" id="inputEmail4" name="email" placeholder="e.g. yourname@yourmail.com" required="" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contact_phone_num">Contact Phone Number</label>
                                <input type="phone" class="form-control" id="contact_phone_num" name="contact_phone_number" maxlength="10" pattern="^\d{3}\d{3}\d{4}$" placeholder="XXXXXXXXXX" required="" value="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="user_pass">Password</label>
                                <input type="password" maxlength="15" class="form-control" id="user_pass" name="password" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user_pass_confirm">Confirm Password</label>
                                <input type="password" class="form-control" id="user_pass_confirm" name="password_confirmation" maxlength="15" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">
                                    I agree to the
                                    <a class="terms-link" data-toggle="modal" data-target="#sh_terms_of_use" href="#">Terms of Use</a>
                                </span>
                            </label>
                        </div>
                        <input id="sign_up_form_user_type" type="hidden" name="sign_up_form_user_type" value="">
                        <button type="submit" class="sh_sign_btn btn btn-primary">Sign up</button>
                    </form>
                </div>
                <div class="col-lg-2 col-md-2">
                </div>
            </div>
        </div>
    </section>
@endsection
