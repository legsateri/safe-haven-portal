<?php

namespace App\Validators;

use GuzzleHttp\Client;
use App\Code\AppConfig;

class ReCaptcha
{
    public function validate(
        $attribute, 
        $value, 
        $parameters, 
        $validator
    ){
        $config = AppConfig::get();
        $client = new Client();
    
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>$config->recaptcha_secret_key,
                    'response'=>$value
                 ]
            ]
        );
    
        $body = json_decode((string)$response->getBody());
        return $body->success;
    }

}