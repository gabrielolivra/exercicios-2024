<?php
namespace Chuva\Php\WebScrapping;
require_once 'vendor/autoload.php';
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Main {

  public static function run(): array {
    $dom = new \DOMDocument('1.0', 'utf-8');
    $dom->loadHTMLFile(__DIR__ . '/../../assets/origin.html');
    $allLinks = $dom->getElementsByTagName('a');
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

// Atribua os valores das universidades às variáveis correspondentes
for ($i = 0; $i < count($universidades); $i++) {
    ${'universidade' . ($i + 1)} = $universidades[$i];
}

// Remova universidades extras se houver mais de 9
if (count($universidades) > 9) {
    array_splice($universidades, 9);
}

// Junte as universidades em uma string separada por vírgula
$autoresUni = implode(', ', $universidades);

// Adicione as variáveis das universidades ao array $data
$data[] = [
    'id' => $id,
    'title' => $titulo,
    'author1' => $autor1,
    'author2' => $autor2,
    'author3' => $autor3,
    'author4' => $autor4,
    'author5' => $autor5,
    'author6' => $autor6,
    'author7' => $autor7,
    'author8' => $autor8,
    'author9' => $autor9,
    'universidade1' => $universidade1,
    'universidade2' => $universidade2,
    'universidade3' => $universidade3,
    'universidade4' => $universidade4,
    'universidade5' => $universidade5,
    'universidade6' => $universidade6,
    'universidade7' => $universidade7,
    'universidade8' => $universidade8,
    'universidade9' => $universidade9,
    'type' => $type
];



    }

    $writer = \Box\Spout\Writer\Common\Creator\WriterEntityFactory::createXLSXWriter(); // Corrigido o namespace aqui
    $outputFilePath = realpath(__DIR__ . '/../../assets/model.xlsx');

    // Se o arquivo não existir, cria um novo
    if (!file_exists($outputFilePath)) {
        $writer = \Box\Spout\Writer\Common\Creator\WriterEntityFactory::createXLSXWriter();
        $writer->openToFile($outputFilePath);
    
        // Defina o cabeçalho da planilha
        $headers = [
            'ID',
            'Title',
            'Author 1',
            'Author 2',
            'Author 3',
            'Author 4',
            'Author 5',
            'Author 6',
            'Author 7',
            'Author 8',
            'Author 9',
            'University 1',
            'University 2',
            'University 3',
            'University 4',
            'University 5',
            'University 6',
            'University 7',
            'University 8',
            'University 9',
            'Type'
        ];
        $headerRow = WriterEntityFactory::createRowFromArray($headers);
        $writer->addRow($headerRow);
    } else {
        // Se o arquivo já existir, abra-o para adicionar novas linhas
        $writer = \Box\Spout\Writer\Common\Creator\WriterEntityFactory::createXLSXWriter();
        $writer->openToFile($outputFilePath, 'a'); // 'a' para adicionar novas linhas
    }
    
    // Adicione os dados ao arquivo
    foreach ($data as $row) {
        $rowData = WriterEntityFactory::createRowFromArray([
            $row['id'],
            $row['title'],
            $row['author1'],
            $row['author2'],
            $row['author3'],
            $row['author4'],
            $row['author5'],
            $row['author6'],
            $row['author7'],
            $row['author8'],
            $row['author9'],
            $row['universidade1'],
            $row['universidade2'],
            $row['universidade3'],
            $row['universidade4'],
            $row['universidade5'],
            $row['universidade6'],
            $row['universidade7'],
            $row['universidade8'],
            $row['universidade9'],
            $row['type']
        ]);
        $writer->addRow($rowData);
    }
    
    // Feche o arquivo
    $writer->close();
    
    return $data;

}

 }

 $resultsFromHTML = Main::run();


