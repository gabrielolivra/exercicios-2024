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



$writer = WriterEntityFactory::createXLSXWriter();



$writer->openToFile($file);


$header = [
    'ID', 'Title', 'Type', 'Author 1', 'Author 1 Institution',
    'Author 2', 'Author 2 Institution', 'Author 3', 'Author 3 Institution',
    'Author 4', 'Author 4 Institution', 'Author 5', 'Author 5 Institution',
    'Author 6', 'Author 6 Institution', 'Author 7', 'Author 7 Institution',
    'Author 8', 'Author 8 Institution', 'Author 9', 'Author 9 Institution'
];



$styleCabecalho = (new StyleBuilder())->setFontBold()->setFontName('Arial')->setFontSize(10)->build();



$headerRow = WriterEntityFactory::createRowFromArray($header, $styleCabecalho);



$writer->addRow($headerRow);


foreach ($data as $row) {


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

 

    $styleDados = (new StyleBuilder())->setFontName('Arial')->setFontSize(10)->build();

    

    $rowData = WriterEntityFactory::createRow($cells, $styleDados);

    

    $writer->addRow($rowData);
}



$writer->close();

return $data;

}

}


