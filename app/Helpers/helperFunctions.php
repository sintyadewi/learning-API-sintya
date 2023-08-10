<?php

if (! function_exists('error_response_handling')) {
    function get_title($code)
    {
        $titles = [
            401 => 'Authentication Failed',
        ];

        return $titles[$code];
    }

    function get_message($code)
    {
        $messages = [
            401 => 'Unauthenticated.',
        ];

        return $messages[$code];
    }

    function error_response_handling($code, $errors = [])
    {
        return response()->json([
            'error' => [
                'code'    => $code,
                'title'   => get_title($code),
                'message' => get_message($code),
                'errors'  => $errors,
            ],
        ], $code);
    }
}
