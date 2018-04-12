<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 12/04/18
 * Time: 17:01
 */

namespace Model;

/**
 * Formate des données brutes de BDD
 * Class Format
 * @package Model
 */
class Format
{
    /**
     * Formate des données provenant d'une jointure Comment / Job
     * @param array $rows
     * @return array
     */
    public function commentJob(array $rows) :array
    {
        $datas = [];

        foreach ($rows as $row) {
            $comment = new Comment();
            $comment->hydrate($row);

            $job = new Job();
            $resultJob['name'] = $row['name'];
            $job->hydrate($resultJob);

            $datas[] = ['comment' => $comment, 'job' => $job];
        }

        return $datas;
    }
}
