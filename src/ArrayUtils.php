<?php
namespace TimDev;

/**
 * Class that provides static utility methods for working with arrays.
 */
class ArrayUtils
{
    /**
     * Digs a value out of a (possibly nested) array using an array of keys, or return a default value.
     *
     * This method's purpose is to avoid a bunch of calls to isset($array['some']['nested']['value']) in userland code.
     *
     * val($array, ['a','b']) => $array['a']['b'] (or null)
     * val($array, ['a',6], false) => $array['a'][6] (or false)
     *
     * @param array $array
     * @param int|string|array $key
     * @param mixed $default
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public static function val(array $array, $key, $default = null)
    {
        // if key isn't an array, turn it into [ $key ]
        $key = (array) $key;

        $sub = $array;

        $path = ''; // tracks how far we've dug.

        foreach($key as $idx=>$k){

            // check that current key is valid.
            if ( ! (is_int($k) || is_string($k))){
                throw new \InvalidArgumentException("Invalid array key at index {$idx} in call to " .  __METHOD__ . "().  Path up to here was: {$path}");
            }

            $path .= "//{$k}";

            // if key doesn't exist, return $default
            if (! array_key_exists($k, $sub)){
                return $default;
            }

            // keep digging
            $sub = $sub[$k];
        }

        return $sub;

    }

}