<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait Helpers
{
    /**
     * Loop through an array recursively and remove a specific key.
     *
     * @param $array
     * @param $unwantedKey
     * @return array|false
     */
    public function recursiveUnset(array &$array, $unwantedKey)
    {
        if (!is_array($array) || empty($unwantedKey)) {
            return false;
        }

        if (is_array($unwantedKey)) {
            foreach ($unwantedKey as $key) {
                unset($array[$key]);
            }
        } else {
            unset($array[$unwantedKey]);
        }

        foreach ($array as &$value) {
            if (is_array($value)) {
                call_user_func_array([$this, __FUNCTION__], [&$value, $unwantedKey]);
            }
        }

        return $array;
    }

    /**
     * Convert an array to a collection recursively.
     *
     * @param array $array
     * @return bool|Collection
     */
    public function recursiveCollect(array $array)
    {
        if (!is_array($array) || empty($array)) {
            return false;
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = call_user_func_array([$this, __FUNCTION__], [$value]);
            }
        }

        return collect($array);
    }
}
