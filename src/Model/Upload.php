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
    /**
     * @param $name
     * @param $dir
     * @param $index
     * @param $id
     * @return bool
     */
    public function upload($name, $dir, $index, $id)
    {

        $typeUpload = strtolower(substr(strrchr($_FILES[$index]['name'], '.'), 1));
        $road = '../public/assets/images/' . $dir . '/' . $name . '-' . $id . '.' . $typeUpload;

        return move_uploaded_file($_FILES[$index]['tmp_name'], $road);

    }

    /**
     * @param $name
     * @param $dir
     * @param $index
     * @param $id
     * @return string
     */
    public function renameFile($name, $dir, $index, $id)
    {

        $typeUpload = strtolower(substr(strrchr($_FILES[$index]['name'], '.'), 1));
        $road = 'assets/images/' . $dir . '/' . $name . '-' . $id . '.' . $typeUpload;

        return $road;
    }

    /**
     * @param $name
     */
    public function deleteFile($name): bool
    {
        return unlink($name);
    }

}
