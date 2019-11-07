<?php
/**
  * Soulmkt
  *
  * NOTICE OF LICENSE
  *
  * This source file is subject to the Academic Free License (AFL 3.0)
  * It is also available through the world-wide-web at this URL:
  * http://opensource.org/licenses/afl-3.0.php
  *
  * @category    Soulmkt
  * @package     Soulmkt_VirtusApi
  * @author      Felipe <felipe@soulmkt.com.br>
  * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
  */

class virtusApi
{
    public $endpoint = 'https://homologacao.virtusfarma.com.br'; // homologacao
    // public $endpoint = 'https://virtusfarma.com.br'; // produção
    public $lastResponse;
    public $apiConfig = [];

    public function __construct($consumerKey, $consumerSecret, $oauth_token, $oauth_token_secret)
    {
        $this->apiConfig = [
            'apiUrl' => $this->endpoint . "/api/rest/soulhub",
            'consumerKey' => $consumerKey,
            'consumerSecret' => $consumerSecret,
            'oauth_token' => $oauth_token,
            'oauth_token_secret' => $oauth_token_secret
        ];

        $this->OAuth = new OAuth(
            $this->apiConfig['consumerKey'],
            $this->apiConfig['consumerSecret'],
            OAUTH_SIG_METHOD_HMACSHA1,
            OAUTH_AUTH_TYPE_AUTHORIZATION
        );
        $this->OAuth->enableDebug();
    }

    public function exec($action, $body)
    {
        try {
            $this->OAuth->setToken($this->apiConfig['oauth_token'], $this->apiConfig['oauth_token_secret']);

            $body = json_encode($body);

            $resourceUrl = $this->apiConfig['apiUrl'] . "/" . $action;

            $this->OAuth->fetch(
                $resourceUrl,
                $body,
                OAUTH_HTTP_METHOD_PUT,
                ['Content-Type' => 'application/json']
            );

            $this->lastResponse = $this->OAuth->getLastResponse();

            $response = json_decode($this->lastResponse, 1);

            if (empty($response)) {
                $response = $this->lastResponse;
            }

        } catch (Exception $e) {
            var_dump($e->getMessage());
            return false;
        }

        return $response;
    }
}
