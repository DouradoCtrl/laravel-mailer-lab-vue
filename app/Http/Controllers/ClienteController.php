<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Inertia\Inertia;

class ClienteController extends Controller
{
    public function index(Request $request) {
        $clientes = Cliente::paginate(15);

        return Inertia::render('clientes/Clientes', ['clientes' => $clientes]);
    }
}
