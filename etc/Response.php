<?php

namespace Core;

use Core\Interfaces\ResponseInterface;

class Response implements ResponseInterface
{
    const HTTP_OK = 200;
    const HTTP_NOT_FOUND = 404;
    const HTTP_INTERNAL_SERVER_ERROR = 500;

    public $statusCode;

    public $content;

    public $statusText;

    public $protocolVersion = "1.0";

    public static $statusTexts = [
        200 => "OK",
        404 => "NOT FOUND",
        500 => "INTERNAL SERVER ERROR"
    ];

    public function __construct(string $content, int $statusCode = 200, array $headers = [])
    {
         $this->setContent($content);
         $this->setStatusCode($statusCode);
         $this->setProtocolVersion("1.0");
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    private function setStatusCode(int $statusCode)
    {
        $this->statusText = self::$statusTexts[$statusCode];
        $this->statusCode = $statusCode;
    }

    private function setContent(string $content): void
    {
        $this->content = $content;
    }

    private function setProtocolVersion(string $protocolVersion)
    {
        $this->protocolVersion = $protocolVersion;
    }

    public function send()
    {
        $this->prepareHeaders();
        $this->prepareContent();
    }

    private function prepareHeaders()
    {
        if (headers_sent()){
            return;
        }

        header(sprintf("HTTP/%s %s %s", $this->protocolVersion, $this->statusCode, $this->statusText),
            true, $this->statusCode);
    }

    private function prepareContent()
    {
        echo $this->content;
    }


}

