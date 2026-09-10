<?php
$page_title = 'Events (SETs)';
$page_description = 'RFC 9967 defines a SCIM profile for Security Event Tokens, enabling asynchronous exchange of resource-change events between SCIM service providers and receivers.';
require(__DIR__.'/../../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/specs/">Specifications</a></li>
      <li>Events (SETs)</li>
    </ol>
  </nav>

  <h2>Events (SETs)</h2>

  <div class="page-meta">
    <a href="https://www.rfc-editor.org/rfc/rfc9967" class="rfc-badge">RFC 9967</a>
    <span class="status status--published">Published</span>
    <span class="status status--neutral">Updates 7643, 7644</span>
    <a href="https://www.rfc-editor.org/rfc/rfc9967" class="mono-url">rfc-editor.org/rfc/rfc9967</a>
  </div>

  <p class="lede">
    Asynchronous SCIM events, delivered as Security Event Tokens.
  </p>

  <p>
    SCIM as defined in RFC 7644 is request/response: a client asks, a service provider answers.
    RFC 9967 adds the other direction. When a resource changes, a provider can emit a signal
    describing what happened, and interested receivers can consume it without polling the
    resource endpoints. Events are
    <a href="https://www.rfc-editor.org/rfc/rfc8417" class="rfc-badge">RFC 8417</a>
    Security Event Tokens (SETs), delivered either by push
    (<a href="https://www.rfc-editor.org/rfc/rfc8935" class="rfc-badge">RFC 8935</a>) or by poll
    (<a href="https://www.rfc-editor.org/rfc/rfc8936" class="rfc-badge">RFC 8936</a>).
  </p>

  <p>
    A SET is a JWT: standard top-level claims plus an <code>events</code> claim holding one or
    more event URIs, each mapped to an object carrying that event's detail. Multiple event URIs
    in one SET mean the events came from the same transaction or state change on a single
    resource. Stream registration and configuration are deliberately out of scope.
  </p>

  <h3>Identifying the subject</h3>

  <p>
    Events identify their subject with the
    <a href="https://www.rfc-editor.org/rfc/rfc9493" class="rfc-badge">RFC 9493</a>
    <code>sub_id</code> claim, which lives in the top-level JWT claims &mdash; never inside an
    event payload.
  </p>

  <dl class="terminology">
    <dt>format <span class="term-abbr">"scim"</span></dt>
    <dd>Marks the remaining <code>sub_id</code> attributes as SCIM attributes.</dd>

    <dt>uri <span class="term-abbr">required</span></dt>
    <dd>
      The relative path of the resource &mdash; the resource type endpoint plus the resource
      <code>id</code>, such as <code>/Users/2b2f880af6674ac284bae9381673d462</code>. A receiver
      that cannot match the URI locally may append it to a previously agreed base URI and issue
      a SCIM <code>GET</code>.
    </dd>

    <dt>externalId</dt>
    <dd>The resource's <code>externalId</code>, if known, so a receiver can correlate the subject with its own record.</dd>

    <dt>id</dt>
    <dd>The SCIM <code>id</code>, permitted alongside <code>uri</code> for backwards compatibility.</dd>
  </dl>

  <div class="callout">
    <strong class="callout-label">Do not use the JWT sub claim</strong>
    <p>
      <code>sub</code> MUST NOT be used to identify the subject of a SCIM event, specifically to
      avoid confusion with JWT authorization tokens. Where <code>id</code> and
      <code>externalId</code> are not enough to correlate a resource, <code>sub_id</code> may
      carry attributes whose uniqueness is <code>server</code> or <code>global</code>, such as
      <code>userName</code> or <code>emails</code>.
    </p>
  </div>

  <h3>Event types</h3>

  <p>
    All event URIs are prefixed <code>urn:ietf:params:scim:event</code> and grouped into
    sub-namespaces: <code>feed</code> for feed control, <code>prov</code> for provisioning, and
    <code>misc</code>.
  </p>

  <div class="table-wrap">
    <table class="data">
      <thead>
        <tr>
          <th scope="col">Event URI</th>
          <th scope="col">Meaning</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><code>feed:add</code></td>
          <td>A resource has been added to the receiver's event feed.</td>
        </tr>
        <tr>
          <td><code>feed:remove</code></td>
          <td>A resource has been removed from the feed.</td>
        </tr>
        <tr>
          <td><code>prov:create:{notice|full}</code></td>
          <td>A resource was created. The provider-assigned <code>id</code> is shared so replicas can reuse it.</td>
        </tr>
        <tr>
          <td><code>prov:patch:{notice|full}</code></td>
          <td>A resource was modified with <code>PATCH</code>.</td>
        </tr>
        <tr>
          <td><code>prov:put:{notice|full}</code></td>
          <td>A resource was replaced with <code>PUT</code>.</td>
        </tr>
        <tr>
          <td><code>prov:delete</code></td>
          <td>A resource was deleted.</td>
        </tr>
        <tr>
          <td><code>prov:activate</code></td>
          <td>A resource was activated.</td>
        </tr>
        <tr>
          <td><code>prov:deactivate</code></td>
          <td>A resource was deactivated.</td>
        </tr>
        <tr>
          <td><code>misc:asyncresp</code></td>
          <td>The response to an asynchronous SCIM request.</td>
        </tr>
      </tbody>
    </table>
  </div>

  <p>
    The <code>:notice</code> and <code>:full</code> suffixes decide how much the event carries.
    A <code>full</code> event includes a <code>data</code> payload with the resource content; a
    <code>notice</code> event includes only an <code>attributes</code> list naming what changed,
    leaving the receiver to fetch the values itself. Exactly one of <code>data</code> or
    <code>attributes</code> is present &mdash; never both.
  </p>

  <?php code_block(<<<'JSON'
{
  "jti": "4d3559ec67504aaba65d40b0363faad8",
  "iat": 1458496404,
  "iss": "https://scim.example.com",
  "aud": [
    "https://scim.example.com/Feeds/98d52461fa5bbc879593b7754",
    "https://scim.example.com/Feeds/5d7604516b1d08641d7676ee7"
  ],
  "sub_id": {
    "format": "scim",
    "uri": "/Users/44f6142df96bd6ab61e7521d9",
    "externalId": "jdoe"
  },
  "events": {
    "urn:ietf:params:scim:event:prov:create:full": {
      "data": {
        "schemas": ["urn:ietf:params:scim:schemas:core:2.0:User"],
        "userName": "jdoe",
        "name": {
          "givenName": "John",
          "familyName": "Doe"
        },
        "emails": [
          { "type": "work", "value": "jdoe@example.com" }
        ]
      }
    }
  }
}
JSON, 'json', 'prov:create:full — resource content included') ?>

  <p>
    The same change as a notice carries only the attribute names:
  </p>

  <?php code_block(<<<'JSON'
{
  "jti": "4d3559ec67504aaba65d40b0363faad8",
  "iat": 1458496404,
  "iss": "https://scim.example.com",
  "sub_id": {
    "format": "scim",
    "uri": "/Users/44f6142df96bd6ab61e7521d9",
    "externalId": "jdoe"
  },
  "events": {
    "urn:ietf:params:scim:event:prov:create:notice": {
      "attributes": ["id", "name", "userName", "password", "emails"]
    }
  }
}
JSON, 'json', 'prov:create:notice — attribute names only') ?>

  <h3>Discovery</h3>

  <p>
    A provider advertises event support through a <code>securityEvents</code> attribute on
    <a href="/protocol/discovery/"><code>/ServiceProviderConfig</code></a>. When the attribute is
    absent, the provider does not support events or is not configured for them.
  </p>

  <dl class="terminology">
    <dt>asyncRequest <span class="term-abbr">"none" | "long" | "request"</span></dt>
    <dd>
      Whether asynchronous SCIM requests are supported: <code>none</code> not at all,
      <code>long</code> at the server's discretion, <code>request</code> when the client asks
      for it.
    </dd>

    <dt>eventUris <span class="term-abbr">multi-valued string</span></dt>
    <dd>
      The event URIs this provider can generate and deliver over a SET stream. Informational
      only &mdash; it does not register or configure a stream.
    </dd>
  </dl>

  <div class="link-grid">
    <a href="/protocol/discovery/" class="link-chip">
      Discovery
      <span class="chip-note">ServiceProviderConfig</span>
    </a>
    <a href="/protocol/operations/" class="link-chip">
      Operations
      <span class="chip-note">The synchronous protocol</span>
    </a>
    <a href="https://www.rfc-editor.org/rfc/rfc9967" class="link-chip">
      Read RFC 9967
      <span class="chip-note">rfc-editor.org</span>
    </a>
  </div>

</div>

<?php require(__DIR__.'/../../../includes/_footer.php') ?>
