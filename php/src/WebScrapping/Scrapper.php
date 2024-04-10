<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;


class Scrapper {

  public function scrap(\DOMDocument $dom): array {

    $dom = new \DOMDocument('1.0', 'utf-8');
    $dom->loadHTMLFile(__DIR__ . '/../../assets/origin.html');
    
    $xpath = new \DOMXPath($dom);
    


    $query = "//a[contains(concat(' ', normalize-space(@class), ' '), ' paper-card p-lg bd-gradient-left ')]";
    $allLinks = $xpath->query($query);
    


    foreach ($allLinks as $link) {
        $tagName = $link->tagName;
        $textContent = trim($link->textContent);
        $href = $link->getAttribute('href');



    preg_match('~/_papers/(\d+)~', $href, $matches);
        $id = $matches[1] ?? '';
        $type = ''; 
        $parentDivs = $link->parentNode->getElementsByTagName('div');
    
        foreach ($parentDivs as $parentDiv) {
            if ($parentDiv->hasAttribute('class') && $parentDiv->getAttribute('class') === 'tags mr-sm') {
                $type = trim($parentDiv->textContent);
                break; 
            }
        }




        if ($link->getElementsByTagName('h4')->length > 0) {
            $titulo = trim($link->getElementsByTagName('h4')[0]->textContent);
        } else {
            $titulo = ''; 
        }


$authors = [];

for ($i = 1; $i <= 10; $i++) {        
    if ($link->getElementsByTagName('span')->item($i - 1)) {
        $authors[] = trim($link->getElementsByTagName('span')->item($i - 1)->textContent);
    }
}

$autor1 = ''; $autor2 = ''; $autor3 = ''; $autor4 = ''; $autor5 = ''; $autor6 = ''; $autor7 = ''; $autor8 = ''; $autor9 = '';

for ($i = 0; $i < count($authors); $i++) {
    ${'autor' . ($i + 1)} = $authors[$i];
}

if (count($authors) > 9) {
    array_splice($authors, 9);
}

$autores = implode(', ', $authors);



$universidades = [];

for ($i = 1; $i <= 10; $i++) {        
    if ($link->getElementsByTagName('span')->item($i - 1)) {
        $span = $link->getElementsByTagName('span')->item($i - 1);
        if ($span->hasAttribute('title')) {
            $universidades[] = trim($span->getAttribute('title'));
        }
    }
}




$universidade1 = ''; $universidade2 = ''; $universidade3 = ''; $universidade4 = ''; $universidade5 = ''; $universidade6 = ''; $universidade7 = '';
$universidade8 = ''; $universidade9 = '';

for ($i = 0; $i < count($universidades); $i++) {
    ${'universidade' . ($i + 1)} = $universidades[$i];
}

if (count($universidades) > 9) {
    array_splice($universidades, 9);
}

$autoresUni = implode(', ', $universidades);
$data[] = [
    'id' => $id,
    'title' => $titulo,
    'type' => $type,
    'author1' => $autor1,
    'universidade1' => $universidade1,
    'author2' => $autor2,
    'universidade2' => $universidade2,
    'author3' => $autor3,
    'universidade3' => $universidade3,
    'author4' => $autor4,
    'universidade4' => $universidade4,
    'author5' => $autor5,
    'universidade5' => $universidade5,
    'author6' => $autor6,
    'universidade6' => $universidade6,
    'author7' => $autor7,
    'universidade7' => $universidade7,
    'author8' => $autor8,
    'universidade8' => $universidade8,
    'author9' => $autor9,
    'universidade9' => $universidade9    
];

}
    return $data;

  }

}
