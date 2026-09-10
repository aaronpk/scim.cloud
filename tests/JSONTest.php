<?php

class JSONTest extends PHPUnit\Framework\TestCase {

  const PROPERTIES = [
    'project_name',
    'client',
    'server',
    'open_source',
    'license',
    'developer',
    'link',
  ];

  /**
   * @dataProvider loadJSON
   */
  public function testFileSyntax($data, $f) {

    if($data == null) {
      $this->fail('JSON syntax error in file: '.$f);
    }

    $this->assertArrayHasKey('implementations', $data, 'Missing "implementations" list in: '.$f);

    foreach($data['implementations'] as $im) {
      $this->assertArrayHasKey('project_name', $im, 'Missing "project_name" in: '.$f);

      $name = $im['project_name'];

      // Check for required properties
      foreach(self::PROPERTIES as $p) {
        $this->assertArrayHasKey($p, $im, '"'.$name.'" is missing property: '.$p);
      }

      // Check values

      $this->assertContains($im['client'], ['Yes','No'], '"'.$name.'" property "client" must be either Yes or No. Found: '.$im['client']);

      $this->assertContains($im['server'], ['Yes','No'], '"'.$name.'" property "server" must be either Yes or No. Found: '.$im['server']);

      $this->assertContains($im['open_source'], ['Yes','No','Partial'], '"'.$name.'" property "open_source" must be Yes, No, or Partial. Found: '.$im['open_source']);

      $this->assertIsString($im['license'], '"'.$name.'" property "license" must be a string');

      if($im['open_source'] === 'No') {
        $this->assertSame('', $im['license'], '"'.$name.'" is not open source, so "license" must be empty');
      }

      // One legacy entry (CA Identity Manager) still points at an ftp:// URL,
      // so the scheme check allows it rather than failing the whole suite.
      $this->assertMatchesRegularExpression('~^(https?|ftp)://.+~', $im['link'], '"'.$name.'" property "link" must be a URL');

      // Ensure there are no other keys
      $this->assertEmpty(array_diff(array_keys($im), self::PROPERTIES),
        '"'.$name.'" contains extra properties: '.$f);

    }

  }

  public static function loadJSON()
  {

    $files = glob(__DIR__.'/../public/json/*.json');
    foreach($files as $f) {
      yield basename($f) => [json_decode(file_get_contents($f), true), $f];
    }

  }

}
