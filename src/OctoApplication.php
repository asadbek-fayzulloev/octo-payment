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
    public function pay($order_id)
    {

        $prepareData = $this->preparePayment($order_id);

        if ($prepareData && ($order_id == $prepareData["order_id"])) {
            $booking = $this->findBookingById($order_id);
            $user = $this->findUserById($booking["user_id"]);
            return redirect()->to($prepareData["octo_pay_url"]);
        }
        return false;
    }
    public function verify($shop_transaction_id){
        $prepareData = $this->preparePayment($shop_transaction_id);
        $bookingsObject = $this->findBookingById($shop_transaction_id);
        if($prepareData["status"] == "succeeded" && $prepareData["shop_transaction_id"] == $shop_transaction_id ){
            $cashback = new Cashback();
            if($bookingsObject["paid"] == null){
                $cashback->giveCashback($bookingsObject["user_id"], $bookingsObject["price"]);
            }
            $this->updateStatus($shop_transaction_id);
            $this->update_by_id($shop_transaction_id, ["status" => "confirmed"]);

        }
        return redirect()->route('site.profile.bookings.show', ["booking" => $shop_transaction_id]);
    }
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