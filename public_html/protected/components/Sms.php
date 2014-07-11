<?php

class Sms extends CComponent
{
    public static function send($to, $message) {

        $adminPhone = Settings::getCacheValue('appPhone');

        if ($to=='admin') {
            $to = $adminPhone;
        }

        //$url = self::API_URL . '?' . 'api_id=' . self::API_KEY . '&to=' . $to . '&from=' . self::FROM . '&text=' . urlencode($message);
        $url = Settings::getCacheValue('smsApiUrl') . '?' . 'api_id=' . Settings::getCacheValue('smsApiKey') . '&to=' . $to . '&text=' . urlencode($message);
        if (Settings::getCacheValue('smsName') == 1) {
            $url .= '&from=' . Settings::getCacheValue('smsFrom');
        }

        $result = file_get_contents($url);

        if ( false === $result ) {
            return false;
        }
        return true;
    }

    public static function getBalance()
    {
        $body=file_get_contents("http://sms.ru/my/balance?api_id=".Settings::getCacheValue('smsApiKey'));

        list($code,$balance) = explode("\n", $body);
        if ($code=="100") {
            return $balance .' руб.';
        } else {
            return 'Нет данных! Попробуйте проверить позже';
        }
    }

    public static function getUsageSms()
    {
        $usageList = array();
        $contactSms = Settings::getCacheValue('contact-sms');
        if ($contactSms == 1) {
            $usageList[] = 'Уведомление об отправке из контактной формы';
        }

        $callBackSms = Settings::getCacheValue('callback');
        if ($callBackSms == 1 || $callBackSms == 2) {
            $usageList[] = 'Уведомление об обратном звонке';
        }
        return $usageList;
    }

}