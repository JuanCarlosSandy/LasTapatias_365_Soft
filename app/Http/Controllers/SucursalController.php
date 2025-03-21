<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use App\Sucursales;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class SucursalController extends Controller
{
    //listar datos de sucursales
    public function index(Request $request)
{
    if (!$request->ajax()) return redirect('/');

    $buscar = $request->buscar;
    $criterio = $request->criterio;

    if ($buscar == ''){
        $sucursales = Sucursales::join('empresas', 'sucursales.idempresa', '=', 'empresas.id')
            ->select('sucursales.id', 'sucursales.idempresa', 'empresas.nombre as nombre_empresa', 'sucursales.nombre', 'sucursales.direccion', 'sucursales.correo', 'sucursales.telefono', 'sucursales.departamento', 'sucursales.codigoSucursal', 'sucursales.condicion')
            ->orderBy('sucursales.id', 'desc');
            //->paginate(4);
    } else {
        $sucursales = Sucursales::join('empresas', 'sucursales.idempresa', '=', 'empresas.id')
            ->select('sucursales.id', 'sucursales.idempresa', 'empresas.nombre as nombre_empresa', 'sucursales.nombre', 'sucursales.direccion', 'sucursales.correo', 'sucursales.telefono', 'sucursales.departamento', 'sucursales.codigoSucursal', 'sucursales.condicion')
            ->where('sucursales.' . $criterio, 'like', '%' . $buscar . '%')
            ->orderBy('sucursales.id', 'desc');
            //->paginate(4);
    }

    $sucursalesPaginated = $sucursales->get();

    if ($sucursalesPaginated->count() > 4) {
        return [
            'pagination' => [
                'total'        => 0,
                'current_page' => 0,
                'per_page'     => 0,
                'last_page'    => 0,
                'from'         => 0,
                'to'           => 0,
            ],
            'sucursales' => []
        ];
    }

    $sucursalesPaginated = $sucursales->paginate(4);

    return [
        'pagination' => [
            'total'        => $sucursalesPaginated->total(),
            'current_page' => $sucursalesPaginated->currentPage(),
            'per_page'     => $sucursalesPaginated->perPage(),
            'last_page'    => $sucursalesPaginated->lastPage(),
            'from'         => $sucursalesPaginated->firstItem(),
            'to'           => $sucursalesPaginated->lastItem(),
        ],
        'sucursales' => $sucursalesPaginated
    ];
}

    public function obtenerUltimoCodigoSucursal() {
        $ultimoCodigo = DB::table('sucursales')
          ->select('codigoSucursal')
          ->orderBy('codigoSucursal', 'desc')
          ->first();
      
        return response()->json(['ultimoCodigo' => $ultimoCodigo->codigoSucursal]);
      }

    public function store(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }

        // Registra la información en el log antes de realizar la operación de almacenamiento
        Log::info('Datos recibidos para registrar una nueva sucursal:', $request->all());

        $sucursal = new Sucursales();

        $sucursal->idempresa = Empresa::first()->id;
        $sucursal->nombre = $request->nombre;
        $sucursal->direccion = $request->direccion ?? '';
        $sucursal->correo = $request->correo ?? '';
        $sucursal->telefono = $request->telefono;
        $sucursal->departamento = $request->departamento;
        $sucursal->codigoSucursal = $request->codigoSucursal;

        $sucursal->condicion = '1';
        $sucursal->save();

        // Registra la información en el log después de realizar la operación de almacenamiento
        Log::info('Nueva sucursal registrada con éxito:', ['id' => $sucursal->id]);
    }
    //---------hasa qui
    //-------actualizar datos
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sucursal = Sucursales::findOrFail($request->id);
        $sucursal->idempresa = $request->idempresa;
        $sucursal->nombre = $request->nombre;
        $sucursal->direccion = $request->direccion;
        $sucursal->correo = $request->correo;
        $sucursal->telefono = $request->telefono;
        $sucursal->departamento = $request->departamento;
        $sucursal->codigoSucursal = $request->codigoSucursal;
        $sucursal->condicion = '1';
        $sucursal->save();
    }
    //-----------hasta aqui
    //---desactivar registro

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sucursal = Sucursales::findOrFail($request->id);
        $sucursal->condicion = '0';
        $sucursal->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sucursal = Sucursales::findOrFail($request->id);
        $sucursal->condicion = '1';
        $sucursal->save();
    }
    //--------hasta aqui

    public function selectSucursal(Request $request)
    {
        $sucursales = Sucursales::where('condicion', '=', '1')
        ->select('id','nombre')
        ->orderBy('nombre', 'asc')->get();

        return ['sucursales' => $sucursales];
    } 

    
    public function selectedSucursal(Request $request)
    {
        if (!$request->ajax())
            return redirect('/');

        $filtro = $request->filtro;
        $sucursales = Sucursales::where('nombre', 'like', '%' . $filtro . '%')
            ->orderBy('nombre', 'asc')->get();

        return ['sucursales' => $sucursales];
    }
}
