<?php

if (!function_exists('makeEmptyNullable')) {
    /**
     * Updates fields values that are empty strings to null
     *
     * @param array $array
     * @param bool $trimValue
     * @return array
     */
    function makeEmptyNullable(array $array, $trimValue = false)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = makeEmptyNullable($value, $trimValue);
            }

            if ($trimValue && is_string($value)) {
                $value = trim($value);
            }

            if ($value == "") {
                $value = null;
            }

            $array[$key] = $value;
        }

        return $array;
    }
}
