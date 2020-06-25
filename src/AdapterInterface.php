<?php

declare(strict_types=1);

namespace Saippuakauppias\EDBApter;

use Saippuakauppias\EDBApter\EDBApterException;

/**
 * Interface AdapterInterface
 * @package EDBApter\Adapter;
 */
interface AdapterInterface
{
    /**
     * @return AdapterInterface
     */
    public function close(): AdapterInterface;

    /**
     * @return bool
     */
    public function isOpen(): bool;

    /**
     * @param string $key
     * @param bool|string $default
     * @return string
     * @throws EDBApterException
     */
    public function read(string $key, mixed $default): string;

    /**
     * @param string $key
     * @param string @value
     * @return AdapterInterface
     * @throws EDBApterException
     */
    public function write(string $key, string $value): AdapterInterface;

    /**
     * @param string $key
     * @param string @value
     * @return AdapterInterface
     * @throws EDBApterException
     */
    public function update(string $key, string $avlue): AdapterInterface;

    /**
     * @param string $key
     * @return AdapterInterface
     * @throws EDBApterException
     */
    public function delete(string $key): AdapterInterface;

    /**
     * @param string $key
     * @return bool
     */
    public function exists(string $key): bool;

    /**
     * @param string $key
     * @return AdapterInterface
     * @throws EDBApterException
     */
    public function checkKeyLength(string $key): AdapterInterface;
}
