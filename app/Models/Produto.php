<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    // Definindo os campos que podem ser preenchidos (mass assignment)
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'quantidade',
        'estabelecimento_id',
        'status',
    ];

    // Escondendo o campo de senha ou outros campos sensíveis
    protected $hidden = [
        // 'password',
    ];

    // Definindo os tipos de dados dos campos
    protected $casts = [
        'preco' => 'decimal:2',  // Garantir que o preço tenha duas casas decimais
        'quantidade' => 'integer',
    ];

    public function atualizarEstoque(int $quantidadeVendida)
    {
        $this->quantidade -= $quantidadeVendida;
        $this->save();
    }

    public function estabelecimento()
    {
        return $this->belongsTo(Estabelecimento::class);
    }

}

