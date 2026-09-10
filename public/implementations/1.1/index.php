<?php
require(__DIR__.'/../../../includes/implementations.php');

$implementations = load_implementations('1');

$page_title = 'SCIM 1.1 Implementations';
$page_description = 'A searchable list of '.count($implementations).' known SCIM 1.1 implementations — clients, servers, and libraries.';
$page_scripts = ['/script/implementations-filter.js'];
require(__DIR__.'/../../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/implementations/">Implementations</a></li>
      <li>SCIM 1.1</li>
    </ol>
  </nav>

  <h2>SCIM 1.1 Implementations</h2>

  <div class="page-meta">
    <span class="status status--draft">Pre-IETF</span>
  </div>

  <p class="lede">
    <?= count($implementations) ?> known implementations of SCIM 1.1.
  </p>

  <p>
    SCIM 1.1 predates the IETF standardization work. New deployments should target
    <a href="/implementations/2.0/">SCIM 2.0</a>.
  </p>

  <?php render_implementations($implementations, '1') ?>

  <?php render_implementations_contribute() ?>

</div>

<?php require(__DIR__.'/../../../includes/_footer.php') ?>
