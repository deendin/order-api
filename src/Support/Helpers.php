<?php

if (!function_exists('json_response')) {

    function json_response($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}

