<?php
$page_title = 'Specifications';
$page_description = 'The SCIM specifications: the six published RFCs, the Internet-Drafts currently in progress, and the archived SCIM 1.1 and 1.0 documents.';
require(__DIR__.'/../../includes/_header.php');
?>

<div class="container">

  <nav aria-label="Breadcrumb">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li>Specifications</li>
    </ol>
  </nav>

  <h2>Specifications</h2>

  <p class="lede">
    SCIM 2.0 was published by the IETF in September 2015 as three RFCs, and has since been
    extended by three more, with further work in progress.
  </p>

  <h3>SCIM 2.0</h3>

  <p>
    SCIM 2.0 is released as RFC 7642, RFC 7643, and RFC 7644 under the
    <a href="https://datatracker.ietf.org/wg/scim/about/">IETF SCIM working group</a>.
  </p>

  <ul class="spec-list">
    <li>
      <div class="spec-title">
        <a href="https://www.rfc-editor.org/rfc/rfc7643" class="rfc-badge">RFC 7643</a>
        <a href="https://www.rfc-editor.org/rfc/rfc7643">SCIM: Core Schema</a>
        <span class="status status--published">Published</span>
      </div>
      <p>
        The Core Schema provides a platform-neutral schema and extension model for
        representing users and groups.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://www.rfc-editor.org/rfc/rfc7644" class="rfc-badge">RFC 7644</a>
        <a href="https://www.rfc-editor.org/rfc/rfc7644">SCIM: Protocol</a>
        <span class="status status--published">Published</span>
      </div>
      <p>
        The SCIM Protocol is an application-level, REST protocol for provisioning and
        managing identity data on the web.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://www.rfc-editor.org/rfc/rfc7642" class="rfc-badge">RFC 7642</a>
        <a href="https://www.rfc-editor.org/rfc/rfc7642">SCIM: Definitions, Overview, Concepts, and Requirements</a>
        <span class="status status--published">Published</span>
      </div>
      <p>
        This document lists the user scenarios and use cases of System for Cross-domain
        Identity Management (SCIM).
      </p>
    </li>
  </ul>

  <h3>Extensions and updates</h3>

  <p>
    Standards Track RFCs published since SCIM 2.0, extending the core specifications or updating
    them in place.
  </p>

  <ul class="spec-list">
    <li>
      <div class="spec-title">
        <a href="https://www.rfc-editor.org/rfc/rfc9865" class="rfc-badge">RFC 9865</a>
        <a href="/extensions/cursor-pagination/">Cursor-Based Pagination of SCIM Resources</a>
        <span class="status status--published">Published</span>
      </div>
      <p>
        Defines <code>cursor</code> and <code>count</code> query parameters and
        <code>nextCursor</code> / <code>previousCursor</code> response attributes, so service
        providers whose backing store already pages by cursor need not translate to index-based
        paging. Updates RFC 7643 and RFC 7644.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://www.rfc-editor.org/rfc/rfc9944" class="rfc-badge">RFC 9944</a>
        <a href="/extensions/device-schema/">Device Schema Extensions to the SCIM Model</a>
        <span class="status status--published">Published</span>
      </div>
      <p>
        Adds <code>Device</code> and <code>EndpointApp</code> resource types plus per-system
        bootstrapping extensions, enabling provisioning of devices using Wi-Fi Easy Connect,
        FIDO Device Onboard, Bluetooth Low Energy, Ethernet MAB, and Zigbee.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://www.rfc-editor.org/rfc/rfc9967" class="rfc-badge">RFC 9967</a>
        <a href="/extensions/events/">SCIM Profile for Security Event Tokens (SETs)</a>
        <span class="status status--published">Published</span>
      </div>
      <p>
        Defines a set of SCIM events carried as Security Event Tokens, for asynchronous exchange
        of resource changes between service providers and receivers. Updates RFC 7643 and
        RFC 7644.
      </p>
    </li>
  </ul>

  <h3>Current work</h3>

  <p>
    Where SCIM development is happening now. This list reflects the
    <a href="https://datatracker.ietf.org/wg/scim/documents/">working group's document page</a>
    as of September 2026; check there for the current state of any draft.
  </p>

  <h4>Working group drafts</h4>

  <div class="callout callout--muted">
    <strong class="callout-label">Note</strong>
    <p>
      The working group's other adopted drafts have all been published as RFCs and are listed
      above. One adopted draft remains open, and its most recent revision has lapsed &mdash;
      drafts expire six months after publication and are routinely revived by a new revision, so
      an expired draft is not necessarily abandoned work.
    </p>
  </div>

  <ul class="spec-list">
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-ietf-scim-roles-entitlements/" class="rfc-badge">draft-ietf-scim-roles-entitlements</a>
        <span class="rev-pill">-01</span>
        <span class="status status--neutral">WG Document</span>
        <span class="status status--expired">Expired</span>
      </div>
      <p>
        SCIM Roles and Entitlements Extension. Lets a service provider publish the permitted
        values for the core <code>roles</code> and <code>entitlements</code> attributes, which in
        practice vary by tenant and by which services a customer has bought, so a client can
        discover them rather than guess.
      </p>
    </li>
  </ul>

  <h4>Individual drafts</h4>

  <p>
    These are individual submissions that the working group has not adopted. They carry no
    consensus and may change or disappear, but they are where most active SCIM work currently
    sits.
  </p>

  <ul class="spec-list">
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-zollner-scim-interop-profile/" class="rfc-badge">draft-zollner-scim-interop-profile</a>
        <span class="rev-pill">-01</span>
        <span class="status status--active">Active</span>
      </div>
      <p>
        SCIM 2.0 Interoperability Profile. Constrains the base specification's many optional
        features into a required baseline, on the argument that the many-to-many model &mdash;
        one identity provider talking to many service providers, each provider accepting many
        identity providers &mdash; multiplies the cost of every optional feature.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-schreiber-scim-ipsie-profile/" class="rfc-badge">draft-schreiber-scim-ipsie-profile</a>
        <span class="rev-pill">-00</span>
        <span class="status status--active">Active</span>
      </div>
      <p>
        SCIM 2.0 IPSIE Profile. A profile for enterprise identity lifecycle covering
        provisioning, account management, client authentication, and synchronization, organised
        into three Account Lifecycle assurance levels: deprovisioning, user and group
        management, then role management.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-zollner-scim-group-members/" class="rfc-badge">draft-zollner-scim-group-members</a>
        <span class="rev-pill">-01</span>
        <span class="status status--active">Active</span>
      </div>
      <p>
        SCIM Group Member Resource Type Extension. Promotes membership to a top-level
        <code>GroupMember</code> resource. Because RFC 7643 models members as values inside a
        Group attribute, there is no way to page, filter, or sort them &mdash; at a million
        members a single response can exceed 100&nbsp;MB, which is why many implementations
        simply omit <code>members</code>.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-kushwaha-scim-attr-cursor-pagination/" class="rfc-badge">draft-kushwaha-scim-attr-cursor-pagination</a>
        <span class="rev-pill">-01</span>
        <span class="status status--active">Active</span>
      </div>
      <p>
        Cursor-based pagination and deferred retrieval for multi-valued attributes. Tackles the
        same scale problem from the other direction: rather than flattening membership into its
        own resource, it pages <em>within</em> an attribute such as
        <code>Group.members</code>, and defines how a client can tell a bounded response from a
        complete one. Distinct from <a href="/extensions/cursor-pagination/">RFC 9865</a>, which
        pages collections of resources.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-wzdk-scim-agent-resource/" class="rfc-badge">draft-wzdk-scim-agent-resource</a>
        <span class="rev-pill">-00</span>
        <span class="status status--active">Active</span>
      </div>
      <p>
        AI Agent Resource Extension. A minimal schema for representing an AI agent as a SCIM
        resource, so an agent identity can be provisioned over the SCIM protocol and later
        authenticated and authorized like any other principal.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-kushwaha-scim-agent-governance/" class="rfc-badge">draft-kushwaha-scim-agent-governance</a>
        <span class="rev-pill">-00</span>
        <span class="status status--active">Active</span>
      </div>
      <p>
        SCIM Agent Governance Extension. Builds on the agent resource above with governance
        metadata: a lifecycle state model drawn from ISO/IEC 24760-1 rather than a single
        boolean, an autonomy classification, a validity window, and a credential-discovery
        reference. Authorization and credential management are deliberately left out.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-kushwaha-scim-tenant-resource/" class="rfc-badge">draft-kushwaha-scim-tenant-resource</a>
        <span class="rev-pill">-00</span>
        <span class="status status--active">Active</span>
      </div>
      <p>
        Tenant-aware identity provisioning. Adds a <code>Tenant</code> resource type and
        tenant-membership extensions to User and Group, plus tenant-scoped uniqueness, a rule for
        resolving which tenant a request applies to, and tenant-aware filtering. Aimed at
        multi-tenant SaaS and B2B deployments.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-kushwaha-scim-didvc-binding/" class="rfc-badge">draft-kushwaha-scim-didvc-binding</a>
        <span class="rev-pill">-01</span>
        <span class="status status--active">Active</span>
      </div>
      <p>
        SCIM DID/VC Binding Extension. Records auditable links between a SCIM User and
        Decentralized Identifiers or Verifiable Credentials, via an
        <code>IdentityBinding</code> resource type and a read-only User extension exposing
        binding state. DID resolution and credential issuance are out of scope; state changes
        propagate as <a href="/extensions/events/">RFC 9967</a> events.
      </p>
    </li>
  </ul>

  <h3>Historical drafts</h3>

  <details class="disclosure">
    <summary>Expired individual drafts from 2015&ndash;2018 (6)</summary>
    <div class="disclosure-body">

  <div class="callout callout--muted">
    <strong class="callout-label">Note</strong>
    <p>
      These are individual Internet-Drafts rather than working group products, and all of
      them have expired. They are listed for the historical record; do not treat them as
      current.
    </p>
  </div>

  <ul class="spec-list">
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-ansari-scim-soft-delete/" class="rfc-badge">draft-ansari-scim-soft-delete</a>
        <span class="status status--expired">Expired</span>
      </div>
      <p>
        This document specifies a profile that handles soft delete of Users on SCIM service
        providers.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-hunt-scim-notify/" class="rfc-badge">draft-hunt-scim-notify</a>
        <span class="status status--expired">Expired</span>
      </div>
      <p>
        In a SCIM environment, changes to resources may be requested by multiple parties. As
        time goes by an interested subscriber may wish to be informed about resource state
        changes that are occurring at the SCIM service provider. This specification defines a
        hub notification service that can be used to publish and distribute events to
        interested registered subscribers.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-hunt-scim-password-mgmt/" class="rfc-badge">draft-hunt-scim-password-mgmt</a>
        <span class="status status--expired">Expired</span>
      </div>
      <p>
        This specification defines a set of password and account status extensions for
        managing passwords and password usage (e.g. failures) and other related session data.
        The specification defines new ResourceTypes that enable management of passwords and
        account recovery functions.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-wahl-scim-jit-profile/" class="rfc-badge">draft-wahl-scim-jit-profile</a>
        <span class="status status--expired">Expired</span>
      </div>
      <p>
        This document specifies a profile of the System for Cross-domain Identity Management
        Protocol (SCIM). Servers which implement protocols such as SAML or OpenID Connect
        receive user identities through those protocols and often cache them, and this
        profile of SCIM defines how an identity provider can notify a SCIM server of changes
        to user accounts.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-greevenbosch-scim-vcard-mapping/" class="rfc-badge">draft-greevenbosch-scim-vcard-mapping</a>
        <span class="status status--expired">Expired</span>
      </div>
      <p>
        This document defines a mapping between SCIM and vCard.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="https://datatracker.ietf.org/doc/draft-grizzle-scim-pam-ext/" class="rfc-badge">draft-grizzle-scim-pam-ext</a>
        <span class="status status--expired">Expired</span>
      </div>
      <p>
        This document contains a SCIM 2.0 extension for Privileged Access Management, which
        includes extensions to the core User and Group objects, and new resource types and
        schemas for standard Privileged Access Management constructs. This extension is
        intended to provide greater interoperability between PAM software and clients, a
        common language for PAM concepts, and a baseline that can be further extended to
        support more complex PAM requirements.
      </p>
    </li>
  </ul>

    </div>
  </details>

  <h3>SCIM 1.1</h3>

  <p>
    Second official release of the SCIM specification, released in July 2012. Compatible with
    1.0 and contains cleanups and clarifications on issues found during interop testing.
    These documents predate the IETF work and are archived here.
  </p>

  <ul class="spec-list">
    <li>
      <div class="spec-title">
        <a href="/specs/draft-scim-core-schema-01.html">Core Schema</a>
        <span class="status status--draft">Archived</span>
      </div>
      <p>
        The Core Schema provides a platform-neutral schema and extension model for
        representing users and groups in JSON and XML formats.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="/specs/draft-scim-api-01.html">REST API</a>
        <span class="status status--draft">Archived</span>
      </div>
      <p>
        The SCIM Protocol is an application-level, REST protocol for provisioning and
        managing identity data on the web.
      </p>
    </li>
  </ul>

  <h3>SCIM 1.0</h3>

  <div class="page-meta">
    <span class="status status--deprecated">Deprecated</span>
  </div>

  <p>
    First official release of the SCIM specification, released in December 2011.
  </p>

  <ul class="spec-list">
    <li>
      <div class="spec-title">
        <a href="/specs/draft-scim-scenarios-04.html">Scenarios Doc &mdash; draft 4</a>
        <span class="status status--deprecated">Deprecated</span>
      </div>
      <p>
        The scenario document was created to guide the development of the specification and is
        not normative.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="/specs/draft-scim-core-schema-00.html">Core Schema</a>
        <span class="status status--deprecated">Deprecated</span>
      </div>
      <p>
        The Core Schema provides a platform-neutral schema and extension model for
        representing users and groups in JSON and XML formats.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="/specs/draft-scim-api-00.html">REST API</a>
        <span class="status status--deprecated">Deprecated</span>
      </div>
      <p>
        The SCIM Protocol is an application-level, REST protocol for provisioning and
        managing identity data on the web.
      </p>
    </li>
    <li>
      <div class="spec-title">
        <a href="/specs/draft-scim-saml2-binding-02.html">SAML 2.0 Binding &mdash; draft 1</a>
        <span class="status status--deprecated">Deprecated</span>
      </div>
      <p>
        Defines a binding of SCIM schema to SAML messages and assertions.
      </p>
    </li>
  </ul>

</div>

<?php require(__DIR__.'/../../includes/_footer.php') ?>
