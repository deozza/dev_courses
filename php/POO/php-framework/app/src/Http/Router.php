<?php

namespace App\Http;

use App\Controllers\AbstractController;
use App\Http\Request;

class Router {
    public function route(Request $request): Response {
        foreach(self::getConfig() as $route) {
            if(self::checkUri($request, $route) === false){
                continue;
            }
        
            if(self::checkMethod($request, $route) === false){
                continue;
            }

            $controller = self::getController($route);
            return $controller->process($request);
        }

        return new Response('Not found', 404);
    }

    private static function getConfig(): array {
        $config = json_decode(file_get_contents(__DIR__ . '/../../config/routes.json'));
        return $config;
    }

    private static function checkMethod(Request $request, object $route): bool {
        return in_array($request->getMethod(), $route->methods);
    }

    private static function checkUri(Request $request, object $route): bool {
        return $route->path === $request->getUri();
    }

    private static function getController(object $route): AbstractController {
        $controllerNamespace = "App\\Controllers\\" . $route->controller;

        if(self::checkClassExists($controllerNamespace) === false){
            throw new \Exception("Controller not found");
        }

        $controller = new $controllerNamespace();

        if(self::checkControllerInstance($controller) === false){
            throw new \Exception("Controller not found");
        }

        return new $controllerNamespace();
    }

    private static function checkClassExists(string $controllerNamespace): bool {
        return class_exists($controllerNamespace);
    }

    private static function checkControllerInstance(AbstractController $controller): bool {
        return $controller instanceof AbstractController;
    }
}