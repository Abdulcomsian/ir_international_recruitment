<?php

namespace Database\Seeders;

use App\Models\{
    History,
    HistoryImage,
    TitleDescription,
};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $history = History::create([
            "name" => "History of Quebec",
            "short_description" => "Discover the rich history and culture of Quebec's First Nations.",
            "main_image" => "assets/history_images/history_main_image.png",
        ]);

        $history_images = [
            [
                "history_id" => $history->id,
                "image" => "assets/history_images/history_extra_image_1.png",
                "type" => "history",
            ],
            [
                "history_id" => $history->id,
                "image" => "assets/history_images/history_extra_image_2.png",
                "type" => "history",
            ],
            [
                "history_id" => $history->id,
                "image" => "assets/history_images/history_extra_image_3.png",
                "type" => "history",
            ],
        ];

        foreach($history_images as $image){
            HistoryImage::create($image);
        }

        $title_descriptions = [
            [
                "history_id" => $history->id,
                "title" => "Quebec History",
                "description" => "Quebec history is rich and complex, marked by a series of events and transformations that have shaped this French-speaking province within a predominantly English-speaking Canada. From the first permanent European settlement in North America to its current role as a bastion of French culture and language in America, Quebec has a unique history that is deeply rooted in its identity.",
                "type" => "history",
            ],
            [
                "history_id" => $history->id,
                "title" => "The First Nations",
                "description" => "Before the arrival of Europeans, the territory that is now Quebec was inhabited by various aboriginal peoples, including the Iroquoians, Algonquians and Inuit. These peoples lived by hunting, fishing and farming, and had developed complex cultures and societies.",
                "type" => "history",
            ],
            [
                "history_id" => $history->id,
                "title" => "New France (1534-1763)",
                "description" => "Quebec's colonial history begins with the arrival of Jacques Cartier in 1534, who claimed the territory for France. In 1608, Samuel de Champlain founded the city of Quebec, which became the center of New France. The colony developed slowly, with an economy based on the fur trade and agriculture. The seigneurial system was established to encourage settlement, and society was structured around the Catholic religion, the French language, and a social hierarchy imported from France.",
                "type" => "history",
            ],
            [
                "history_id" => $history->id,
                "title" => "The British Conquest and the Royal Proclamation (1763)",
                "description" => "After the Seven Years' War, France ceded New France to Great Britain through the Treaty of Paris. This change of sovereignty marked the beginning of British influence over Quebec. The Royal Proclamation of 1763 established the Province of Quebec and attempted to assimilate the French Canadians by encouraging British immigration and imposing British laws and institutions. However, this policy met with resistance from the Canadians, who remained predominantly French-speaking and Catholic.",
                "type" => "history",
            ],
            [
                "history_id" => $history->id,
                "title" => "The Quebec Act (1774)",
                "description" => "To ease tensions and ensure the loyalty of the French Canadians, the British government passed the Quebec Act in 1774. This act expanded the boundaries of the Province of Quebec, recognized French civil law, and granted religious freedom to Catholics. This allowed the Canadians to retain their language, religion, and customs, which would contribute to shaping Quebec's identity.",
                "type" => "history",
            ],
            [
                "history_id" => $history->id,
                "title" => "The Rebellion of 1837-1838",
                "description" => "In the early 19th century, political and social tensions increased in Lower Canada (present-day Quebec) as French Canadians demanded more political power in the face of a dominant British elite. These tensions culminated in the Rebellion of 1837-1838, an uprising against the colonial government. Although the rebellion was suppressed, it left a lasting mark on Quebec's national consciousness.",
                "type" => "history",
            ],
            [
                "history_id" => $history->id,
                "title" => "Canadian Confederation (1867)",
                "description" => "In 1867, Quebec became one of the four founding provinces of Canada with the adoption of the British North America Act. Confederation was a compromise that allowed Quebec to retain its legal system, language, and religion while integrating into a new federation dominated by English speakers. This linguistic and cultural duality became a permanent feature of Canada.",
                "type" => "history",
            ],
            [
                "history_id" => $history->id,
                "title" => "The 20th Century - Modernization and the quiet revolution",
                "description" => "The 20th century saw the transformation of Quebec from a rural and conservative society to a modern and urban one. The Quiet Revolution of the 1960s marked a major turning point, with the secularization of society, the nationalization of key industries such as hydroelectricity, and the assertion of a distinct Quebec identity. The separatist movement gained strength, culminating in the referendums on sovereignty in 1980 and 1995, both of which were narrowly defeated.",
                "type" => "history",
            ],
        ];


        foreach($title_descriptions as $td){
            TitleDescription::create($td);
        }
        
    }
}
