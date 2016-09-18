<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace riwin\HumanJson;

/**
 * Description of BeautyJson
 *
 * @author Richard
 */
class HumanJson {


    public static function make($json) {

        $tc = 0;        //tab count
        $r = '';        //result
        $q = false;     //quotes
        $t = "   ";      //tab
        $nl = "\n";     //new line

        for ($i = 0; $i < strlen($json); $i++) {
            $c = $json[$i];
            if ($c == '"' && $json[$i - 1] != '\\')
                $q = !$q;
            if ($q) {
                $r .= $c;
                continue;
            }
            switch ($c) {
                case '{':
                case '[':
                    $r .= $c . $nl . str_repeat($t, ++$tc);
                    break;
                case '}':
                case ']':
                    $r .= $nl . str_repeat($t, --$tc) . $c;
                    break;
                case ',':
                    $r .= $c;
                    if ($json[$i + 1] != '{' && $json[$i + 1] != '[')
                        $r .= $nl . str_repeat($t, $tc);
                    break;
                case ':':
                    $r .= $c . ' ';
                    break;
                default:
                    $r .= $c;
            }
        }
        return $r;
    }

}
