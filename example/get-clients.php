<?php
/*
 * This example file will return your clients
 */

$io = new InvoiceOceanClient('username', 'api_token_goes_here');

$clients = $io->getClients();

var_dump($clients);

?>