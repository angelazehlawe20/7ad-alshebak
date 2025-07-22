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
        return Booking::select('phone', 'email', 'name')
            ->selectRaw('COUNT(*) as bookings_count')
            ->groupBy('phone', 'email', 'name')
            ->having('bookings_count', '>=', 5)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Phone',
            'Email', 
            'Name',
            'Number of Bookings',
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->phone,
            $booking->email,
            $booking->name,
            $booking->bookings_count
        ];
    }
}
