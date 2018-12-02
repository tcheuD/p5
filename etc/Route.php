<?php

namespace Core;

class Route
{
    private $path;
    private $action;
    private $param;
    private $uri;
    private $methods = [];

    public function __construct($path, $action, $param, $uri, $methods = [])
    {
        $this->setPath($path);
        $this->setAction($action);
        $this->setUri($uri);
        $this->setParam($param, $uri);
        $this->methods = $methods;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParam()
    {
        return $this->param;
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    public function setParam($param, $uri)
    {
        $this->param = $param ?? [];
        if ($this->param) {
            $result = [];
            foreach ($param as $key => $regex) {
                    preg_match('#'.$regex.'$#', $uri, $result);
                if ($result) {
                    $path = strtr($this->path, ['{'.$key.'}' => $result[0]]);

                        $this->path = $path;
                        $this->param = $result[0];
                    } else {
                        return null;
                    }
                }
            }
        }
}