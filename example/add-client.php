<?php
/*
 * This example file will add a client
 */

$io = new InvoiceOceanClient('username', 'api_token_goes_here');

    $client = array(
        'name'          => 'Chris Schalenborgh',
        'tax_no'        => 1,
        'bank'          => 'My Bank',
        'bank_account'  => '001-123456-78',
        'city'          => 'Maasmechelen',
        'country'       => 'BE',
        'email'         => 'chris@schalenborgh.be',
        'person'        => '',
        'post_code'     => '1234',
        'phone'         => '+32.123456789',
        'street'        => 'Street',
        'street_no'     => '123'
    );

$result = $io->addClient($client);

var_dump($result);

?>