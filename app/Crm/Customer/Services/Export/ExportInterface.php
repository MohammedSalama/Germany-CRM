<?php

namespace Crm\Customer\Services\Export;

interface ExportInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function export(array $data);
}
