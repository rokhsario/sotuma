<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
        );
        DB::table('settings')->insert($data);
        DB::table('settings')->where('id', 1)->update([
            'address' => 'Route gremda km8, Sfax, TUNISIE',
            'phone' => '+216 58 844 717',
            'email' => 'anis.fakhfakh@yahoo.fr',
            'facebook' => 'https://facebook.com/sotuma',
        ]);
    }
}
