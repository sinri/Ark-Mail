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
     * @return $this
     */
    public function prepare();

    /**
     * This should be set before adding methods.
     * NULL for no limit and array of email address strings as limitation
     * @param string[]|null $emails
     * @return $this
     */
    public function setReceiverLimitation($emails);

    /**
     * @param string $address
     * @param string $name
     * @return $this
     */
    public function addReceiver($address, $name = '');

    /**
     * @param string $address
     * @param string $name
     * @return $this
     */
    public function addReplyAddress($address, $name='');

    /**
     * @param string $address
     * @param string $name
     * @return $this
     */
    public function addCCAddress($address, $name='');

    /**
     * @param string $address
     * @param string $name
     * @return $this
     */
    public function addBCCAddress($address, $name='');

    /**
     * @param string $attachmentFile
     * @param string $name
     * @return $this
     * @throws ArkMailException
     */
    public function addAttachment($attachmentFile, $name = '');

    /**
     * @param string $subject
     * @return $this
     */
    public function setSubject($subject);

    /**
     * @param string $text
     * @return $this
     */
    public function setTextBody($text);

    /**
     * @param string $htmlCode
     * @return $this
     */
    public function setHTMLBody($htmlCode);

    /**
     * @throws ArkMailException
     * @return void
     */
    public function finallySend();
}