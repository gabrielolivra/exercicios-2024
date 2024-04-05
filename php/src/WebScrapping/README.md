# GaloScrapper
## Web Scrapping
Neste segundo exercício você deve capturar os dados de uma página HTML e converter em uma planilha. O arquivo a ser lido é `webscrapping/origin.html`, ele é uma página (com algumas adaptações) de um Proceedings do Galoá. O seu objetivo é extrair as informações sobre trabalhos e montar uma planilha similar a `webscrapping/model.xlsx`.

Para a resolução do exercício, você pode alterar qualquer arquivo dentro da pasta `src/WebScrapping`.

### Como rodar

Dependências:

* PHP - linha de comando
* Extensões do PHP: ZIP, DOM, XML
* [Composer](https://getcomposer.org/)

Rode o seguinte comando para instalar o ambiente:

```
composer install
```

Para rodar o scrapping, rode o seguinte comando:

```
composer webscrapping
```

### Dicas de resolução

Duas ferramentas vão ser especialmente úteis para você resolver este exercício.

* DOM, para ler o HTML - https://www.php.net/manual/pt_BR/class.domdocument.php
* Spout, para escrever a planilha - https://opensource.box.com/spout/



#####

-------------------- COMO RODAR O GALOSCRAPPER---------------------------------------

1. Baixar o PHP 8.1
2. Baixar o Composer
3. Instalar o Composer
4. Entrar no SRC do app
5. Dar o comando *composer WebScrapping*
6. Irá Fazer o Scrapping da pagina html origin.html
7. Irá gerar uma planilha no assets com nome *model-resultado.xlsx* com todos os dados obtidos e tratados em suas devidas colunas.

------------------------- CASO NÃO CONSIGA RODAR O APP --------------------------------

1. Usar o comando *composer install*
2. Instalar todas dependencias importadas no diretorio webscrapping no arquivo *Main.php*
3. Seguir os passos a partir do numero 4 do *COMO RODAR O GALOSCRAPPER*

----------------------------- RODANDO OS TESTES --------------------------------------

1. Instalar os teste - Comando ->  *composer require --dev phpunit/phpunit*
2. acesssar o diretorio *php\tests\Unit\WebScrapping*
3. Utilizar o comando *..\..\..\vendor\bin\phpunit .\ScrapperTest.php* para executar os teste
