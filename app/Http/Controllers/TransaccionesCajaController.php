<?php

namespace App\Http\Controllers;

use App\Caja;
use App\Ingreso;
use App\TransaccionesCaja;
use App\Venta;
use App\Sucursales;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransaccionesCajaController extends Controller
{
     public function index(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;

        if ($buscar==''){
            $transaccionesCajas = TransaccionesCaja::join('cajas', 'transacciones_cajas.idcaja', '=', 'cajas.id')
                ->join('users', 'transacciones_cajas.idusuario', '=', 'users.id')
                ->select('transacciones_cajas.id', 'transacciones_cajas.idcaja', 'transacciones_cajas.idusuario', 'users.usuario as usuario', 'transacciones_cajas.fecha', 'transacciones_cajas.transaccion', 'transacciones_cajas.importe', 'cajas.fechaApertura')
                ->where('transacciones_cajas.idcaja', '=', $id)
                ->orderBy('transacciones_cajas.id', 'desc')->paginate(10);
        }

        $ventas = Venta::join('users', 'ventas.idusuario', '=', 'users.id')
                ->join('tipo_pagos', 'ventas.idtipo_pago', '=', 'tipo_pagos.id')
                ->select(
                    'ventas.id',
                    'ventas.tipo_comprobante',
                    'ventas.serie_comprobante',
                    'ventas.num_comprobante',
                    'ventas.fecha_hora',
                    'ventas.impuesto',
                    'ventas.total',
                    'ventas.estado',
                    'ventas.cliente AS nombre',
                    'users.usuario',
                    'tipo_pagos.nombre_tipo_pago'
                )
                ->orderBy('ventas.id', 'desc')->where('idcaja', $id)->paginate(10);

        return [
            'pagination' => [
                'total'        => $transaccionesCajas->total(),
                'current_page' => $transaccionesCajas->currentPage(),
                'per_page'     => $transaccionesCajas->perPage(),
                'last_page'    => $transaccionesCajas->lastPage(),
                'from'         => $transaccionesCajas->firstItem(),
                'to'           => $transaccionesCajas->lastItem(),
            ],
            'transacciones' => $transaccionesCajas,
            'ventas'=> $ventas

        ];
    }

    public function reportecajaPDF(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
    
        // Obtener el id desde el request
        $id = $request->query('id');
    
        // Obtener todas las transacciones por idcaja
        $transaccionesCajas = TransaccionesCaja::join('cajas', 'transacciones_cajas.idcaja', '=', 'cajas.id')
            ->join('users', 'transacciones_cajas.idusuario', '=', 'users.id')
            ->select('transacciones_cajas.id', 'transacciones_cajas.idcaja', 'transacciones_cajas.idusuario', 'users.usuario as usuario', 'transacciones_cajas.fecha', 'transacciones_cajas.transaccion', 'transacciones_cajas.importe', 'cajas.fechaApertura')
            ->where('transacciones_cajas.idcaja', '=', $id)
            ->orderBy('transacciones_cajas.id', 'desc')
            ->get();
    
        // Obtener todas las ventas por idcaja
        $ventas = Venta::join('users', 'ventas.idusuario', '=', 'users.id')
            ->join('tipo_pagos', 'ventas.idtipo_pago', '=', 'tipo_pagos.id')
            ->select(
                'ventas.id',
                'ventas.tipo_comprobante',
                'ventas.serie_comprobante',
                'ventas.num_comprobante',
                'ventas.fecha_hora',
                'ventas.impuesto',
                'ventas.total',
                'ventas.estado',
                'ventas.cliente AS nombre',
                'users.usuario',
                'tipo_pagos.nombre_tipo_pago'
            )
            ->where('ventas.idcaja', '=', $id)
            ->orderBy('ventas.id', 'desc')
            ->get();

        $caja = Caja::join('sucursales', 'cajas.idsucursal', '=', 'sucursales.id')
            ->select(
                'cajas.ventasContado',
                'cajas.ventasQR',
                'cajas.saldoFaltante',
                'cajas.saldoCaja',
                'cajas.saldototalVentas',
                'cajas.fechaApertura',
                'cajas.fechaCierre',
                'cajas.depositos',
                'cajas.salidas',
                'cajas.saldoInicial',
                'cajas.tarifaqrdelivery',
                'sucursales.nombre as nombreSucursal'
            )
            ->where('cajas.id', '=', $id)
            ->get();
    
        return response()->json([
            'transacciones' => $transaccionesCajas,
            'ventas' => $ventas,
            'cajaport' => $caja
        ]);
    }
    
}