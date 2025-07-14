<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class FrequentBookersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Booking::select('phone', 'email', 'name_ar', 'name_en')
            ->selectRaw('COUNT(*) as bookings_count')
            ->groupBy('phone', 'email', 'name_ar', 'name_en')
            ->having('bookings_count', '>=', 5)
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

    public function map($booking): array
    {
        return [
            $booking->phone,
            $booking->email,
            $booking->name_ar,
            $booking->name_en,
            $booking->bookings_count
        ];
    }
}
