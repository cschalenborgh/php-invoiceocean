<?php
/**
 * Abstract class InvoiceOcean
 *
 * API class to communicate with the InvoiceOcean API
 *
 * @abstract
 * @author Chris Schalenborgh <chris@schalenborgh.be>
 * @version 1.0
 * @link https://github.com/InvoiceOcean/api
 *
 */
abstract class InvoiceOcean
{
    /**
     * @var bool
     */
    private $_debug = false;

    /**
     * @var string
     */
    private $_api_url_sample = 'https://[USERNAME].invoiceocean.com/';

    /**
     * @var mixed
     */
    private $_api_url;

    /**
     * @var
     */
    private $_api_token;

    /**
     * @var array
     */
    private $_api_methods = array(
        // clients
        'getClient'     =>  'clients/[ID].json',
        'addClient'     =>  'clients.json',
        'updateClient'  =>  'clients/[ID].json',
        'getClients'    =>  'clients.json',

        // invoices
        'getInvoice'    =>  'invoices/[ID].json',
        'addInvoice'    =>  'invoices.json',
        'updateInvoice' =>  'invoices/[ID].json',
        'deleteInvoice' =>  'invoices.json',
        'sendInvoice'   =>  'invoices/[INVOICEID]/send_by_email.json',
        
        // products
        'getProduct'    =>  'products/[ID].json',
        'addProduct'    =>  'products.json',
        'updateProduct' =>  'products/[ID].json',
        'getProducts'   =>  'products.json',
    );

    /**
     * @param $username - InvoiceOcean username
     * @param $api_token - InvoiceOcean API token
     */
    protected function __construct($username, $api_token) {        
        $this->_api_url = str_replace('[USERNAME]', $username, $this->_api_url_sample);
        $this->_api_token = $api_token;
    }

    /**
     * return API token
     *
     * @return string
     */
    protected function getApiToken()
    {
        return $this->_api_token;
    }

    /**
     * returns full API url
     *
     * @return string
     */
    protected function getApiUrl()
    {
        return $this->_api_url;
    }

    /**
     * returns all available API methods
     *
     * @return array
     */
    protected function getApiMethods() {
        return $this->_api_methods;
    }

    /**
     * return API method url if found in available methods array
     *
     * @param string $api_method_name
     *
     * @return bool|string
     */
    protected function getApiMethod($api_method_name = '') {        
        if(!Empty($api_method_name) && array_key_exists($api_method_name, $this->_api_methods)) {
            return $this->getApiUrl() . $this->_api_methods[$api_method_name];
        }

        return false;
    }

    /**
     * Returns the HTTP method based on the first verb of the method name
     *
     * @param string $verb
     * @return string
     */
    private function verbToHttpMethod($verb = '') {

        if(substr(strtolower($verb), 0, 3) == 'get') {
            return 'GET';
        }
        elseif(substr(strtolower($verb), 0, 3) == 'add' || substr(strtolower($verb), 0, 4) == 'send') {
            return 'POST';
        }
        elseif(substr(strtolower($verb), 0, 6) == 'update') {
            return 'PUT';
        }
        elseif(substr(strtolower($verb), 0, 6) == 'delete') {
            return 'DELETE';
        }
    }

    /**
     * Function to check if valid json
     *
     * @param $string
     * @return bool
     */
    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * Send a RESTful request to the API via cURL
     *
     * @param string $api_method
     * @param array $body
     * @param int $id
     * @return array
     */
    protected function request($api_method = '', $body = array(), $id = 0) {

        // construct API url
        $location       = $this->getApiMethod($api_method);
        $http_method    = $this->verbToHttpMethod($api_method);

        if($id > 0) {
            $location = str_replace('[ID]', $id, $location);
            $location = str_replace('[INVOICEID]', $id, $location);
        }

        // let's only accept json
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );

        // only get requests have the api_token in the url/location
        if($http_method == 'GET') {
            $location = $location. '?api_token=' .$this->getApiToken();
        }
        else {
            $body['api_token'] = $this->getApiToken();
        }

        $data = json_encode($body);

        // setup curl
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $location);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

        switch($http_method)
        {
            case 'GET':
                break;

            case 'POST':            
                curl_setopt($handle, CURLOPT_POST, true);
                curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
                break;

            case 'PUT':
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
                break;

            case 'DELETE':
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }
        $response = curl_exec($handle);
        $result = $response;

        // debug mode? let's return more information about this request
        if($this->_debug) {
            $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

            return array(
                'api'               => array(
                    'location'          => $location,
                    'method'            => $http_method,
                    'token'             => $this->getApiToken(),
                ),
                'input_body'        => $body,
                'response_code'     => $code,
                'response_body'     => $result,
            );
        }
        else {
            if($this->isJson($result)) {
                return array(
                    'success'   => true,
                    'response'  => json_decode($result)
                );
            }
            else {
                return array(
                    'success'   => false,
                    'response'  => $result
                );
            }
        }
    }
}
?>