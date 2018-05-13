<?php

require_once 'APIInput.php';

class APIController {

    var $input;
    var $allowed_urls;

    function __construct() {
        $this->input = new APIInput();
        $this->allowed_urls = array(
            'https://mgsurvey.herokuapp.com/'
        );
    }

    function _getUrl() {
        $url = $this->input->server('HTTPS') !== 'on' ? 'http://' . $this->input->server('SERVER_NAME') : 'https://' . $this->input->server('SERVER_NAME');
        return $url . '/';
    }

    function is_allowed_url($url = '') {
        $uri = $url ? $url : $this->_getUrl();
        return in_array($uri, $this->allowed_urls);
    }

}
