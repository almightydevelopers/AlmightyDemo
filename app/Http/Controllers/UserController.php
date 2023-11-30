<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Passport\Token;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'required',
        ]);
        if ($validator->fails()) {
             return response()->json(['error'=>$validator->errors()], 401);
        }

        $files = [];
        if($request->hasfile('image'))
         {
            $f=$request->file('image');
            // dd('okgfjkjdna',$f);
            foreach($f as $file)
            {
                // dd('okkk',$f);
                $imageName = time().rand(1,50).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('images'), $imageName);
                $files[] = $imageName;
                // dd($imageName);
            }
    // dd('new',$file);
         }

    // $imageName = time().'.'.request()->image->getClientOriginalExtension();
    // request()->image->move(public_path('images'), $imageName);

        // $input = $request->all();
        $input=[
            'name'=> $request->input('name'),
                // 'c_id'=>$request->c_name,
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
            'gender'=>$request->input('gender'),
            'phone'=>$request->input('phone'),
            'address'=>$request->input('address'),
            'image'=>implode(',',$files),
            ];
// dd($input);
        $input['image'] = implode(',',$files);
        $input['password'] = bcrypt($input['password']);
        $input['remember_token'] = Str::random(10);
        $user = User::create($input);
        // $user = User::create($input->toArray());
        $success['token'] =  $user->createToken('token')-> accessToken;
        $success['name'] =  $user->name;
        $success['image'] =  $user->image;
        return response()->json(['success'=>$success]);
        // return response()->json(['success'=>$success], $this-> successStatus);

    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)
        ->first();
        if ($user) {
          if($user->status == '1'){
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('token')->accessToken;
                $response['token'] = ['token' => $token];
                $response['name'] =  $user->name;

                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
          }else
          $response = ["message" =>'User status not aprove by ADMIN'];
          return response($response, 422);

        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }

    }
    public function userDetails()
    {
        if(Auth::check()){
        $user = Auth::user();
        return response()->json(['success' => $user]);
        }
        else{
            return response()->json(['error' => 'Unauthorised',],401);
        }
    }


    public function logout(Request $request){
        if(Auth::check()){
            auth()->user()->tokens()->delete();
            // Auth::user()->tokens()->delete();
            return response()->json(['success' => 'user logout successfully',],200);
        }else{
            return response()->json(['message' => 'user logout unsuccessfully',],401);
        }
    }

    public function deleteuser(Request $request){
      $id=$request->id;
        $user = User::find($id);
        $user->delete();
        return response()->json(['success' => 'user delete successfully',],200);
    }
    public function userrestore(Request $request){
        $id=$request->id;
        $data = User::where('id', $id)->withTrashed()->first();
        $data->restore();
        // $data = User::withTrashed()->get();
        return response()->json(['success' => 'user restore successfully',],200);

    }
    public function userdeletePermanently(Request $request)
    {
        $id=$request->id;
        $data = User::where('id', $id)->withTrashed()->first();
        $data->forceDelete();
        return response()->json(['success' => 'user permantly deleted from table successfully',],200);

    }
}
