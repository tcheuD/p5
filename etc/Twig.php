<?php

namespace Core;

class Twig
{
    public function getTwig($request)
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../templates');

        $twig = new \Twig_Environment($loader, array('debug' => true));
        $twig->addGlobal('request', $request);
        $twig->addGlobal('session', $request->getSession());
        $twig->addExtension(new \Twig_Extension_Debug());

        return $twig;
    }
}
