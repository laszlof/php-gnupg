--TEST--n
sign a text with sigmode SIG_MODE_CLEAR
--FILE--
<?php
require_once dirname(__FILE__) . "/vars.inc";
gnupg_test_import();

$gpg = gnupg_init();
gnupg_seterrormode($gpg, GNUPG_ERROR_WARNING);
gnupg_setsignmode($gpg, GNUPG_SIG_MODE_CLEAR);
gnupg_addsignkey($gpg, $fingerprint, $passphrase);
$ret = gnupg_sign($gpg, $plaintext);

$gpg = NULL;

$gpg = gnupg_init();
$tmp = false;
$ret = gnupg_verify($gpg, $ret, false, $tmp);

var_dump($ret);
var_dump($tmp);
?>
--EXPECTF--
array(1) {
  [0]=>
  array(5) {
    ["fingerprint"]=>
    string(40) "64DF06E42FCF2094590CDEEE2E96F141B3DD2B2E"
    ["validity"]=>
    int(0)
    ["timestamp"]=>
    int(%d)
    ["status"]=>
    int(0)
    ["summary"]=>
    int(0)
  }
}
string(8) "foo bar
"
