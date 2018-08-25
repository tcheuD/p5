<?php

namespace Core;

class Route
{
    private $path;
    private $action;
    private $param;

    public function __construct($path, $action)
    {
        $this->setPath($path);
        $this->setAction($action);
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

    public function setParam($param)
    {
        $this->param = $param;
        $path = $this->getPath();

        if ($this->param) {
            $result = [];

            foreach ($param as $key => $regex) {
                if (!is_null($regex)) {
                    preg_match('#' . $regex . '$#', $path, $result);
                    if ($result) {
                        $path = strtr($this->path, ['{' . $key . '}' => $result[0]]);

                        $this->path = $path;
                        print_r($path);
                        $this->param = $result;
                        var_dump($result);
                    } else {
                        return null;
                    }
                }

            }
        }
    }

    public function match($uri)
    {
            $path = $this->getPath();
                preg_match('#' . $path . '$#', $uri, $result);
                if ($result) {
                    array_shift($result);
                    $this->setParam($result);
                } else {
                    return null;
                }
            }
}