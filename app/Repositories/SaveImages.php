<?php

namespace App\Repositories;

class SaveImages
{
    /**
     * data es el modelo
     * image el archivo tipo file
     * mkdir el nombre de la carpeta
     * is_array false: se guarda a bd el modelo return true
     * is_array true: no se guarda a bd return customFileName
     */
    public function saveImage($data,$image,$mkdir,$is_array=false)
    {
        $customFileName = uniqid() . '_.' . $image->extension();
        // $image->storeAs('public/products', $customFileName);
        $image->storeAs('public/'.$mkdir, $customFileName);
        if($is_array == false){
            $data->image = $mkdir . '/' .$customFileName;
            $data->save();
            return true;
        }
        return $mkdir . '/' .$customFileName;
    }
}
