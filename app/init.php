<?php
namespace Metallium;

require_once(dirname(__DIR__) . '/vendor/autoload.php');

define('MTL_BASE_DIR', dirname(dirname(__FILE__)));

function ptpath($id)
{
    return 'pairtree_root/' . preg_replace('/(..)/', '\1/', $id);
}

function mip_dir($mips_dir, $id)
{
    $base_id = preg_replace('/_.*/', '', $id);
    return "$mips_dir/" . ptpath($base_id) . $base_id;
}

require_once('Metallium.php');
