# scim.cloud

Source code for [scim.cloud](https://scim.cloud).

## Know of an implementation that should be listed?

Submit a pull request updating
[scim_v1_implementations.json](https://github.com/aaronpk/scim.cloud/blob/main/public/json/scim_v1_implementations.json)
or
[scim_v2_implementations.json](https://github.com/aaronpk/scim.cloud/blob/main/public/json/scim_v2_implementations.json).

Every entry has exactly these seven fields, in this order:

| Field | Values | Notes |
| --- | --- | --- |
| `project_name` | string | Display name of the project or product. |
| `client` | `Yes` / `No` | Whether it initiates provisioning requests. |
| `server` | `Yes` / `No` | Whether it acts as a SCIM service provider. |
| `open_source` | `Yes` / `No` / `Partial` | |
| `license` | SPDX identifier, or `""` | e.g. `MIT`, `Apache-2.0`. Empty when not open source, or when the license isn't stated. |
| `developer` | string | Company or individual. |
| `link` | URL | Documentation or project home page. |

The test suite enforces this schema, so a malformed entry fails CI.

## Local development

```bash
composer install
composer start        # http://127.0.0.1:8080
composer test
```

`router.php` is only used by PHP's built-in server — it exists because that server
otherwise mishandles paths containing a dot, such as `/implementations/2.0/`. In production,
`public/` is served directly as the document root.

## Layout

```
includes/            shared layout: header, sidebar, footer, code blocks, data loading
public/              document root
  index.php          home page
  overview/          introduction and object model
  schema/            RFC 7643 — core schema, example User and Group
  protocol/          RFC 7644 — operations, discovery, examples
  extensions/        one directory per extension RFC (9865, 9944, 9967)
  implementations/   the implementation lists
  json/              implementation data
  stylesheets/       the design system (single file)
  specs/             the RFC index, plus archived SCIM 1.0 and 1.1 documents
tests/               PHPUnit: JSON schema checks and PHP syntax linting
```

Adding a page means creating `public/<path>/index.php` and linking it from
`includes/_sidebar.php` — a test asserts every page is reachable from the sidebar.

The exception is a **redirect stub**: an `index.php` that is nothing but
`header('Location: …', true, 301)`, left behind at a URL that has moved. Stubs are exempt from
the sidebar check, and a separate test asserts each one points at a page that exists.
