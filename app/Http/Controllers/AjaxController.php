<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function fetchClient()
    {
        $client = Client::find(request('id'));
        return response()->json(['client' => $client]);
    }
}
