<?php
/**
 * InvoiceOceanClient
 *
 * API class to communicate with the InvoiceOcean API for clients
 *
 * @author Chris Schalenborgh <chris@schalenborgh.be>
 * @version 1.0
 * @link https://github.com/InvoiceOcean/api
 **/

class InvoiceOceanClient extends InvoiceOcean
{
    /**
     * @param $username
     * @param $api_token
     */
    public function __construct($username, $api_token) {
        parent::__construct($username, $api_token);
    }

    /**
     * Return clients
     *
     * @return array
     */
    public function getClients() {
        $result = $this->request(__FUNCTION__);

        return $result;
    }

    /**
     * Return specific client info
     *
     * @param int $client_id
     *
     * @return array
     */
    public function getClient($client_id = 0) {
        $result = $this->request(__FUNCTION__, array(), $client_id);

        return $result;
    }

    /**
     * Create a client
     *
     * @param array $client
     * @return array
     */
    public function addClient($client = array()) {
        // construct parameters
        $parameters = array(
            'client' => $client
        );

        // send to api
        $result = $this->request(__FUNCTION__, $parameters);

        return $result;
    }

    /**
     * Update a client
     *
     * @param int $client_id
     * @param array $client
     * @return array
     */
    public function updateClient($client_id = 0, $client = array()) {
        // construct parameters
        $parameters = array(
            'client' => $client
        );

        // send to api
        $result = $this->request(__FUNCTION__, $parameters, $client_id);

        return $result;
    }

    /**
     * Get specific invoice information
     *
     * @param int $invoice_id
     *
     * @return array
     */
    public function getInvoice($invoice_id = 0) {
        // send to api
        $result = $this->request(__FUNCTION__, array(), $invoice_id);

        return $result;
    }

    /**
     * Create an invoice
     *
     * @param array $invoice
     * @return array
     */
    public function addInvoice($invoice = array()) {
        // construct parameters
        $parameters = array(
            'invoice' => $invoice
        );

        // send to api
        $result = $this->request(__FUNCTION__, $parameters);

        return $result;
    }

    /**
     * Update an invoice
     *
     * @param int $invoice_id
     * @param array $invoice
     * @return array
     */
    public function updateInvoice($invoice_id = 0, $invoice = array()) {
        // construct parameters
        $parameters = array(
            'invoice' => $invoice
        );

        // send to api
        $result = $this->request(__FUNCTION__, $parameters, $invoice_id);

        return $result;
    }

    /**
     * Delete an invoice
     *
     * @param int $invoice_id
     * @return array
     */
    public function deleteInvoice($invoice_id = 0) {
        // send to api
        $result = $this->request(__FUNCTION__, array(), $invoice_id);

        return $result;
    }

    /**
     * Email an invoice
     *
     * @param int $invoice_id
     * @return array
     */
    public function sendInvoice($invoice_id = 0) {
        // send to api
        $result = $this->request(__FUNCTION__, array(), $invoice_id);

        return $result;
    }
}
