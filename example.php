<?php
require_once __DIR__ . '/vendor/autoload.php';

use Saippuakauppias\EDBApter\LMDB;

// create lmdb instance
$db = new LMDB(__DIR__ . '/test.db', 'w');

// write
$db->write('key0', 'data0')->write('key1', 'data1');

// update
$db->update('key0', 'd0');

// read
$val = $db->read('key0') . $db->read('key1');
if ($val != 'd0data1') {
    throw new \Exception('Read failed: ' . $val);
}

// delete
$db->delete('key0');

// exists
if (
    ($db->exists('key0') === true) ||
    ($db->exists('key1') === false)
) {
    throw new \Exception('Check exists failed');
}

// delete
$db->delete('key1');

// close db
$db->close();

// check database is closed
if ($db->isOpen()) {
    throw new \Exception('Database open');
}

echo 'Success';
