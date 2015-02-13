<?php

/**
 * Pharaoh Tools Constants
 */

define('PHARAOH_APP', "pttest") ;

if (in_array(PHP_OS, array("Windows", "WINNT"))) {
    $sd = getenv('SystemDrive') ;
    $pf = getenv('ProgramFiles') ;
    $pf = str_replace(" (x86)", "", $pf) ;
    $command = "where /R \"{$pf}\" *VBoxManage* " ;
    $outputArray = array();
    exec($command, $outputArray);
    define('VBOXMGCOMM', "\"{$outputArray[0]}\" ") ;
    define('PFILESDIR', $sd.'\\PharaohTools\boxes') ;
    define('CLEOCOMM', "ptconfigure.cmd") ;
    define('DAPPCOMM', "ptdeploy.cmd") ;
    define('PHLCOMM', "ptvirtualize.cmd") ;
    define('TSTCOMM', "pttest.cmd") ;
    define('BOXDIR', $sd.'\\PharaohTools\boxes') ;
    define("DS", "\\");
    define("BASE_TEMP_DIR", getenv("SystemDrive").'\Temp\\'); }
else if (in_array(PHP_OS, array("Linux", "Solaris", "FreeBSD", "OpenBSD", "Darwin"))) {
    define('VBOXMGCOMM', "vboxmanage ") ;
    define('PFILESDIR', "/opt/") ;
    define('CLEOCOMM', "ptconfigure ") ;
    define('DAPPCOMM', "ptdeploy ") ;
    define('PHLCOMM', "ptvirtualize") ;
    define('TSTCOMM', "pttest") ;
    define("DS", "/");
    define("BASE_TEMP_DIR", '/tmp/');
    define('BOXDIR', DS.'ptvirtualize/boxes'.'\\') ; }