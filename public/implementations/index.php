<?php
require(__DIR__.'/../../includes/implementations.php');

$v2 = load_implementations('2');
$v1 = load_implementations('1');

$page_title = 'Implementations';
$page_description = 'Known SCIM implementations — clients, servers, and libraries — for SCIM 2.0 and SCIM 1.1.';
require(__DIR__.'/../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li>Implementations</li>
    </ol>
  </nav>

  <h2>Implementations</h2>

  <p class="lede">
    <?= count($v2) + count($v1) ?> known SCIM clients, servers, and libraries.
  </p>

  <p>
    These lists are community-maintained. A <b>client</b> initiates provisioning requests; a
    <b>server</b> (a service provider, in the language of the specification) receives them.
    Many projects act as both.
  </p>

  <div class="grid grid--2">
    <a href="/implementations/2.0/" class="entry-card">
      <div class="entry-text">
        <div class="entry-title">SCIM 2.0</div>
        <p class="entry-desc">
          <?= count($v2) ?> implementations of the current standard,
          RFC 7643 and RFC 7644.
        </p>
      </div>
      <span class="entry-arrow" aria-hidden="true">&rarr;</span>
    </a>
    <a href="/implementations/1.1/" class="entry-card">
      <div class="entry-text">
        <div class="entry-title">SCIM 1.1</div>
        <p class="entry-desc">
          <?= count($v1) ?> implementations of the pre-IETF 1.1 specification.
        </p>
      </div>
      <span class="entry-arrow" aria-hidden="true">&rarr;</span>
    </a>
  </div>

  <h3>Contributing</h3>

  <?php render_implementations_contribute() ?>

</div>

<?php require(__DIR__.'/../../includes/_footer.php') ?>
