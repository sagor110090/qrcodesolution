<?php


if (!class_exists('QRcdrFn', false)) {

    class QRcdrFn
    {
        /**
         * Holds an instance of the object
         *
         * @var MeMeMe_Admin
         */
        protected static $instance = null;

        /**
         * Returns the running object
         *
         * @return QRcdrFn
         */
        public static function getInstance()
        {
            if (null === self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }






        /**
         * Reverse string
         *
         * @param string $str string to reverse
         *
         * @return reversed string
         */
        public static function reverseString($str)
        {

            if (false === function_exists("mb_str_split")) {
                /**
                 * Convert a string to an array.
                 *
                 * @param string $string       The input string
                 * @param int    $split_length Maximum length of the chunk
                 *
                 * @return array If the optional split_length parameter is specified,
                 *  the returned array will be broken down into chunks with each being
                 *  split_length in length, otherwise each chunk will be one character
                 *  in length. FALSE is returned if split_length is less than 1. If the
                 *  split_length length exceeds the length of string, the entire string
                 *  is returned as the first (and only) array element.
                 */
                function mb_str_split($string, $split_length = 1)
                {
                    if (false === function_exists("mb_strlen") || false === function_exists("mb_substr")) {
                        $array =  str_split($string);
                    } else {
                        $split_length = ($split_length <= 0) ? 1 : $split_length;
                        $mb_strlen = mb_strlen($string, "utf-8");
                        $array = array();
                        for ($i = 0; $i < $mb_strlen; $i = $i + $split_length) {
                            $array[] = mb_substr($string, $i, $split_length);
                        }
                    }
                    return $array;
                }
            }

            $ar = mb_str_split($str);
            return join('', array_reverse($ar));
        }


        /**
         * Get translated string
         *
         * @param string $string key to search
         *
         * @return translated string
         */
        public function getString($string)
        {
            global $_translations;
            $result = '>'.$string.'<';

            if (isset($_translations[$string])) {
                $stringa = $_translations[$string];
                if (strlen($stringa) > 0) {
                    $result = $_translations[$string];
                }
            }
            return $result;
        }

        /**
         * Get config value
         *
         * @param string $key     key to search
         * @param string $default default value
         *
         * @return config value
         */
        public function getConfig($key, $default = false)
        {
            global $_CONFIG;
            if (isset($_CONFIG[$key])) {
                return $_CONFIG[$key];
            }
            return $default;
        }



        /**
         * Set error
         *
         * @param string $error error message
         *
         * @return global error
         */
        public function setError($error)
        {
            global $_ERROR;
            $_ERROR = $error;
        }

        /**
         * Delete old files
         *
         * @param string $dir the dir to scan
         * @param int    $age files lifetime
         * @param str    $ext file extension: svg, png
         *
         * @return a clean directory
         */
        public function deleteOldFiles($dir = 'qrcodes/', $age = 3600, $ext = 'png')
        {
            if (file_exists($dir)) {
                $ext = strlen($ext) ? '.'.$ext : '';
                $now = time();
                $searchfiles = glob($dir.'*'.$ext);
                foreach ($searchfiles as $file) {
                    $filelastmodified = filemtime($file);
                    $life = $now - $filelastmodified;
                    if ($life > $age) {
                        unlink($file);
                    }
                }
            }
        }


        /**
         * Convert hex color
         *
         * @param string $colorCode    color to convert
         * @param string $defaultcolor default color
         *
         * @return converted color
         */
        public function hexdecColor($colorCode, $defaultcolor = '#000000')
        {
            // If user accidentally passed along the # sign, strip it off
            $colorCode = ltrim($colorCode, '#');

            $colorCode = strlen($colorCode) > 6 ? substr($colorCode, 0, 6) : $colorCode;
            $colorCode = strlen($colorCode) > 3 && strlen($colorCode) < 6 ? substr($colorCode, 0, 3) : $colorCode;

            if (ctype_xdigit($colorCode)) {
                $converted = hexdec(str_replace('#', '0x', $colorCode));
            } else {
                $converted = hexdec(str_replace('#', '0x', $defaultcolor));
            }
            return $converted;
        }





        /**
         * Increases or decreases the brightness of a color by a percentage of the current brightness.
         *
         * @param string $hexCode       Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
         * @param float  $adjustPercent A number between -1 and 1. E.g. 0.3 = 30% lighter; -0.4 = 40% darker.
         *
         * @return string
         */
        public function adjustBrightness($hexCode, $adjustPercent)
        {
            $hexCode = ltrim($hexCode, '#');

            if (strlen($hexCode) == 3) {
                $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
            }
            $hexCode = array_map('hexdec', str_split($hexCode, 2));

            foreach ($hexCode as & $color) {
                $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
                $adjustAmount = ceil($adjustableLimit * $adjustPercent);

                $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
            }
            return '#' . implode($hexCode);
        }

        /**
         * Convertt color hex to rgb
         *
         * @param string $htmlCode to convert
         *
         * @return RGB color
         */
        public function HTMLToRGB($htmlCode)
        {
            if ($htmlCode[0] == '#') {
                $htmlCode = substr($htmlCode, 1);
            }

            if (strlen($htmlCode) == 3) {
                $htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
            }

            if (strlen($htmlCode) == 4) {
                $htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2] . $htmlCode[3] . $htmlCode[3];
            }

            $r = hexdec($htmlCode[0] . $htmlCode[1]);
            $g = hexdec($htmlCode[2] . $htmlCode[3]);
            $b = hexdec($htmlCode[4] . $htmlCode[5]);

            return $b + ($g << 0x8) + ($r << 0x10);
        }

        /**
         * Converto color RGB to HSL
         *
         * @param string $RGB to convert
         *
         * @return HSL color
         */
        public function RGBToHSL($RGB)
        {
            $r = 0xFF & ($RGB >> 0x10);
            $g = 0xFF & ($RGB >> 0x8);
            $b = 0xFF & $RGB;

            $r = ((float)$r) / 255.0;
            $g = ((float)$g) / 255.0;
            $b = ((float)$b) / 255.0;

            $maxC = max($r, $g, $b);
            $minC = min($r, $g, $b);

            $l = ($maxC + $minC) / 2.0;

            if ($maxC == $minC) {
                $s = 0;
                $h = 0;
            } else {
                if ($l < .5) {
                    $s = ($maxC - $minC) / ($maxC + $minC);
                } else {
                    $s = ($maxC - $minC) / (2.0 - $maxC - $minC);
                }
                if ($r == $maxC) {
                    $h = ($g - $b) / ($maxC - $minC);
                }
                if ($g == $maxC) {
                    $h = 2.0 + ($b - $r) / ($maxC - $minC);
                }
                if ($b == $maxC) {
                    $h = 4.0 + ($r - $g) / ($maxC - $minC);
                }
                $h = $h / 6.0;
            }

            $h = (int)round(255.0 * $h);
            $s = (int)round(255.0 * $s);
            $l = (int)round(255.0 * $l);

            return (object) Array('hue' => $h, 'saturation' => $s, 'lightness' => $l);
        }


    }


    function qrcdr()
    {
        return QRcdrFn::getInstance();
    }

    // Get it started.
    qrcdr();
}


