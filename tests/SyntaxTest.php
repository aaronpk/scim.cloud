<?php

/**
 * The site has no autoloader and no unit-testable classes, so the cheapest
 * useful guard is linting every PHP file that gets served or included.
 */
class SyntaxTest extends PHPUnit\Framework\TestCase {

  /**
   * @dataProvider phpFiles
   */
  public function testFileParses($file) {
    $output = [];
    $status = 0;
    exec('php -l '.escapeshellarg($file).' 2>&1', $output, $status);

    $this->assertSame(0, $status, implode("\n", $output));
  }

  public static function phpFiles() {
    $root = dirname(__DIR__);

    $files = array_merge(
      glob($root.'/*.php'),
      glob($root.'/includes/*.php'),
      // public/**/index.php, up to the deepest level the site uses.
      glob($root.'/public/index.php'),
      glob($root.'/public/*/index.php'),
      glob($root.'/public/*/*/index.php'),
      glob($root.'/public/*/*/*/index.php')
    );

    foreach($files as $file) {
      yield substr($file, strlen($root) + 1) => [$file];
    }
  }

  public function testEveryPageIsReachableFromTheSidebar() {
    $sidebar = file_get_contents(dirname(__DIR__).'/includes/_sidebar.php');
    $root = dirname(__DIR__).'/public';

    foreach(self::pages() as $path => $page) {
      // Redirect stubs live at retired URLs on purpose and are not navigable.
      if(self::redirectTarget($page) !== null) continue;

      $this->assertStringContainsString('href="'.$path.'"', $sidebar,
        $path.' is not linked from the sidebar');
    }
  }

  public function testRedirectStubsPointAtRealPages() {
    $root = dirname(__DIR__).'/public';
    $found = 0;

    foreach(self::pages() as $path => $page) {
      $target = self::redirectTarget($page);
      if($target === null) continue;

      $found++;
      $this->assertNotSame($path, $target, $path.' redirects to itself');
      $this->assertFileExists($root.$target.'index.php',
        $path.' redirects to '.$target.', which is not a page');
    }

    $this->assertGreaterThan(0, $found, 'expected at least one redirect stub');
  }

  /** @return array<string,string> URL path => absolute file path */
  private static function pages() {
    $root = dirname(__DIR__).'/public';

    $files = array_merge(
      glob($root.'/*/index.php'),
      glob($root.'/*/*/index.php'),
      glob($root.'/*/*/*/index.php')
    );

    $pages = [];
    foreach($files as $file) {
      $pages[str_replace($root, '', dirname($file)).'/'] = $file;
    }
    return $pages;
  }

  /** The Location target if this file is a redirect stub, otherwise null. */
  private static function redirectTarget($file) {
    if(!preg_match("~header\('Location: ([^']+)'~", file_get_contents($file), $m)) {
      return null;
    }
    return $m[1];
  }

}
