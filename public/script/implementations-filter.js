/**
 * Search, filter, and sort for the implementation tables.
 *
 * Operates on server-rendered rows — without this script the full sorted table
 * is still there, just without the controls.
 */
(function() {
  var table  = document.getElementById('impl-table');
  var search = document.getElementById('impl-search');
  var count  = document.getElementById('impl-count');
  var empty  = document.getElementById('impl-empty');
  if(!table || !search || !count) return;

  var tbody   = table.tBodies[0];
  var rows    = Array.prototype.slice.call(tbody.rows);
  var total   = rows.length;
  var filters = document.querySelectorAll('.impl-filter');
  var active  = { client: false, server: false, oss: false };

  function apply() {
    var q = search.value.trim().toLowerCase();
    var shown = 0;

    rows.forEach(function(row) {
      var matchesQuery = !q
        || row.dataset.name.indexOf(q) !== -1
        || row.dataset.developer.indexOf(q) !== -1
        || row.dataset.license.indexOf(q) !== -1;

      var matchesFilters =
           (!active.client || row.dataset.client === '1')
        && (!active.server || row.dataset.server === '1')
        && (!active.oss    || row.dataset.oss === '1');

      var visible = matchesQuery && matchesFilters;
      row.hidden = !visible;
      if(visible) shown++;
    });

    count.textContent = shown === total
      ? total + ' implementations'
      : total + ' implementations · showing ' + shown;

    if(empty) empty.hidden = shown !== 0;
    table.hidden = shown === 0;
  }

  search.addEventListener('input', apply);

  filters.forEach(function(btn) {
    btn.addEventListener('click', function() {
      var key = btn.dataset.filter;
      active[key] = !active[key];
      btn.setAttribute('aria-pressed', active[key] ? 'true' : 'false');
      apply();
    });
  });

  // Sorting. Name/developer/license sort as text; client/server as booleans,
  // with project name as the tiebreaker so the order stays stable and readable.
  var headers = table.querySelectorAll('th.sortable');

  function keyFor(row, sort) {
    switch(sort) {
      case 'client':  return row.dataset.client;
      case 'server':  return row.dataset.server;
      case 'license': return row.dataset.license;
      case 'developer': return row.dataset.developer;
      default: return row.dataset.name;
    }
  }

  headers.forEach(function(th) {
    th.addEventListener('click', function() {
      var sort = th.dataset.sort;
      var dir = th.getAttribute('aria-sort') === 'ascending' ? -1 : 1;

      headers.forEach(function(other) { other.removeAttribute('aria-sort'); });
      th.setAttribute('aria-sort', dir === 1 ? 'ascending' : 'descending');

      rows.sort(function(a, b) {
        var av = keyFor(a, sort), bv = keyFor(b, sort);
        if(av !== bv) return av < bv ? -dir : dir;
        return a.dataset.name < b.dataset.name ? -1 : 1;
      });

      rows.forEach(function(row) { tbody.appendChild(row); });
    });
  });

  apply();
})();
