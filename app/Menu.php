<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    //
    protected $table = 'menu';
    protected $fillable = [
        'idcategoria_menu', 
        'nombre',
        'codigo',
        'precio_venta',
        'descripcion',
        'tipoMenu'
    ];
    public function categoria_menu()
    {
        return $this->belongsTo('App\categoria_menu');
    }
}
