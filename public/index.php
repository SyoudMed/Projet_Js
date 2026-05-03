<?php
session_start();

// Simple Autoloader
spl_autoload_register(function ($class_name) {
    // Map namespaces to directories: App -> app, Config -> config
    $prefix = explode('\\', $class_name)[0];
    if ($prefix === 'App') {
        $class_name = preg_replace('/^App\\\\/', 'app/', $class_name);
    } elseif ($prefix === 'Config') {
        $class_name = preg_replace('/^Config\\\\/', 'config/', $class_name);
    }
    
    $file = __DIR__ . '/../' . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Simple router
$request = $_SERVER['REQUEST_URI'];
$request = strtok($request, '?');

// Remove base path depending on environment
$base_path = '/js_project/public';
if (strpos($request, $base_path) === 0) {
    $request = substr($request, strlen($base_path));
}

if ($request === '' || $request === '/') {
    // Default route
    require __DIR__ . '/../app/Controllers/HomeController.php';
    $controller = new \App\Controllers\HomeController();
    $controller->index();
} else {
    // Basic routing: /controller/method
    $parts = explode('/', trim($request, '/'));
    $controllerName = ucfirst($parts[0]) . 'Controller';
    $methodName = isset($parts[1]) && $parts[1] !== '' ? $parts[1] : 'index';
    
    $controllerFile = __DIR__ . '/../app/Controllers/' . $controllerName . '.php';
    
    if (file_exists($controllerFile)) {
        require $controllerFile;
        $class = '\\App\\Controllers\\' . $controllerName;
        $controller = new $class();
        
        if (method_exists($controller, $methodName)) {
            $controller->$methodName();
        } else {
            http_response_code(404);
            echo "<h1>404 Not Found</h1><p>Method $methodName not found in $controllerName.</p>";
        }
    } else {
        http_response_code(404);
        echo "<h1>404 Not Found</h1><p>Controller $controllerName not found.</p>";
    }
}
