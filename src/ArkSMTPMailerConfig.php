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
     * @return mixed|null
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed|null $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed|null
     */
    public function getSmtpAuth()
    {
        return $this->smtpAuth;
    }

    /**
     * @param mixed|null $smtpAuth
     */
    public function setSmtpAuth($smtpAuth)
    {
        $this->smtpAuth = $smtpAuth;
    }

    /**
     * @return mixed|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed|null $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed|null $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed|null
     */
    public function getSmtpSecure()
    {
        return $this->smtpSecure;
    }

    /**
     * @param mixed|null $smtpSecure
     */
    public function setSmtpSecure($smtpSecure)
    {
        $this->smtpSecure = $smtpSecure;
    }

    /**
     * @return mixed|null
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed|null $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return mixed|null
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param mixed|null $displayName
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }


}