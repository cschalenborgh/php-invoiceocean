<?php
/**
 * InvoiceOceanInvoice
 *
 * API class to communicate with the InvoiceOcean API for invoices
 *
 * @author Chris Schalenborgh <chris@schalenborgh.be>
 * @version 1.0
 * @link https://github.com/InvoiceOcean/api
 **/

class InvoiceOceanInvoice extends InvoiceOcean
{
    /**
     * @param $username
     * @param $api_token
     */
    public function __construct($username, $api_token) {
        parent::__construct($username, $api_token);
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
        $result = $this->request(__FUNCTION__, $invoice_id);

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
            'api_token'     => $this->getApiToken(),
            'invoice'       => $invoice
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
            'api_token' => $this->getApiToken(),
            'client'    => array(
            )
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
        $result = $this->request(__FUNCTION__, $invoice_id);

        return $result;
    }
}
?>