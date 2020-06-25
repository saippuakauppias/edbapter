<?php

declare(strict_types=1);

namespace Saippuakauppias\EDBApter;

use Saippuakauppias\EDBApter\EDBApterException;

/**
 * Adapter to LMDB database
 */
class LMDB extends AbstractAdapter
{
    // https://github.com/LMDB/lmdb/blob/mdb.master/libraries/liblmdb/mdb.c#L658-L662
    protected $maxKeyLength = 511;

    protected $handerType = 'lmdb';

    public function __construct(string $filepath, string $mode = 'r')
    {
        parent::__construct($filepath, $mode);

        // five param:
        // https://bugs.php.net/bug.php?id=78808
        // https://github.com/php/php-src/pull/4910
        // https://github.com/php/php-src/blob/PHP-7.3/ext/dba/tests/bug78808.phpt
        // https://github.com/LMDB/lmdb/blob/mdb.master/libraries/liblmdb/mdb.c#L727-L731
        $this->db = \dba_open($filepath, $mode, $this->handerType, 0644, 100*1024*1024);

        if ($this->db === false) {
            throw new EDBApterException(
                'Open db "' . $filepath . '" with mode "' . $mode . '" failed!'
            );
        }
    }
}
