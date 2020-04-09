<?php

namespace ThemeHouse\UserCriteria\Util;

class Color extends \XF\Util\Color
{
    public static function getRedValue($color) {
        $color = self::colorToRgb($color);
        return $color[0];
    }

    public static function getGreenValue($color) {
        $color = self::colorToRgb($color);
        return $color[1];
    }

    public static function getBlueValue($color) {
        $color = self::colorToRgb($color);
        return $color[2];
    }
}