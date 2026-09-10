<?php
$page_title = 'Protocol';
$page_description = 'The SCIM protocol is an application-level REST protocol for provisioning and managing identity data on the web, defined in RFC 7644.';
require(__DIR__.'/../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li>Protocol</li>
    </ol>
  </nav>

  <h2>Protocol</h2>

  <div class="page-meta">
    <a href="https://www.rfc-editor.org/rfc/rfc7644" class="rfc-badge">RFC 7644</a>
    <span class="status status--published">Published</span>
    <a href="https://www.rfc-editor.org/rfc/rfc7644" class="mono-url">rfc-editor.org/rfc/rfc7644</a>
  </div>

  <p class="lede">
    An application-level REST protocol for provisioning and managing identity data on the web.
  </p>

  <p>
    For manipulation of resources, SCIM provides a REST API with a rich but simple set of
    operations, which support everything from patching a specific attribute on a specific
    user to doing massive bulk updates.
  </p>

  <h3>Conventions</h3>

  <dl class="terminology">
    <dt>Versioned base URL</dt>
    <dd>
      Endpoint paths contain a version number &mdash; <code>/v2/Users</code> &mdash; so that
      different versions of the SCIM API can co-exist. The versions a given server supports
      can be discovered at runtime through the
      <a href="/protocol/discovery/"><code>/ServiceProviderConfig</code></a> endpoint.
    </dd>

    <dt>Media type</dt>
    <dd>
      SCIM defines <code>application/scim+json</code>. Servers commonly also accept
      <code>application/json</code>.
    </dd>

    <dt>Concurrency control</dt>
    <dd>
      Responses carry an <code>ETag</code> matching the resource's
      <code>meta.version</code>. Passing it back in <code>If-Match</code> on a subsequent
      write prevents concurrent modification.
    </dd>
  </dl>

  <div class="link-grid">
    <a href="/protocol/operations/" class="link-chip">
      Operations
      <span class="chip-note">Create, read, update, delete, search</span>
    </a>
    <a href="/protocol/discovery/" class="link-chip">
      Discovery
      <span class="chip-note">Runtime feature detection</span>
    </a>
    <a href="/protocol/examples/" class="link-chip">
      Examples
      <span class="chip-note">Full request/response pairs</span>
    </a>
  </div>

</div>

<?php require(__DIR__.'/../../includes/_footer.php') ?>
