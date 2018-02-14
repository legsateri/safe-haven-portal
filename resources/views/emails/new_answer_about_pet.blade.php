<?php
/**
 * email template for new answer about pet
 */
?>
<html>
<head>
</head>
<body>
    <h1>Hello!</h1>
    <p>You have receiving this email because advocate has aswered on question that your organisation has posted about pet.</p>
    <p>
        <ul>
            <li>Pet's name: {{ $data->pet_name }}</li>
            <li>Your question: {{ $data->question }}</li>
            <li>Answer: {{ $data->answer }}</li>
        </ul>
    </p>
    <p>To see more details you need to login to your account.</p>
    <p><a href="{{ url('login') }}">Login here</a></p>
    <p><small>If you recieved this email and you are not part of Safe Haven Network, please ignore it.</small></p>
</body>
</html>