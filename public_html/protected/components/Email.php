<?php

class Email extends CComponent {

    public static function sendMail($email, $subject, $message) {

        $siteName='=?UTF-8?B?'.base64_encode(Yii::app()->name).'?=';
        $adminEmail = Yii::app()->params['adminEmail'];

        $headers =
            "From: {$siteName} <{$adminEmail}>\r\n" .
            "Reply-To: {$adminEmail}\r\n" .
            "MIME-Version: 1.0\r\n" .
            "Content-Type: text/html; charset=\"utf-8\"\r\n" .
            "Content-Transfer-Encoding: 8bit\r\n" .
            "X-Mailer: PHP/" . phpversion();

        $message = wordwrap($message, 70);
        $message = str_replace("\r\n", "\n", $message);
        $message = str_replace("\n.", "\n..", $message);

        $message = "<html>\n<head><title>{$subject}</title>\n</head>\n<body>\n{$message}</body>\n</html>\n";

        return mail($email,'=?utf-8?B?' . base64_encode($subject) . '?=',$message,$headers, "-f{$adminEmail}");

    }

}