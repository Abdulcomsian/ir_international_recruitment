<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\HistoryImage;
use App\Models\TitleDescription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $event  = Event::create([
            "name" => "Major Historical Events in Quebec",
            "short_description" => "Discover the Quebec’s evolutions.",
            "main_image" => "assets/event_images/event_main_image.png",
        ]);

        $event_images = [
            [
                "event_id" => $event->id,
                "image" => "assets/event_images/event_extra_image_1.png",
                "type" => "event",
            ],
            [
                "event_id" => $event->id,
                "image" => "assets/event_images/event_extra_image_2.png",
                "type" => "event",
            ],
            [
                "event_id" => $event->id,
                "image" => "assets/event_images/event_extra_image_3.png",
                "type" => "event",
            ],
        ];

        foreach($event_images as $image){
            HistoryImage::create($image);
        }

        $title_descriptions = [
            [
                "event_id" => $event->id,
                "title" => "The October Crisis (1970)",
                "description" => "The October Crisis is one of the most dramatic events in modern Quebec history. In October 1970, the Front de libération du Québec (FLQ), a radical separatist group, kidnapped British diplomat James Cross and Quebec Minister Pierre Laporte. The crisis reached its peak when the federal government, led by Pierre Elliott Trudeau, invoked the War Measures Act, suspending civil rights and deploying the army in the streets of Montreal. The crisis ended with the release of James Cross and the death of Pierre Laporte, marking a turning point in the Quebec separatist movement, which subsequently abandoned violence for legitimate political avenues.",
                "type" => "event",
            ],

            [
                "event_id" => $event->id,
                "title" => "The Meech Lake Accord (1987-1990)",
                "description" => "The Meech Lake Accord was an attempt at constitutional reform aimed at securing Quebec's endorsement of the 1982 Canadian Constitution, which it had refused to sign. The accord, negotiated by Prime Minister Brian Mulroney, sought to recognize Quebec as a 'distinct society.' However, it failed in 1990 after two provinces, Manitoba and Newfoundland, refused to ratify it. This failure was seen as a rejection of the recognition of Quebec within the Canadian federation, reigniting the sovereignty movement and leading directly to the 1995 referendum.",
                "type" => "event",
            ],

            [
                "event_id" => $event->id,
                "title" => "The Night of the Long Knives (1981)",
                "description" => "The Night of the Long Knives refers to a series of secret constitutional negotiations that took place in November 1981 without Quebec's participation. During this night, the federal government and the nine other Canadian provinces reached an agreement to repatriate the Canadian Constitution from London and include a Charter of Rights and Freedoms. Quebec, led by Premier René Lévesque, was excluded from the final discussions and refused to sign the agreement. This event is considered a betrayal by many Quebecers and exacerbated tensions between Quebec and the rest of Canada.",
                "type" => "event",
            ],

            [
                "event_id" => $event->id,
                "title" => "The Francophonie Summit in Quebec City (1987)",
                "description" => "In 1987, Quebec City hosted the Francophonie Summit, bringing together heads of state and government from French-speaking countries. This event was a key moment for Quebec on the international stage, affirming its leadership role in the Francophone world. The summit allowed Quebec to strengthen its cultural and economic ties with other Francophone countries while asserting its distinct identity within Canada. It was also an opportunity for Quebec to promote the French language and engage in discussions on global issues affecting Francophone countries.",
                "type" => "event",
            ],

            [
                "event_id" => $event->id,
                "title" => "The 1995 Referendum",
                "description" => "The 1995 Referendum was the second referendum on Quebec sovereignty. The question asked Quebecers whether they wanted Quebec to become a sovereign country while maintaining an economic association with Canada. The 'Yes' side received 49.42% of the vote, while the 'No' side won with 50.58%, an extremely narrow margin. This result led to a period of deep reflection in Quebec and Canada on the future of federal-provincial relations. Although the referendum did not result in sovereignty, it profoundly influenced Quebec and Canadian politics for years to come.",
                "type" => "event",
            ],

            [
                "event_id" => $event->id,
                "title" => "The Women's March Against Poverty (1995)",
                "description" => "In 1995, hundreds of Quebec women participated in a historic march against poverty, organized by the Fédération des femmes du Québec. This march, also known as the 'Bread and Roses March,' crossed several regions of Quebec and drew attention to the difficult socio-economic conditions faced by women, particularly those living in poverty. The march culminated in a series of demands addressed to the provincial and federal governments to improve the living conditions of women. This event was a significant moment in the struggle for women's rights and led to several important social reforms in Quebec.",
                "type" => "event",
            ],

            [
                "event_id" => $event->id,
                "title" => "The Defeat of the Quebec Nordiques (1995)",
                "description" => "Although this event may seem less significant politically, the defeat and relocation of the Quebec Nordiques in 1995 had a profound impact on the cultural identity and morale of Quebec City. The Nordiques were more than just a hockey team; they represented an essential part of Quebec pride and identity. Their move to Denver, where they became the Colorado Avalanche, left a void in the hearts of Quebec sports fans and was seen as a loss of stature for Quebec City on the national stage.",
                "type" => "event",
            ],

            [
                "event_id" => $event->id,
                "title" => "The Truth and Reconciliation Commission (2008-2015)",
                "description" => "While the Truth and Reconciliation Commission was a national process, it had significant repercussions in Quebec. The commission was established to investigate the abuses suffered by Indigenous children in residential schools across Canada, including in Quebec. The commission's final report revealed the extent of the abuse and trauma experienced by Indigenous communities and made recommendations for reconciliation. In Quebec, this event led to increased awareness of historical injustices committed against Indigenous peoples and efforts to improve relations between Quebecers and Indigenous communities.",
                "type" => "event",
            ],
        ];


        foreach($title_descriptions as $td){
            TitleDescription::create($td);
        }
    }
}
