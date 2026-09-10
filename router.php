<?php
/**
 * Routing shim for PHP's built-in dev server:
 *
 *   php -S 127.0.0.1:8080 -t public router.php
 *
 * The built-in server treats any path segment containing a dot as a file
 * request, so /implementations/2.0/ would 404 without this. Real deployments
 * serve public/ directly and never load this file.
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__.'/public'.$path;

// Serve existing static files as-is.
if($path !== '/' && is_file($file)) {
  return false;
}

// Directory (with or without a trailing slash) containing an index.php.
foreach([rtrim($file, '/').'/index.php', $file.'/index.php'] as $candidate) {
  if(is_file($candidate)) {
    require($candidate);
    return true;
  }
}

http_response_code(404);
echo '404 Not Found';
return true;
