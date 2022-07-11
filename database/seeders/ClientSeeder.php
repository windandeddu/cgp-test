<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        /*
         * Speed way:
         * (26 sec in my laptop)
         */
        $clients = Client::factory()->count(10000)->make();
        DB::table('clients')->insert($clients->toArray());

        $companies=Company::all();
        $clients = Client::all();
        $data = collect();
        foreach ($clients as $client) {
            $client_company = $companies->random(rand(1,20))->map(function($company) use($client) {
                return ['client_id'=>$client->id, 'company_id'=>$company->id];
            });
            $data = $data->merge($client_company);
        }

        $chunks = $data->chunk(10000);

        foreach ($chunks as $chunk) {
            DB::table('client_company')->insert($chunk->toArray());
        }

        /*
         * Laravel way:
         * (4 min 46 sec)
         */
        /*
            $companies=Company::all();
            Client::factory()->count(10000)->create()->each(function($client) use ($companies) {
                $companies->random(rand(1, 20))->each(function ($company) use ($client) {
                    $client->companies()->save($company);
                });
            });
        */
    }
}
