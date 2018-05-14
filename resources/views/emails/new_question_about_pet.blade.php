<?php
/**
 * email template for new question about pet
 */
?>
<html>
<head>
</head>
<body>
    <h1>Hello!</h1>
    <p>You have receiving this email because shelter has posted question about pet that belongs to client of your organization.</p>
    <p>
        <ul>
            <li>Client's name: {{ $data['application']->client_first_name }} {{ $data['application']->client_last_name }}</li>
            <li>
            @if ( count($data['pets']) == 1 )
                Pet's name: 
            @else
                Pet names: 
            @endif
            <?php
                $firstPet = true;
                $petNames = '';
                foreach( $data['pets'] as $pet )
                {
                    if ( $firstPet == false )
                    {
                        $petNames .= ', ';
                    }
                    $petNames .= $pet->name;
                    $firstPet = false;
                }
            ?>
            {{ $petNames }}
            </li>
            <li>Question: {{ $data['application']->question }}</li>
        </ul>
    </p>
    <p>To see more details you need to login to your account.</p>
    <p><a href="{{ url('login') }}">Login here</a></p>
    <p><small>If you recieved this email and you are not part of Safe Haven Network, please ignore it.</small></p>
</body>
</html>