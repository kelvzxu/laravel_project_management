<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Storage;
use Validator;
use Socialite;
use Auth;
use Exception;

class GithubController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
    
            $response = Socialite::driver('github')->stateless()->user();
            $user = $response->user;
            $finduser = User::where('github_id', $user['id'])->first();
     
            if($finduser){
                Auth::login($finduser);
    
                return redirect('/dashboard');
     
            }else{
                $newUser = User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'github_id'=> $user['id'],
                    'email_verified_at' =>date("Y-m-d h:i:s"),
                    'password' => encrypt('123456dummy'),
                    'website_url' => $user['blog'],
                    'location' => $user['location'],
                    'twitter'=>$user['twitter_username'],
                    'profile_photo_path'=> $this->storeimage($response),
                ]);
                
                $team = $this->createTeam($newUser);
                echo $team;
                Auth::login($newUser);
     
                return redirect('/dashboard');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
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

    public function storeimage($response){
        $url = $response->avatar;
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        $filename = "profile-photos/$response->id-$response->name.png";
        Storage::put("public/$filename", $contents);
        return $filename;
    }
}
