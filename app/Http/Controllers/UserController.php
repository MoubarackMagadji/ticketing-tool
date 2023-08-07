<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{




    public function logout(Request $request){
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function authenticate(Request $request){
        // dd($request->all());

        $user = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($user)){

            request()->session()->regenerateToken();
            return redirect( route('dashboard'));
        }else{
            if(Cookie::get('error')){
                $erroCookie = Cookie::get('error');
                if($erroCookie == 2){
                    Cookie::queue('error', 1,-1);
                    Cookie::queue('lock', 1,3);
                }else{
                    Cookie::queue('error', ($erroCookie +1), 3);
                }
                
                
            }else{
                Cookie::queue('error', 1, 3);
            }

            

            return redirect()->back()->with('error','Wrong credentials');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $depts = Dept::all()->where('d_active',1);
        return view('users.create', compact('depts'));
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        $user = $request->all();

        $user['password'] = bcrypt($user['password']);
        $user['isadmin'] = 0;

        User::create($user);

        return redirect()->back()->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $depts = Dept::all()->where('d_active',1);

        return view('users.edit', 
            [ 
                'user' => $user,
                'depts' => $depts
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {

        
        $userData = $request->all();

        $userData['isadmin'] = $request->has('isadmin') ? 1 : 0;
        

        $user['status'] = $userData['status'] = $request->has('status') ? 1 : 0;
        $user->update($userData);

        return redirect()->back()->with('success', 'User details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
