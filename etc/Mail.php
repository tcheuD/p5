<?php

namespace Core;

class Mail
{

    private $from;
    private $to;
    private $subject;
    private $message;
    private $headers;

    public function __construct()
    {
        $this->setFrom();
        $this->setHeaders();
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getHeaders(): string
    {
        return $this->headers;
    }

    /**
     * @param string $from
     */
    public function setFrom(string $from = 'contact@damienchedan.fr'): void
    {
        $this->from = $from;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to): void
    {
        $this->to = $to;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @param string $headers
     */
    public function setHeaders(string $headers = 'De : '): void
    {
        $this->headers = $headers.' '.$this->from;
    }



}