<?php

class Sms extends CComponent {

    const API_URL = 'http://sms.ru/sms/send';
    const API_KEY = '10e3b70f-2eed-5364-210f-3fcd3687e8d9';
    const FROM = 'yahochudom';

    public static function send($to, $message) {

        $adminPhone = Settings::getCacheValue('appPhone');

        if ($to=='admin') {
            $to = $adminPhone;
        }

        //$url = self::API_URL . '?' . 'api_id=' . self::API_KEY . '&to=' . $to . '&from=' . self::FROM . '&text=' . urlencode($message);
        $url = self::API_URL . '?' . 'api_id=' . self::API_KEY . '&to=' . $to . '&text=' . urlencode($message);
        $result = file_get_contents($url);

        if ( false === $result ) {
            return false;
        }
        return true;
    }

}