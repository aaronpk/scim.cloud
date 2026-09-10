<?php
$page_title = 'Discovery';
$page_description = 'SCIM provides three endpoints for discovering supported features and attribute details: /ServiceProviderConfig, /ResourceTypes, and /Schemas.';
require(__DIR__.'/../../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/protocol/">Protocol</a></li>
      <li>Discovery</li>
    </ol>
  </nav>

  <h2>Discovery</h2>

  <p class="lede">
    Three endpoints let a client learn what a server supports, at runtime.
  </p>

  <p>
    To simplify interoperability, SCIM provides three endpoints to discover supported
    features and specific attribute details. A client can adapt to a given service provider
    rather than hard-coding assumptions about it.
  </p>

  <dl class="terminology">
    <dt>GET /ServiceProviderConfig</dt>
    <dd>
      Specification compliance, authentication schemes, and data models. This is where you
      learn whether the server supports <code>PATCH</code>, bulk operations, filtering,
      sorting, and ETags, along with any limits on those.
    </dd>

    <dt>GET /ResourceTypes</dt>
    <dd>
      An endpoint used to discover the types of resources available &mdash; typically
      <code>User</code> and <code>Group</code>, but a server may expose more &mdash; along
      with each one's endpoint and schema URIs.
    </dd>

    <dt>GET /Schemas</dt>
    <dd>
      Introspect resources and attribute extensions. Returns the full attribute definitions:
      names, types, mutability, uniqueness, and whether each is required or multi-valued.
    </dd>
  </dl>

  <?php code_block(<<<'TEXT'
GET /v2/ServiceProviderConfig HTTP/1.1
Host: example.com
Accept: application/scim+json
TEXT, 'http', 'Discovering server capabilities') ?>

  <div class="callout">
    <strong class="callout-label">Extensions advertise themselves here</strong>
    <p>
      Later RFCs add their own attributes to <code>/ServiceProviderConfig</code>, so this is
      where a client discovers optional capabilities:
      <a href="/extensions/cursor-pagination/">RFC 9865</a> adds <code>pagination</code> to describe
      cursor and index paging support, and <a href="/extensions/events/">RFC 9967</a> adds
      <code>securityEvents</code> to describe asynchronous event support.
    </p>
  </div>

  <div class="callout callout--muted">
    <strong class="callout-label">Note</strong>
    <p>
      These three endpoints are read-only, and
      <a href="https://www.rfc-editor.org/rfc/rfc7644" class="rfc-badge">RFC 7644</a>
      allows them to be served without authentication so that a client can discover a
      server's capabilities before provisioning credentials.
    </p>
  </div>

  <div class="link-grid">
    <a href="/protocol/examples/" class="link-chip">
      Examples
      <span class="chip-note">Next &rarr;</span>
    </a>
  </div>

</div>

<?php require(__DIR__.'/../../../includes/_footer.php') ?>
