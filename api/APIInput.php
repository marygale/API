<?php

class APIInput {

    function __construct() {

    }

    function __call($name = '', $args = array()) {
        $error = sprintf('Method %s does not exists in ' . __CLASS__, $name);
        die($error);
    }

    function get($name = '') {
        return filter_input(INPUT_GET, $name) ? filter_input(INPUT_GET, $name) : FALSE;
    }

    function post($name = '') {
        return filter_input(INPUT_POST, $name) ? filter_input(INPUT_POST, $name) : FALSE;
    }

    function request($name = '') {
        return filter_input(INPUT_REQUEST, $name) ? filter_input(INPUT_REQUEST, $name) : FALSE;
    }

    function server($name) {
        return filter_input(INPUT_SERVER, $name) ? filter_input(INPUT_SERVER, $name) : FALSE;
    }

    function segment($number) {
        $a = parse_url($this->server('REQUEST_URI'), PHP_URL_PATH);
        $segment = explode('/', $a);
        $segment_arr = $segment;
        if (is_array($segment)) {
            if (isset($number)) {
                $segment_arr = $segment[$number];
            }
            return $segment_arr;
        }
        return FALSE;
    }

    function ajax_request() {
        if (!empty($this->server('HTTP_X_REQUESTED_WITH')) && strtolower($this->server('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {
            return TRUE;
        }
        return FALSE;
    }

}
