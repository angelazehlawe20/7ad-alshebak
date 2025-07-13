<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;

class FrequentBookersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Booking::select('phone', 'email', 'name_ar', 'name_en')
            ->selectRaw('COUNT(*) as bookings_count')
            ->groupBy('phone', 'email', 'name_ar', 'name_en')
            ->having('bookings_count', '>', 5)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Phone',
            'Email',
            'Arabic Name',
            'English Name',
            'Number of Bookings',
        ];
    
    }
}
