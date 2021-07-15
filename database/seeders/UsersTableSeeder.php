<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pengguna = ['Sumiyati Rahayu','Didik Setyadi','Novia Indra Sari','Mansur Hidayat','Dedi Mulyono','Rasyid Wijaya','Chairul Anam','Hendri Hendarto'];
    	for ($i=0; $i < count($pengguna) ; $i++) { 
            $name = explode(" ",$pengguna[$i]);
            $namaSpace = strtolower(str_replace(' ', '', $pengguna[$i]));
	        User::create([
                'privileges' => $i==0 ? "kades" : "aparatur",
	        	'first_name'=>$name[0],
	        	'last_name'=>$name[1],
	        	'email'=> $namaSpace . '@gs-app.com',
                'username' => strtolower(str_replace(' ', '', $pengguna[$i])),
	        	'password'=> Hash::make('a'),
	        ]);
    	}
    }
}
