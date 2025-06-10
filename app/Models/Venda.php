<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id',
        'quantidade_vendida',
        'preco_unitario',
        'valor_total',
        'estabelecimento_id'
    ];

    // Relacionamento com o produto
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function estabelecimento()
    {
        return $this->belongsTo(Estabelecimento::class);
    }

}
