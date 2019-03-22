<?php

class Ticket { 
    private $response;

    function __construct($strToken, $strAuth, $strBody) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://travellogix.api.test.conceptsol.com/api/Ticket/Search",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $strBody,
            CURLOPT_HTTPHEADER => array(
                "Authorization: {$strAuth} {$strToken}",
                "Content-Type: application/json",
                "cache-control: no-cache"
              )
          ));
        $response = curl_exec($curl);
        curl_close($curl);

        $obj = json_decode($response, true);

        if(!empty($obj)) {
            $this->setResponse($obj['Result']);
        }
    }
    
    public function getResponse() {
        return $this->response;
    }

    public function setResponse($response) {
        $this->response = $response;
    }

}
