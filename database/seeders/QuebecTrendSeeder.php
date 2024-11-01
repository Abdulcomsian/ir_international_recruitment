<?php

namespace Database\Seeders;

use App\Models\CurrentTrend;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuebecTrendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trends = [
            [
                "title"=>"Technology",
                "category" => "Growing Sectors",
                "media_url" => "assets/currentTrend_logos/img1.png"
            ],
            [
                "title"=>"HealthCare",
                "category" => "Growing Sectors",
                "media_url" => "assets/currentTrend_logos/img1.png"
            ],
            [
                "title"=>"Education",
                "category" => "Growing Sectors",
                "media_url" => "assets/currentTrend_logos/img1.png"
            ],
            [
                "title"=>"Software Developers",
                "category" => "In Demand Professions",
                "media_url" => "assets/currentTrend_logos/img1.png"
            ],
            [
                "title"=>"Healthcare Professionals",
                "category" => "In Demand Professions",
                "media_url" => "assets/currentTrend_logos/img1.png"
            ],

        ];

        foreach($trends as $trend)
        {
            CurrentTrend::create($trend);
        }

    }
}
