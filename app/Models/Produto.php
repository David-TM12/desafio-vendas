<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Reader\Xls\Style\FillPattern;
use Cviebrock\EloquentSluggable\Sluggable;

class Produto extends Model
{

    use Sluggable;

    protected $fillable = [
        'descricao',
        'estoque',
        'preco',
        'slug',
        'fabricante_id',
    ];

     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array 
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'descricao'
            ]
        ];
    }

    public function fabricante()
    {   
        return $this->belongsTo(Fabricante::class);
    }
}
