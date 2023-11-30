<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Passport\Token;
use File;
use Illuminate\Support\Facades\Storage;



class AdminController extends Controller
{
    public function index(){
    if(Auth::check()){
        return view('admin.layout.index');
    }
    return redirect("loginForm")->withSuccess('You are not allowed to access');
    }

    public function showlist(){
        $user = User::all();
        // dd($user);
        return view('admin.user',compact('user'));
    }
    public function AproveUser(Request $request){
        // dd($id);
        $id=$request->id;
        User::where('id',$id)->update(['status'=>'1']);
        return redirect()->back();
    }
    public function DenyUser(Request $request){
        // dd($request->all())
        $id=$request->id;
        User::where('id',$id)->update(['status'=>'0']);
        return redirect()->back();
    }

    public function loginForm(){
        return view('admin.login');
    }
    public function submitLogin(Request $request){
        // dd($request->all());
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if($request->user()->status == "2" && $request->user()->roll_id=='2'){
                 return redirect()->intended('dashboard')
                          ->withSuccess('You have Successfully loggedin');
                    }
                    else{
                        return redirect()->back()->with('message','You are not ADMIN');
                    }
        }
        return redirect("loginForm")->withSuccess('Oppes! You have entered invalid credentials');
    }
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('loginForm');
    }
    public function adduser(){
        return view('admin.register');
    }
    public function registerSubmit(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'required',
            'image.*'=>'image'
        ],
        [
            'name.required' => 'Name Field is required',
            'email.required' => 'Email Field is required',
            'email.unique' => 'Email Already Exites!',
            'password.required' => 'Please enter password',
            'password.min' => 'Please enter password min 6 digit',
            'cpassword.required' => 'Please enter confirm password',
            'cpassword.same' => 'password and confirm password does not match',
            'address.required' => 'Please enter Address',
            'gender.required' => 'Please enter Your Gender',
            'phone.required' => 'Please enter Phone Number',


        ]
    );
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    $files = [];
    if($request->hasfile('image'))
     {
        $f=$request->file('image');
        // dd('okgfjkjdna');
        foreach($f as $file)
        {
            // dd('okkk');
            $imageName = time().rand(1,50).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $imageName);
            $files[] = $imageName;
         //    dd($name);
        }
// dd('new');
     }

    // dd($validated);
        // $imageName = time().'.'.request()->image->getClientOriginalExtension();
        // request()->image->move(public_path('images'), $imageName);

        // $input = $request->all();
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->gender = $request->input('gender');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->image = implode(',',$files);
        $user->save();
        return redirect()->back()->with([
            'message' => 'User added successfully!',
            'status' => 'success'
        ]);
        // return view('admin.register');
    }

    public function deleteUser($id){
        User::where('id',$id)->delete();
        return redirect()->back();
    }
    public function editUserForm(Request $request){
        $ids=$request->id;
        // dd($ids);
        // $UpdateDetails = User::where('id', '=',  $ids)->get();
        $UpdateDetails = User::find($ids);
        // dd($UpdateDetails);
        return view('admin.editUserForm',compact('UpdateDetails'));
    }
    public function updateUser(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            // 'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'name.required' => 'Name Field is required',
            'email.required' => 'Email Field is required',
            'email.unique' => 'Email Already Exites!',
            'password.required' => 'Please enter password',
            'password.min' => 'Please enter password min 6 digit',
            'cpassword.required' => 'Please enter confirm password',
            'cpassword.same' => 'password and confirm password does not match',
            'address.required' => 'Please enter Address',
            'gender.required' => 'Please enter Your Gender',
            'phone.required' => 'Please enter Phone Number',
            // 'image.required' => 'select your image',
            // 'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif, svg.',

        ]
    );
    //   $input = $request->all();

    if($request->hasfile('image'))
     {
        foreach($request->images as $img)
        $deleteimg =public_path('images/').$img;
        if (File::exists($deleteimg)) {
            File::delete($deleteimg);
        }


        $files = [];
        $f=$request->file('image');
        foreach($f as $file)
        {
            $imageName = time().rand(1,50).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $imageName);
            $files[] = $imageName;
        }
     }
     else{
        $files=$request->images;
     }


    $value=array(
        'name'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'gender'=>$request->gender,
        'address'=>$request->address,
        'image'=>implode(',',$files),
    );
     User::where('id', $request->id)->update($value);
   return redirect('userlist')

   ->with('message','USER update successfully');
    }


}
