<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Text;
use App\Detail;

class UserController extends Controller
{
   private $arrtext = [];
   private $rannum = [];
   private $texts;
   private $n=0;
   public $flag = 0;

  

    public function create() {
        $this->texts = Text::all();
         $texts2 = $this->texts;
         
        if(Auth::check()) {
            
            $arrtext = explode('.',$this->texts[0]);
            $this->rn = rand(0,count($arrtext)-2);
            $this->arrwords = explode(' ',$arrtext[$this->rn]);
            $arrword = $this->arrwords;
            
            return view('index',compact('texts2','textid','arrword'));
        }
        else{
             return view('sessions.signup');
        }
        
          }

     public function singletext(Text $text,Request $r) {
        $arrtext = explode('.',$text->text);
        $this->rn = rand(0,count($arrtext)-2);
        $this->arrwords = explode(' ',$arrtext[$this->rn]);
        $arrword = $this->arrwords;
      
         $det = new Detail;
         $details = $det->where('user_id',auth()->user()->id)->get();
        
         return view('singletext',compact('text','arrword','details'));
     }

     public function generate(Request $r) {
          $data = auth()->user()->score + $r->score;
          User::where('id',auth()->user()->id)->update(['score' => $data]);
          
          $det = auth()->user()->score;
              
    return response()->json(['success' => $det,'message' => 'hello']);
   
     }

    public function signup(Request $request) {
        $this->validate($request,[
            'first_name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);

         $first_name = $request['first_name'];
         $email = $request['email'];
         $password = bcrypt($request['password']);

         $user = new User;
         $user->first_name = $first_name;
         $user->email = $email;
         $user->password = $password;

         $user->save();
         Auth::login($user);

         return redirect()->home();

    }
    public function destroy() {
        auth()->logout();

        return redirect()->home();
    }

    public function signin() {
        return view('sessions.signin');
    }

    public function login(Request $request) {
        if(Auth::attempt(['email' => $request['email'],
        'password' => $request['password']])) {
            return redirect()->home();
        }
        else{
            return redirect()->back();
        }
    }

}
