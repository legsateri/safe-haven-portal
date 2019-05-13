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
    <p>Pet that is related to your client has been accepted by shelter</p>
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
            <li>Shelter name: {{ $data['application']->shelter_name }}</li>
            <li>Shelter agent name: {{ $shelterAgent->shelter_user_first_name }} {{ $shelterAgent->shelter_user_last_name }}</li>
            <li>Email of shelter agent: {{ $shelterAgent->shelter_user_email }}</li>
            @if( isset($shelterAgentPhone->phone) )
                @if ( $shelterAgentPhone->phone != null && $shelterAgentPhone->phone != "" )
                    <li>Phone number of shelter agent: {{ $shelterAgentPhone->phone }}</li>
                @endif
            @endif
        </ul>
    </p>
    <p>To see more details you need to login to your account.</p>
    <p><a href="{{ url('login') }}">Login here</a></p>
    <p><small>If you recieved this email and you are not part of Safe Haven Network, please ignore it.</small></p>
</body>
</html>