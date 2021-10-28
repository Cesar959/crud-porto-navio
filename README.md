<h1 align="center"> Crud de Porto de Navios </h1>

<p align="center">
    <img src="doc/resultado.jpg" alt="imagem-site" width="600" height="auto">
</p>


Projeto Crud (Create, Read, Update, Delete) para Porto de Navios.

## Descrição

O projeto é um crud de Porto de Navios aonde é possível cadastrar, alterar, ler e excluir registro de Containers e Movimentações no banco de dados. Para isso foi utilizando o PHP para realizar execução de instruções SQL no banco de dados phpMyAdmin, além disso foi utilizado POO (Programação Orientada a Objetos), PDO (PHP Data Object) e DAO (Data Access Object) na construção das class. Na arquitetura do projeto foi utilizado a ideia do MVC (Model View Controller) para que assim as class ficassem separadas permitindo melhor manutenção do código e tambem a utilização do Composer para Geração de PDF e autoload das class. Na pasta DOC você encontra todo o planejamento do projeto como o desenho da modelagem do banco de dados, diagrama UML das class utilizadas e o próprio banco de dados exportado. 

## São requisitos funcionais da aplicaçào:

### Crud de Contêiner

* Cliente
* Número do contêiner (4 letras e 7 números. Ex: TEST1234567)
* Tipo: 20 / 40
* Status: Cheio / Vazio
* Categoria: Importaçào / Exportaçào

### Crud de Movimentações

* Tipo	de	Movimentaçào	(embarque,	descarga,	gate	in,	gate	out, reposicionamento, pesagem, scanner)
* Data e Hora do Início
* Data e Hora do Fim
* Relatório  com   o   total   de   movimentações   agrupadas   por   cliente   e   tipo  de movimentaçào.
  * No final do relatório deverá conter um sumário com o total de importaçào / exportação.



## Status do Projeto

**Concluido**: O projeto esta terminado, não havera futuras alterações de funcionalidade.


## Construído com

* [HTML](https://www.w3schools.com/html/) - HTML abreviação para a expressão inglesa HyperText Markup Language, que significa: "Linguagem de Marcação de Hipertexto" é uma linguagem de marcação utilizada na construção de páginas na Web. Documentos HTML podem ser interpretados por navegadores. A tecnologia é fruto da junção entre os padrões HyTime e SGML.

* [CSS](https://www.w3schools.com/css/default.asp) - Cascading Style Sheets é um mecanismo para adicionar estilo a um documento web. O código CSS pode ser aplicado diretamente nas tags ou ficar contido dentro das tags "style". Também é possível, em vez de colocar a formatação dentro do documento, criar um link para um arquivo CSS que contém os estilos.

* [JavaScript](https://developer.mozilla.org/pt-BR/docs/Web/JavaScript) - CJavaScript é uma linguagem de programação interpretada estruturada, de script em alto nível com tipagem dinâmica fraca e multiparadigma. Juntamente com HTML e CSS, o JavaScript é uma das três principais tecnologias da World Wide Web.

* [PHP](https://www.php.net/manual/pt_BR/intro-whatis.php) - PHP é uma linguagem interpretada livre, usada originalmente apenas para o desenvolvimento de aplicações presentes e atuantes no lado do servidor, capazes de gerar conteúdo dinâmico na World Wide Web.

* [SQL](https://www.w3schools.com/sql/) - Structured Query Language, ou Linguagem de Consulta Estruturada ou SQL, é a linguagem de pesquisa declarativa padrão para banco de dados relacional. Muitas das características originais do SQL foram inspiradas na álgebra relacional.

* [Composer](https://getcomposer.org/) - O Composer é um gerenciador de pacotes no nível do aplicativo para a linguagem de programação PHP que fornece um formato padrão para gerenciar dependências do software PHP e bibliotecas necessárias. Foi desenvolvido por Nils Adermann e Jordi Boggiano, que continuam a gerenciar o projeto. 

## Versão das Linguagens e Ferramentas

#### Servidor de base de dados

* MariaDB - 10.4.21-MariaDB

#### Servidor web

* PHP - 7.3.31
* Apache - 2.4.51

#### Gerenciamento do banco de dados

* phpMyAdmin - 5.1.1

#### Ferramentas

* Xampp - 3.3.0


## Autor

* **Cesar dos Santos de Almeida** - *responsável pela construção e desenvolvimento do projeto*

## Licença

Este projeto está licenciado sob a licença MIT - consulte o arquivo  [LICENSE.md](LICENSE.md) para obter detalhes


## Links

* [Layout do Projeto](https://www.figma.com/file/AyqBIHaMYiOi86GXCcPvMq/Crud-de-Porto-de-Navios?node-id=0%3A1) - Link do projeto no figma
* [Demo do projeto](http://csantosalmeida.rf.gd/index.php) - Link da Demo





