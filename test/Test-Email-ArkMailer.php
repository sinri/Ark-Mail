<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2018/2/13
 * Time: 17:41
 */

require_once __DIR__ . '/../vendor/autoload.php';
//require_once __DIR__ . '/../autoload.php';

use sinri\ark\email\ArkSMTPMailer;
use sinri\ark\email\ArkSMTPMailerConfig;
use sinri\ark\email\exception\ArkMailException;

$config = new ArkSMTPMailerConfig([
    'host' => 'smtp.exmail.qq.com',
    'smtp_auth' => true,
    'username' => '',
    'password' => '',
    'smtp_secure' => 'ssl',
    'port' => 465,
    'display_name' => 'Ark Mailer Tester',
]);

$mailer = new ArkSMTPMailer($config);
try {
    $mailer->prepare()
        ->addReceiver("support@beian.gov.cn", '公安部网络安全保卫局')
        ->setSubject(__FILE__)
        ->setHTMLBody("<p style='color:red'>" . __LINE__ . "</p>")
        ->finallySend();
} catch (ArkMailException $e) {
    echo $e->getNestedMessage();
}