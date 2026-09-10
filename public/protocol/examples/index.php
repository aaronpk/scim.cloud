<?php
$page_title = 'Examples';
$page_description = 'Complete SCIM request and response examples: creating a user, fetching a user, and filtering a list of users.';
require(__DIR__.'/../../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/protocol/">Protocol</a></li>
      <li>Examples</li>
    </ol>
  </nav>

  <h2>Examples</h2>

  <p class="lede">
    Complete request and response pairs, headers included.
  </p>

  <h3>Create</h3>

  <p>
    To create a resource, send an HTTP <code>POST</code> request to the resource's respective
    endpoint. In the example below we see the creation of a User.
  </p>

  <p>
    As can be seen in this and later examples, the URL contains a version number so that
    different versions of the SCIM API can co-exist. Available versions can be dynamically
    discovered via the
    <a href="/protocol/discovery/"><code>ServiceProviderConfig</code></a> endpoint.
  </p>

  <?php code_block(<<<'TEXT'
POST /v2/Users HTTP/1.1
Accept: application/json
Authorization: Bearer h480djs93hd8
Host: example.com
Content-Length: ...
Content-Type: application/json

{
  "schemas":["urn:ietf:params:scim:schemas:core:2.0:User"],
  "externalId":"dschrute",
  "userName":"dschrute",
  "name":{
    "familyName":"Schrute",
    "givenName":"Dwight"
  }
}
TEXT, 'http', 'Request') ?>

  <p>
    A response contains the created resource and HTTP code <code>201</code> to indicate that
    the resource has been created successfully. Note that the returned user contains more
    data than was posted: <code>id</code> and <code>meta</code> have been added by the
    service provider to make a complete User resource. A <code>Location</code> header
    indicates where the resource can be fetched in subsequent requests.
  </p>

  <?php code_block(<<<'TEXT'
HTTP/1.1 201 Created
Content-Type: application/scim+json
Location: https://example.com/v2/Users/2819c223-7f76-453a-919d-413861904646
ETag: W/"e180ee84f0671b1"

{
  "schemas":["urn:ietf:params:scim:schemas:core:2.0:User"],
  "id":"2819c223-7f76-453a-919d-413861904646",
  "externalId":"dschrute",
  "meta":{
    "resourceType":"User",
    "created":"2011-08-01T21:32:44.882Z",
    "lastModified":"2011-08-01T21:32:44.882Z",
    "location": "https://example.com/v2/Users/2819c223-7f76-453a-919d-413861904646",
    "version":"W\/\"e180ee84f0671b1\""
  },
  "name":{
    "familyName":"Schrute",
    "givenName":"Dwight"
  },
  "userName":"dschrute"
}
TEXT, 'http', 'Response') ?>

  <h3>Get</h3>

  <p>
    Fetching resources is done by sending HTTP <code>GET</code> requests to the desired
    resource endpoint, as in this example.
  </p>

  <?php code_block(<<<'TEXT'
GET /v2/Users/2819c223-7f76-453a-919d-413861904646 HTTP/1.1
Host: example.com
Accept: application/scim+json
Authorization: Bearer h480djs93hd8
TEXT, 'http', 'Request') ?>

  <p>
    The response to a <code>GET</code> contains the resource. The <code>ETag</code> header
    can, in subsequent requests, be used to prevent concurrent modifications of resources.
  </p>

  <?php code_block(<<<'TEXT'
HTTP/1.1 200 OK
Content-Type: application/scim+json
Location: https://example.com/v2/Users/2819c223-7f76-453a-919d-413861904646
ETag: W/"f250dd84f0671c3"

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
TEXT, 'http', 'Response') ?>

  <h3>Filter</h3>

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
TEXT, 'text', 'Request') ?>

  <p>
    The response to a filtered <code>GET</code> request is a list of matching resources:
  </p>

  <?php code_block(<<<'JSON'
{
  "schemas":["urn:ietf:params:scim:api:messages:2.0:ListResponse"],
  "totalResults":2,
  "Resources":[
    {
      "id":"c3a26dd3-27a0-4dec-a2ac-ce211e105f97",
      "title":"Assistant VP",
      "userName":"dschrute"
    },
    {
      "id":"a4a25dd3-17a0-4dac-a2ac-ce211e125f57",
      "title":"VP",
      "userName":"jsmith"
    }
  ]
}
JSON, 'json', 'Response') ?>

  <div class="link-grid">
    <a href="/specs/" class="link-chip">
      Specifications
      <span class="chip-note">The normative documents</span>
    </a>
    <a href="/implementations/" class="link-chip">
      Implementations
      <span class="chip-note">Libraries and services</span>
    </a>
  </div>

</div>

<?php require(__DIR__.'/../../../includes/_footer.php') ?>
