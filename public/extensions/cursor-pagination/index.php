<?php
$page_title = 'Cursor Pagination';
$page_description = 'RFC 9865 defines cursor-based pagination for SCIM queries, as an alternative to the index-based paging in RFC 7644.';
require(__DIR__.'/../../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li>Extensions</li>
      <li>Cursor Pagination</li>
    </ol>
  </nav>

  <h2>Cursor Pagination</h2>

  <div class="page-meta">
    <a href="https://www.rfc-editor.org/rfc/rfc9865" class="rfc-badge">RFC 9865</a>
    <span class="status status--published">Published</span>
    <span class="status status--neutral">Updates 7643, 7644</span>
    <a href="https://www.rfc-editor.org/rfc/rfc9865" class="mono-url">rfc-editor.org/rfc/rfc9865</a>
  </div>

  <p class="lede">
    Cursor-based pagination for SCIM queries, for service providers whose underlying store
    already pages by cursor.
  </p>

  <p>
    <a href="https://www.rfc-editor.org/rfc/rfc7644" class="rfc-badge">RFC 7644</a>
    pages results by index: the client asks for a <code>startIndex</code> and a
    <code>count</code>. That does not map cleanly onto every backend. Many existing codebases,
    databases, and APIs already page by cursor, and translating between the two models is
    awkward and often expensive. RFC 9865 adds cursor-based pagination as an alternative, so
    those providers can expose what they already do.
  </p>

  <p>
    A service provider may implement either method or both. When it supports both, the client
    picks by sending either <code>startIndex</code> or <code>cursor</code>, and the provider
    MUST choose a default for requests that specify neither. A provider retrofitting cursors
    onto an existing index-based implementation should keep <b>index</b> as the default, so
    clients that expect the old behaviour are not broken.
  </p>

  <h3>Query parameters</h3>

  <div class="table-wrap">
    <table class="data">
      <thead>
        <tr>
          <th scope="col">Parameter</th>
          <th scope="col">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><code>cursor</code></td>
          <td>
            The <code>nextCursor</code> value from a previous result page. Empty or omitted on
            the first request. Restricted to the unreserved character set of RFC 3986.
          </td>
        </tr>
        <tr>
          <td><code>count</code></td>
          <td>
            The desired maximum number of results per page. A negative value is treated as
            <code>0</code>, which returns only <code>totalResults</code>. The provider must not
            return more than requested, but may return fewer.
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <h3>Response attributes</h3>

  <div class="table-wrap">
    <table class="data">
      <thead>
        <tr>
          <th scope="col">Attribute</th>
          <th scope="col">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><code>nextCursor</code></td>
          <td>
            Cursor for the next page. Providers supporting cursor pagination must include it in
            every paged response <em>except</em> the last &mdash; its absence is what signals
            that there are no more pages.
          </td>
        </tr>
        <tr>
          <td><code>previousCursor</code></td>
          <td>
            Cursor for the previous page. Optional, and never returned with the first page. Its
            presence tells the client the provider supports reverse traversal.
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <p>
    Cursor values are URL-safe strings that are opaque to the client. To fetch another page the
    client repeats the original query <em>exactly</em>, changing only the cursor value.
  </p>

  <?php code_block(<<<'TEXT'
GET /v2/Users?filter=userName%20sw%20J&cursor&count=10 HTTP/1.1
Host: example.com
Accept: application/scim+json
Authorization: Bearer U8YJcYYRMjbGeepD
TEXT, 'http', 'First page — empty cursor') ?>

  <?php code_block(<<<'TEXT'
HTTP/1.1 200 OK
Content-Type: application/scim+json

{
  "schemas": ["urn:ietf:params:scim:api:messages:2.0:ListResponse"],
  "totalResults": 100,
  "itemsPerPage": 10,
  "nextCursor": "VZUTiyhEQJ94IR",
  "Resources": [
    { "id": "2819c223-7f76-453a-919d-413861904646", "userName": "jsmith" },
    { "id": "c3a26dd3-27a0-4dec-a2ac-ce211e105f97", "userName": "jhalpert" }
  ]
}
TEXT, 'http', 'Response — nextCursor, no previousCursor on page one') ?>

  <p>
    The next request reuses every parameter and sets <code>cursor</code> to the
    <code>nextCursor</code> just returned:
  </p>

  <?php code_block(<<<'TEXT'
GET /v2/Users?filter=userName%20sw%20J&cursor=VZUTiyhEQJ94IR&count=10 HTTP/1.1
Host: example.com
Accept: application/scim+json
Authorization: Bearer U8YJcYYRMjbGeepD
TEXT, 'http', 'Subsequent page') ?>

  <?php code_block(<<<'TEXT'
HTTP/1.1 200 OK
Content-Type: application/scim+json

{
  "schemas": ["urn:ietf:params:scim:api:messages:2.0:ListResponse"],
  "totalResults": 100,
  "itemsPerPage": 10,
  "previousCursor": "ze7L30kMiiLX6x",
  "nextCursor": "YkU3OF86Pz0rGv",
  "Resources": [
    { "id": "a4a25dd3-17a0-4dac-a2ac-ce211e125f57", "userName": "jlevinson" }
  ]
}
TEXT, 'http', 'Response — forward and reverse traversal') ?>

  <p>
    Providers should still return an accurate <code>totalResults</code> across all pages, but
    one that cannot estimate it may omit the attribute entirely. The same parameters work with
    <code>POST /.search</code>, passed in the request body alongside
    <code>filter</code> and <code>attributes</code> rather than on the URL.
  </p>

  <h3>Errors</h3>

  <p>
    These <code>scimType</code> values extend the detail error keywords in RFC 7644 &sect;3.12
    and are returned with HTTP <code>400</code>:
  </p>

  <div class="table-wrap">
    <table class="data">
      <thead>
        <tr>
          <th scope="col">scimType</th>
          <th scope="col">Meaning</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><code>invalidCursor</code></td>
          <td>The cursor value is not valid for this query.</td>
        </tr>
        <tr>
          <td><code>expiredCursor</code></td>
          <td>The cursor has expired. The client waited longer than the provider's <code>cursorTimeout</code> between page requests.</td>
        </tr>
        <tr>
          <td><code>invalidCount</code></td>
          <td>The count is outside <code>0</code>&ndash;<code>maxPageSize</code>, or differs from the count used in the initial query.</td>
        </tr>
      </tbody>
    </table>
  </div>

  <h3>Discovery</h3>

  <p>
    A provider implementing cursor pagination should advertise a <code>pagination</code> complex
    attribute from <a href="/protocol/discovery/"><code>/ServiceProviderConfig</code></a>:
  </p>

  <dl class="terminology">
    <dt>cursor <span class="term-abbr">boolean, required</span></dt>
    <dd>Whether cursor-based pagination is supported.</dd>

    <dt>index <span class="term-abbr">boolean, required</span></dt>
    <dd>Whether index-based pagination is supported.</dd>

    <dt>defaultPaginationMethod <span class="term-abbr">"cursor" | "index"</span></dt>
    <dd>Which method applies when the client specifies neither.</dd>

    <dt>defaultPageSize <span class="term-abbr">integer</span></dt>
    <dd>Page size used when the query omits <code>count</code>.</dd>

    <dt>maxPageSize <span class="term-abbr">integer</span></dt>
    <dd>Ceiling on results per page, whatever <code>count</code> asks for.</dd>

    <dt>cursorTimeout <span class="term-abbr">seconds</span></dt>
    <dd>Minimum time a cursor stays valid between page requests.</dd>
  </dl>

  <div class="callout">
    <strong class="callout-label">Absent does not mean unlimited</strong>
    <p>
      Every sub-attribute except <code>cursor</code> and <code>index</code> is optional, and a
      provider may legitimately publish none of them &mdash; page limits can vary per resource
      type, or depend on response size rather than a resource count. Clients must not read a
      missing value as "no limit" or "no default".
    </p>
  </div>

  <div class="link-grid">
    <a href="/protocol/operations/" class="link-chip">
      Operations
      <span class="chip-note">Filtering and sorting</span>
    </a>
    <a href="/protocol/discovery/" class="link-chip">
      Discovery
      <span class="chip-note">ServiceProviderConfig</span>
    </a>
    <a href="https://www.rfc-editor.org/rfc/rfc9865" class="link-chip">
      Read RFC 9865
      <span class="chip-note">rfc-editor.org</span>
    </a>
  </div>

</div>

<?php require(__DIR__.'/../../../includes/_footer.php') ?>
