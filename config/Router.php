<?php
require __DIR__.'./actionResolver.php';

function handleRequest(array $request) {
    $routes = require __DIR__.'./routes.php';

    foreach ($routes as $key => $value) {
        switch ($value) {/*
            case $value['path'] === $request['REQUEST_URI'] && in_array($_SERVER['REQUEST_METHOD'], $value['method']):
                resolveAction($value['action']);
                break;*/
            case in_array($_SERVER['REQUEST_METHOD'], $value['method']):
                $params = catchParams($value['params'] ?? [], $request['REQUEST_URI'], $value['path']);
                if ($value['path'] === $request['REQUEST_URI'] && in_array($_SERVER['REQUEST_METHOD'], $value['method'])) {
                    resolveAction($value['action'], $params ?? []);
                }
                break;
        }
    }
}

function catchParams(array $params, string $path, string &$routePath) {
 // PARAMROUTER SERVERURL ROUTEPATH
    $result = [];
    foreach ($params as $key => $regex) {
        preg_match('#'.$regex.'$#', $path, $result);
        if ($result) {
            $routePath = strtr($routePath, ['{'.$key.'}' => $result[0]]);

            return $result;
        } else {
            return null;
        }


    }
}


/*
require __DIR__.'./actionResolver.php';

function handleRequest(array $request){
    $routes = require __DIR__.'./routes.php';

    var_dump($request['REQUEST_URI']);

    foreach ($routes as $key => $value){
        switch ($value){

            case $value['path'] === $request['REQUEST_URI'] && in_array($_SERVER['REQUEST_METHOD'], $value['method']):
                resolveAction($value['action']);

                break;

            case in_array($_SERVER['REQUEST_METHOD'], array([$value['method']]));
                if ($value['path'] === $request['REQUEST_URI'] && in_array($_SERVER['REQUEST_METHOD'], $value['method'])) {
                    $params = catchParams($value['params']/* ?? [], $request['REQUEST_URI'], $value['path']);
                    resolveAction($value['action'], $params);
                }
                break;
        }
    }
}
function catchParams(array $params, string $path, string &$routePath) {

    $result = [];

    foreach ($params as $key => $regex) {
        preg_match('#'.$regex.'#', $path, $result);
        if (\is_null($result)) {
            echo "is null";
        }

        $routePath = strtr($routePath, ['{'.$key.'}' => $result[0]]);

        return $result;
    }
}

*/