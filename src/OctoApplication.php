<?php

namespace Asadbekinha\OctoPayment;

use Asadbekinha\OctoPayment\Exception\OctoException;

class OctoApplication
{
    public $config;
    public $request;
    public $response;
    public $merchant;

    /**
     * Application constructor.
     * @param array $config configuration array with <em>merchant_id</em>, <em>login</em>, <em>keyFile</em> keys.
     */
    public function __construct($config)
    {
        $this->config   = $config;
        $this->request  = new Request();
        $this->response = new Response($this->request);
        $this->merchant = new Merchant($this->config);
    }

    /**
     * Authorizes session and handles requests.
     */
    public function run()
    {
        try {
            // authorize session
            $this->merchant->Authorize($this->request->id);

            // handle request
            switch ($this->request->method) {
                case 'Pay':
                    $this->CheckPerformTransaction();
                    break;
                case 'Verify':
                    $this->CheckTransaction();
                    break;

                default:
                    $this->response->error(
                        PaycomException::ERROR_METHOD_NOT_FOUND,
                        'Method not found.',
                        $this->request->method
                    );
                    break;
            }
        } catch (OctoException $exc) {
            $exc->send();
        }
    }
}