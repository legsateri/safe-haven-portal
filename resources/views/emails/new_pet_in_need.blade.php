<?php
/**
 * email template for new pet in need
 */
?>
<html>
<head>
</head>
<body>
    <h1>Hello!</h1>
    <p>You have receiving this email because {{ $data['application']->adv_organisation_name }} has acquired client with pet that needs temporary home.</p>
    <p>
        @foreach( $data['pets'] as $pet )
            <ul>
                <li>Pet's name: {{ $pet->name }}</li>
                <li>Pet's breed: {{ $pet->type }} - {{ $pet->breed }}</li>
                <li>Pet's age: {{ $pet->age }}</li>
            </ul>
        @endforeach
    </p>
    <p>To see more details or to contact advocate office you need to login to your account.</p>
    <p><a href="{{ url('login') }}">Login here</a></p>
    <p><small>If you recieved this email and you are not part of Safe Haven Network, please ignore it.</small></p>
</body>
</html>