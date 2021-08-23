<?php
/**
 * Created by PhpStorm.
 * User: sinri
 * Date: 2019-03-30
 * Time: 12:33
 */

namespace sinri\ark\email;


use sinri\ark\core\ArkHelper;

/**
 * Class ArkSMTPMailerConfig
 * @package sinri\ark\email
 * @since 1.2
 */
class ArkSMTPMailerConfig
{
    protected $host;
    protected $smtpAuth;
    protected $username;
    protected $password;
    protected $smtpSecure;
    protected $port;
    protected $displayName;

    public function __construct($params = [])
    {
        $this->host = ArkHelper::readTarget($params, 'host', '');
        $this->smtpAuth = ArkHelper::readTarget($params, 'smtp_auth', '');
        $this->username = ArkHelper::readTarget($params, 'username', '');
        $this->password = ArkHelper::readTarget($params, 'password', '');
        $this->smtpSecure = ArkHelper::readTarget($params, 'smtp_secure', '');
        $this->port = ArkHelper::readTarget($params, 'port', '');
        $this->displayName = ArkHelper::readTarget($params, 'display_name', '');
    }

    /**
     * @return string|null
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return bool|null
     */
    public function getSmtpAuth()
    {
        return $this->smtpAuth;
    }

    /**
     * @param bool $smtpAuth
     */
    public function setSmtpAuth($smtpAuth)
    {
        $this->smtpAuth = $smtpAuth;
    }

    /**
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getSmtpSecure()
    {
        return $this->smtpSecure;
    }

    /**
     * @param string $smtpSecure
     */
    public function setSmtpSecure($smtpSecure)
    {
        $this->smtpSecure = $smtpSecure;
    }

    /**
     * @return int|null
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return string|null
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }


}