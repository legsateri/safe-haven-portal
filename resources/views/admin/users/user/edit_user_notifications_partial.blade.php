
<!--general success message -->
@if (session('success-general'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success-general') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!--contact success message -->
@if (session('success-contact'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success-contact') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!--password success message -->
@if (session('success-password'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success-password') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- verify 1 success message -->
@if (session('success-verify1'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success-verify1') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- verify 0 success message -->
@if (session('success-verify0'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('success-verify0') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- ban 1 success message -->
@if (session('success-ban1'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('success-ban1') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- ban 0 success message -->
@if (session('success-ban0'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success-ban0') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- verify admin password error message -->
@if ($errors->has('admin_password_verify'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first('admin_password_verify') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- verify admin password error message -->
@if (session('error-admin-password-verify'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error-admin-password-verify') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- ban admin password error message -->
@if ($errors->has('admin_password_ban'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first('admin_password_ban') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- ban admin password error message -->
@if (session('error-admin-password-ban'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error-admin-password-ban') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
