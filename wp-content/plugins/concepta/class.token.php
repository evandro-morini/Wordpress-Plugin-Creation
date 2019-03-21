<?php

class Token { 
    private $token;
    private $auth;
    
    function __construct() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://travellogix.api.test.conceptsol.com/Token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=password&username=test1%40test2.com&password=Aa234567%21",
          ));
        $response = curl_exec($curl);
        curl_close($curl);

        $obj = json_decode($response);

        if(!empty($obj->access_token)) {
            $this->setToken($obj->access_token);
        }
        if(!empty($obj->token_type)) {
            $this->setAuth($obj->token_type);
        }
    }
    
    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function getAuth() {
        return $this->auth;
    }

    public function setAuth($auth) {
        $this->auth = $auth;
    }
    
}
