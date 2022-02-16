<?php

use Illuminate\Database\Seeder;

class NetworksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('networks')->insert([
            ['name' => 'facebook', 'link' => 'https://www.facebook.com/groups/activgaming/', 'friendly' => '', 'show' => '1', 'icon' => 'facebook-f'],
            ['name' => 'twitch', 'link' => 'https://www.twitch.tv/activgamingtv', 'friendly' => '', 'show' => '1', 'icon' => 'twitch'],
            ['name' => 'teamspeak', 'link' => 'ts3server://ts.activ-gaming.com?port=9987&addbookmark=Activ Gaming&nickname=','friendly' => 'ts.activ-gaming.com', 'show' => '1', 'icon' => 'teamspeak'],
            ['name' => 'twitter', 'link' => '', 'friendly' => '', 'show' => '0', 'icon' => 'twitter'],
            ['name' => 'youtube', 'link' => '', 'friendly' => '', 'show' => '0', 'icon' => 'youtube'],
            ['name' => 'discord', 'link' => '', 'friendly' => '', 'show' => '0', 'icon' => 'discord'],
        ]);
    }
}
