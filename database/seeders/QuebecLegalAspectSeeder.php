<?php

namespace Database\Seeders;

use App\Models\QuebecLegalAspect;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuebecLegalAspectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        QuebecLegalAspect::insert([
            [
                'img' => 'key_navigation.jpg',
                'title' => 'Key to Navigating Quebec',
                'type' => 'key_navigation',
                'description' => 'Discover in depth information about legal aspect of living and working in Quebec.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'img' => 'faq.png',
                'title' => 'FAQ',
                'type' => 'faq',
                'description' => 'Address common legal questions and concerns faced by Quebec’s newcomers.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'img' => 'useful_links.jpg',
                'title' => 'Useful Links',
                'type' => 'useful_links',
                'description' => 'Discover the important useful resources.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'img' => 'legal_aid.jpg',
                'title' => 'Free Legal Aid',
                'type' => 'legal_aid',
                'description' => 'Discover free legal assistance centers',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'img' => 'quiz.png',
                'title' => 'Quiz',
                'type' => 'quiz',
                'description' => 'Do you know legal aspect in Quebec?',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
