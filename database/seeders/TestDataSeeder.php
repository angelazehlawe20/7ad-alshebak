<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Contact;
use Carbon\Carbon;
use Faker\Factory as Faker;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // Create Arabic faker instance for Arabic fields
        $fakerAr = Faker::create('ar_SA');
        // Create English faker instance for English fields
        $fakerEn = Faker::create('en_US');

        // Create 20 bookings with different statuses
        for ($i = 0; $i < 20; $i++) {
            $status = $fakerEn->randomElement(['pending', 'confirmed', 'cancelled']);
            $createdAt = $fakerEn->dateTimeBetween('-1 week', 'now');

            Booking::create([
                'name' => $fakerAr->name,
                'email' => $fakerEn->email,
                'phone' => '9' . $fakerEn->numberBetween(10000000, 99999999),
                'guests_count' => $fakerEn->numberBetween(1, 10),
                'booking_date' => Carbon::parse($createdAt)->addDays($fakerEn->numberBetween(1, 14))->format('d-m-Y'),
                'booking_time' => $fakerEn->dateTimeBetween('10:00', '22:00')->format('H:i:s'),
                'message' => $fakerAr->optional(0.7)->text(100),
                'status' => $status,
                'is_notified' => $status !== 'pending',
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ]);
        }

        // Create 15 contact messages with different read status
        for ($i = 0; $i < 15; $i++) {
            $isRead = $fakerEn->boolean(70); // 70% chance of being read
            $createdAt = $fakerEn->dateTimeBetween('-1 week', 'now');

            Contact::create([
                'name' => $fakerAr->name,
                'email' => $fakerEn->email,
                'subject' => $fakerAr->sentence,
                'message' => $fakerAr->realText(200),
                'is_read' => $isRead,
                'is_notified' => $isRead,
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ]);
        }
    }
}
