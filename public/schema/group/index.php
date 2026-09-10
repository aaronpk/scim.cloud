<?php
$page_title = 'Example Group';
$page_description = 'An example SCIM Group resource. Groups model organizational structure and can contain users or other groups.';
require(__DIR__.'/../../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/schema/">Schema</a></li>
      <li>Example Group</li>
    </ol>
  </nav>

  <h2>Example Group</h2>

  <p class="lede">
    Groups model the organizational structure of provisioned resources.
  </p>

  <p>
    In addition to users, SCIM includes the definition of groups. Groups are used to model
    the organizational structure of provisioned resources, and can contain users or other
    groups. Each entry in <code>members</code> carries the member's <code>value</code>
    (its <code>id</code>), a <code>$ref</code> URI where the member can be fetched, and a
    human-readable <code>display</code> name.
  </p>

  <?php code_block(<<<'JSON'
{
  "schemas": ["urn:ietf:params:scim:schemas:core:2.0:Group"],
  "id":"e9e30dba-f08f-4109-8486-d5c6a331660a",
  "displayName": "Sales Reps",
  "members":[
    {
      "value": "2819c223-7f76-453a-919d-413861904646",
      "$ref": "https://example.com/v2/Users/2819c223-7f76-453a-919d-413861904646",
      "display": "Dwight Schrute"
    },
    {
      "value": "902c246b-6245-4190-8e05-00816be7344a",
      "$ref": "https://example.com/v2/Users/902c246b-6245-4190-8e05-00816be7344a",
      "display": "Jim Halpert"
    }
  ],
  "meta": {
    "resourceType": "Group",
    "created": "2010-01-23T04:56:22Z",
    "lastModified": "2011-05-13T04:42:34Z",
    "version": "W\/\"3694e05e9dff592\"",
    "location": "https://example.com/v2/Groups/e9e30dba-f08f-4109-8486-d5c6a331660a"
  }
}
JSON, 'json', 'Group resource') ?>

  <div class="link-grid">
    <a href="/protocol/" class="link-chip">
      Protocol
      <span class="chip-note">Next &rarr;</span>
    </a>
  </div>

</div>

<?php require(__DIR__.'/../../../includes/_footer.php') ?>
