<?php
$page_title = 'Introduction';
$page_description = 'An introduction to SCIM: what the specification suite covers, the problem it solves, and how the documents relate to each other.';
require(__DIR__.'/../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li>Introduction</li>
    </ol>
  </nav>

  <h2>Introduction</h2>

  <p class="lede">
    SCIM makes managing user identities in cloud-based applications and services easier.
  </p>

  <p>
    The System for Cross-domain Identity Management (SCIM) specification suite builds on
    experience with existing schemas and deployments, placing specific emphasis on
    simplicity of development and integration, while applying existing authentication,
    authorization, and privacy models. Its intent is to reduce the cost and complexity of
    user management operations by providing a common user schema and extension model, as
    well as binding documents to provide patterns for exchanging this schema using standard
    protocols. In essence: make it fast, cheap, and easy to move users into, out of, and
    around the cloud.
  </p>

  <div class="callout callout--muted">
    <strong class="callout-label">Note</strong>
    <p>
      Information in this Overview section is not normative. The
      <a href="/specs/">specifications</a> are authoritative.
    </p>
  </div>

  <h3>How the specifications fit together</h3>

  <p>
    SCIM 2.0 is defined by three RFCs published by the IETF in September 2015. Each covers a
    different layer of the problem:
  </p>

  <dl class="terminology">
    <dt>Core Schema <span class="term-abbr">RFC 7643</span></dt>
    <dd>
      A platform-neutral schema and extension model for representing users and groups.
      This is where <code>User</code>, <code>Group</code>, and <code>EnterpriseUser</code>
      are defined. See <a href="/schema/">Schema</a>.
    </dd>

    <dt>Protocol <span class="term-abbr">RFC 7644</span></dt>
    <dd>
      An application-level REST protocol for provisioning and managing identity data on the
      web &mdash; the operations, filtering, and discovery endpoints. See
      <a href="/protocol/">Protocol</a>.
    </dd>

    <dt>Definitions, Overview, Concepts, and Requirements <span class="term-abbr">RFC 7642</span></dt>
    <dd>
      The user scenarios and use cases that motivated the design. Useful background rather
      than something you implement against.
    </dd>
  </dl>

  <h3>Where to go next</h3>

  <div class="link-grid">
    <a href="/overview/model/" class="link-chip">
      Object Model
      <span class="chip-note">Resource, id, meta</span>
    </a>
    <a href="/schema/" class="link-chip">
      Schema
      <span class="chip-note">User, Group, extensions</span>
    </a>
    <a href="/protocol/operations/" class="link-chip">
      Operations
      <span class="chip-note">POST, GET, PUT, PATCH, DELETE</span>
    </a>
    <a href="/implementations/" class="link-chip">
      Implementations
      <span class="chip-note">Who supports SCIM</span>
    </a>
  </div>

</div>

<?php require(__DIR__.'/../../includes/_footer.php') ?>
