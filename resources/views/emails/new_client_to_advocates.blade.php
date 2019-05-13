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
<p>You are receiving this email because of new client application:</p>
<div>Client first name: {{$client->first_name}}</div>
<div>Client last name: {{$client->last_name}}</div>
<p>To see more details you need to login to your account.</p>
<p><a href="{{ url('login') }}">Login here</a></p>
<p><small>If you recieved this email and you are not part of Safe Haven Network, please ignore it.</small></p>
</body>
</html>