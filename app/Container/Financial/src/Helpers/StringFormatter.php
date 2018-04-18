<?php

namespace App\Container\Financial\src\Helpers;


class StringFormatter
{
    /**
     * The method to return upper string including spanish chars
     *
     * @param null $string
     * @return mixed|string
     */
    public static function toUpper( $string = null )
    {
        return mb_convert_case( strtolower( trim( $string ) ), MB_CASE_UPPER, 'UTF-8');
    }

    public static function toMoney( $currency = 0 )
    {
        return '$ '.number_format($currency, 2, ',', '.');
    }

    public static function htmlAttributes( $attributes )
    {
        $string = '';
        if ( is_array( $attributes ) ) {
            foreach ( $attributes as $key => $attribute) {
                $string .= "$key=$attribute ";
            }
        }

        return trim( $string );
    }
}