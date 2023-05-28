<?php

namespace Crm\Customer\Services\Export;

use Crm\Customer\Exceptions\InvalidExportFormat;

class ExportFactory
{
    /**
     * @param string $format
     * @return ExportInterface
     * @throws InvalidExportFormat
     */
    public static function instance(string $format): ExportInterface
    {
        $handler = config('export.exporter')[$format] ?? null;

        if (! $handler) {
            throw new InvalidExportFormat(sprintf('format %s is not supported', $format));
        }

        return new $handler;
    }
}
