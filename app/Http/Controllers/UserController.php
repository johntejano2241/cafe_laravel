<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Jobs\SendResetPassword;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\User_Account;
use App\Models\User_Character;

use App\Models\User_Ruby;
use App\Models\User_Item;
use App\Models\User_Reward;
use App\Models\User_Score;
use App\Models\User_Verify;

use App\Models\Trivia;
use App\Models\Question_Answer;

use App\Jobs\VerifyEmailJob;
use App\Mail\SendForgotPassword;
use App\Mail\SendVerifyEmail;
use App\Models\Trivia_Model;
use Ognjen\Laravel\AsyncMail;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;



class UserController extends Controller
{
    //

    static $PEPPER_PASSWORD = 'safeOur$$2022';





    public function userLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:64',
        ]);

        $user = User::where('email', $request->email)->first();

        $checkPassword = $request->password . self::$PEPPER_PASSWORD;

        if ($user) {


            // if($user->email_verified_at == null){
            //     return response()->json([
            //         'message' => 'Please Verify Your Email',
            //     ], 401);
            // }

            if (Hash::check($checkPassword, $user->password)) {

                $token = $user->createToken('oursafetoken')->plainTextToken;

                return response()->json([
                    'message' => 'Login Success',
                    'token' => $token,
                ], 200);
            } else {

                return response()->json([
                    'message' => 'Login Failed, Wrong Credentials',
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'Account Not Found',
            ], 401);
        }


    }


    public function userRegister(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:player',
            'password' => 'required|min:8|max:64',
            'first_name' => 'required|max:32',
            'last_name' => 'required|max:32',
            'gender' => 'required|max:32',
            'date' => 'required',

        ]);


        $hashedPassword = Hash::make($request->password . self::$PEPPER_PASSWORD);


        $id = User::create([
            'email' => $request->email,
            'name' => $request->first_name,
            'password' => $hashedPassword,
        ]);


        $token = $id->createToken('oursafetoken')->plainTextToken;


        $user_account = User_Account::create([
            'account_id' => $id->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'birthdate' => $request->date,
        ]);

        User_Ruby::create([
            'account_id' => $id->id,
            'ruby' => 0,
        ]);


        if (!$user_account) {
            return response()->json([
                'message' => 'Register Failed',
            ], 401);
        } else {

            // Email Verification
            $this->sendEmailVerification($request->email, $id->id);

            return response()->json([
                'message' => 'Register Success',
                'token' => $token,
            ], 200);
        }
    }



    public function userLogout()
    {

        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout Success',
        ], 200);

    }




    public function userTest(Request $request)
    {
        return response()->json([
            'message' => "Device Name: " . auth()->user()->id,
        ], 200);
    }






    // Ruby Functions

    public function setRuby(Request $request)
    {


        $request->validate([
            'ruby' => 'required|numeric',
        ]);

        $getRuby = User_Ruby::where('account_id', auth()->user()->id)->first();

        $newRuby = intval($request->ruby);

        $user_ruby = User_Ruby::where('account_id', auth()->user()->id)
            ->update(['ruby' =>  $newRuby]);


        if ($user_ruby) {
            return response()->json([
                'message' => "Ruby Added",
            ], 200);
        } else {
            return response()->json([
                'message' => "Ruby Not Added",
            ], 401);
        }
    }

    public function addRuby(Request $request)
    {

        $request->validate([
            'ruby' => 'required|numeric',
        ]);

        $getRuby = User_Ruby::where('account_id', auth()->user()->id)->first();

        $newRuby = $getRuby->ruby + intval($request->ruby);

        $user_ruby = User_Ruby::where('account_id', auth()->user()->id)
            ->update(['ruby' =>  $newRuby]);


        if ($user_ruby) {
            return response()->json([
                'message' => "Ruby Added",
            ], 200);
        } else {
            return response()->json([
                'message' => "Ruby Not Added",
            ], 401);
        }
    }


    public function subRuby(Request $request)
    {

        $request->validate([
            'ruby' => 'required|numeric',
        ]);

        $getRuby = User_Ruby::where('account_id', auth()->user()->id)->first();

        $newRuby = $getRuby->ruby - intval($request->ruby);

        $user_ruby = User_Ruby::where('account_id', auth()->user()->id)
            ->update(['ruby' =>  $newRuby]);

        if ($user_ruby) {
            return response()->json([
                'message' => "Ruby Subtracted",
            ], 200);
        } else {
            return response()->json([
                'message' => "Ruby Not Subtracted",
            ], 401);
        }
    }

    public function getRuby()
    {

        $user_ruby = User_Ruby::where('account_id', auth()->user()->id)->first();

        return response()->json([
            'message' => $user_ruby->ruby,
        ], 200);
    }

    // =======================================================================================

    // Get All Items
    public function getAllItems()
    {

        $user_items = User_Item::where('account_id', auth()->user()->id)->get();

        return response()->json([
            'items' => $user_items,
        ], 200);
    }

    public function addItem(Request $request)
    {

        $request->validate([

            'category' => 'required|max:32',
            'item' => 'required|max:32',

        ]);

        // Date Now
        $checkItem = User_Item::where('account_id', auth()->user()->id)
            ->where('category', $request->category)
            ->where('item', $request->item)
            ->first();

        if ($checkItem) {

            return response()->json([
                'message' => "Item Already Exist",
            ], 401);
        } else {

            $user_items = User_Item::create([
                'account_id' => auth()->user()->id,
                'category' => $request->category,
                'item' => $request->item,
                'date_acquired' => Carbon::now()->format('Y-m-d'),

            ]);


            if ($user_items) {
                return response()->json([
                    'message' => "Item Added",
                ], 200);
            } else {
                return response()->json([
                    'message' => "Item Not Added",
                ], 401);
            }
        }
    }


    // =======================================================================================

    // Get All Scores
    public function getAllScores()
    {

        $user_scores = User_Score::where('account_id', auth()->user()->id)->get();


        if ($user_scores) {
            return response()->json([
                'scores' => $user_scores,
            ], 200);
        } else {
            return response()->json([
                'message' => "Scores Not Added",
            ], 401);
        }
    }

    public function addScore(Request $request)
    {

        $request->validate([

            'category' => 'required|max:32',
            'value' => 'required|numeric|max:32',

        ]);

        $find_score = User_Score::where('account_id', auth()->user()->id)
            ->where('category', $request->category)
            ->first();

        if ($find_score) {

            $user_score = User_Score::where('account_id', auth()->user()->id)
                ->where('category', $request->category)
                ->update(['value' =>  $request->value]);
        } else {

            // $user_score = User_Score::create([
            //     'account_id' => auth()->user()->id,
            //     'category' => $request->category,
            //     'value' => $request->value,
            //     'date_record' => Carbon::now()->format('Y-m-d'),

            // ]);

            $user_score = User_Score::create([
                'account_id' => auth()->user()->id,
                'value' => $request->value,
                'category' => $request->category,
                'date_record' => Carbon::now()->format('Y-m-d')
            ]);

            // UserScore Create



            // return response()->json([
            //     'message' => auth()->user()->id,
            // ], 401);

        }


        if ($user_score) {
            return response()->json([
                'message' => "Score Added",
            ], 200);
        } else {
            return response()->json([
                'message' => "Score Not Added",
            ], 401);
        }
    }

    // =======================================================================================

    // Player Character
    public function getPlayerCharacter()
    {

        $user_character = User_Character::where('account_id', auth()->user()->id)->first();

        return response()->json([
            'character' => $user_character,
        ], 200);
    }


    //  Player Data
    public function getPlayerData()
    {

        $user_account = User_Account::where('account_id', auth()->user()->id)->first();

        $user_character = User_Character::where('account_id', auth()->user()->id)->first();

        $user_ruby = User_Ruby::where('account_id', auth()->user()->id)->first();
        $user_items = User_Item::where('account_id', auth()->user()->id)->get();
        $user_scores = User_Score::where('account_id', auth()->user()->id)->get();
        $user_rewards = User_Reward::where('account_id', auth()->user()->id)->get();


        $trivia = Trivia_Model::select('trivia')->get();


        $questionAnswer = Question_Answer::get();

        $earthquakeQuestionAnswer = Question_Answer::where('category', 'EARTHQUAKE')->get();
        $floodQuestionAnswer = Question_Answer::where('category', 'FLOOD')->get();
        $fireQuestionAnswer = Question_Answer::where('category', 'FIRE')->get();
        $typhoonQuestionAnswer = Question_Answer::where('category', 'TYPHOON')->get();
        $tsunamiQuestionAnswer = Question_Answer::where('category', 'TSUNAMI')->get();
        $landslideQuestionAnswer = Question_Answer::where('category', 'LANDSLIDE')->get();


        if ($user_account) {

            return response()->json([
                'account' => $user_account,
                'character' => $user_character,
                'ruby' => $user_ruby,
                'items' => $user_items,
                'scores' => $user_scores,
                'rewards' => $user_rewards,
                'trivia' => $trivia,
                'earthquakeQuestionAnswer' => $earthquakeQuestionAnswer,
                'floodQuestionAnswer' => $floodQuestionAnswer,
                'fireQuestionAnswer' => $fireQuestionAnswer,
                'typhoonQuestionAnswer' => $typhoonQuestionAnswer,
                'tsunamiQuestionAnswer' => $tsunamiQuestionAnswer,
                'landslideQuestionAnswer' => $landslideQuestionAnswer,
            ], 200);
        } else {
            return response(400);
        }
    }


    // =======================================================================================
    // Player Character
    public function getCharacter()
    {

        $user_character = User_Character::where('account_id', auth()->user()->id)->first();

        return response()->json([
            'character' => $user_character,
        ], 200);
    }


    public function setCharacter(Request $request)
    {

        $request->validate([

            'character_name' => 'required|max:100',
            'character_sex' => 'required|max:32',
            'character_data' => 'required',

        ]);

        $user_character = User_Character::where('account_id', auth()->user()->id)->first();

        if ($user_character) {

            $user_data = User_Character::where('account_id', auth()->user()->id)
                ->update(
                    ['character_data' =>  $request->character_data]
                );
        } else {
            $user_data = User_Character::create([
                'account_id' => auth()->user()->id,
                'character_name' => $request->character_name,
                'character_sex' => $request->character_sex,
                'character_data' => $request->character_data,
            ]);
        }

        if ($user_data) {
            return response()->json([
                'message' => "Character Data Added",
            ], 200);
        } else {
            return response()->json([
                'message' => "Character Data Not Added",
            ], 401);
        }
    }


    public function setReward(Request $request)
    {

        // validate request
        $request->validate([
            'category' => 'required|max:32',
            'datetime' => 'required|max:32',
        ]);

        $userReward = User_Reward::where('account_id', auth()->user()->id)->where('category', $request->category)->first();


        if ($userReward) {
            // Find Existing
            $userData =  User_Reward::where('account_id', auth()->user()->id)
                ->where('category', $request->category)
                ->update(['datetime' => $request->datetime]);
        } else {

            $userData = User_Reward::create([
                'account_id' => auth()->user()->id,
                'category' => $request->category,
                'datetime' => $request->datetime
            ]);
        }


        if ($userData) {
            return response()->json([
                'message' => "User_Reward Added",
            ], 200);
        } else {
            return response()->json([
                'message' => "Character Data NOT Added",
            ], 401);
        }
    }


    public function getAllReward()
    {

        $userAllReward = User_Reward::where('account_id', auth()->user()->id)->get();

        if ($userAllReward) {
            return response()->json([
                'rewards' => $userAllReward,
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Existing Reward',
            ], 401);
        }
    }


    public function sendEmailVerification(string $email, int $id)
    {

        $verificationToken = bcrypt(bin2hex(random_bytes(8)));


        $cleanedString = preg_replace('/\/+/', '', $verificationToken);


        $user_verify = User_Verify::create([
            'account_id' => $id,
            'category' => "EMAIL_VERIFICATION",
            'token' => $cleanedString,
            'date_created' => Carbon::now(),
        ]);

        $data = [
            'verification_token' => $cleanedString
        ];


        if ($user_verify) {

            // Mail::to($email)->send(new SendVerifyEmail($data, $email));

            dispatch(new SendEmail($data, $email));

            // Mail::to($email)->queue(new SendVerifyEmail($data, $email));

            // Queue::push(new VerifyEmailJob($data, $email));


            //    new Ognjen\Laravel\AsyncMail::send(new VerifyEmailJob($data, $email));

            // AsyncMail::send(new VerifyEmailJob($data, $email));


            // Mail::send('emailverify', $data, function ($message) use ($email) {
            //         $message->from('oursafe@elkyzer.link', 'OurSafe');
            //         $message->to($email);
            //         $message->subject('Verify Your Email Address');
            //     });


            // Queue::push(function ($job) use ($email, $data) {
            //     Mail::send('emailverify', $data, function ($message) use ($email) {
            //         $message->from('oursafe@elkyzer.link', 'OurSafe');
            //         $message->to($email);
            //         $message->subject('Verify Your Email Address');
            //     });
            //     $job->delete();
            // });

            // Mail::send('emailverify', $data, function ($message) use ($email) {
            //     $message->from('oursafe@elkyzer.link', 'OurSafe');
            //     $message->to($email);
            //     $message->subject('Verify Your Email Address');
            // });

            // Mail::later('emailverify', $data, function ($message) use ($email) {
            //     $message->from('oursafe@elkyzer.link', 'OurSafe');
            //     $message->to($email);
            //     $message->subject('Verify Your Email Address');
            // });

        }
    }



    // Landing Verification
    public function landingRequestPassword()
    {
        return view('landing_forgot_password');
    }


    public function verifyEmail($token)
    {


        $user_verify = User_Verify::where('category', "EMAIL_VERIFICATION")->where('token', $token)->first();

        if ($user_verify) {

            $userAccountVerify = User::where('id', $user_verify->account_id)->update(['email_verified_at' => Carbon::now()]);

            if ($userAccountVerify) {

                $user_verifyDelete = User_Verify::where('account_id', $user_verify->account_id);
                $user_verifyDelete->delete();

                return view('email.success');
            } else {

                return view('email.fail');
            }
        } else {

            return view('email.fail');
        }
    }


    public function requestForgotPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email|max:100',
        ]);

        $userAccount = User::where('email', $request->email)->first();

        if ($userAccount) {

            if ($userAccount->email_verified_at == null) {
                return back()->with('error', 'Email Not Verified');
            }

            $verificationToken = bcrypt(bin2hex(random_bytes(8)));

            $cleanedString = preg_replace('/\/+/', '', $verificationToken);

            $user_verify = User_Verify::create([
                'account_id' => $userAccount->id,
                'category' => "FORGOT_PASSWORD",
                'token' => $cleanedString,
                'date_created' => Carbon::now(),
            ]);

            $data = [
                'verification_token' => $cleanedString,
                'email' => $userAccount->email,
            ];

            if ($user_verify) {

                // Mail::to($userAccount->email)->send(new SendForgotPassword($data, $userAccount->email));

                dispatch(new SendResetPassword($data, $userAccount->email));

                // Mail::to($userAccount->email)->queue(new SendForgotPassword($data, $userAccount->email));

                // Queue::push(new ForgotPasswordJob($data, $userAccount->email));

                // Mail::send('emailverify', $data, function ($message) use ($userAccount->email) {
                //         $message->from('

                return view('email.success_request_password');

            }
        } else {

            return back()->with('error', 'Email not found');
        }
    }

    public function forgotPassword($token)
    {

        $user_verify = User_Verify::where('category', "FORGOT_PASSWORD")->where('token', $token)->first();

        if ($user_verify) {

            $userAccount = User::where('id', $user_verify->account_id)->first();

            $data = [
                'token' => $token,
                'email' => $userAccount->email,
            ];

            return view('email.forgot_password', $data);
        } else {

            return view('email.fail');
        }
        //                $data = [
        //                     'verification_token' => "ahuiajshdakjhdkajsd",
        //                     'email' => "Sample@gmail.com",
        //                 ];

        // return view('email.forgot_password', $data);


    }





    public function userNewPassword(Request $request)
    {

        $request->validate([
            'token' => 'required|max: 512',
            'password' => 'required|min:8|max:64',
        ]);

        $userVerify = User_Verify::where('category', "FORGOT_PASSWORD")->where('token', $request->token)->first();

        if ($userVerify) {

            $userAccount = User::where('id', $userVerify->account_id)->first();

            if ($userAccount) {

                $userAccount->password = Hash::make($request->password . self::$PEPPER_PASSWORD);

                $userAccount->save();

                $userVerify = User_Verify::where('category', "FORGOT_PASSWORD")->where('token', $request->token)->first();
                $userVerify->delete();

                return view('email.success_reset_password');
            } else {

                return view('email.fail');
            }
        } else {

            return view('email.fail');
        }
    }


    public function getTriviaAndQuiz()
    {

        $trivia = Trivia_Model::select('trivia')->get();

        $earthquakeQuestionAnswer = Question_Answer::where('category', 'EARTHQUAKE')->get();
        $floodQuestionAnswer = Question_Answer::where('category', 'FLOOD')->get();
        $fireQuestionAnswer = Question_Answer::where('category', 'FIRE')->get();
        $typhoonQuestionAnswer = Question_Answer::where('category', 'TYPHOON')->get();
        $tsunamiQuestionAnswer = Question_Answer::where('category', 'TSUNAMI')->get();
        $landslideQuestionAnswer = Question_Answer::where('category', 'LANDSLIDE')->get();

        return response()->json([
            'trivia' => $trivia,
            'earthquakeQuestionAnswer' => $earthquakeQuestionAnswer,
            'floodQuestionAnswer' => $floodQuestionAnswer,
            'fireQuestionAnswer' => $fireQuestionAnswer,
            'typhoonQuestionAnswer' => $typhoonQuestionAnswer,
            'tsunamiQuestionAnswer' => $tsunamiQuestionAnswer,
            'landslideQuestionAnswer' => $landslideQuestionAnswer,
        ], 200);
    }
}
