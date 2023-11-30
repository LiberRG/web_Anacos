<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Empareja extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function getId() { return $this->id; }
    public function getImagenId() { return $this->imagen_id; }
    public function getRutaImg() { return $this->rutaImg; }
    public function getDescripcion() { return $this->descripcion; }
    public function getTitulo() { return $this->titulo; }

    public function imgDibujo(){
        return $this->HasOne(Imagen::class, 'id', 'imagen_id');
    }
}
