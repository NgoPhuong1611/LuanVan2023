<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HookController extends Controller
{
    public function index(Request $request)
    {
        $x_hook_secret = $request->header('X-Hook-Secret');
        $x_hook_signature = $request->header('X-Hook-Signature');
        $body = $request->getContent();

        if ($x_hook_secret) {
            Log::debug('Get X Hook Secret: ' . $x_hook_secret);
            return response([], 201)->header('X-Hook-Secret', $x_hook_secret);
        } elseif ($x_hook_signature) {
            Log::debug('Get X Hook Signature: ' . $x_hook_signature);

            $computedSignature = hash_hmac('SHA256', (string) $body, '2ca8950d5524b5761eb4aa6bad923605');
            Log::debug('Create X Hook Signature: ' . $computedSignature);

            if (0 !== strcmp($computedSignature, $x_hook_signature)) {
                Log::debug('X Hook Signature: ' . $x_hook_signature);
                Log::debug('Computed Signature: ' . $computedSignature);
                Log::error('They are not equal!');
                return response([], 401);
            }

            Log::debug('Authorized successed!');
        }

        error_log($body);
        Log::debug($body);
    }
}
