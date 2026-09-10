<?php

function e($t) {
  return htmlspecialchars((string)$t, ENT_QUOTES, 'UTF-8');
}

function current_path() {
  return parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
}

// Prefix match — highlights a whole section.
function nav_active($prefix) {
  return strpos(current_path(), $prefix) === 0 ? ' active' : '';
}

// Exact match — highlights a single leaf page.
function sidebar_active($path) {
  return rtrim(current_path(), '/') === rtrim($path, '/') ? ' active' : '';
}

// Auto-expands a <details> group when the current page lives under one of its prefixes.
function section_open(array $prefixes) {
  $path = current_path();
  foreach($prefixes as $prefix) {
    if(strpos($path, $prefix) === 0) return ' open';
  }
  return '';
}

// Cache-busting query string based on the file's mtime, so it never needs bumping by hand.
function asset($path) {
  $file = __DIR__.'/../public'.$path;
  return file_exists($file) ? $path.'?v='.filemtime($file) : $path;
}
