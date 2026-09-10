<?php require_once(__DIR__.'/_functions.php') ?>
<nav class="site-sidebar-nav" aria-label="Site navigation">

  <a href="/" class="sidebar-link<?= sidebar_active('/') ?>">Home</a>

  <span class="sidebar-divider">Overview</span>
  <a href="/overview/" class="sidebar-link<?= sidebar_active('/overview/') ?>">Introduction</a>
  <a href="/overview/model/" class="sidebar-link<?= sidebar_active('/overview/model/') ?>">Object Model</a>
  <details<?= section_open(['/overview/schema']) ?>>
    <summary class="sidebar-summary">Schema</summary>
    <ul class="sidebar-sub">
      <li><a href="/overview/schema/" class="sidebar-sublink<?= sidebar_active('/overview/schema/') ?>">Overview</a></li>
      <li><a href="/overview/schema/user/" class="sidebar-sublink<?= sidebar_active('/overview/schema/user/') ?>">Example User</a></li>
      <li><a href="/overview/schema/group/" class="sidebar-sublink<?= sidebar_active('/overview/schema/group/') ?>">Example Group</a></li>
    </ul>
  </details>

  <span class="sidebar-divider">Protocol</span>
  <a href="/protocol/" class="sidebar-link<?= sidebar_active('/protocol/') ?>">Overview</a>
  <a href="/protocol/operations/" class="sidebar-link<?= sidebar_active('/protocol/operations/') ?>">Operations</a>
  <a href="/protocol/discovery/" class="sidebar-link<?= sidebar_active('/protocol/discovery/') ?>">Discovery</a>
  <a href="/protocol/examples/" class="sidebar-link<?= sidebar_active('/protocol/examples/') ?>">Examples</a>

  <span class="sidebar-divider">Reference</span>
  <a href="/specs/" class="sidebar-link<?= sidebar_active('/specs/') ?>">Specifications</a>
  <details<?= section_open(['/implementations']) ?>>
    <summary class="sidebar-summary">Implementations</summary>
    <ul class="sidebar-sub">
      <li><a href="/implementations/" class="sidebar-sublink<?= sidebar_active('/implementations/') ?>">Overview</a></li>
      <li><a href="/implementations/2.0/" class="sidebar-sublink<?= sidebar_active('/implementations/2.0/') ?>">SCIM 2.0</a></li>
      <li><a href="/implementations/1.1/" class="sidebar-sublink<?= sidebar_active('/implementations/1.1/') ?>">SCIM 1.1</a></li>
    </ul>
  </details>

  <span class="sidebar-divider">About</span>
  <a href="/resources/" class="sidebar-link<?= sidebar_active('/resources/') ?>">Resources</a>

</nav>
