<?php

namespace App\Exports;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class BookingsByDateExport implements FromCollection, WithHeadings, WithMapping, Responsable
{
    use Exportable;

    private $fromDate;
    private $toDate;

    /**
     * اسم الملف عند التصدير المباشر.
     */
    public string $fileName;

    public function __construct(string $fromDate, string $toDate)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->fileName = "bookings_from_{$fromDate}_to_{$toDate}.xlsx";
    }

    /**
     * جلب البيانات بين التاريخين.
     */
    public function collection()
    {
        return Booking::whereBetween('booking_date', [$this->fromDate, $this->toDate])->get();
    }

    /**
     * عناوين الأعمدة في ملف Excel.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Phone',
            'Email',
            'Birth Date',
            'Guests Count',
            'Booking Date',
            'Booking Time',
            'Message',
            'Status',
            'Sent At',
            'Total Bookings by Phone'
        ];
    }

    /**
     * تنسيق كل صف من البيانات.
     */
    public function map($booking): array
    {
        $totalBookings = Booking::where('phone', $booking->phone)->count();

        return [
            $booking->id,
            $booking->name,
            '+963'.$booking->phone,
            $booking->email,
            $booking->birth_date,
            $booking->guests_count,
            $booking->booking_date,
            Carbon::parse($booking->booking_time)->format('h:i A'),
            $booking->message,
            $booking->status,
            $booking->created_at,
            $totalBookings
        ];
    }
}
