<?php
$page_title = 'Operations';
$page_description = 'The SCIM REST operations: create, read, replace, delete, update, search, and bulk.';
require(__DIR__.'/../../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/protocol/">Protocol</a></li>
      <li>Operations</li>
    </ol>
  </nav>

  <h2>Operations</h2>

  <p class="lede">
    A rich but simple set of operations, from patching one attribute to bulk updates.
  </p>

  <p>
    For manipulation of resources, SCIM provides a REST API with a rich but simple set of
    operations, which support everything from patching a specific attribute on a specific
    user to doing massive bulk updates:
  </p>

  <div class="table-wrap">
    <table class="data">
      <thead>
        <tr>
          <th scope="col">Operation</th>
          <th scope="col">Method</th>
          <th scope="col">Path</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><b>Create</b></td>
          <td><code>POST</code></td>
          <td><code>https://example.com/{v}/{resource}</code></td>
        </tr>
        <tr>
          <td><b>Read</b></td>
          <td><code>GET</code></td>
          <td><code>https://example.com/{v}/{resource}/{id}</code></td>
        </tr>
        <tr>
          <td><b>Replace</b></td>
          <td><code>PUT</code></td>
          <td><code>https://example.com/{v}/{resource}/{id}</code></td>
        </tr>
        <tr>
          <td><b>Delete</b></td>
          <td><code>DELETE</code></td>
          <td><code>https://example.com/{v}/{resource}/{id}</code></td>
        </tr>
        <tr>
          <td><b>Update</b></td>
          <td><code>PATCH</code></td>
          <td><code>https://example.com/{v}/{resource}/{id}</code></td>
        </tr>
        <tr>
          <td><b>Search</b></td>
          <td><code>GET</code></td>
          <td><code>https://example.com/{v}/{resource}?filter={attribute}{op}{value}&amp;sortBy={attributeName}&amp;sortOrder={ascending|descending}</code></td>
        </tr>
        <tr>
          <td><b>Bulk</b></td>
          <td><code>POST</code></td>
          <td><code>https://example.com/{v}/Bulk</code></td>
        </tr>
      </tbody>
    </table>
  </div>

  <h3>Filtering and sorting</h3>

  <p>
    In addition to getting single resources it is possible to fetch sets of resources by
    querying the resource endpoint without the <code>id</code> of a specific resource.
    Typically a fetch request will include a filter to be applied to the resources. SCIM has
    support for the filter operations equals, contains, starts with, and more.
  </p>

  <p>
    In addition to filtering the response it is also possible to ask the service provider to
    sort the resources in the response, return specific attributes of the resources, and
    return only a subset of the resources.
  </p>

  <?php code_block(<<<'TEXT'
https://example.com/{resource}?filter={attribute} {op} {value}&sortBy={attributeName}&sortOrder={ascending|descending}&attributes={attributes}

https://example.com/Users?filter=title pr and userType eq "Employee"&sortBy=title&sortOrder=ascending&attributes=title,username
TEXT, 'text', 'Filter query syntax') ?>

  <div class="callout">
    <strong class="callout-label">See it in context</strong>
    <p>
      <a href="/protocol/examples/">Examples</a> shows complete create, get, and filter
      request/response pairs including headers.
    </p>
  </div>

  <div class="link-grid">
    <a href="/protocol/discovery/" class="link-chip">
      Discovery
      <span class="chip-note">Next &rarr;</span>
    </a>
  </div>

</div>

<?php require(__DIR__.'/../../../includes/_footer.php') ?>
