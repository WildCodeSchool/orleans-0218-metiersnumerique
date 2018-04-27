<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 17/04/18
 * Time: 10:46
 */

namespace Model;

/**
 * Class cleanInput
 * @package Model
 */
class cleanInput
{

    /**
     * @param array $array
     * @return array
     */
    public function clean(array $array): array
    {
        $newArray = [];

        foreach ($array as $key => $value) {
            $newArray[$key] = trim(strip_tags($value));
            if ($key == 'firstname' || $key == 'profession' || $key == 'company' || $key == 'name') {
                $newArray[$key] = ucfirst($newArray[$key]);
            } elseif ($key == 'lastname') {
                $newArray[$key] = mb_strtoupper($value);
            } elseif ($key == 'wilder') {
                $newArray[$key] = $this->wilder($newArray[$key]);
            } elseif ($key == 'question1' || $key == 'question2' || $key == 'question3' || $key == 'resum' || $key == 'description') {
                $newArray[$key] = $this->firstUpperAfterDot($newArray[$key]);
            } elseif ($key == 'email') {
                $newArray[$key] = mb_strtolower($newArray[$key]);
            }
        }

        return $newArray;
    }

    /**
     * @param string $input
     * @return string
     */
    private function firstUpperAfterDot(string $input): string
    {
        $tab = explode('.', $input);
        $result = '';
        foreach ($tab as $string => $value) {
            if($value != '') {
                $result .= ucfirst(trim($value)) . '. ';
            }
        }
        $result = trim($result);
        return $result;
    }

    /**
     * @param string $input
     * @return int
     */
    private function wilder(string $input = null): int
    {
        if ($input === 'on') {
            return 1;
        } else {
            return 0;
        }
    }
}