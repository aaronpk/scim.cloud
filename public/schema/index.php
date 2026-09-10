<?php
$page_title = 'Schema';
$page_description = 'The SCIM core schema defines User, Group, and Enterprise User resource types, plus an extension model for adding your own attributes.';
require(__DIR__.'/../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li>Schema</li>
    </ol>
  </nav>

  <h2>Schema</h2>

  <div class="page-meta">
    <a href="https://www.rfc-editor.org/rfc/rfc7643" class="rfc-badge">RFC 7643</a>
    <span class="status status--published">Published</span>
    <a href="https://www.rfc-editor.org/rfc/rfc7643" class="mono-url">rfc-editor.org/rfc/rfc7643</a>
  </div>

  <p class="lede">
    A platform-neutral schema and extension model for representing users and groups.
  </p>

  <p>
    The core schema defines the resource types a SCIM service provider exposes, the
    attributes each one carries, and the rules for extending them. Every resource is
    identified by one or more schema URIs listed in its <code>schemas</code> attribute.
  </p>

  <h3>Resource types</h3>

  <dl class="terminology">
    <dt>User <span class="term-abbr">urn:ietf:params:scim:schemas:core:2.0:User</span></dt>
    <dd>
      An individual identity. Carries <code>userName</code>, <code>name</code>,
      <code>emails</code>, <code>phoneNumbers</code>, <code>addresses</code>,
      <code>active</code>, and more.
      <a href="/schema/user/">See an example &rarr;</a>
    </dd>

    <dt>Group <span class="term-abbr">urn:ietf:params:scim:schemas:core:2.0:Group</span></dt>
    <dd>
      A collection used to model organizational structure. Carries
      <code>displayName</code> and a multi-valued <code>members</code> attribute; members
      may be users or other groups.
      <a href="/schema/group/">See an example &rarr;</a>
    </dd>

    <dt>Enterprise User <span class="term-abbr">urn:ietf:params:scim:schemas:extension:enterprise:2.0:User</span></dt>
    <dd>
      A schema extension for common enterprise attributes: <code>employeeNumber</code>,
      <code>costCenter</code>, <code>organization</code>, <code>division</code>,
      <code>department</code>, and <code>manager</code>.
    </dd>
  </dl>

  <p>
    Those are the resource types defined by the core schema.
    <a href="/extensions/device-schema/">RFC 9944</a> adds two more &mdash; <code>Device</code> and
    <code>EndpointApp</code> &mdash; extending SCIM from provisioning people to provisioning
    devices.
  </p>

  <h3>Extensions</h3>

  <p>
    Extensions are namespaced by their own schema URI and appear as a nested object keyed by
    that URI, alongside the core attributes. A resource lists every schema it conforms to in
    <code>schemas</code>, so a client can tell what to expect:
  </p>

  <?php code_block(<<<'JSON'
{
  "schemas": [
    "urn:ietf:params:scim:schemas:core:2.0:User",
    "urn:ietf:params:scim:schemas:extension:enterprise:2.0:User"
  ],
  "id": "2819c223-7f76-453a-919d-413861904646",
  "userName": "dschrute",
  "urn:ietf:params:scim:schemas:extension:enterprise:2.0:User": {
    "employeeNumber": "701984",
    "department": "Sales",
    "manager": {
      "value": "26118915-6090-4610-87e4-49d8ca9f808d",
      "displayName": "Michael Scott"
    }
  }
}
JSON, 'json') ?>

  <p>
    Which resource types and schemas a particular server supports is discoverable at
    runtime &mdash; see <a href="/protocol/discovery/">Discovery</a>.
  </p>

  <div class="link-grid">
    <a href="/schema/user/" class="link-chip">
      Example User
      <span class="chip-note">Simple, complex, multi-valued</span>
    </a>
    <a href="/schema/group/" class="link-chip">
      Example Group
      <span class="chip-note">members, $ref</span>
    </a>
  </div>

</div>

<?php require(__DIR__.'/../../includes/_footer.php') ?>
