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

    $pages = array_merge(
      glob($root.'/*/index.php'),
      glob($root.'/*/*/index.php'),
      glob($root.'/*/*/*/index.php')
    );

    foreach($pages as $page) {
      $path = str_replace($root, '', dirname($page)).'/';
      $this->assertStringContainsString('href="'.$path.'"', $sidebar,
        $path.' is not linked from the sidebar');
    }
  }

}
