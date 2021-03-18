<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
            $this->UserJapan();
            $this->UserIndonesia();
            $this->UserChina();
            $this->UserKorea();
            $this->UserUs();
        }catch(\Exception $e){
        }
    }

    public function UserJapan(){
        $faker = Faker::create('ja_JP');
 
    	for($i = 1; $i <= 150; $i++){

            $newUser = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'email_verified_at' => now(),
                'password' => Hash::make('demo123456'),
                'job_title' => $faker->jobTitle,
                'show_public_email' => $faker->numberBetween(0,1),
                'website_url' => $faker->url,
                'location' => "Japan, $faker->prefecture",
                'organization' => $faker->company,
                'bio' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $team = $this->createTeam($newUser);
 
    	}
    }

    public function UserIndonesia(){
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 150; $i++){
 
            $newUser = User::create([
    			'name' => $faker->name,
                'email' => $faker->email,
                'email_verified_at' => now(),
                'password' => Hash::make('demo123456'),
    			'job_title' => $faker->jobTitle,
    			'show_public_email' => $faker->numberBetween(0,1),
    			'website_url' => $faker->url,
                'location' => "Indonesia, $faker->state",
                'organization' => $faker->company,
                'bio' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'created_at' => now(),
                'updated_at' => now(),
    		]);

            $team = $this->createTeam($newUser);
 
    	}
    }

    public function UserChina(){
        $faker = Faker::create('zh_TW');
 
    	for($i = 1; $i <= 150; $i++){
 
    	    $newUser = User::create([
    			'name' => $faker->name,
                'email' => $faker->email,
                'email_verified_at' => now(),
                'password' => Hash::make('demo123456'),
    			'job_title' => $faker->jobTitle,
    			'show_public_email' => $faker->numberBetween(0,1),
    			'website_url' => $faker->url,
                'location' => "China, $faker->city",
                'organization' => $faker->company,
                'bio' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'created_at' => now(),
                'updated_at' => now(),
    		]);
            
            $team = $this->createTeam($newUser);
    	}
    }

    public function UserKorea(){
        $faker = Faker::create('ko_KR');
 
    	for($i = 1; $i <= 150; $i++){
 
    	    $newUser = User::create([
    			'name' => $faker->name,
                'email' => $faker->email,
                'email_verified_at' => now(),
                'password' => Hash::make('demo123456'),
    			'job_title' => $faker->jobTitle,
    			'show_public_email' => $faker->numberBetween(0,1),
    			'website_url' => $faker->url,
                'location' => "Korea, $faker->province",
                'organization' => $faker->company,
                'bio' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'created_at' => now(),
                'updated_at' => now(),
    		]);
            $team = $this->createTeam($newUser);
    	}
    }

    public function UserUs(){
        $faker = Faker::create('en_US');
 
    	for($i = 1; $i <= 250; $i++){
 
    	    $newUser = User::create([
    			'name' => $faker->name,
                'email' => $faker->email,
                'email_verified_at' => now(),
                'password' => Hash::make('demo123456'),
    			'job_title' => $faker->jobTitle,
    			'show_public_email' => $faker->numberBetween(0,1),
    			'website_url' => $faker->url,
                'location' => "$faker->state, $faker->city",
                'organization' => $faker->company,
                'bio' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'created_at' => now(),
                'updated_at' => now(),
    		]);
            $team = $this->createTeam($newUser);
    	}
    }

    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'access_token' => bin2hex(random_bytes(24)),
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
