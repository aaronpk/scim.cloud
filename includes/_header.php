<?php
require_once(__DIR__.'/_functions.php');
require_once(__DIR__.'/_code.php');

$title = !empty($page_title) ? $page_title.' — SCIM' : 'SCIM: System for Cross-domain Identity Management';
$description = !empty($page_description)
  ? $page_description
  : 'SCIM is an open standard for automating the exchange of user identity information between identity domains and IT systems.';
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title) ?></title>
  <meta name="description" content="<?= e($description) ?>">

  <meta property="og:type" content="website">
  <meta property="og:site_name" content="scim.cloud">
  <meta property="og:title" content="<?= e($title) ?>">
  <meta property="og:description" content="<?= e($description) ?>">
  <meta property="og:image" content="https://scim.cloud/img/logo/SCIM_B-and-W_792x270.png">
  <meta name="twitter:card" content="summary">

  <link rel="icon" href="/img/logo/SCIM_B-and-W_48x16.png" type="image/png">
  <link rel="stylesheet" href="<?= e(asset('/stylesheets/style.css')) ?>">

  <script>
    // Runs before first paint so the correct theme is applied with no flash.
    (function() {
      var saved = localStorage.getItem('theme');
      var prefDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
      document.documentElement.setAttribute('data-theme', saved || (prefDark ? 'dark' : 'light'));
    })();
  </script>
<?php if(($_SERVER['SERVER_NAME'] ?? '') == 'scim.cloud'): ?>
  <script src="https://cdn.usefathom.com/script.js" data-site="TWSTXBKQ" defer></script>
<?php endif ?>
</head>
<body>

<div class="site-topbar">
  <a href="/" class="topbar-brand">
    <img src="/img/logo/SCIM_B-and-W_72x24.png" width="60" height="20" alt="">
    scim.cloud
  </a>
  <div class="topbar-actions">
    <button class="theme-toggle" id="theme-toggle" aria-label="Toggle dark/light theme" title="Toggle theme">
      <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <circle cx="12" cy="12" r="5"></circle>
        <line x1="12" y1="1" x2="12" y2="3"></line>
        <line x1="12" y1="21" x2="12" y2="23"></line>
        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
        <line x1="1" y1="12" x2="3" y2="12"></line>
        <line x1="21" y1="12" x2="23" y2="12"></line>
        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
      </svg>
      <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
      </svg>
    </button>
    <button class="sidebar-toggle" id="sidebar-toggle" aria-label="Toggle navigation" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</div>

<div class="site-layout">
  <aside class="site-sidebar" id="site-sidebar">
    <?php require(__DIR__.'/_sidebar.php') ?>
  </aside>
  <div class="site-overlay" id="site-overlay"></div>
  <main class="site-main">
