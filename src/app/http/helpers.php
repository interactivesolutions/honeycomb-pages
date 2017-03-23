<?php

if (!function_exists('makeEmptyNullable'))
{
    /**
     * Updates fields values that are empty strings to null
     *
     * @param array $array
     * @return array
     */
    function makeEmptyNullable(array $array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = makeEmptyNullable($value);
            }
            if ($value == "")
                $value = null;

            $array[$key] = $value;
        }

        return $array;
    }
}
