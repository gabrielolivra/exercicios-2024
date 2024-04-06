<?php
namespace Chuva\Php\WebScrapping;
require __DIR__.'../../vendor/autoload.php';
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\CellAlignment;
use Box\Spout\Common\Entity\Style\Color;


class Main {

  public static function run(): array {

    $dom = new \DOMDocument('1.0', 'utf-8');
    libxml_use_internal_errors(true);
    $dom -> loadHTMLFile(__DIR__.'/../../assets/origin.html');
    $data = (new Scrapper())->scrap($dom);


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

// Adiciona estilos no cabeçalho

$styleCabecalho = (new StyleBuilder())->setFontBold()->setFontName('Arial')->setFontSize(10)->build();

// Cria a linha de cabeçalho com o estilo

$headerRow = WriterEntityFactory::createRowFromArray($header, $styleCabecalho);

// Adiciona a linha de cabeçalho ao escritor

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

    // Adiciona estilos aos dados exibidos no excel

    $styleDados = (new StyleBuilder())->setFontName('Arial')->setFontSize(10)->build();

    // Cria uma linha com as células

    $rowData = WriterEntityFactory::createRow($cells, $styleDados);

    // Adiciona a linha ao escritor

    $writer->addRow($rowData);
}

// Fecha o arquivo

$writer->close();

return $data;

}

}


