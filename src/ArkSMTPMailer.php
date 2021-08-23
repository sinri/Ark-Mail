<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2018/2/13
 * Time: 17:09
 */

namespace sinri\ark\email;


use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use sinri\ark\email\exception\ArkMailException;

/**
 * Class ArkSMTPMailer
 * @package sinri\ark\email
 * updated @since 1.2
 */
class ArkSMTPMailer implements ArkMailer
{
    private $phpMailerInstance;
    protected $availableAddressList = null;
    /**
     * @var ArkSMTPMailerConfig
     */
    private $smtpConfig;

    /**
     * LibMail constructor.
     * @param ArkSMTPMailerConfig $smtpConfig
     *
     * host,smtp_auth,username,password,smtp_secure,port,display_name
     */
    public function __construct(ArkSMTPMailerConfig $smtpConfig)
    {
        $this->smtpConfig = $smtpConfig;
        $this->phpMailerInstance = new PHPMailer();
    }

    /**
     * @param string[] $emails
     * @return $this
     */
    public function setReceiverLimitation($emails)
    {
        $this->availableAddressList = $emails;
        return $this;
    }

    /**
     * @return PHPMailer
     */
    public function getPhpMailerInstance(): PHPMailer
    {
        return $this->phpMailerInstance;
    }

    /**
     * @param int $target 0 for no debug, 4 for full debug
     * @return $this
     */
    public function setDebug(int $target = 0)
    {
        $this->phpMailerInstance->SMTPDebug = $target;
        return $this;
    }

    /**
     * @param string $charset PHPMailer::CHARSET_ISO88591 | CHARSET_UTF8
     * @return $this
     */
    public function setCharset(string $charset)
    {
        $this->phpMailerInstance->CharSet = $charset;
        return $this;
    }

    /**
     * If you are using OSX and PHP 5.6 and find error in debug, you might try on this.
     * This is the solution given by PHPMail Official GitHub Developer.
     *
     * 2017-07-18 06:00:18     Connection failed. Error #2: stream_socket_client(): SSL operation failed with code 1. OpenSSL Error messages:
     * error:14090086:SSL routines:ssl3_get_server_certificate:certificate verify failed [~/enoch/SmallPHPMail/SMTP.php line 294]
     * 2017-07-18 06:00:18     Connection failed. Error #2: stream_socket_client(): Failed to enable crypto [~/enoch/SmallPHPMail/SMTP.php line 294]
     * 2017-07-18 06:00:18     Connection failed. Error #2: stream_socket_client(): unable to connect to ssl://smtp.exmail.qq.com:465 (Unknown error) [~/enoch/SmallPHPMail/SMTP.php line 294]
     *
     * @return $this
     */
    public function stopSSLVerify()
    {
        $this->phpMailerInstance->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        return $this;
    }

    /**
     * @return $this
     * @throws ArkMailException
     */
    public function prepare(): ArkSMTPMailer
    {
        try {
            $this->phpMailerInstance = new PHPMailer();
            $this->phpMailerInstance->Host = $this->smtpConfig->getHost();// Specify main and backup SMTP servers
            $this->phpMailerInstance->SMTPAuth = $this->smtpConfig->getSmtpAuth();// Enable SMTP authentication
            $this->phpMailerInstance->Username = $this->smtpConfig->getUsername();// SMTP username
            $this->phpMailerInstance->Password = $this->smtpConfig->getPassword();// SMTP password
            $this->phpMailerInstance->SMTPSecure = $this->smtpConfig->getSmtpSecure();// Enable TLS encryption, `ssl` also accepted
            $this->phpMailerInstance->Port = $this->smtpConfig->getPort();// TCP port to connect to

            $this->phpMailerInstance->CharSet = PHPMailer::CHARSET_UTF8;

            $this->phpMailerInstance->setFrom($this->smtpConfig->getUsername(), $this->smtpConfig->getDisplayName());

            $this->phpMailerInstance->isSMTP();
        } catch (Exception $e) {
            throw new ArkMailException($e, __METHOD__ . ' Failed');
        }
        return $this;
    }

    private function turnHTML2TEXT($html): string
    {
        $html = preg_replace('/<[Bb][Rr] *\/?>/', PHP_EOL, $html);
        return strip_tags($html);
    }

    /**
     * @param string $address
     * @param string $name
     * @return $this
     * @throws ArkMailException
     */
    public function addReceiver($address, $name = '')
    {
        if ($this->availableAddressList === null || in_array($address, $this->availableAddressList)) {
            try {
                $this->phpMailerInstance->addAddress($address, $name);
            } catch (Exception $e) {
                throw new ArkMailException($e, __METHOD__ . ' Failed: ' . $e->getMessage());
            }
        }
        return $this;
    }

    /**
     * @param string $address
     * @param string $name
     * @return $this
     * @throws ArkMailException
     */
    public function addReplyAddress($address, $name = '')
    {
        try {
            $this->phpMailerInstance->addReplyTo($address, $name);
        } catch (Exception $e) {
            throw new ArkMailException($e,__METHOD__.' Failed: '.$e->getMessage());
        }
        return $this;
    }

    /**
     * @param $address
     * @param string $name
     * @return $this
     * @throws ArkMailException
     */
    public function addCCAddress($address, $name = '')
    {
        if ($this->availableAddressList === null || in_array($address, $this->availableAddressList))
        {
            try {
                $this->phpMailerInstance->addCC($address, $name);
            } catch (Exception $e) {
                throw new ArkMailException($e,__METHOD__.' Failed: '.$e->getMessage());
            }
        }
        return $this;
    }

    /**
     * @param $address
     * @param string $name
     * @return $this
     * @throws ArkMailException
     */
    public function addBCCAddress($address, $name = '')
    {
        if ($this->availableAddressList === null || in_array($address, $this->availableAddressList))
        {
            try {
                $this->phpMailerInstance->addBCC($address, $name);
            } catch (Exception $e) {
                throw new ArkMailException($e,__METHOD__.' Failed: '.$e->getMessage());
            }
        }
        return $this;
    }

    /**
     * @param string $attachmentFile
     * @param string $name
     * @return $this
     * @throws ArkMailException
     */
    public function addAttachment($attachmentFile, $name = '')
    {
        try {
            $this->phpMailerInstance->addAttachment($attachmentFile, $name);
        } catch (Exception $e) {
            throw new ArkMailException($e,__METHOD__.' Failed: '.$e->getMessage());
        }
        return $this;
    }

    /**
     * @param $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->phpMailerInstance->Subject = $subject;
        return $this;
    }

    /**
     * @param $text
     * @return $this
     */
    public function setTextBody($text)
    {
        $this->phpMailerInstance->Body = $text;
        return $this;
    }

    /**
     * @param $htmlCode
     * @return $this
     */
    public function setHTMLBody($htmlCode)
    {
        $this->phpMailerInstance->isHTML(true);// Set email format to HTML
        $this->phpMailerInstance->Body = $htmlCode;
        $this->phpMailerInstance->AltBody = $this->turnHTML2TEXT($htmlCode);
        return $this;
    }

    /**
     * @throws ArkMailException
     */
    public function finallySend()
    {
        try {
            $this->phpMailerInstance->send();
        } catch (Exception $e) {
            throw new ArkMailException($e,__METHOD__.' Failed: '.$e->getMessage());
        }
    }
}