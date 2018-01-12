
@extends('Layout.mainlayout')

@section('content')
    <section class="jumbotron text-center homepage">
        <div class="container">
            <h1 class="jumbotron-heading">Welcome to the Secure Portal!</h1>
            <p class="lead">
                The Safe Haven Network provides dedicated housing options for domestic violence victims and their pets by placing the pets in shelters and foster homes while the victims stay in domestic violence shelters.
            </p>
            <p>
                <a href="/register" class="btn btn-primary">New here?  Sign up!</a>
                <a href="/login" class="btn btn-secondary">Log in here!</a>
            </p>
        </div>
    </section>
@endsection