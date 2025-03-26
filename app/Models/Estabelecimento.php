<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Adicionando a importação correta
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Estabelecimento extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['nome', 'email', 'password'];
    protected $hidden = ['password'];
}


