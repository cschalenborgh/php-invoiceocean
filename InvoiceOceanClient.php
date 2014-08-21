<?php
/**
 * InvoiceOceanClient
 *
 * API class to communicate with the InvoiceOcean API
 *
 * @author Chris Schalenborgh <chris@schalenborgh.be>
 * @version 1.0
 * @link https://github.com/InvoiceOcean/api
 **/

class InvoiceOceanClient extends InvoiceOcean
{
    public function __construct($username, $api_token) {
        parent::__construct($username, $api_token);
    }

    public function getClients() {
        // send to api
        $result = $this->request(__FUNCTION__);

        return $result;
    }

    public function getClient($client_id = 0) {
        // send to api
        $result = $this->request(__FUNCTION__, $client_id);

        return $result;
    }

    public function addClient($client = array()) {
        // construct api method url
        //$api_method_url = $this->getApiMethod(__FUNCTION__);

        // construct parameters
        $parameters = array(
            'api_token' => $this->getApiToken(),
            'client'    => array(
                'name'          => @$client['name'],
                'tax_no'        => @$client['tax_no'],
                'bank'          => @$client['bank'],
                'bank_account'  => @$client['bank_account'],
                'city'          => @$client['city'],
                'country'       => @$client['country'],
                'email'         => @$client['email'],
                'person'        => @$client['person'],
                'post_code'     => @$client['post_code'],
                'phone'         => @$client['phone'],
                'street'        => @$client['street'],
                'street_no'     => @$client['street_no'],
            )
        );

        // send to api
        $result = $this->request(__FUNCTION__, $parameters);

        return $result;
    }

    public function updateClient($client_id = 0, $client = array()) {
        // construct parameters
        $parameters = array(
            'api_token' => $this->getApiToken(),
            'client'    => array(
                'name'          => @$client['name'],
                'tax_no'        => @$client['tax_no'],
                'bank'          => @$client['bank'],
                'bank_account'  => @$client['bank_account'],
                'city'          => @$client['city'],
                'country'       => @$client['country'],
                'email'         => @$client['email'],
                'person'        => @$client['person'],
                'post_code'     => @$client['post_code'],
                'phone'         => @$client['phone'],
                'street'        => @$client['street'],
                'street_no'     => @$client['street_no'],
            )
        );

        // send to api
        $result = $this->request(__FUNCTION__, $parameters, $client_id);

        return $result;
    }
}
?>