<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Adicionando a importação correta
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Estabelecimento extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['nome', 'email', 'password','cnpj', 'nome_empresa', 'telefone'];
    protected $hidden = ['password'];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

}


