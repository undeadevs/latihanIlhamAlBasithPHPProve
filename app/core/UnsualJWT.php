<?php

    class UnsualJWT{
        public static function encode($data, $secret){
            $header = json_encode(['alg'=>'HS256', 'typ'=>'JWT']);
            $payload = json_encode($data);
            $base64URLHeader = str_replace(['+','/','='],['-','_',''],base64_encode($header));
            $base64URLPayload = str_replace(['+','/','='],['-','_',''],base64_encode($payload));
            $signature = hash_hmac('sha256', $base64URLHeader.'.'.$base64URLPayload, $secret, true);
            $base64URLSignature = str_replace(['+','/','='],['-','_',''],base64_encode($signature));
            $reversedBase64URLHeader = implode('',array_reverse(str_split($base64URLHeader)));
            $reversedBase64URLPayload = implode('',array_reverse(str_split($base64URLPayload)));
            $reversedBase64URLSignature = implode('',array_reverse(str_split($base64URLSignature)));
            $reversedToken = implode('',array_reverse(str_split("$reversedBase64URLHeader.$reversedBase64URLPayload.$reversedBase64URLSignature")));
            return $reversedToken;
        }

        public static function decode($token, $secret){
            $splitToken = explode('.', implode('',array_reverse(str_split($token))));
            $header = implode('',array_reverse(str_split($splitToken[0])));
            $payload = implode('',array_reverse(str_split($splitToken[1])));
            $correctSignature = implode('',array_reverse(str_split($splitToken[2])));

            $signature = hash_hmac('sha256', $header.'.'.$payload, $secret, true);
            $base64URLSignature = str_replace(['+','/','='],['-','_',''],base64_encode($signature));
            if(hash_equals($correctSignature,$base64URLSignature)){
                return json_decode(base64_decode($payload), true);
            }else{
                die('Invalid signature');
            }
        }
    }