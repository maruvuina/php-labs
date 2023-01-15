<?php

class synonimizer {

    const DEBUG = 0;

    const ROW_DELIM   = '=>';
    const VALUE_DELIM = '|';

    private $_dic_file = 'dic.txt';

    /**
     * @private array 'syn' = array(value, value, value)
     */
    private $parsed = array();


    function __construct() {

        $_parsed = file(dirname(__FILE__) . '/' . $this->_dic_file);

        foreach ($_parsed as $k => $v) {
            $v = trim($v);
            if (empty($v) || 0 === strpos($v, '#')) {
                ; // nop
            }
            else {
                $v = explode(self::ROW_DELIM, $v);
                $_key = trim($v[0]);
                $_data = array();
                if (strpos($v[1], self::VALUE_DELIM) !== false) {
                    $data = explode(self::VALUE_DELIM, $v[1]);
                    foreach ($data as $dk => $dv) {
                        $_data[$dk] = trim($dv);
                    }
                }
                else {
                    $_data = array(trim($v[1]));
                    if (strpos($_data[0], '@') === 0) {
                        // this is alias
                        $_data = $this->parsed[substr($_data[0], 1)];
                    }
                }

                // save
                $this->parsed[$_key] = $_data;
            }
        }
    }

    /**
     * Callback
     */
    static $_c_matches = false;
    static function syn_callback($matches) {
        $out = $matches[2];
        if (self::DEBUG) echo " -- " . $out . "\n";
        if (!empty(self::$_c_matches)) {
            $i = count(self::$_c_matches) - 1;
            $i = ($i > 0) ? mt_rand(0, $i) : 0;
            $out = self::$_c_matches[$i];
        }
        if (self::DEBUG)  echo " ++ " . $out . "\n\n";
        return $matches[1] . $out . $matches[3];
    }

    private static $index = 0;

    public function syn($text) {

        $text = ' ' . str_replace(array('\r\n', '\n'), "\r\n", $text) . ' ';
        self::$index++;
        echo ">>> " . self::$index . "\n";

        if (self::DEBUG) {
            echo str_repeat("-", 80) . "\n" . wordwrap($text, 80) . "\n" .  str_repeat("-", 80) . "\n\n";
        }

        foreach ($this->parsed as $key => $matches) {
            self::$_c_matches = &$matches;
            $text = preg_replace_callback(
                '#([^\w\d\-])(' . preg_quote($key) . ')([^\w\d\-])#i'// ([^\w\d\-]) //([\s\.\,])
                , 'synonimizer::syn_callback'
                , $text
            );

        }

        $text = str_replace("\r\n", '\r\n', substr($text, 1, -1));
        if (self::DEBUG) echo "--> " . wordwrap($text, 80) . " \n\n";
        return $text;
    }
}