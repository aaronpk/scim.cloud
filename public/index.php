<?php
require(__DIR__.'/../includes/implementations.php');

$v2_count = count(load_implementations('2'));
$v1_count = count(load_implementations('1'));

$page_title = null; // use the default site title on the home page
$page_description = 'SCIM is an open standard for automating the exchange of user identity information between identity domains and IT systems. Published by the IETF as RFC 7642, RFC 7643, and RFC 7644.';
require(__DIR__.'/../includes/_header.php');
?>

<div class="container">

  <div class="home-hero">
    <img src="/img/logo/SCIM_B-and-W_400x136.png" width="400" height="136" alt="SCIM" class="art-invert">
    <h1>System for Cross-domain Identity Management</h1>
    <p class="lede">
      SCIM is an open standard for automating the exchange of user identity information
      between identity domains and IT systems. It defines a common schema for users and
      groups, and a REST protocol for managing them &mdash; so moving users into, out of,
      and around the cloud is fast, cheap, and easy.
    </p>
  </div>

  <div class="stat-row">
    <div class="stat">
      <div class="stat-value">6</div>
      <div class="stat-label">IETF RFCs</div>
    </div>
    <div class="stat">
      <div class="stat-value"><?= $v2_count ?></div>
      <div class="stat-label">SCIM 2.0 implementations</div>
    </div>
    <div class="stat">
      <div class="stat-value"><?= $v1_count ?></div>
      <div class="stat-label">SCIM 1.1 implementations</div>
    </div>
  </div>

  <p class="eyebrow">Start here</p>

  <div class="grid grid--2">
    <a href="/overview/" class="entry-card">
      <div class="entry-text">
        <div class="entry-title">Introduction</div>
        <p class="entry-desc">
          What SCIM is, the problem it solves, and how the specifications fit together.
        </p>
      </div>
      <span class="entry-arrow" aria-hidden="true">&rarr;</span>
    </a>
    <a href="/schema/" class="entry-card">
      <div class="entry-text">
        <div class="entry-title">Schema</div>
        <p class="entry-desc">
          The Resource, User, Group, and Enterprise User schemas, with worked examples.
        </p>
      </div>
      <span class="entry-arrow" aria-hidden="true">&rarr;</span>
    </a>
    <a href="/protocol/" class="entry-card">
      <div class="entry-text">
        <div class="entry-title">Protocol</div>
        <p class="entry-desc">
          The REST operations, discovery endpoints, and request/response examples.
        </p>
      </div>
      <span class="entry-arrow" aria-hidden="true">&rarr;</span>
    </a>
    <a href="/specs/" class="entry-card">
      <div class="entry-text">
        <div class="entry-title">Specifications</div>
        <p class="entry-desc">
          The SCIM 2.0 RFCs, related drafts, and the archived SCIM 1.1 and 1.0 documents.
        </p>
      </div>
      <span class="entry-arrow" aria-hidden="true">&rarr;</span>
    </a>
    <a href="/implementations/" class="entry-card">
      <div class="entry-text">
        <div class="entry-title">Implementations</div>
        <p class="entry-desc">
          <?= $v2_count + $v1_count ?> known clients and servers, searchable by role and license.
        </p>
      </div>
      <span class="entry-arrow" aria-hidden="true">&rarr;</span>
    </a>
    <a href="/resources/" class="entry-card">
      <div class="entry-text">
        <div class="entry-title">Resources</div>
        <p class="entry-desc">
          Logo downloads, the working group mailing list, and how to contribute.
        </p>
      </div>
      <span class="entry-arrow" aria-hidden="true">&rarr;</span>
    </a>
  </div>

</div>

<script>
// This site used to be a single page with #hash anchors. Keep those links working.
(function() {
  var map = {
    '#Overview':         '/overview/',
    '#Specification':    '/specs/',
    '#Resources':        '/resources/',
    '#Implementations1': '/implementations/1.1/',
    '#Implementations2': '/implementations/2.0/'
  };
  var target = map[window.location.hash];
  if(target) window.location.replace(target);
})();
</script>

<?php require(__DIR__.'/../includes/_footer.php') ?>
