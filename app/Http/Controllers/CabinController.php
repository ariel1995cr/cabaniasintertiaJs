<?php

namespace App\Http\Controllers;

use App\Http\Requests\CabinCreateRequest;
use App\Models\Cabins;
use App\Models\TypeCabin;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CabinController extends Controller
{
    //
    public function index(){
        $data = Cabins::all();
        $TypeCabin = TypeCabin::all()->pluck('id');
        return Inertia::render('Cabin/Index', ['data' => $data, 'tipoCabañas' => $TypeCabin]);
    }

    public function store(CabinCreateRequest $request){
        return $request->all();
    }
}
