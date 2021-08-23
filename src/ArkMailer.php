<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2018/2/22
 * Time: 14:24
 */

namespace sinri\ark\email;

use sinri\ark\email\exception\ArkMailException;

interface ArkMailer
{
    /**
     * @throws ArkMailException
     * @return ArkMailer
     */
    public function prepare();

    /**
     * This should be set before adding methods.
     * NULL for no limit and array of email address strings as limitation
     * @param string[]|null $emails
     * @return void
     */
    public function setReceiverLimitation($emails);

    /**
     * @param string $address
     * @param string $name
     * @return ArkMailer
     */
    public function addReceiver($address, $name = '');

    /**
     * @param string $address
     * @param string $name
     * @return ArkMailer
     */
    public function addReplyAddress($address, $name='');

    /**
     * @param string $address
     * @param string $name
     * @return ArkMailer
     */
    public function addCCAddress($address, $name='');

    /**
     * @param string $address
     * @param string $name
     * @return ArkMailer
     */
    public function addBCCAddress($address, $name='');

    /**
     * @param string $attachmentFile
     * @param string $name
     * @return ArkMailer
     * @throws ArkMailException
     */
    public function addAttachment($attachmentFile, $name = '');

    /**
     * @param string $subject
     * @return ArkMailer
     */
    public function setSubject($subject);

    /**
     * @param string $text
     * @return ArkMailer
     */
    public function setTextBody($text);

    /**
     * @param string $htmlCode
     * @return ArkMailer
     */
    public function setHTMLBody($htmlCode);

    /**
     * @throws ArkMailException
     * @return void
     */
    public function finallySend();
}