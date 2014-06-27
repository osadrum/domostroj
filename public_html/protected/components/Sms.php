<?php

class Sms extends CComponent {

    const API_URL = 'http://sms.ru/sms/send';
    const API_KEY = '7bbeb875-25fb-55d4-d1de-ff18d53b3bbf';
    const FROM = 'cronofunds';

    public static function send($to, $message) {
        $url = self::API_URL . '?' . 'api_id=' . self::API_KEY . '&to=' . $to . '&from=' . self::FROM . '&text=' . urlencode($message);
        $result = file_get_contents($url);
        if ( false === $result ) {
            return false;
        }
        return true;
    }

}