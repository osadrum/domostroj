<?php

class Email extends CComponent {

    public static function sendMail($to,$subject,$message, $file=array()) {
        if ($to=='admin') {
            $adminEmail = Settings::getCacheValue('email');
            $to = $adminEmail;
        }

        $mail = new YiiMailer(
            'contact',
            array(
                'message' => $message,
                'name' => Settings::getCacheValue('smtpName'))
        );
        $mail->setSmtp(
            Settings::getCacheValue('smtpHost'),
            Settings::getCacheValue('smtpPort'),
            '',
            true,
            Settings::getCacheValue('smtpEmail'),
            Settings::getCacheValue('smtpPass'));

        $mail->setFrom(Settings::getCacheValue('smtpEmail'), Settings::getCacheValue('smtpName'));
        $mail->setSubject($subject);
        $mail->setTo($to);

        if (!empty($file)) {
            $mail->setAttachment(array($file['tmp_name']=>$file['name']));
        }

        if ($mail->send()) {
            return true;
        } else {
            //echo $mail->getError();die;
            return false;
        }
    }

}