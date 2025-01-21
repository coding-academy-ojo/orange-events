<?php

namespace App\Imports;

use App\Models\Attendee;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportAttendee implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return $row;
    }
}
