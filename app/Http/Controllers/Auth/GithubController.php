<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
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
                    'username' => $user['login'],
                    'email' => $user['email'],
                    'github_id'=> $user['id'],
                    'password' => encrypt('123456dummy'),
                    'website_url' => $user['blog'],
                    'location' => $user['location'],
                    'twitter'=>$user['twitter_username'],
                ]);
                
                $this->createTeam($newUser);

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
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
