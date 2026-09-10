<?php
/**
 * Code block rendering.
 *
 * Samples are stored as plain text and tokenized here, rather than carrying
 * pre-baked <span style="..."> markup around. That keeps the samples editable
 * and lets the token colors come from the theme.
 */

require_once(__DIR__.'/_functions.php');

/**
 * @param string      $code  The sample, as plain text.
 * @param string      $lang  'json', 'http', or 'text'.
 * @param string|null $label Optional header strip, e.g. "POST /v2/Users".
 */
function code_block($code, $lang = 'json', $label = null) {
  $code = trim($code, "\n");

  switch($lang) {
    case 'http': $html = highlight_http($code); break;
    case 'json': $html = highlight_json($code); break;
    default:     $html = e($code);
  }

  echo '<div class="code-block">';
  if($label !== null) {
    echo '<div class="code-block-label">'.e($label).'</div>';
  }
  echo '<pre><code>'.$html.'</code></pre>';
  echo '</div>'."\n";
}

function highlight_json($code) {
  // One alternation over string literals (optionally followed by a colon, which
  // makes them object keys), numbers, literals, and punctuation.
  $pattern = '/("(?:\\\\.|[^"\\\\])*")([ \t]*:)?'
           . '|(-?\d+(?:\.\d+)?(?:[eE][+-]?\d+)?)'
           . '|\b(true|false)\b'
           . '|\b(null)\b'
           . '|([{}\[\],:])/';

  $out = '';
  $offset = 0;

  while($offset <= strlen($code)
        && preg_match($pattern, $code, $m, PREG_OFFSET_CAPTURE, $offset)) {
    $start = $m[0][1];
    $out .= e(substr($code, $offset, $start - $offset));

    if(matched($m, 1)) {
      if(matched($m, 2)) {
        $out .= span('t-key', $m[1][0]).span('t-punct', $m[2][0]);
      } else {
        $out .= span('t-str', $m[1][0]);
      }
    } elseif(matched($m, 3)) {
      $out .= span('t-num', $m[3][0]);
    } elseif(matched($m, 4)) {
      $out .= span('t-bool', $m[4][0]);
    } elseif(matched($m, 5)) {
      $out .= span('t-null', $m[5][0]);
    } elseif(matched($m, 6)) {
      $out .= span('t-punct', $m[6][0]);
    }

    $offset = $start + strlen($m[0][0]);
  }

  return $out.e(substr($code, $offset));
}

function highlight_http($code) {
  // Split the message at the first blank line: head, then optional JSON body.
  $parts = preg_split('/\R\R/', $code, 2);
  $head  = $parts[0];
  $body  = isset($parts[1]) ? $parts[1] : null;

  $out = [];
  foreach(preg_split('/\R/', $head) as $i => $line) {
    if($i === 0 && preg_match('~^([A-Z]+) (\S+) (HTTP/[\d.]+)$~', $line, $m)) {
      $out[] = span('t-method', $m[1]).' '.span('t-path', $m[2]).' '.span('t-proto', $m[3]);
    } elseif($i === 0 && preg_match('~^(HTTP/[\d.]+) (\d{3})(.*)$~', $line, $m)) {
      $out[] = span('t-proto', $m[1]).' '.span('t-num', $m[2]).span('t-status', $m[3]);
    } elseif(preg_match('/^([A-Za-z0-9-]+):(.*)$/', $line, $m)) {
      $out[] = span('t-header', $m[1]).span('t-punct', ':').e($m[2]);
    } else {
      $out[] = e($line);
    }
  }

  $html = implode("\n", $out);
  if($body !== null) {
    $html .= "\n\n".highlight_json($body);
  }
  return $html;
}

function span($class, $text) {
  return '<span class="'.$class.'">'.e($text).'</span>';
}

// With PREG_OFFSET_CAPTURE an unmatched group is ['', -1].
function matched(array $m, $i) {
  return isset($m[$i]) && $m[$i][1] !== -1 && $m[$i][0] !== '';
}
