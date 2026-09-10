<?php
$page_title = 'Resources';
$page_description = 'SCIM logo downloads, the IETF working group mailing list, and how to contribute to scim.cloud.';
require(__DIR__.'/../../includes/_header.php');

$logos = [
  'Vector' => [
    ['/img/logo/8.27.13_SCIM_Logo_Gang-up.eps', 'EPS', 'All logos, vector'],
    ['/img/logo/8.27.13 SCIM Logo Gang-up.pdf', 'PDF', 'All logos, vector'],
  ],
  'PNG' => [
    ['/img/logo/SCIM_B-and-W_48x16.png', 'PNG 48×16', 'Black and white'],
    ['/img/logo/SCIM_White_48x16.png', 'PNG 48×16', 'White'],
    ['/img/logo/SCIM_Box_Version_B-and-W_68x24.png', 'PNG 68×24', 'Boxed, black and white'],
    ['/img/logo/SCIM_B-and-W_72x24.png', 'PNG 72×24', 'Black and white'],
    ['/img/logo/SCIM_B-and-W_400x136.png', 'PNG 400×136', 'Black and white'],
    ['/img/logo/SCIM_B-and-W_792x270.png', 'PNG 792×270', 'Black and white'],
  ],
  'GIF' => [
    ['/img/logo/SCIM_B-and-W_48x16.gif', 'GIF 48×16', 'Black and white'],
    ['/img/logo/SCIM_White_48x16.gif', 'GIF 48×16', 'White'],
    ['/img/logo/SCIM_Box_Version_B-and-W_68x24.gif', 'GIF 68×24', 'Boxed, black and white'],
    ['/img/logo/SCIM_B-and-W_72x24.gif', 'GIF 72×24', 'Black and white'],
  ],
  'JPG' => [
    ['/img/logo/SCIM_B-and-W_792x270.jpg', 'JPG 792×270', 'Black and white'],
  ],
];
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li>Resources</li>
    </ol>
  </nav>

  <h2>Resources</h2>

  <p class="lede">
    Logo downloads, the working group, and how to contribute.
  </p>

  <h3>Working group</h3>

  <p>
    SCIM is developed in the IETF SCIM working group. Discussion happens on the working group
    mailing list, which is open to anyone.
  </p>

  <div class="link-grid">
    <a href="https://datatracker.ietf.org/wg/scim/about/" class="link-chip">
      SCIM working group
      <span class="chip-note">datatracker.ietf.org</span>
    </a>
    <a href="https://mailarchive.ietf.org/arch/browse/scim/" class="link-chip">
      Mailing list archive
      <span class="chip-note">mailarchive.ietf.org</span>
    </a>
  </div>

  <h3>Contributing to this site</h3>

  <p>
    scim.cloud is open source. The implementation lists in particular are
    community-maintained &mdash; if a project is missing or out of date, a pull request is the
    fastest way to fix it.
  </p>

  <div class="link-grid">
    <a href="https://github.com/aaronpk/scim.cloud" class="link-chip">
      GitHub repository
      <span class="chip-note">github.com/aaronpk/scim.cloud</span>
    </a>
    <a href="/implementations/" class="link-chip">
      Add an implementation
      <span class="chip-note">How to get listed</span>
    </a>
  </div>

  <h3>Logo</h3>

  <p>
    The SCIM logo is available in vector and raster formats. The artwork is black and white;
    the white variants are intended for use on dark backgrounds.
  </p>

  <figure class="figure">
    <img src="/img/logo/SCIM_B-and-W_400x136.png" width="400" height="136" alt="The SCIM logo" class="art-invert" style="width: 260px;">
  </figure>

  <?php foreach($logos as $group => $files): ?>
    <h4><?= e($group) ?></h4>
    <div class="link-grid">
      <?php foreach($files as list($href, $name, $note)): ?>
        <a href="<?= e($href) ?>" class="link-chip">
          <?= e($name) ?>
          <span class="chip-note"><?= e($note) ?></span>
        </a>
      <?php endforeach ?>
    </div>
  <?php endforeach ?>

</div>

<?php require(__DIR__.'/../../includes/_footer.php') ?>
