<?php

class SendSMS
{

    public function Send($verification_code = null, $toNum = null, $messageContent = null)
    {
        try {
            $client = new \SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
            $user = "09199312019";
            $pass = "justdoitSEPEHR123$%^";
            $fromNum = "00989999150632";

            $messageContent = 'Code: 123456 متن جهت تست می‌باشد.';
            $op = "send";
            //If you want to send in the future  ==> $time = '2016-07-30' //$time = '2016-07-30 12:50:50'
            $pattern_code = '5yc4nnml9hpitv8';
            $time = '';

            $input_data = array(
                "verification_code" => $verification_code,

            );

            echo $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
        } catch (SoapFault $ex) {
            echo $ex->faultstring;
        }
    }
}