<?php

use Illuminate\Database\Seeder;
// use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
   /**
   * Auto generated seed file
   *
   * @return void
   */
   public function run()
   {
      $date = now();

      \DB::table('admins')->delete();

      \DB::table('admins')->insert([
         'name' => 'Riwaj Ghimire',
         'email' => 'bharyang@gmail.com',
         'password' => \Hash::make('123456'),
         'created_at' => $date,
         'updated_at' => $date,
      ]);
   }
}