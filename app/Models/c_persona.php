<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class c_persona extends Model{
    
    use SoftDeletes;
    protected $primaryKey ='idpersona';
    protected $fillable=['idpersona','nombre1','nombre2','apellidopat','apellidomat','genero','nacimiento','rfc','curp','nacionalidad','usuario','pass'];
    protected $date=['deleted_at'];
}
