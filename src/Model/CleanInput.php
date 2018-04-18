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
            $newArray[$key] = $this->trim($value);
            if ($key == 'lastname' || $key == 'firstname' || $key == 'profession' || $key == 'company') {
                $newArray[$key] = $this->firstUpperCase($newArray[$key]);
            } elseif ($key == 'wilder') {
                $newArray[$key] = $this->wilder($newArray[$key]);
            } elseif ($key == 'question1' || $key == 'question2' || $key == 'question3') {
                $newArray[$key] = $this->firstUpperAfterDot($newArray[$key]);
            } elseif ($key == 'email') {
                $newArray[$key] = $this->lowerCases($newArray[$key]);
            }
        }

        return $newArray;
    }

    /**
     * @param string $input
     * @return string
     */
    private function trim(string $input): string
    {
        return trim($input);
    }

    /**
     * @param string $input
     * @return string
     */
    private function firstUpperCase(string $input): string
    {
        return ucfirst($input);
    }

    /**
     * @param string $input
     * @return string
     */
    private function lowerCases(string $input): string
    {
        return strtolower($input);
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
                $result .= $this->firstUpperCase($this->trim($value)) . '. ';
            }
        }
        $result = $this->trim($result);
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