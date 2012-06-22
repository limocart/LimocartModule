<?php

namespace LimocartModule\Authentication\Adapter;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result;

class Oauth2 implements AdapterInterface
{

    /**
     * $_identity - Identity value
     *
     * @var string
     */
    protected $_identity = null;

    /**
     * $_credential - Credential values
     *
     * @var string
     */
    protected $_credential = null;

    /**
     * @var \LimocartPhpSdk\Limocart
     */
    protected $_api;

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        $api = $this->getApi();

        $apiResult = $api->api('oauth2/token', array(
            'username' => $this->_identity,
            'password' => $this->_credential,
            'client_id' => $api->getClientId(),
            'client_secret' => $api->getClientSecret(),
            'grant_type' => 'password'
        ), $api::METHOD_POST);

        if ($apiResult->isSuccess()
            && isset($apiResult->getVariables()->token)
            && isset($apiResult->getVariables()->user)) {
            $result = new Result(Result::SUCCESS, $apiResult->getVariables());
        } else {
            $result = new Result(Result::FAILURE_CREDENTIAL_INVALID, null);
        }

        return $result;
    }

    /**
     * setIdentity() - set the value to be used as the identity
     *
     * @param  string $value
     * @return DbTable Provides a fluent interface
     */
    public function setIdentity($value)
    {
        $this->_identity = $value;
        return $this;
    }

    /**
     * setCredential() - set the credential value to be used, optionally can specify a treatment
     * to be used, should be supplied in parametrized form, such as 'MD5(?)' or 'PASSWORD(?)'
     *
     * @param  string $credential
     * @return DbTable Provides a fluent interface
     */
    public function setCredential($credential)
    {
        $this->_credential = $credential;
        return $this;
    }

    /**
     * @param \LimocartPhpSdk\Limocart $api
     */
    public function setApi($api)
    {
        $this->_api = $api;
    }

    /**
     * @return \LimocartPhpSdk\Limocart
     */
    public function getApi()
    {
        return $this->_api;
    }

}
