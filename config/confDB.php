<?php

/** @author Jesús Temprano Gallego
 *  @since 16/12/2025
 */

/*  Constantes para la conexión con la DB.
    Existen tanto `define()` como `const` y se pueden usar igual en la mayoría de casos.
    En esta pagina web explican las diferencias y en que casos se usa uno u otro:
        https://mclibre.org/consultar/php/lecciones/php-constantes.html
*/

const DBHost = "10.199.11.252";   // desarrollo
// const DBHost = "localhost";   // explotación

// usuario
const DBName = "DBJTGDWESAplicacionFinal";
const DBUser = "userJTGDWESAplicacionFinal";
const DBPass = "paso";   // desarrollo
// const DBPass = "!Paso1234x";   // explotación
const DSN = "mysql:host=".DBHost.";dbname=".DBName;
