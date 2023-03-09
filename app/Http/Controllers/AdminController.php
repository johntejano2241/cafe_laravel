<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Trivia_Model;
use App\Models\Admin_Model;
use App\Models\Question_Answer;
use App\Models\User;
use App\Models\User_Account;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    const PEPPER = "OurSAf3Pepper$$";
    protected $pepper = self::PEPPER;

    public function adminHome()
    {
        return view('admin.home');
    }



    public function adminTrivia()
    {

        $allTrivias = Trivia_Model::get();

        $data = [
            'allTrivias' => $allTrivias,
        ];

        return view('trivia', $data);
    }


    public function adminQuiz()
    {

        $allQuiz = Question_Answer::get();

        $data = [
            'allQuiz' => $allQuiz,
        ];

        return view('quiz', $data);
    }


    public function adminViewAccount()
    {

        $totalUsers = 0;
        $totalMale = 0;
        $totalFemale = 0;

        $userAccounts = User_Account::select('account_id', 'first_name', 'last_name', 'gender', 'birthdate')->get();

        $totalUsers = User_Account::count();
        $totalMale =  User_Account::where('gender', 'MALE')->count();

        $totalFemale =  User_Account::where('gender', 'FEMALE')->count();

        // dd($totalUsers, $totalMale, $totalFemale);

        $data = [
            'userAccounts' => $userAccounts,
            'totalUsers' => $totalUsers,
            'totalMale' => $totalMale,
            'totalFemale' => $totalFemale,
        ];

        return view('view-accounts', $data);

    }


    public function adminSetting()
    {
        return view('setting');
    }

    public function userTest()
    {
    }

    public function adminLogout()
    {
        session()->forget('auth_token');
        return redirect()->route('admin.home');
    }

    public function adminDashboard()
    {


        $userAccounts = User::select('id')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();



        $userAccounts = $userAccounts->pluck('id');

        $userAccounts = User_Account::select('account_id', 'first_name', 'last_name', 'gender', 'birthdate')
            ->whereIn('account_id', $userAccounts)
            ->get();

        $userCounts = User::count();

        $data = [
            'userAccounts' => $userAccounts,
            'userCounts' => $userCounts,
        ];

        return view('dashboard', $data);
    }




    public function checkLogin(Request $request)
    {

        $request->validate([
            'username' => 'required|max:255',
            'password' => 'required|max:255',
        ]);


        $username = $request->username;
        $password = $request->password;


        $admin = Admin_Model::where('username', $username)->first();


        if ($admin) {

            if (Hash::check($password . $this->pepper, $admin->password)) {

                $authToken = Hash::make(random_bytes(16));

                $admin->auth_token = $authToken;
                $admin->save();

                $request->session()->put('auth_token', $authToken);


                return redirect('/admin/trivia');
            } else {
                return back()->with('fail', 'Invalid Credentials');
            }
        } else {
            return back()->with('fail', 'Invalid Credentials');
        }


        // return view('dashboard');
    }


    public function updateAdminAccount(Request $request)
    {

        $request->validate([
            'username' => 'required|max:255',
            'password' => 'required|max:255',
            'newUsername' => 'required|max:255',
            'newPassword' => 'required|max:255',
        ]);

        $username = $request->username;
        $password = $request->password;
        $newUsername = $request->newUsername;
        $newPassword = $request->newPassword;


        $admin = Admin_Model::where('username', $username)->first();

        if (!$admin) {
            // Wrong Username
            return back()->with('fail', 'Invalid Credentials');
        }


        if (Hash::check($password . $this->pepper, $admin->password)) {

            // Update
            $admin->username = $newUsername;
            $admin->password = Hash::make($newPassword . $this->pepper);
            $admin->save();

            return back()->with('success', 'Successfully updated');
        } else {

            return back()->with('fail', 'Invalid Credentials');
        }
    }



    // Trivia
    public function createTrivia(Request $request)
    {

        $request->validate([
            'id' => 'nullable|numeric|max:255',
            'triviaForm' => 'required|max:255',
        ]);


        if ($request->id != 0) {

            // Update
            $triviaSave = Trivia_Model::where('id', $request->id)->update([
                'trivia' => $request->triviaForm,

            ]);
        } else {

            // Create
            $triviaSave = Trivia_Model::create([
                'trivia' => $request->triviaForm,
                'date_created' => date('Y-m-d H:i:s'),
            ]);
        }


        if ($triviaSave) {
            return back()->with('success', 'Successfully saved');
        } else {
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }




    public function deleteTrivia(Request $request)
    {

        $request->validate([
            'deleteId' => 'required|numeric|max:255',
        ]);

        $triviaDelete = Trivia_Model::where('id', $request->deleteId)->delete();

        if ($triviaDelete) {
            return back()->with('success', 'Trivia has been deleted');
        } else {
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }



    public function createQuiz(Request $request)
    {

        $request->validate([
            'id' => 'nullable|numeric|max:255',
            'question' => 'required|max:255',
            'choice1' => 'required|max:255',
            'choice2' => 'required|max:255',
            'choice3' => 'required|max:255',
            'choice4' => 'required|max:255',
            'answer' => 'required|max:255',
            'category' => 'required|max:255',
        ]);



        if ($request->id != 0) {

            // Update
            $quizSave = Question_Answer::where('id', $request->id)->update([
                'question' => $request->question,
                'choice1' => $request->choice1,
                'choice2' => $request->choice2,
                'choice3' => $request->choice3,
                'choice4' => $request->choice4,
                'answer' => $request->answer,
                'category' => $request->category,
            ]);
        } else {

            // Create
            $quizSave = Question_Answer::create([
                'question' => $request->question,
                'choice1' => $request->choice1,
                'choice2' => $request->choice2,
                'choice3' => $request->choice3,
                'choice4' => $request->choice4,
                'answer' => $request->answer,
                'category' => $request->category,
            ]);
        }

        if ($quizSave) {
            return back()->with('success', 'Successfully saved');
        } else {
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }



    public function deleteQuiz(Request $request)
    {

        $request->validate([
            'deleteId' => 'required|numeric|max:255',
        ]);

        $quizDelete = Question_Answer::where('id', $request->deleteId)->delete();

        if ($quizDelete) {
            return back()->with('success', 'Quiz has been deleted');
        } else {
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }
}
