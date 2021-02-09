<?php

namespace FavioVige;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "usuarios";
    protected $fillable = ['nome', 'email', 'senha', 'data_nascimento'];
}
