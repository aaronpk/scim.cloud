<?php
$page_title = 'Device Schema';
$page_description = 'RFC 9944 defines SCIM schema extensions for provisioning devices, covering Wi-Fi Easy Connect, FIDO device onboarding, BLE, Ethernet MAB, and Zigbee.';
require(__DIR__.'/../../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/specs/">Specifications</a></li>
      <li>Device Schema</li>
    </ol>
  </nav>

  <h2>Device Schema</h2>

  <div class="page-meta">
    <a href="https://www.rfc-editor.org/rfc/rfc9944" class="rfc-badge">RFC 9944</a>
    <span class="status status--published">Published</span>
    <a href="https://www.rfc-editor.org/rfc/rfc9944" class="mono-url">rfc-editor.org/rfc/rfc9944</a>
  </div>

  <p class="lede">
    Schema extensions for provisioning devices, not just users.
  </p>

  <p>
    The SCIM core schema was designed for provisioning users. RFC 9944 adds schemas for
    provisioning <em>devices</em>, and for carrying the bootstrapping material a device needs to
    get onto a network. It defines two new resource types plus a family of extensions, one per
    underlying onboarding system &mdash; Wi-Fi Easy Connect, FIDO Device Onboard vouchers,
    Bluetooth Low Energy pairing, MAC Authenticated Bypass, and Zigbee.
  </p>

  <p>
    Unlike <a href="/specs/cursor-pagination/">RFC 9865</a> and
    <a href="/specs/events/">RFC 9967</a>, this document does not update RFC 7643 or RFC 7644.
    It is purely additive: new resource types and new schema URIs, using the extension model the
    core schema already provides.
  </p>

  <h3>Resource types</h3>

  <dl class="terminology">
    <dt>Device <span class="term-abbr">urn:ietf:params:scim:schemas:core:2.0:Device</span></dt>
    <dd>
      A provisionable device. Carries the core attributes below, and one or more bootstrapping
      extensions describing how the device is onboarded.
    </dd>

    <dt>EndpointApp <span class="term-abbr">urn:ietf:params:scim:schemas:core:2.0:EndpointApp</span></dt>
    <dd>
      An application permitted to communicate with devices. Devices reference endpoint
      applications through the application endpoint extension, which is how a deployment
      expresses which app may talk to which device.
    </dd>
  </dl>

  <h3>Core device attributes</h3>

  <div class="table-wrap">
    <table class="data">
      <thead>
        <tr>
          <th scope="col">Attribute</th>
          <th scope="col">Required</th>
          <th scope="col">Mutability</th>
          <th scope="col">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><code>displayName</code></td>
          <td><span class="no">&ndash;</span></td>
          <td>readWrite</td>
          <td>Human-readable name, suitable for showing to end users. Not case sensitive, no uniqueness constraint.</td>
        </tr>
        <tr>
          <td><code>active</code></td>
          <td><span class="yes">&check;</span></td>
          <td>readWrite</td>
          <td>Whether the device is intended to be operational. Attempts to control or reach a device with <code>active</code> false may be rejected.</td>
        </tr>
        <tr>
          <td><code>mudUrl</code></td>
          <td><span class="no">&ndash;</span></td>
          <td>readWrite</td>
          <td>URL of the device's Manufacturer Usage Description file (<a href="https://www.rfc-editor.org/rfc/rfc8520" class="rfc-badge">RFC 8520</a>). Case sensitive.</td>
        </tr>
        <tr>
          <td><code>groups</code></td>
          <td><span class="no">&ndash;</span></td>
          <td>readOnly</td>
          <td>Group membership, in the same form as the <code>groups</code> attribute in RFC 7643 &sect;4.1.2.</td>
        </tr>
      </tbody>
    </table>
  </div>

  <p>
    All four sit alongside the usual common attributes &mdash; <code>id</code>,
    <code>externalId</code>, and <code>meta</code> &mdash; described in the
    <a href="/overview/model/">object model</a>. A minimal Device resource:
  </p>

  <?php code_block(<<<'JSON'
{
  "schemas": ["urn:ietf:params:scim:schemas:core:2.0:Device"],
  "id": "e9e30dba-f08f-4109-8486-d5c6a3316111",
  "displayName": "BLE Heart Monitor",
  "active": true,
  "meta": {
    "resourceType": "Device",
    "created": "2022-01-23T04:56:22Z",
    "lastModified": "2022-05-13T04:42:34Z",
    "version": "W\/\"a330bc54f0671c9\"",
    "location": "https://example.com/v2/Devices/e9e30dba-f08f-4109-8486-d5c6a3316111"
  }
}
JSON, 'json', 'Device resource') ?>

  <h3>Bootstrapping extensions</h3>

  <p>
    Each onboarding system gets its own extension schema, keyed by URI in the resource just like
    any other SCIM extension. A device lists every schema it conforms to in
    <code>schemas</code>.
  </p>

  <div class="table-wrap">
    <table class="data">
      <thead>
        <tr>
          <th scope="col">Extension</th>
          <th scope="col">Schema URI</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Bluetooth Low Energy</td>
          <td><code>&hellip;:extension:ble:2.0:Device</code></td>
        </tr>
        <tr>
          <td>Wi-Fi Easy Connect (DPP)</td>
          <td><code>&hellip;:extension:dpp:2.0:Device</code></td>
        </tr>
        <tr>
          <td>Ethernet MAB</td>
          <td><code>&hellip;:extension:ethernet-mab:2.0:Device</code></td>
        </tr>
        <tr>
          <td>FIDO Device Onboard</td>
          <td><code>&hellip;:extension:fido-device-onboard:2.0:Device</code></td>
        </tr>
        <tr>
          <td>Zigbee</td>
          <td><code>&hellip;:extension:zigbee:2.0:Device</code></td>
        </tr>
        <tr>
          <td>Application endpoints</td>
          <td><code>&hellip;:extension:endpointAppsExt:2.0:Device</code></td>
        </tr>
      </tbody>
    </table>
  </div>

  <p>
    Every URI above is prefixed <code>urn:ietf:params:scim:schemas</code>. BLE additionally
    defines four pairing-method extensions &mdash; <code>pairingJustWorks</code>,
    <code>pairingPassKey</code>, <code>pairingOOB</code>, and <code>pairingNull</code> &mdash;
    selected according to how the device authenticates during pairing.
  </p>

  <p>
    A device onboarded with Wi-Fi Easy Connect carries its bootstrapping key, MAC address, and
    the class/channel pairs it can be reached on:
  </p>

  <?php code_block(<<<'JSON'
{
  "schemas": [
    "urn:ietf:params:scim:schemas:core:2.0:Device",
    "urn:ietf:params:scim:schemas:extension:dpp:2.0:Device"
  ],
  "id": "e9e30dba-f08f-4109-8486-d5c6a3316111",
  "displayName": "WiFi Heart Monitor",
  "active": true,
  "urn:ietf:params:scim:schemas:extension:dpp:2.0:Device": {
    "dppVersion": 2,
    "bootstrappingMethod": ["QR"],
    "bootstrapKey": "MDkwEwYHKoZIzj0CAQYIKoZIzj0DAQcDIgADURzxmttZoIRIPWGoQMV00XHWCAQIhXruVWOz0NjlkIA=",
    "deviceMacAddress": "2C:54:91:88:C9:F2",
    "classChannel": ["81/1", "115/36"],
    "serialNumber": "4774LH2b4044"
  },
  "meta": {
    "resourceType": "Device",
    "created": "2022-01-23T04:56:22Z",
    "lastModified": "2022-05-13T04:42:34Z",
    "version": "W\/\"a330bc54f0671c9\""
  }
}
JSON, 'json', 'Device with the Wi-Fi Easy Connect extension') ?>

  <div class="callout">
    <strong class="callout-label">Bootstrapping material is sensitive</strong>
    <p>
      These extensions carry keys, passcodes, and vouchers. RFC 9944 &sect;8 treats unauthorized
      device creation as the central threat &mdash; a device added by an attacker may be granted
      network access &mdash; and several attributes are defined write-only, never returned in a
      response, for exactly this reason.
    </p>
  </div>

  <div class="link-grid">
    <a href="/overview/schema/" class="link-chip">
      Schema
      <span class="chip-note">User, Group, extensions</span>
    </a>
    <a href="/overview/model/" class="link-chip">
      Object Model
      <span class="chip-note">Common attributes</span>
    </a>
    <a href="https://www.rfc-editor.org/rfc/rfc9944" class="link-chip">
      Read RFC 9944
      <span class="chip-note">rfc-editor.org</span>
    </a>
  </div>

</div>

<?php require(__DIR__.'/../../../includes/_footer.php') ?>
