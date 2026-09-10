<?php
/**
 * Loading and rendering of the SCIM implementation lists.
 *
 * The data lives in public/json/scim_v{1,2}_implementations.json. Rows are
 * rendered server-side; the search/filter/sort UI is layered on top by
 * public/script/implementations-filter.js and degrades to a plain table.
 */

require_once(__DIR__.'/_functions.php');

/**
 * @param string $version '1' or '2'.
 * @return array Entries sorted case-insensitively by project name.
 */
function load_implementations($version) {
  $file = __DIR__.'/../public/json/scim_v'.$version.'_implementations.json';
  $data = json_decode(file_get_contents($file), true);

  if(!is_array($data) || !isset($data['implementations'])) {
    return [];
  }

  $implementations = $data['implementations'];
  usort($implementations, function($a, $b) {
    return strcmp(strtolower($a['project_name']), strtolower($b['project_name']));
  });

  return $implementations;
}

function render_implementations(array $implementations, $version) {
  $count = count($implementations);
  $label = 'SCIM '.($version === '2' ? '2.0' : '1.1');
?>
<div class="impl-controls">
  <input type="search" class="impl-search" id="impl-search"
         placeholder="Search <?= $count ?> <?= e($label) ?> implementations&hellip;"
         aria-label="Search implementations" autocomplete="off">
  <button type="button" class="impl-filter" data-filter="client" aria-pressed="false">Client</button>
  <button type="button" class="impl-filter" data-filter="server" aria-pressed="false">Server</button>
  <button type="button" class="impl-filter" data-filter="oss" aria-pressed="false">Open source</button>
</div>

<p class="impl-count" id="impl-count" data-total="<?= $count ?>" aria-live="polite">
  <?= $count ?> implementations
</p>

<div class="table-wrap">
  <table class="data" id="impl-table">
    <thead>
      <tr>
        <th scope="col" class="sortable" data-sort="name" aria-sort="ascending">Project</th>
        <th scope="col" class="sortable" data-sort="client">Client</th>
        <th scope="col" class="sortable" data-sort="server">Server</th>
        <th scope="col" class="sortable" data-sort="license">License</th>
        <th scope="col" class="sortable" data-sort="developer">Developer</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($implementations as $im): ?>
      <?php
        $isClient = ($im['client'] ?? 'No') === 'Yes';
        $isServer = ($im['server'] ?? 'No') === 'Yes';
        $oss      = $im['open_source'] ?? 'No';
        $license  = $im['license'] ?? '';
      ?>
      <tr data-client="<?= $isClient ? '1' : '0' ?>"
          data-server="<?= $isServer ? '1' : '0' ?>"
          data-oss="<?= $oss === 'No' ? '0' : '1' ?>"
          data-name="<?= e(strtolower($im['project_name'])) ?>"
          data-developer="<?= e(strtolower($im['developer'])) ?>"
          data-license="<?= e(strtolower($license)) ?>">
        <td><a href="<?= e($im['link']) ?>"><?= e($im['project_name']) ?></a></td>
        <td><?= $isClient ? '<span class="yes" title="Yes">&check;</span>' : '<span class="no" title="No">&ndash;</span>' ?></td>
        <td><?= $isServer ? '<span class="yes" title="Yes">&check;</span>' : '<span class="no" title="No">&ndash;</span>' ?></td>
        <td>
          <?php if($oss === 'No'): ?>
            <span class="no">&ndash;</span>
          <?php else: ?>
            <?php if($license !== ''): ?>
              <span class="license-pill"><?= e($license) ?></span>
            <?php else: ?>
              <span class="license-pill">Open source</span>
            <?php endif ?>
            <?php if($oss === 'Partial'): ?>
              <span class="status status--draft">Partial</span>
            <?php endif ?>
          <?php endif ?>
        </td>
        <td><?= e($im['developer']) ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <p class="impl-empty" id="impl-empty" hidden>No implementations match those filters.</p>
</div>
<?php
}

/** Shared "how to get listed" block, used on all three implementation pages. */
function render_implementations_contribute() {
?>
<div class="callout">
  <strong class="callout-label">Know of an implementation that should be listed?</strong>
  <p>
    Submit a pull request to the
    <a href="https://github.com/aaronpk/scim.cloud">GitHub repository</a>, or join the
    <a href="https://datatracker.ietf.org/wg/scim/about/">IETF SCIM mailing list</a> and send an
    <a href="mailto:scim@ietf.org?subject=New%20SCIM%20implementation&amp;body=Project%20name:%0D%0AClient:%0D%0AServer:%0D%0AOpen%20Source:%0D%0ALicense:%0D%0ADeveloper:%0D%0AURL:%0D%0ASCIM%20version:">email</a>
    with the project name, whether it acts as a client and/or server, its license, the developer,
    a URL, and whether it implements SCIM 1.1 or SCIM 2.0.
  </p>
</div>
<?php
}
