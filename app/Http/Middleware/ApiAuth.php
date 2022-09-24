<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use \Firebase\JWT\JWT;

class ApiAuth {

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        $jwt = $request->header('token');
        $publicKey = file_get_contents(asset('/') . 'jwt-keys/public.pem');
        try {
            $decoded = JWT::decode($jwt, $publicKey, array('RS256'));
            if (is_object($decoded)) {
                $decoded_array = (array) $decoded;
                if ($request->method() == 'POST') {
                    if (($request->post('user_id') !== null) && ($decoded_array['uuid'] == $request->post('user_id'))) {
                        return $next($request);
                    } else {
                        echo json_encode(array('success' => false, 'message' => 'unauthorized user'));
                        die();
                    }
                } else {
                    return $next($request);
                }
            } else {
                $result = json_decode($decoded, true);

                echo json_encode($result);
                die;
            }
        } catch (Exception $exp) {
            echo json_encode(array('success' => false, 'message' => $exp->getMessage()));
            die;
        }
    }

}
