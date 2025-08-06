<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'address' => 'Uzbekistan, Tashkent, Chilonzor street',
            'phone' => '+998 99 999 99 99',
            'email' => 'admin@yopmail.com',
            'facebook' => 'https://www.facebook.com/',
            'instagram' => 'https://instagram.com/',
            'youtube' => 'https://www.youtube.com/',
        ];
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
