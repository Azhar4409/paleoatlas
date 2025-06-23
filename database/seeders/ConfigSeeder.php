<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Config::insert([
            [
                'name' => 'logo',
                'value' => 'logo.png'
            ],
            [
                'name' => 'blogname',
                'value' => 'paleoatlas'
            ],
            [
                'name' => 'title',
                'value' => 'Welcome to PaleoAtlas Blog!'
            ],
            [
                'name' => 'caption',
                'value' => 'Website for paleo enthusiasts'
            ],
            [
                'name' => 'ads_widget',
                'value' => 'adsense 1'
            ],
            [
                'name' => 'ads_header',
                'value' => 'adsense 2'
            ],
            [
                'name' => 'ads_footer',
                'value' => 'adsense 3'
            ],
            [
                'name' => 'phone',
                'value' => '081223080881'
            ],
            [
                'name' => 'email',
                'value' => 'veritasstudiocreative@gmail.com'
            ],
            [
                'name' => 'facebook',
                'value' => 'facebook.com'
            ],
            [
                'name' => 'instagram',
                'value' => 'instagram.com'
            ],
            [
                'name' => 'youtube',
                'value' => 'youtube.com'
            ],
            [
                'name' => 'Footer',
                'value' => 'Paleo Atlas'
            ],
        ]);
    }
}
