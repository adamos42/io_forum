<?php

function colorize($str) {

   $colors = array(); $str = "<span>".$str;

   $colors["^0"] = '</span><span style="color:#222222">';
   $colors["^1"] = '</span><span style="color:#DA0120">';
   $colors["^2"] = '</span><span style="color:#00B906">';
   $colors["^3"] = '</span><span style="color:#E8FF19">';
   $colors["^4"] = '</span><span style="color:#170BDB">';
   $colors["^5"] = '</span><span style="color:#23C2C6">';
   $colors["^6"] = '</span><span style="color:#E201DB">';
   $colors["^7"] = '</span><span style="color:#FFFFFF">';
   $colors["^8"] = '</span><span style="color:#CA7C27">';
   $colors["^9"] = '</span><span style="color:#757575">';
   $colors["^a"] = '</span><span style="color:#EB9F53">';
   $colors["^b"] = '</span><span style="color:#106F59">';
   $colors["^c"] = '</span><span style="color:#5A134F">';
   $colors["^d"] = '</span><span style="color:#035AFF">';
   $colors["^e"] = '</span><span style="color:#681EA7">';
   $colors["^f"] = '</span><span style="color:#5097C1">';
   $colors["^g"] = '</span><span style="color:#BEDAC4">';
   $colors["^h"] = '</span><span style="color:#024D2C">';
   $colors["^i"] = '</span><span style="color:#7D081B">';
   $colors["^j"] = '</span><span style="color:#90243E">';
   $colors["^k"] = '</span><span style="color:#743313">';
   $colors["^l"] = '</span><span style="color:#A7905E">';
   $colors["^m"] = '</span><span style="color:#555C26">';
   $colors["^n"] = '</span><span style="color:#AEAC97">';
   $colors["^o"] = '</span><span style="color:#C0BF7F">';
   $colors["^p"] = '</span><span style="color:#000000">';
   $colors["^q"] = '</span><span style="color:#DA0120">';
   $colors["^r"] = '</span><span style="color:#00B906">';
   $colors["^s"] = '</span><span style="color:#E8FF19">';
   $colors["^t"] = '</span><span style="color:#170BDB">';
   $colors["^u"] = '</span><span style="color:#23C2C6">';
   $colors["^v"] = '</span><span style="color:#E201DB">';
   $colors["^w"] = '</span><span style="color:#FFFFFF">';
   $colors["^x"] = '</span><span style="color:#CA7C27">';
   $colors["^y"] = '</span><span style="color:#757575">';
   $colors["^z"] = '</span><span style="color:#CC8034">';
   $colors["^/"] = '</span><span style="color:#DBDF70">';
   $colors["^*"] = '</span><span style="color:#BBBBBB">';
   $colors["^-"] = '</span><span style="color:#747228">';
   $colors["^+"] = '</span><span style="color:#993400">';
   $colors["^?"] = '</span><span style="color:#670504">';
   $colors["^@"] = '</span><span style="color:#623307">';
   $colors["^."] = '</span><span>';
   
   $str = str_replace(array_keys($colors), array_values($colors), $str);

   return $str."</span>";
}
