<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NERLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //「関根の拡張固有表現階層」Version 7.1.2+独自追加
        $param=[

           ['label'=>'Animation',
           'name'=>'アニメタイトル',
           'parent'=>'かどで日記独自'],

           ['label'=>'Library_Framework',
           'name'=>'ライブラリ名',
           'parent'=>'かどで日記独自'],

           ['label'=>'Programming_Lang',
           'name'=>'プログラミング言語',
           'parent'=>'かどで日記独自'],

           ['label'=>'Name_Other',
           'name'=>'名前_その他',
           'parent'=>'名前_その他'],

           ['label'=>'Person',
           'name'=>'人名',
           'parent'=>'人名'],

           ['label'=>'God',
           'name'=>'神名',
           'parent'=>'神名'],

           /**
            * 組織名
            */
           ['label'=>'Organization_Other',
           'name'=>'組織名_その他',
           'parent'=>'組織名'],

           ['label'=>'International_Organization',
           'name'=>'国際組織名',
           'parent'=>'組織名'],

           ['label'=>'International_Organization',
           'name'=>'公演組織名',
           'parent'=>'組織名'],

           ['label'=>'Family',
           'name'=>'家系名',
           'parent'=>'組織名'],

           ['label'=>'Ethnic_Group_Other',
           'name'=>'民族名_その他',
           'parent'=>'組織名'],

           ['label'=>'Nationality',
           'name'=>'国籍名',
           'parent'=>'組織名'],

           ['label'=>'Sports_Organization_Other',
           'name'=>'競技組織名_その他',
           'parent'=>'組織名'],

           ['label'=>'Pro_Sports_Organization',
           'name'=>'プロ競技組織名',
           'parent'=>'組織名'],

           ['label'=>'Sports_League',
           'name'=>'競技リーグ名',
           'parent'=>'組織名'],

           ['label'=>'Corporation_Other',
           'name'=>'法人名_その他',
           'parent'=>'組織名'],

           ['label'=>'Company',
           'name'=>'企業名',
           'parent'=>'組織名'],

           ['label'=>'Company_Group',
           'name'=>'企業グループ名',
           'parent'=>'組織名'],

           ['label'=>'Political_Organization_Other',
           'name'=>'政治的組織名_その他',
           'parent'=>'組織名'],

           ['label'=>'Government',
           'name'=>'政府組織名',
           'parent'=>'組織名'],

           ['label'=>'Political_Party',
           'name'=>'政党名',
           'parent'=>'組織名'],

           ['label'=>'Cabinet',
           'name'=>'内閣名',
           'parent'=>'組織名'],

           ['label'=>'Military',
           'name'=>'軍隊名',
           'parent'=>'組織名'],

           /**
            * 地名
            */
           ['label'=>'Location_Other',
           'name'=>'地名_その他',
           'parent'=>'地名'],

           ['label'=>'Spa',
           'name'=>'温泉名',
           'parent'=>'地名'],

           ['label'=>'GPE_Other',
           'name'=>'ＧＰＥ_その他',
           'parent'=>'地名'],

           ['label'=>'City',
           'name'=>'市区町村名',
           'parent'=>'地名'],

           ['label'=>'County',
           'name'=>'郡名',
           'parent'=>'地名'],

           ['label'=>'Province',
           'name'=>'都道府県州名',
           'parent'=>'地名'],

           ['label'=>'Country',
           'name'=>'国名',
           'parent'=>'地名'],

           ['label'=>'Region_Other',
           'name'=>'地域名_その他',
           'parent'=>'地名'],

           ['label'=>'Continental_Region',
           'name'=>'大陸地域名',
           'parent'=>'地名'],

           ['label'=>'Domestic_Region',
           'name'=>'国内地域名',
           'parent'=>'地名'],

           ['label'=>'Geological_Region_Other',
           'name'=>'地形名_その他',
           'parent'=>'地名'],

           ['label'=>'Mountain',
           'name'=>'山地名',
           'parent'=>'地名'],

           ['label'=>'Island',
           'name'=>'島名',
           'parent'=>'地名'],

           ['label'=>'River',
           'name'=>'河川名',
           'parent'=>'地名'],

           ['label'=>'Lake',
           'name'=>'湖沼名',
           'parent'=>'地名'],

           ['label'=>'Sea',
           'name'=>'海洋名',
           'parent'=>'地名'],

           ['label'=>'Bay',
           'name'=>'湾名',
           'parent'=>'地名'],

           ['label'=>'Astral_Body_Other',
           'name'=>'天体名_その他',
           'parent'=>'地名'],

           ['label'=>'Star',
           'name'=>'恒星名',
           'parent'=>'地名'],

           ['label'=>'Planet',
           'name'=>'惑星名',
           'parent'=>'地名'],

           ['label'=>'Constellation',
           'name'=>'星座名',
           'parent'=>'地名'],

           ['label'=>'Address_Other',
           'name'=>'アドレス_その他',
           'parent'=>'地名'],

           ['label'=>'Postal_Address',
           'name'=>'郵便住所',
           'parent'=>'地名'],

           ['label'=>'Phone_Number',
           'name'=>'電話番号',
           'parent'=>'地名'],

           ['label'=>'Email',
           'name'=>'電子メイル',
           'parent'=>'地名'],

           ['label'=>'URL',
           'name'=>'URL',
           'parent'=>'地名'],

           /**
            * 施設名
            */

            ['label'=>'Facility_Other',
            'name'=>'施設名_その他',
            'parent'=>'施設名'],

            ['label'=>'Facility_Part',
            'name'=>'施設部分名',
            'parent'=>'施設名'],

            ['label'=>'Archaeological_Place_Other',
            'name'=>'遺跡名_その他',
            'parent'=>'施設名'],

            ['label'=>'Tumulus',
            'name'=>'古墳名',
            'parent'=>'施設名'],

            ['label'=>'GOE_Other',
            'name'=>'ＧＯＥ_その他',
            'parent'=>'施設名'],

            ['label'=>'Public_Institution',
            'name'=>'公共機関名',
            'parent'=>'施設名'],

            ['label'=>'School',
            'name'=>'学校名',
            'parent'=>'施設名'],

            ['label'=>'Research_Institute',
            'name'=>'研究機関名',
            'parent'=>'施設名'],

            ['label'=>'Market',
            'name'=>'取引所名',
            'parent'=>'施設名'],

            ['label'=>'Park',
            'name'=>'公園名',
            'parent'=>'施設名'],

            ['label'=>'Sports_Facility',
            'name'=>'競技施設名',
            'parent'=>'施設名'],

            ['label'=>'Museum',
            'name'=>'美術博物館名',
            'parent'=>'施設名'],

            ['label'=>'Zoo',
            'name'=>'動植物園名',
            'parent'=>'施設名'],

            ['label'=>'Amusement_Park',
            'name'=>'遊園施設名',
            'parent'=>'施設名'],

            ['label'=>'Theater',
            'name'=>'劇場名',
            'parent'=>'施設名'],

            ['label'=>'Worship_Place',
            'name'=>'神社寺名',
            'parent'=>'施設名'],

            ['label'=>'Car_Stop',
            'name'=>'停車場名',
            'parent'=>'施設名'],

            ['label'=>'Station',
            'name'=>'電車駅名',
            'parent'=>'施設名'],

            ['label'=>'Airport',
            'name'=>'空港名',
            'parent'=>'施設名'],

            ['label'=>'Port',
            'name'=>'港名',
            'parent'=>'施設名'],

            ['label'=>'Line_Other',
            'name'=>'路線名_その他',
            'parent'=>'施設名'],

            ['label'=>'Railroad',
            'name'=>'電車路線名',
            'parent'=>'施設名'],

            ['label'=>'Road',
            'name'=>'道路名',
            'parent'=>'施設名'],

            ['label'=>'Canal',
            'name'=>'運河名',
            'parent'=>'施設名'],

            ['label'=>'Water_Route',
            'name'=>'航路名',
            'parent'=>'施設名'],

            ['label'=>'Tunnel',
            'name'=>'トンネル名',
            'parent'=>'施設名'],

            ['label'=>'Bridge',
            'name'=>'橋名',
            'parent'=>'施設名'],

            /**
             * 製品名
             */

            ['label'=>'Product_Other',
            'name'=>'製品名_その他',
            'parent'=>'製品名'],

            ['label'=>'Material',
            'name'=>'材料名',
            'parent'=>'製品名'],

            ['label'=>'Clothing',
            'name'=>'衣類名',
            'parent'=>'製品名'],

            ['label'=>'Money_Form',
            'name'=>'貨幣名',
            'parent'=>'製品名'],

            ['label'=>'Drug',
            'name'=>'医薬品名',
            'parent'=>'製品名'],

            ['label'=>'Weapon',
            'name'=>'武器名',
            'parent'=>'製品名'],

            ['label'=>'Stock',
            'name'=>'株名',
            'parent'=>'製品名'],

            ['label'=>'Award',
            'name'=>'賞名',
            'parent'=>'製品名'],

            ['label'=>'Decoration',
            'name'=>'勲章名',
            'parent'=>'製品名'],

            ['label'=>'Offense',
            'name'=>'罪名',
            'parent'=>'製品名'],

            ['label'=>'Service',
            'name'=>'便名',
            'parent'=>'製品名'],

            ['label'=>'Class',
            'name'=>'等級名',
            'parent'=>'製品名'],

            ['label'=>'Character',
            'name'=>'キャラクター名',
            'parent'=>'製品名'],

            ['label'=>'ID_Number',
            'name'=>'識別番号',
            'parent'=>'製品名'],

            ['label'=>'Vehicle_Other',
            'name'=>'乗り物名_その他',
            'parent'=>'製品名'],

            ['label'=>'Car',
            'name'=>'車名',
            'parent'=>'製品名'],

            ['label'=>'Train',
            'name'=>'列車名',
            'parent'=>'製品名'],

            ['label'=>'Aircraft',
            'name'=>'飛行機名',
            'parent'=>'製品名'],

            ['label'=>'Spaceship',
            'name'=>'宇宙船名',
            'parent'=>'製品名'],

            ['label'=>'Ship',
            'name'=>'船名',
            'parent'=>'製品名'],

            ['label'=>'Food_Other',
            'name'=>'食べ物名_その他',
            'parent'=>'製品名'],

            ['label'=>'Dish',
            'name'=>'料理名',
            'parent'=>'製品名'],

            ['label'=>'Art_Other',
            'name'=>'芸術作品名_その他',
            'parent'=>'製品名'],

            ['label'=>'Picture',
            'name'=>'絵画名',
            'parent'=>'製品名'],

            ['label'=>'Broadcast_Program',
            'name'=>'番組名',
            'parent'=>'製品名'],

            ['label'=>'Movie',
            'name'=>'映画名',
            'parent'=>'製品名'],

            ['label'=>'Show',
            'name'=>'公演名',
            'parent'=>'製品名'],

            ['label'=>'Music',
            'name'=>'音楽名',
            'parent'=>'製品名'],

            ['label'=>'Book',
            'name'=>'文学名',
            'parent'=>'製品名'],

            ['label'=>'Printing_Other',
            'name'=>'出版物名_その他',
            'parent'=>'製品名'],

            ['label'=>'Newspaper',
            'name'=>'新聞名',
            'parent'=>'製品名'],

            ['label'=>'Magazine',
            'name'=>'雑誌名',
            'parent'=>'製品名'],

            ['label'=>'Doctrine_Method_Other',
            'name'=>'主義方式名_その他',
            'parent'=>'製品名'],

            ['label'=>'Culture',
            'name'=>'文化名',
            'parent'=>'製品名'],

            ['label'=>'Religion',
            'name'=>'宗教名',
            'parent'=>'製品名'],

            ['label'=>'Academic',
            'name'=>'学問名',
            'parent'=>'製品名'],

            ['label'=>'Sport',
            'name'=>'競技名',
            'parent'=>'製品名'],

            ['label'=>'Style',
            'name'=>'流派名',
            'parent'=>'製品名'],

            ['label'=>'Movement',
            'name'=>'運動名',
            'parent'=>'製品名'],

            ['label'=>'Theory',
            'name'=>'理論名',
            'parent'=>'製品名'],

            ['label'=>'Plan',
            'name'=>'政策計画名',
            'parent'=>'製品名'],

            ['label'=>'Rule_Other',
            'name'=>'規則名_その他',
            'parent'=>'製品名'],

            ['label'=>'Treaty',
            'name'=>'条約名',
            'parent'=>'製品名'],

            ['label'=>'Law',
            'name'=>'法令名',
            'parent'=>'製品名'],

            ['label'=>'Title_Other',
            'name'=>'称号名_その他',
            'parent'=>'製品名'],

            ['label'=>'Position_Vocation',
            'name'=>'地位職業名',
            'parent'=>'製品名'],

            ['label'=>'Language_Other',
            'name'=>'言語名_その他',
            'parent'=>'製品名'],

            ['label'=>'National_Language',
            'name'=>'国語名',
            'parent'=>'製品名'],

            ['label'=>'Unit_Other',
            'name'=>'単位名_その他',
            'parent'=>'製品名'],

            ['label'=>'Currency',
            'name'=>'通貨単位名',
            'parent'=>'製品名'],

            /**
             * イベント名
             */

            ['label'=>'Event_Other',
            'name'=>'イベント名_その他',
            'parent'=>'イベント名'],

            ['label'=>'Occasion_Other',
            'name'=>'催し物名_その他',
            'parent'=>'イベント名'],

            ['label'=>'Religious_Festival',
            'name'=>'例祭名',
            'parent'=>'イベント名'],

            ['label'=>'Game',
            'name'=>'競技会名',
            'parent'=>'イベント名'],

            ['label'=>'Conference',
            'name'=>'会議名',
            'parent'=>'イベント名'],

            ['label'=>'Incident_Other',
            'name'=>'事故事件名_その他',
            'parent'=>'イベント名'],

            ['label'=>'War',
            'name'=>'戦争名',
            'parent'=>'イベント名'],

            ['label'=>'Natural_Phenomenon_Other',
            'name'=>'自然現象名_その他',
            'parent'=>'イベント名'],

            ['label'=>'Natural_Disaster',
            'name'=>'自然災害名',
            'parent'=>'イベント名'],

            ['label'=>'Earthquake',
            'name'=>'地震名',
            'parent'=>'イベント名'],
            /**
             * 自然物名
             */

            ['label'=>'Natural_Object_Other',
            'name'=>'自然物名_その他',
            'parent'=>'自然物名'],

            ['label'=>'Element',
            'name'=>'元素名',
            'parent'=>'自然物名'],

            ['label'=>'Compound',
            'name'=>'化合物名',
            'parent'=>'自然物名'],

            ['label'=>'Mineral',
            'name'=>'鉱物名',
            'parent'=>'自然物名'],

            ['label'=>'Living_Thing_Other',
            'name'=>'生物名_その他',
            'parent'=>'自然物名'],

            ['label'=>'Fungus',
            'name'=>'真菌類名',
            'parent'=>'自然物名'],

            ['label'=>'Mollusk_Arthropod',
            'name'=>'軟体動物_節足動物名',
            'parent'=>'自然物名'],

            ['label'=>'Insect',
            'name'=>'昆虫類名',
            'parent'=>'自然物名'],

            ['label'=>'Fish',
            'name'=>'魚類名',
            'parent'=>'自然物名'],

            ['label'=>'Amphibia',
            'name'=>'両生類名',
            'parent'=>'自然物名'],

            ['label'=>'Reptile',
            'name'=>'爬虫類名',
            'parent'=>'自然物名'],

            ['label'=>'Bird',
            'name'=>'鳥類名',
            'parent'=>'自然物名'],

            ['label'=>'Mammal',
            'name'=>'哺乳類名',
            'parent'=>'自然物名'],

            ['label'=>'Flora',
            'name'=>'植物名',
            'parent'=>'自然物名'],

            ['label'=>'Living_Thing_Part_Other',
            'name'=>'生物部位名_その他',
            'parent'=>'自然物名'],

            ['label'=>'Animal_Part',
            'name'=>'動物部位名',
            'parent'=>'自然物名'],

            ['label'=>'Flora_Part',
            'name'=>'植物部位名',
            'parent'=>'自然物名'],

            /**
             * 病気名
             */

            ['label'=>'Disease_Other',
            'name'=>'病気名_その他',
            'parent'=>'病気名_その他'],

            ['label'=>'Animal_Disease',
            'name'=>'動物病気名',
            'parent'=>'動物病気名'],

            /**
             * 色名
             */

            ['label'=>'Color_Other',
            'name'=>'色名_その他',
            'parent'=>'色名'],

            ['label'=>'Nature_Color',
            'name'=>'自然色名',
            'parent'=>'色名'],

            /**
             * 時間
             */

            ['label'=>'Time_Top_Other',
            'name'=>'時間表現_その他',
            'parent'=>'時間表現_その他'],

            ['label'=>'Timex_Other',
            'name'=>'時間_その他',
            'parent'=>'時間'],

            ['label'=>'Time',
            'name'=>'時刻表現',
            'parent'=>'時間'],

            ['label'=>'Date',
            'name'=>'日付表現',
            'parent'=>'時間'],

            ['label'=>'Day_Of_Week',
            'name'=>'曜日表現',
            'parent'=>'時間'],

            ['label'=>'Era',
            'name'=>'時代表現',
            'parent'=>'時間'],

                /**
             * 期間
             */
            ['label'=>'Periodx_Other',
            'name'=>'期間_その他',
            'parent'=>'期間'],

            ['label'=>'Period_Time',
            'name'=>'時刻期間',
            'parent'=>'期間'],

            ['label'=>'Period_Day',
            'name'=>'日数期間',
            'parent'=>'期間'],

            ['label'=>'Period_Week',
            'name'=>'週数期間',
            'parent'=>'期間'],

            ['label'=>'Period_Month',
            'name'=>'月数期間',
            'parent'=>'期間'],

            ['label'=>'Period_Year',
            'name'=>'年数期間',
            'parent'=>'期間'],

            /**
             * 数値表現のジャンルなし
             */

            ['label'=>'Numex_Other',
            'name'=>'数値表現_その他',
            'parent'=>'数値表現_その他'],

            ['label'=>'Money',
            'name'=>'金額表現',
            'parent'=>'金額表現'],

            ['label'=>'Stock_Index',
            'name'=>'株指標',
            'parent'=>'株指標'],

            ['label'=>'Point',
            'name'=>'ポイント',
            'parent'=>'ポイント'],

            ['label'=>'Percent',
            'name'=>'割合表現',
            'parent'=>'割合表現'],

            ['label'=>'Multiplication',
            'name'=>'倍数表現',
            'parent'=>'倍数表現'],

            ['label'=>'Frequency',
            'name'=>'頻度表現',
            'parent'=>'頻度表現'],

            ['label'=>'Age',
            'name'=>'年齢',
            'parent'=>'年齢'],

            ['label'=>'School_Age',
            'name'=>'学齢',
            'parent'=>'学齢'],

            ['label'=>'Ordinal_Number',
            'name'=>'序数',
            'parent'=>'序数'],

            ['label'=>'Rank',
            'name'=>'順位表現',
            'parent'=>'順位表現'],

            ['label'=>'Latitude_Longitude',
            'name'=>'緯度経度',
            'parent'=>'緯度経度'],

            /**
             * 寸法表現
             */

            ['label'=>'Measurement_Other',
            'name'=>'寸法表現_その他',
            'parent'=>'寸法表現'],

            ['label'=>'Physical_Extent',
            'name'=>'長さ',
            'parent'=>'寸法表現'],

            ['label'=>'Space',
            'name'=>'面積',
            'parent'=>'寸法表現'],

            ['label'=>'Volume',
            'name'=>'体積',
            'parent'=>'寸法表現'],

            ['label'=>'Weight',
            'name'=>'重量',
            'parent'=>'寸法表現'],

            ['label'=>'Speed',
            'name'=>'速度',
            'parent'=>'寸法表現'],

            ['label'=>'Intensity',
            'name'=>'密度',
            'parent'=>'寸法表現'],

            ['label'=>'Temperature',
            'name'=>'温度',
            'parent'=>'寸法表現'],

            ['label'=>'Calorie',
            'name'=>'カロリー',
            'parent'=>'寸法表現'],

            ['label'=>'Seismic_Intensity',
            'name'=>'震度',
            'parent'=>'寸法表現'],

            ['label'=>'Seismic_Magnitude',
            'name'=>'マグニチュード',
            'parent'=>'寸法表現'],

            /**
             * 個数
             */

            ['label'=>'Contx_Other',
            'name'=>'個数_その他',
            'parent'=>'個数'],

            ['label'=>'N_Person',
            'name'=>'人数',
            'parent'=>'個数'],

            ['label'=>'N_Organization',
            'name'=>'組織数',
            'parent'=>'個数'],

            ['label'=>'N_Location_Other',
            'name'=>'場所数_その他',
            'parent'=>'個数'],

            ['label'=>'N_Country',
            'name'=>'国数',
            'parent'=>'個数'],

            ['label'=>'N_Facility',
            'name'=>'施設数',
            'parent'=>'個数'],

            ['label'=>'N_Product',
            'name'=>'製品数',
            'parent'=>'個数'],

            ['label'=>'N_Event',
            'name'=>'イベント数',
            'parent'=>'個数'],

            ['label'=>'N_Natural_Object_Other',
            'name'=>'自然物数_その他',
            'parent'=>'個数'],

            ['label'=>'N_Animal',
            'name'=>'動物数',
            'parent'=>'個数'],

            ['label'=>'N_Flora',
            'name'=>'植物数',
            'parent'=>'個数'],


        ];
        DB::table("n_e_r_labels")->insert($param);
    }
}
