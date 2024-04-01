<?php

namespace App\Services;

use App\Models\User;

class PhoneService
{

    public function __construct ($userId){
                $ch = curl_init("https://sms.ru/code/call");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
            "phone" => "79788793611", // номер телефона пользователя
            "ip" => '185.135.181.96', // ip адрес пользователя
            "api_id" => "E7E6B8D5-3453-95E8-1A45-E3A2872DB785"
        )));
        $body = curl_exec($ch);
        curl_close($ch);

//        $a =  '{"status":"OK","code":5778,"call_id":"202413-1000010","balance":125.4,"cost":0.4}';
        $body = json_decode($body,true);



        if($body['status'] == 'OK'){
            User::where('id',$userId)->update([
                'phone_verified_at' => $body['code'],
            ]);
        }

        return $body['status'];
    }

}
