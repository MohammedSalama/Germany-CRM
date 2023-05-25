<?php

namespace Crm\Customer\Services\Export;

class JsonExport implements ExportInterface
{
    /**
     * @param array $data
     * @return mixed|void
     */
    public function export(array $data)
    {
        dd('Json Export');
    }
}
