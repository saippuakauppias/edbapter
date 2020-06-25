<?php

declare(strict_types=1);

namespace Saippuakauppias\EDBApter;

use Saippuakauppias\EDBApter\EDBApterException;

abstract class AbstractAdapter implements AdapterInterface
{
    /**
     * The database handler
     *
     * @var resource
     */
    protected $db = null;

    /**
     * The name of the handler
     *
     * @var string
     */
    protected $handerType = null;

    /**
     * Maximum allowed key length
     *
     * @var int
     */
    protected $maxKeyLength = null;

    /**
    * Create a database instance for `filepath` with `mode`
    *
    * @param string $filepath
    * @param string $mode
    * @throws \RuntimeException
    * @throws EDBApterException
    */
    public function __construct(string $filepath, string $mode)
    {
        // check extension
        if (!\extension_loaded('dba')) {
            throw new \RuntimeException('ext/dba not installed!');
        }

        // check handler type
        if (is_null($this->handerType)) {
            throw new \RuntimeException('Hander type not defined!');
        }

        // check handler
        if (
            !\function_exists('dba_handlers') ||
            !\in_array($this->handerType, \dba_handlers(), true)
        ) {
            throw new \RuntimeException(
                'Hander ' . $this->handerType . ' not supported!'
            );
        }

        if (\is_null($this->maxKeyLength)) {
            throw new \RuntimeException('Max key length not defined!');
        }
    }

    public function __destruct()
    {
        $this->close();
    }

    /**
     * {@inheritdoc}
     */
    public function isOpen(): bool
    {
        return !\is_null($this->db);
    }

    /**
     * {@inheritdoc}
     */
    public function close(): AdapterInterface
    {
        if ($this->isOpen()) {
            \dba_close($this->db);
            $this->db = null;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function read(string $key, $default = false): string
    {
        $value = \dba_fetch($key, $this->db);
        if ($value === false) {
            if ($default === false) {
                throw new EDBApterException('Key "' . $key . '" not found!');
            } else {
                $value = $default;
            }
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function write(string $key, string $value): AdapterInterface
    {
        $this->checkKeyLength($key);

        $status = \dba_insert($key, $value, $this->db);
        if ($status === false) {
            throw new EDBApterException('Write key "' . $key . '" failed!');
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function update(string $key, string $value): AdapterInterface
    {
        $this->checkKeyLength($key);

        $status = \dba_replace($key, $value, $this->db);
        if ($status === false) {
            throw new EDBApterException('Update key "' . $key . '" failed!');
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $key): AdapterInterface
    {
        $status = \dba_delete($key, $this->db);
        if ($status === false) {
            throw new EDBApterException('Delete key "' . $key . '" failed!');
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function exists(string $key): bool
    {
        return \dba_exists($key, $this->db);
    }

    /**
     * {@inheritdoc}
     */
    public function checkKeyLength(string $key): AdapterInterface
    {
        if (\strlen($key) > $this->maxKeyLength) {
            throw new EDBApterException('Key very long: "' . $key . '"');
        }

        return $this;
    }
}
