<?php

namespace Crm\Customer\Services\Export;

class PdfExport implements ExportInterface
{

    /**
     * @param array $data
     * @return mixed|void
     */
    public function export(array $data)
    {
        dd('Pdf Export');
    }
}
