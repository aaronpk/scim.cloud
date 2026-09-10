<?php
require(__DIR__.'/../../../includes/implementations.php');

$implementations = load_implementations('2');

$page_title = 'SCIM 2.0 Implementations';
$page_description = 'A searchable list of '.count($implementations).' known SCIM 2.0 implementations — clients, servers, and libraries.';
$page_scripts = ['/script/implementations-filter.js'];
require(__DIR__.'/../../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/implementations/">Implementations</a></li>
      <li>SCIM 2.0</li>
    </ol>
  </nav>

  <h2>SCIM 2.0 Implementations</h2>

  <div class="page-meta">
    <a href="https://www.rfc-editor.org/rfc/rfc7643" class="rfc-badge">RFC 7643</a>
    <a href="https://www.rfc-editor.org/rfc/rfc7644" class="rfc-badge">RFC 7644</a>
    <span class="status status--published">Current</span>
  </div>

  <p class="lede">
    <?= count($implementations) ?> known implementations of SCIM 2.0.
  </p>

  <?php render_implementations($implementations, '2') ?>

  <?php render_implementations_contribute() ?>

</div>

<?php require(__DIR__.'/../../../includes/_footer.php') ?>
