<?php

namespace Core;


use Core\Interfaces\RequestInterface;

final class Request implements RequestInterface
{
    const METHOD_GET = "GET";
    const METHOD_HEAD = "HEAD";
    const METHOD_POST = "POST";
    const METHOD_PUT = "PUT";
    const METHOD_PATCH = "PATCH";
    const METHOD_DELETE = "DELETE";

    public $query;
    public $request;
    public $files;
    public $session;
    public $server;

    public function __construct($query, $request, $files, $server)
    {
        $this->query = new ParameterBag($query);
        $this->request = new ParameterBag($request);
        $this->files = new ParameterBag($files);
        $this->server = new ParameterBag($server);
    }

    public static function createFromGlobals()
    {
        return new self($_GET, $_POST, $_FILES, $_SERVER);
    }

    public function getRequestUri()
    {
        return $this->server->get("REQUEST_URI");
    }

    public function getMethod()
    {
        return $this->server->get("REQUEST_METHOD");
    }

    public function getSession()
    {
        if (!$this->session) {
            $this->session = new SessionHandler();
        }

        return $this->session;
    }
}
