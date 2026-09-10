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

$root = __DIR__.'/public';

// The request path is percent-encoded; decode it before touching the filesystem
// so names containing spaces (the logo PDF) resolve.
$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$file = $root.$path;

// Decoding can introduce "../", so confirm the target really is under public/.
$within = function($candidate) use ($root) {
  $real = realpath($candidate);
  return $real !== false && strpos($real, realpath($root).DIRECTORY_SEPARATOR) === 0;
};

// Serve existing static files as-is.
if($path !== '/' && is_file($file) && $within($file)) {
  return false;
}

// Directory (with or without a trailing slash) containing an index.php.
foreach([rtrim($file, '/').'/index.php', $file.'/index.php'] as $candidate) {
  if(is_file($candidate) && $within($candidate)) {
    require($candidate);
    return true;
  }
}

http_response_code(404);
echo '404 Not Found';
return true;
