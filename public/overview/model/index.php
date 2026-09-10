<?php
$page_title = 'Object Model';
$page_description = 'SCIM 2.0 is built on an object model where a Resource is the common denominator and all SCIM objects derive from it.';
require(__DIR__.'/../../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/overview/">Introduction</a></li>
      <li>Object Model</li>
    </ol>
  </nav>

  <h2>Object Model</h2>

  <p class="lede">
    Every SCIM object derives from a common Resource type.
  </p>

  <p>
    SCIM 2.0 is built on an object model where a Resource is the common denominator and all
    SCIM objects are derived from it. It has <code>id</code>, <code>externalId</code>, and
    <code>meta</code> as attributes, and
    <a href="https://www.rfc-editor.org/rfc/rfc7643" class="rfc-badge">RFC 7643</a>
    defines <code>User</code>, <code>Group</code>, and <code>EnterpriseUser</code> that
    extend the common attributes.
  </p>

  <figure class="figure">
    <img src="/img/model.png" class="art-invert" alt="Diagram of the SCIM object model: Resource as the base type, extended by User, Group, and EnterpriseUser.">
    <figcaption>The SCIM 2.0 object model.</figcaption>
  </figure>

  <h3>Common attributes</h3>

  <dl class="terminology">
    <dt>id</dt>
    <dd>
      A unique identifier assigned by the service provider. Immutable, and never reused
      across resources.
    </dd>

    <dt>externalId</dt>
    <dd>
      An identifier assigned by the <em>client</em>, letting a provisioning client correlate
      the resource with its own record for the same identity.
    </dd>

    <dt>meta</dt>
    <dd>
      Resource metadata maintained by the service provider: <code>resourceType</code>,
      <code>created</code>, <code>lastModified</code>, <code>location</code>, and
      <code>version</code> &mdash; the last of which is the entity tag used for
      concurrency control.
    </dd>
  </dl>

  <h3>Attribute types</h3>

  <p>
    Attributes come in three shapes, and you will see all three in the
    <a href="/overview/schema/user/">Example User</a>:
  </p>

  <ul>
    <li><b>Simple</b> &mdash; a single value, such as a string for <code>userName</code>.</li>
    <li><b>Complex</b> &mdash; an attribute with sub-attributes, such as <code>name</code> or <code>address</code>.</li>
    <li><b>Multi-valued</b> &mdash; a list of values, such as <code>emails</code> or <code>phoneNumbers</code>, where each entry may carry a <code>type</code> and a <code>primary</code> flag.</li>
  </ul>

  <div class="link-grid">
    <a href="/overview/schema/" class="link-chip">
      Schema
      <span class="chip-note">Next &rarr;</span>
    </a>
  </div>

</div>

<?php require(__DIR__.'/../../../includes/_footer.php') ?>
