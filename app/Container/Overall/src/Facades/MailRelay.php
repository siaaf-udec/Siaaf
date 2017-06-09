<?php

namespace App\Container\Overall\Src\Facades;

class MailRelay
{
    private $subject = ""; /*Asunto*/
    private $emails = ""; /*Emails Array*/
    private $api = "";  /*Api*/
    private $curl = ""; /*Url*/
    public function __construct()
    {
        $this->api = "LZGo75SNd1QZ3TQ6CT42DZYkucJHp1l1RsfPnydG";
        $this->curl = curl_init('http://civilandsoft.ip-zone.com/ccm/admin/api/version/2/&type=json');
    }
    public function sendMail($subject, $emails ,$html){
        $postData = array(
            'function' => 'sendMail',
            'apiKey' => $this->api,
            'subject' => $subject,
            'html' => $html,
            'mailboxFromId' => 1,
            'mailboxReplyId' => 1,
            'mailboxReportId' => 1,
            'packageId' => 6,
            'emails' => $emails
        );
        $post = http_build_query($postData);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $post);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        $json = curl_exec($this->curl);
        if ($json === false) {
            return 'Request failed with error: '. curl_error($curl);
        }
        $result = json_decode($json);
        if ($result->status == 0) {
            return 'Bad status returned. Error: '. $result->error;
        }
        return $result->data;
    }
}