<?php require_once(__DIR__.'/_functions.php') ?>

    <footer class="site-footer">
      <?php
        $editurl = isset($EDIT_THIS_PAGE_LINK)
          ? $EDIT_THIS_PAGE_LINK
          : 'https://github.com/aaronpk/scim.cloud/blob/main/public'.rtrim(current_path(), '/').'/index.php';
      ?>
      <div class="contribution-prompt">
        Found an error or want to add something?
        <a href="<?= e($editurl) ?>">Edit this page on GitHub &rarr;</a>
        <span class="divider">·</span>
        <a href="https://github.com/aaronpk/scim.cloud">Source</a>
      </div>
      <div class="footer-meta">
        <p>
          SCIM is developed in the
          <a href="https://datatracker.ietf.org/wg/scim/about/">IETF SCIM working group</a>.
        </p>
      </div>
    </footer>

  </main>
</div><!-- /.site-layout -->

<script>
// Theme toggle
(function() {
  var toggleBtn = document.getElementById('theme-toggle');
  if(!toggleBtn) return;

  function getTheme() {
    return document.documentElement.getAttribute('data-theme') || 'light';
  }
  function updateToggleState(theme) {
    var label = theme === 'dark' ? 'Switch to light theme' : 'Switch to dark theme';
    toggleBtn.setAttribute('aria-label', label);
    toggleBtn.setAttribute('title', label);
  }

  updateToggleState(getTheme());

  toggleBtn.addEventListener('click', function() {
    var next = getTheme() === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', next);
    try { localStorage.setItem('theme', next); } catch(e) {}
    updateToggleState(next);
  });

  if(window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
      // An explicit choice always wins, so only follow the OS if none was made.
      if(localStorage.getItem('theme')) return;
      var theme = e.matches ? 'dark' : 'light';
      document.documentElement.setAttribute('data-theme', theme);
      updateToggleState(theme);
    });
  }
})();

// Sidebar drawer
(function() {
  var toggle  = document.getElementById('sidebar-toggle');
  var sidebar = document.getElementById('site-sidebar');
  var overlay = document.getElementById('site-overlay');
  if(!toggle || !sidebar || !overlay) return;

  function open() {
    sidebar.classList.add('is-open');
    overlay.classList.add('is-open');
    toggle.setAttribute('aria-expanded', 'true');
  }
  function close() {
    sidebar.classList.remove('is-open');
    overlay.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
  }

  toggle.addEventListener('click', function() {
    sidebar.classList.contains('is-open') ? close() : open();
  });
  overlay.addEventListener('click', close);
  document.addEventListener('keydown', function(e) {
    if(e.key === 'Escape') close();
  });
})();

// Copy buttons on code blocks
(function() {
  if(!navigator.clipboard) return;

  document.querySelectorAll('.code-block').forEach(function(block) {
    var pre = block.querySelector('pre');
    if(!pre) return;

    var btn = document.createElement('button');
    btn.className = 'code-copy';
    btn.type = 'button';
    btn.textContent = 'Copy';
    btn.addEventListener('click', function() {
      navigator.clipboard.writeText(pre.innerText).then(function() {
        btn.textContent = 'Copied';
        setTimeout(function() { btn.textContent = 'Copy'; }, 1500);
      });
    });
    block.appendChild(btn);
  });
})();
</script>
<?php if(!empty($page_scripts)): foreach($page_scripts as $src): ?>
<script src="<?= e(asset($src)) ?>"></script>
<?php endforeach; endif ?>
</body>
</html>
