<?php
namespace Chuva\Php\WebScrapping;
//use Box\Spout\Common\Entity\Row;
require __DIR__.'../../vendor/autoload.php';


class Main {

  public static function run(): array {
    $dom = new \DOMDocument('1.0', 'utf-8');
    $dom->loadHTMLFile(__DIR__ . '/../../assets/origin.html');
    
    $xpath = new \DOMXPath($dom);
    
// Filtrar tag a com a classe especifica

    $query = "//a[contains(concat(' ', normalize-space(@class), ' '), ' paper-card p-lg bd-gradient-left ')]";
    $allLinks = $xpath->query($query);
    
    $data = [];

// Ler arquivos do origin.html


    foreach ($allLinks as $link) {
        $tagName = $link->tagName;
        $textContent = trim($link->textContent);
        $href = $link->getAttribute('href');

// Extrai o id'

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

// Extrai o titulo


        if ($link->getElementsByTagName('h4')->length > 0) {
            $titulo = trim($link->getElementsByTagName('h4')[0]->textContent);
        } else {
            $titulo = ''; 
        }

// Extrai os autores

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

// extrai universidades

$universidades = [];

for ($i = 1; $i <= 10; $i++) {        
    if ($link->getElementsByTagName('span')->item($i - 1)) {
        $span = $link->getElementsByTagName('span')->item($i - 1);
        if ($span->hasAttribute('title')) {
            $universidades[] = trim($span->getAttribute('title'));
        }
    }
}

// Inicialize as variáveis de universidade


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
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

$data = Main::run();

$file = __DIR__.'/../../assets/model-resultado.xlsx';

// Cria o escritor
$writer = WriterEntityFactory::createXLSXWriter();

// Abre o arquivo para escrita
$writer->openToFile($file);

// Adiciona o cabeçalho
$header = [
    'ID', 'Title', 'Type', 'Author 1', 'Author 1 Institution',
    'Author 2', 'Author 2 Institution', 'Author 3', 'Author 3 Institution',
    'Author 4', 'Author 4 Institution', 'Author 5', 'Author 5 Institution',
    'Author 6', 'Author 6 Institution', 'Author 7', 'Author 7 Institution',
    'Author 8', 'Author 8 Institution', 'Author 9', 'Author 9 Institution'
];
$headerRow = WriterEntityFactory::createRowFromArray($header);
$writer->addRow($headerRow);

// Itera sobre os dados
foreach ($data as $row) {
    // Cria um array de células para esta linha
    $cells = [
        WriterEntityFactory::createCell($row['id']),
        WriterEntityFactory::createCell($row['title']),
        WriterEntityFactory::createCell($row['type']),
        WriterEntityFactory::createCell($row['author1']),
        WriterEntityFactory::createCell($row['universidade1']),
        WriterEntityFactory::createCell($row['author2']),
        WriterEntityFactory::createCell($row['universidade2']),
        WriterEntityFactory::createCell($row['author3']),
        WriterEntityFactory::createCell($row['universidade3']),
        WriterEntityFactory::createCell($row['author4']),
        WriterEntityFactory::createCell($row['universidade4']),
        WriterEntityFactory::createCell($row['author5']),
        WriterEntityFactory::createCell($row['universidade5']),
        WriterEntityFactory::createCell($row['author6']),
        WriterEntityFactory::createCell($row['universidade6']),
        WriterEntityFactory::createCell($row['author7']),
        WriterEntityFactory::createCell($row['universidade7']),
        WriterEntityFactory::createCell($row['author8']),
        WriterEntityFactory::createCell($row['universidade8']),
        WriterEntityFactory::createCell($row['author9']),
        WriterEntityFactory::createCell($row['universidade9'])
    ];

    // Cria uma linha com as células
    $rowData = WriterEntityFactory::createRow($cells);

    // Adiciona a linha ao escritor
    $writer->addRow($rowData);
}

// Fecha o arquivo
$writer->close();
