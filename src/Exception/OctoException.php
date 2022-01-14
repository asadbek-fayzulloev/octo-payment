<?php

namespace Asadbekinha\OctoPayment\Exception;

use Exception;

class OctoException extends Exception

{
    const ERROR_INTERNAL_SYSTEM = -32400;
    const ERROR_INSUFFICIENT_PRIVILEGE = -32504;
    const ERROR_INVALID_JSON_RPC_OBJECT = -32600;
    const ERROR_METHOD_NOT_FOUND = -32601;
    const ERROR_INVALID_AMOUNT = -31001;
    const ERROR_TRANSACTION_NOT_FOUND = -31003;
    const ERROR_INVALID_ACCOUNT = -31050;
    const ERROR_COULD_NOT_CANCEL = -31007;
    const ERROR_COULD_NOT_PERFORM = -31008;

    /** The error message */
    protected $message;
    /** The error code */
    protected $code;
    /** The filename where the error happened  */
    protected $file;
    /** The line where the error happened */
    protected $line;

    /**
     * OctoException constructor.
     * @param int $request_id id of the request.
     * @param string|array $message error message.
     * @param int $code error code.
     * @param string|null $data parameter name, that resulted to this error.
     */
    public function __construct($message = "", $code = 0)
    {

    }
    public function send(){

    }


}