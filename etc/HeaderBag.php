<?php

namespace Core;


class HeaderBag
{

    protected $headers = array();
    protected $cacheControl = array();

    public function __construct(array $headers = array())
    {
        foreach ($headers as $key => $values) {
            $this->set($key, $values);
        }
    }

    public function __toString()
    {
        if (!$headers = $this->all()) {
            return '';
        }
        ksort($headers);
        $max = max(array_map('strlen', array_keys($headers))) + 1;
        $content = '';
        foreach ($headers as $name => $values) {
            $name = ucwords($name, '-');
            foreach ($values as $value) {
                $content .= sprintf("%-{$max}s %s\r\n", $name.':', $value);
            }
        }
        return $content;
    }

    public function all()
    {
        return $this->headers;
    }

    public function set($key, $values, $replace = true)
    {
        $key = str_replace('_', '-', strtolower($key));

        if (\is_array($values)) {
            $values = array_values($values);

            if (true === $replace || !isset($this->headers[$key])) {
                $this->headers[$key] = $values;
            } else {
                $this->headers[$key] = array_merge($this->headers[$key], $values);
            }
        } else {
            if (true === $replace || !isset($this->headers[$key])) {
                $this->headers[$key] = array($values);
            } else {
                $this->headers[$key][] = $values;
            }
        }

        if ('cache-control' === $key) {
           $this->cacheControl = $this->parseCacheControl(implode(', ', $this->headers[$key]));
        }

    }

    protected function parseCacheControl($header)
    {
        $parts = HeaderUtils::split($header, ',=');

        return HeaderUtils::combine($parts);
    }

}