<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

use GuzzleHttp\Exception\RequestException;

use GuzzleHttp\Psr7\Request;

class FbBot
{
  private $hubVerifyToken = null;
  private $accessToken = null;
  private $tokken = false;
  protected $client = null;

  function __construct(){
  }

  public function setHubVerifyToken($value){
    $this->hubVerifyToken = $value;
  }

  public function setAccessToken($value){
    $this->accessToken = $value;
  }
  
  public function verifyTokken($hub_verify_token, $challange){
    try{
      if ($hub_verify_token === $this->hubVerifyToken) {
        return $challange;
      }
      else{
        throw new Exception("Tokken not verified");
      }
    } catch(Exception $ex) {
      return $ex->getMessage();
    }
  }

  public function readMessage($input){
    
    try{
      $payloads = null;
      $senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
      $messageText = $input['entry'][0]['messaging'][0]['message']['text'];
      $postback = $input['entry'][0]['messaging'][0]['postback'];
      $loctitle = $input['entry'][0]['messaging'][0]['message']['attachments'][0]['title'];
      
      if (!empty($postback)) {
        $payloads = $input['entry'][0]['messaging'][0]['postback']['payload'];
        return ['senderid' => $senderId, 'message' => $payloads];
      }

      if (!empty($loctitle)) {
        $payloads = $input['entry'][0]['messaging'][0]['postback']       ['payload'];
        return ['senderid' => $senderId, 'message' => $messageText, 'location' => $loctitle];
      }

      // var_dump($senderId,$messageText,$payload);
      //   $payload_txt = $input['entry'][0]['messaging'][0]['message']['quick_reply']‌​['payload'];

      return ['senderid' => $senderId, 'message' => $messageText];
    } catch(Exception $ex) {
      return $ex->getMessage();
    }
  }

  public function actions_sender($input,$action_sender){

    $client  = new GuzzleHttp\Client();

    $url = "https://graph.facebook.com/v2.6/me/messages";

    $senderId = $input['senderid'];

    $response = null;

    $header = array('content-type' => 'application/json');
    $response = ['recipient' => ['id' => $senderId], 'sender_action' => $action_sender, 'access_token' => $this->accessToken];

    $response = $client->post($url, ['query' => $response, 'headers' => $header]);

    return true;
  }

  public function sendMessage($senderId,$tipo,$datos){
  
    try {

      //Preparar variables

      $client  = new GuzzleHttp\Client();

      $url = "https://graph.facebook.com/v2.6/me/messages";

      $header = array('content-type' => 'application/json');

      if($tipo == 'botones'){

        $response = [
          'recipient' => ['id' => $senderId], 
          'message' => 
          [
            "text"          => $datos['texto'],
            "quick_replies" => $datos['botones'] 
          ],
          'access_token'  => $this->accessToken
        ];
      }

      if($tipo == 'postback'){
        $response = [
          'recipient' => ['id' => $senderId], 
          'message' => 
          [
            "attachment" => [
              "type" => "template",
              "payload" => [
                "template_type" => "button",
                "text"          => $datos['texto'],
                "buttons"       => $datos['botones'] 
              ]
            ]
          ],
          'access_token'  => $this->accessToken
        ];
      }

      if($tipo == 'imagen'){

        $response = [
          'recipient' => ['id' => $senderId], 
          'message' => 
          [
            "attachment" => [
              "type" => "template",
              "payload" => [
                "template_type" => "generic",
                "elements"      => $datos['elementos']
              ]
            ]
          ],
          'access_token'  => $this->accessToken
        ];
      }

      if($tipo == 'texto'){
        $response = ['recipient' => ['id' => $senderId], 'message' => ['text' => $datos['texto']], 'access_token' => $this->accessToken];
      }

      $response = $client->post($url, ['query' => $response, 'headers' => $header]);

      return true;
    
    } catch(RequestException $e) {
      $response = json_decode($e->getResponse()->getBody(true)->getContents());
      file_put_contents("test.json", json_encode($response));
      return $response;
    }
  }
}
