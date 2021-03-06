<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:api');
    }
    public function identities() {
        return $this->hasMany('../SocialIdentity');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return users if the current user is an Admin
        // Returns 10 users per page
        if (\Gate::allows('isAdmin')){
            return User::latest()->paginate(10);
        }
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Server validation
        $this->validate($request, [
            'name'  => 'required|string|max:191',
            'email'  => 'required|string|email|max:191|unique:users',
            'password'  => 'sometimes|required|min:6'
            
        ]);
        
        // Creates user
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'bio' => $request['bio'],
            'photo' => $request['photo'],
            'password' => Hash::make($request['password']),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();

        $this->validate($request, [
            'name'  => 'required|string|max:191',
            'email'  => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'  => 'sometimes|required|min:6'
            
        ]);

        $currentPhoto = $user->photo;

        if ($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1]; 

            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());
       // return ['message' => "Success"];



    }
     
    public function profile()
    {
        return auth('api')->user();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorFail($id);

        $this->validate($request, [
            'name'  => 'required|string|max:191',
            'email'  => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'  => 'sometimes|min:6'   
        ]);
        $user->update($request->all());
        return ['message' => 'Update the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $user = User::findOrFail($id);

        //  delete user

        $user->delete();

        return ['message' => 'User Deleted'];
    }
}
