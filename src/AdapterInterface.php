<?php

declare(strict_types=1);

namespace Saippuakauppias\EDBApter;

use Saippuakauppias\EDBApter\EDBApterException;

/**
 * Interface AdapterInterface
 *
 * @package EDBApter\Adapter;
 */
interface AdapterInterface
{
    /**
     * Close a database
     *
     * @return AdapterInterface
     */
    public function close(): AdapterInterface;

    /**
     * Check database is open
     *
     * @return bool
     */
    public function isOpen(): bool;

    /**
     * Read value specified by key or return default
     *
     * @param string $key
     * @param bool|string $default
     * @return string
     * @throws EDBApterException
     */
    public function read(string $key, mixed $default): string;

    /**
     * Write value described with key into the database
     *
     * @param string $key
     * @param string @value
     * @return AdapterInterface
     * @throws EDBApterException
     */
    public function write(string $key, string $value): AdapterInterface;

    /**
     * Replace or insert value
     *
     * @param string $key
     * @param string @value
     * @return AdapterInterface
     * @throws EDBApterException
     */
    public function update(string $key, string $avlue): AdapterInterface;

    /**
     * Delete entry specified by key
     *
     * @param string $key
     * @return AdapterInterface
     * @throws EDBApterException
     */
    public function delete(string $key): AdapterInterface;

    /**
     * Check whether key exists
     *
     * @param string $key
     * @return bool
     */
    public function exists(string $key): bool;

    /**
     * Check max key length
     *
     * @param string $key
     * @return AdapterInterface
     * @throws EDBApterException
     */
    public function checkKeyLength(string $key): AdapterInterface;
}
