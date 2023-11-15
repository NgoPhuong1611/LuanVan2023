<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

abstract class BaseController extends Controller
{
    protected $request;

    protected $helpers = ['session', 'form', 'url'];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function callAction($method, $parameters)
    {
        $this->middleware('web');

        return parent::callAction($method, $parameters);
    }

    public function __call($method, $parameters)
    {
        return $this->callAction($method, $parameters);
    }
}
