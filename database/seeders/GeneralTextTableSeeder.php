<?php

namespace Database\Seeders;

use App\Models\GeneralText;
use Illuminate\Database\Seeder;

class GeneralTextTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*


        'key',
        'title',
        'title_ar',
        'media_path',
        'content',
        'content_en',
        'media_path',
        'email',
        */

        GeneralText::insert([
            [
                'key' => "about_app",

                'title' => "title",

                'title_ar' => "عنوان",

                'content' => "content",

                'content_ar' => "<h1>title1</h1><p>paragraph</p>",

                "media_path" => "imgs/master.png",

                'email' => "email@email.com",
            ],

            [
                'key' => "terms",

                'title' => "title",

                'title_ar' => "عنوان",

                'content' => "content",

                'content_ar' => "<h1>title1</h1><p>paragraph</p>",

                "media_path" => "imgs/master.png",

                'email' => "email@email.com",
            ],

            ['key' => 'privacy_policy',

                'title' => "title",

                'title_ar' => "عنوان",

                'content' => "content",

                'content_ar' => "<h1>title1</h1><p>paragraph</p>",

                "media_path" => "imgs/master.png",

                'email' => "email@email.com",

            ],


            ['key' => 'terms',

                'title' => "title",

                'title_ar' => "عنوان",

                'content' => "content",

                'content_ar' => "<h1>title1</h1><p>paragraph</p>",

                "media_path" => "imgs/master.png",

                'email' => "email@email.com",

            ],

            [

                'key' => 'contact_us',

                'title' => "title",

                'title_ar' => "عنوان",

                'content' => "content",

                'content_ar' => "<h1>title1</h1><p>paragraph</p>",

                "media_path" => "imgs/master.png",

                'email' => "email@email.com",

            ],
            [

                'key'=>'points',

                'title'=>"title",

                'title_ar'=>"عنوان",

                'content'=>"content",

                'content_ar'=>"<h1>title1</h1><p>paragraph</p>",

                "media_path"=>"imgs/master.png",

                'email'=>"email@email.com",

            ],


        ]);
    }
}
