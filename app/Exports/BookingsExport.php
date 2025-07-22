<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Booking::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name ',
            'Phone',
            'Email',
            'Guests Count',
            'Booking Date',
            'Booking Time',
            'Message',
            'Status',
            'Created At'
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->name,
            $booking->phone,
            $booking->email,
            $booking->guests_count,
            $booking->booking_date,
            $booking->booking_time,
            $booking->message,
            $booking->status,
            $booking->created_at
        ];
    }
}
