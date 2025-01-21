<?php

namespace App\Exports;

use App\Models\Attendee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendeeExport implements FromCollection, WithHeadings
{
    public $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->id != 0)
            return Attendee::where('event_id', $this->id)->get(['name', 'email', 'phone', 'entity']);
        else
            return Attendee::select('name', 'email', 'phone', 'entity')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Entity',
        ];
    }
}
