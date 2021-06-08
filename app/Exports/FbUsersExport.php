<?php

namespace App\Exports;

use App\Models\Django\FbUser;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FbUsersExport implements FromCollection, WithHeadings
{
    use Exportable;

    /**
     * Accept array of data
     *
     * @var
     */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->data);
    }

    /**
     * Setting custom headings
     *
     * @return string[]
     */
    public function headings() :array
    {
        return [
            'fb_id',
            'user_name',
            'mobile',
            'name',
            'position',
            'location',
            'hometown'
        ];
    }
}
