<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                "title" => "Quebec information",
                "image_url" => "assets/service_images/img1.png"
            ],
            [
                "title" => "City & Accommodation Guide",
                "image_url" => "assets/service_images/img2.png"
            ],
            [
                "title" => "Learning French & Language Test",
                "image_url" => "assets/service_images/img3.png"
            ],
            [
                "title" => "Employment & Diploma Recognition",
                "image_url" => "assets/service_images/img4.png"
            ],
            [
                "title" => "Health & Social Service",
                "image_url" => "assets/service_images/img5.png"
            ],
            [
                "title" => "Activities",
                "image_url" => "assets/service_images/img6.png",
            ],
            [
                "title" => "Networking & Community",
                "image_url" => "assets/service_images/img7.png"
            ],
            [
                "title" => "Support & Advice",
                "image_url" => "assets/service_images/img8.png"
            ],

        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
