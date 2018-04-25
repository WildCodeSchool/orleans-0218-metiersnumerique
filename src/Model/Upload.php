<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 11/04/18
 * Time: 19:53
 */

namespace Model;


class Upload
{

    public function upload ($name,$dir,$index,$id)
    {

        $extension_upload = strtolower(  substr(  strrchr($_FILES[$index]['name'], '.')  ,1)  );
        $nom = '../public/assets/images/'.$dir.'/'.$name.'-'.$id.'.'.$extension_upload;
        return move_uploaded_file($_FILES[$index]['tmp_name'],$nom);

    }

    public function renameFile($name,$dir,$index,$id)
    {

        $extension_upload = strtolower(  substr(  strrchr($_FILES[$index]['name'], '.')  ,1)  );
        $nom = 'assets/images/'.$dir.'/'.$name.'-'.$id.'.'.$extension_upload;

           return $nom;
    }

}
