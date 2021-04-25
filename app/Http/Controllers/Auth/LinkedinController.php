<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Validator;
use Socialite;
use Auth;
use Exception;
use Storage;

class LinkedinController extends Controller
{
    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->scopes(['r_liteprofile','r_emailaddress'])->redirect();
    }

    public function handleLinkedinCallback()
    {
        try {
    
            $response = Socialite::driver('linkedin')->stateless()->user();
            $user = $response->user;
            $finduser = User::where('linkedin_id', $response['id'])->orWhere('email',$response->email)->first();
     
            if($finduser){
                if($finduser->linkedin_id){
                    Auth::login($finduser);
                    return redirect('/dashboard');
                }
                else{
                    $finduser->update([
                        'linkedin_id'=> $response->id
                    ]);
                    Auth::login($finduser);
                    return redirect('/dashboard');
                }
     
            }else{
                $newUser = User::create([
                    'name' => $response->name,
                    'email' => $response->email,
                    'linkedin_id'=> $response->id,
                    'email_verified_at' =>date("Y-m-d h:i:s"),
                    'password' => Hash::make('linkedin123456'),
                    'linkedin' => $response->name,
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
        $name =  str_replace("/","_",Hash::make($response->name));
        $filename = "profile-photos/$response->id-$name.png";
        Storage::put("public/$filename", $contents);
        return $filename;
    }
}
