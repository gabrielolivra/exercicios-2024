<?php

namespace Chuva\Tests\Unit\WebScrapping\WebScrapping\Entity;

use Chuva\Php\WebScrapping\Entity\Person;
use PHPUnit\Framework\TestCase;


class PersonTest extends TestCase {

 
  public function testConstruct() {
    $person = new Person('Name', 'Institution');

    $this->assertEquals('Name', $person->name);
    $this->assertEquals('Institution', $person->institution);
  }


  public function testConstructNoInstitution() {
    $person = new Person('Name', '');

    $this->assertEquals('Name', $person->name);
    $this->assertEquals('', $person->institution);
  }

}