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
    <p>You are receiving this email because advocate has answered on question that your organization has posted about pet.</p>
    <p>
        <ul>
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

            <li>Your question: {{ $data['application']->question }}</li>
            <li>Answer: {{ $data['application']->answer }}</li>
        </ul>
    </p>
    <p>To see more details you need to login to your account.</p>
    <p><a href="{{ url('login') }}">Login here</a></p>
    <p><small>If you received this email and you are not part of Safe Haven Network, please ignore it.</small></p>
</body>
</html>