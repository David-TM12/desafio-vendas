<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Reader\Xls\Style\FillPattern;

class Produto extends Model
{

    protected $fillable = [
        'descricao',
        'estoque',
        'preco',
        'fabricante_id'
    ];

    public function fabricante()
    {   
        return $this->belongsTo(Fabricante::class);
    }
}
