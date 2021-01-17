<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConfiguracionController extends Controller
{
    //
    public function index(){
        $data = Configuracion::all()->first();
        return Inertia::render('Configuracion/Index', ['data' => $data]);
    }

    public function update(Request $request){
        $hola = Configuracion::where('id',$request->input('id'))->update($request->all());
        $msg = ['severity'=>'success',
                'summary'=>'Exito.',
                'detail'=>'Configuracion actualizada correctamente',
                'life'=> 3000];

        return redirect()->back()
                    ->with('message', $msg);
    }
}
