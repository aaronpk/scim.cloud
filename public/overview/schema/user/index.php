<?php
$page_title = 'Example User';
$page_description = 'An example of how user data is encoded as a SCIM object in JSON, showing simple, complex, and multi-valued attributes.';
require(__DIR__.'/../../../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/overview/">Introduction</a></li>
      <li><a href="/overview/schema/">Schema</a></li>
      <li>Example User</li>
    </ol>
  </nav>

  <h2>Example User</h2>

  <p class="lede">
    How user data is encoded as a SCIM object in JSON.
  </p>

  <p>
    While this example does not contain the full set of attributes available, notice the
    different types of data that can be used to create SCIM objects. Simple types like
    strings for <code>id</code> and <code>userName</code>. Complex types &mdash; attributes
    that have sub-attributes &mdash; for <code>name</code> and <code>address</code>.
    Multi-valued types for <code>emails</code>, <code>phoneNumbers</code>,
    <code>addresses</code>, and so on.
  </p>

  <?php code_block(<<<'JSON'
{
  "schemas": ["urn:ietf:params:scim:schemas:core:2.0:User"],
  "id":"2819c223-7f76-453a-919d-413861904646",
  "externalId":"dschrute",
  "meta":{
    "resourceType": "User",
    "created":"2011-08-01T18:29:49.793Z",
    "lastModified":"2011-08-01T18:29:49.793Z",
    "location":"https://example.com/v2/Users/2819c223...",
    "version":"W\/\"f250dd84f0671c3\""
  },
  "name":{
    "formatted": "Mr. Dwight K Schrute, III",
    "familyName": "Schrute",
    "givenName": "Dwight",
    "middleName": "Kurt",
    "honorificPrefix": "Mr.",
    "honorificSuffix": "III"
  },
  "userName":"dschrute",
  "phoneNumbers":[
    {
      "value":"555-555-8377",
      "type":"work"
    }
  ],
  "emails":[
    {
      "value":"dschrute@example.com",
      "type":"work",
      "primary": true
    }
  ]
}
JSON, 'json', 'User resource') ?>

  <div class="callout">
    <strong class="callout-label">Reading the example</strong>
    <p>
      <code>meta.version</code> is the resource's entity tag. Send it back in an
      <code>If-Match</code> header on updates to avoid overwriting a concurrent change
      &mdash; see <a href="/protocol/operations/">Operations</a>.
    </p>
  </div>

  <div class="link-grid">
    <a href="/overview/schema/group/" class="link-chip">
      Example Group
      <span class="chip-note">Next &rarr;</span>
    </a>
    <a href="/protocol/examples/" class="link-chip">
      Protocol Examples
      <span class="chip-note">Full request/response pairs</span>
    </a>
  </div>

</div>

<?php require(__DIR__.'/../../../../includes/_footer.php') ?>
