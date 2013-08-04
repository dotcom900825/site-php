<?php

use Aws\Ses\SesClient;
use Aws\Ses\Exception\SesException;

function sendFileToEmailWithTitleAndMessageAmazonSES($to, $subject, $message, $file){

    require_once(dirname(__FILE__)."/../vendor/autoload.php");

    // create a client
    try{
        $client = SesClient::factory(array(
            'key'    => 'AKIAJSRTQBN3LOYMYGWA',
            'secret' => '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',
            'region' => 'us-east-1'
        ));
    }catch(Exception $e1){

        $EmailFrom = 'noreply@ipassstore.com';
        $EmailTo = 'admin@ipassstore.com';
        $errorSubject = "SesClient Error Report";

        // prepare email body text
        $body = $e1->getMessage();

        // send email
        $success = mail($EmailTo, $errorSubject, $body, "From: <$EmailFrom>");
    }


    try{
        //--------------------------------------------------------------------------
        $recipient = $to;
        $messageText = $message;
        $subjectText = $subject;
        //--------------------------------------------------------------------------

        $baseName = basename($file);
        $base64Content = chunk_split(base64_encode(file_get_contents($file)));
        $boundary = md5(time());

        //--------------------------------------------------------------------------
        $headers = "From: noreply@ipassstore.com\r\n"
            ."To: ".$recipient."\r\n"
            ."Subject: ".$subjectText."\r\n"
            ."MIME-Version: 1.0\r\n"
            ."Content-Type: multipart/mixed; boundary=\"".$boundary."\"";
        //--------------------------------------------------------------------------

        $content = "\r\n\r\n"
            ."This is a multi-part message in MIME format.\r\n"
            ."--".$boundary."\r\n"
            ."Content-Type: text/plain; charset=iso-8859-1\r\n"
            ."Content-Transfer-Encoding: 7bit\r\n\r\n"
            .$message."\r\n\r\n"
            ."--".$boundary."\r\n"
            ."Content-Type: application/octet-stream; name=\"".$baseName."\"\r\n"
            ."Content-Transfer-Encoding: base64\r\n"
            ."Content-Disposition: attachment; filename=\"".$baseName."\"\r\n\r\n"
            .$base64Content."\r\n\r\n"
            ."--".$boundary."--";

        $response = $client->sendRawEmail(array(
            'RawMessage' => array(
                'Data' => base64_encode($headers.$content),
            )));

    }catch(Exception $e2){

        $EmailFrom = 'noreply@ipassstore.com';
        $EmailTo = 'admin@ipassstore.com';
        $subject = "Ses SendRawEmail Error Report";

        // prepare email body text
        $body = $e2->getMessage();

        // send email
        $success = mail($EmailTo, $subject, $body, "From: <$EmailFrom>");
    }
    return;
}
