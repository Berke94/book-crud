<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('authors')->insert([
            ['name' => 'Orhan Pamuk'],
            ['name' => 'Ahmet Hamdi Tanpınar'],
            ['name' => 'Elif Şafak'],
            ['name' => 'Yaşar Kemal'],
            ['name' => 'Hikmet Temel Akarsu'],
            ['name' => 'Sait Faik Abasıyanık'],
            ['name' => 'Reşat Nuri Güntekin'],
            ['name' => 'Kemal Tahir'],
            ['name' => 'İskender Pala'],
            ['name' => 'Latife Tekin'],
            ['name' => 'Ayşe Kulin'],
            ['name' => 'Oğuz Atay'],
            ['name' => 'Buket Uzuner'],
            ['name' => 'Füruzan'],
            ['name' => 'Peyami Safa'],
            ['name' => 'İlhan Berk'],
            ['name' => 'Erdal Öz'],
            ['name' => 'Haldun Taner'],
            ['name' => 'Gülten Dayıoğlu'],
            ['name' => 'Murathan Mungan'],
            ['name' => 'Çağdaş Yılmaz'],
            ['name' => 'Aslı Erdoğan'],
            ['name' => 'Selim İleri'],
            ['name' => 'Metin Kaçan'],
            ['name' => 'Hasan Ali Toptaş'],
            ['name' => 'Serdar Öztürk'],
            ['name' => 'Savaş Ay'],
            ['name' => 'Suna Kıraç'],
            ['name' => 'Cevat Şakir Kabaağaçlı'],
            ['name' => 'Mümtaz Erdoğan'],
            ['name' => 'Zülfü Livaneli'],
            ['name' => 'Hüseyin Yurttaş'],
            ['name' => 'Sadi Şimşek'],
            ['name' => 'Ahmet Ümit'],
            ['name' => 'Kadir Mısıroğlu'],
            ['name' => 'Metin Üstündağ'],
            ['name' => 'Nermin Yıldırım'],
            ['name' => 'Emine Işınsu'],
            ['name' => 'Ahmet Haldun Terzioğlu'],
            ['name' => 'Cahit Zarifoğlu'],
            ['name' => 'Turgut Uyar'],
            ['name' => 'Canan Tan'],
            ['name' => 'Seyit Ahmet'],
            ['name' => 'Şebnem İşigüzel'],
            ['name' => 'Gülseren Budayıcıoğlu'],
            ['name' => 'Turgut Özakman'],
            ['name' => 'Ali Lidar'],
            ['name' => 'Sibel Eraslan'],
            ['name' => 'Fatma Aliye Topuz'],
            ['name' => 'Sedef Kabaş'],
            ['name' => 'Aka Gündüz'],
            ['name' => 'Neslihan Yalçın'],
            ['name' => 'Alev Alatlı'],
        ]);
    }
}
