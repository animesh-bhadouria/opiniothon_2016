<?php

/* Class NetworkHelper which contains HTTP methods useful in making outgoing HTTP requests.
 * function getit :: makes a HTTP GET request to URL passed as parameter.
 * function postit :: makes a HTTP POST request with params passed as Array.
 * function postJson :: makes a HTTP POST with Post data being Json String which is passed as parameter.
 *
 * author : raj
 *
 */

class NetworkHelper
{
    
    // public function to make a HTTP GET request to url passed as a parameter.
    public function getit($url)
    {

        $ch = curl_init();  
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result=curl_exec($ch);
     
        curl_close($ch);
        return $result;

    }


    // public function to make a HTTP POST request to url and the post params [an array] passed as a parameter.
    public function postit($url, $params)
    {
        $postData = '';
        //create name value pairs seperated by &
        foreach ($params as $key => $value) 
        { 
          $postData .= $key . '='.$value.'&'; 
        }

        //Strip '&' from the end of a $postData string
        $postData = rtrim($postData, '&');

        $ch = curl_init();  
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    

        $result=curl_exec($ch);

        curl_close($ch);
        return $result;
 
    }



    // public function to make a HTTP POST request to url and the post data [a Json String] passed as a parameter.
    public function postJson($url, $jsonString)
    {

        $ch = curl_init($url);                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonString);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                'Content-Length: ' . strlen($jsonString))                                                                       
            );                                                                                                                   
                                                                                                                     
        $result = curl_exec($ch);
        
        curl_close($ch);
        return $result;

    }

}



/*
Uncomment and Use this block to test this NetworkHelper


// Make sample HTTP GET Request
echo NetworkHelper::getit("54.201.205.215");



// Make sample HTTP POST Request with params array
$params = array(
   "name" => "Raj Vimal Chopra",
   "hackathon" => "Opiniothon",
);
echo NetworkHelper::postit("54.201.205.215",$params);



// Make sample HTTP POST Request with Json String
$jsonString = '{
                    "name":"Raj Vimal Chopra",
                    "hackathon":"Opiniothon",
                    "city":"Bangalore"
                }';
echo NetworkHelper::postJson("54.201.205.215",$jsonString);



*/

