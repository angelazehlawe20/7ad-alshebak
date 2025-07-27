<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class BookingMonthSheet implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    private $year;
    private $month;

    public function __construct(int $year, int $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function collection()
    {
        return Booking::whereYear('booking_date', $this->year)
            ->whereMonth('booking_date', $this->month)
            ->orderBy('phone')
            ->get();
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
            'Created At',
            'Total Bookings'
        ];
    }

    private $previousPhone = null;
    public function map($booking): array
    {
        $showUserData = $booking->phone !== $this->previousPhone;
        $this->previousPhone = $booking->phone;

        return [
            $showUserData ? $booking->id : '', // فقط إذا الرقم مختلف
            $showUserData ? $booking->name : '',
            $showUserData ? $booking->phone : '',
            $showUserData ? $booking->email : '',
            $showUserData ? $booking->guests_count : '',
            $booking->booking_date,
            $booking->booking_time,
            $booking->message,
            $booking->status,
            $booking->created_at,
            Booking::where('phone', $booking->phone)->count()
        ];
    }

    public function title(): string
    {
        return 'month ' . $this->month;
    }
}
