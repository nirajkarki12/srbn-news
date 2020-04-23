<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
   /**
   * Auto generated seed file
   *
   * @return void
   */
   public function run()
   {
      \DB::table('settings')->delete();
     
      \DB::table('settings')->insert([
         [
            'key' => 'site_tagline',
            'value' => 'SRBN News Portal',
         ],
         [
            'key' => 'site_name',
            'value' => 'SRBN News',
         ],
         [
            'key' => 'site_description',
            'value' => 'SRBN News',
         ],
         [
            'key' => 'data_per_page',
            'value' => '10',
         ],
         [
            'key' => 'date_format',
            'value' => 'Y-m-d',
         ],
         [
            'key' => 'time_format',
            'value' => 'h:i A',
         ],
      ]);
   }
}