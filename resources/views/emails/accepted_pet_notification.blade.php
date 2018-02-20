<?php
/**
 * email template accepted pet notification
 */
?>
<html>
<head>
</head>
<body>
    <h1>Hello!</h1>
    <p>Pet that is related to your client has bee accepted by shelter</p>
    <p>
        <ul>
            <li>Client's name: {{ $data->client_first_name }} {{ $data->client_last_name }}</li>
            <li>Pet's name: {{ $data->pet_name }}</li>
            <li>Shelter name: {{ $data->shelter_name }}</li>
            <li>Shelter agent name: {{ $shelterAgent->shelter_user_first_name }} {{ $shelterAgent->shelter_user_last_name }}</li>
            <li>Email of shelter agent: {{ $shelterAgent->shelter_user_email }}</li>
        </ul>
    </p>
    <p>To see more details you need to login to your account.</p>
    <p><a href="{{ url('login') }}">Login here</a></p>
    <p><small>If you recieved this email and you are not part of Safe Haven Network, please ignore it.</small></p>
</body>
</html>