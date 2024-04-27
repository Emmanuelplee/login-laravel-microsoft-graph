<?php

namespace App\Repositories;

class Activities
{
    // Obtener ruta de la imagen
    public function getImageRoute($image){
        if ($image != null) {
            $path = public_path('/storage/' . $image);
            return file_exists($path) ? 'storage/'.$image : 'assets/images/default.png';
        }else{
            return 'assets/images/default.png';
        }
    }
}
