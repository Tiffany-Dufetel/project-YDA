<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserController as ResourcesUserController;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = Auth::user()->company_id;

        return User::all();
        // return ResourcesUserController::collection(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentURL = url()->previous();

        $validator = Validator::make($request->all(), [
            // 'name' => 'required',
            // 'email' => 'required|email',
            // 'password' => 'required',
            // 'confirm_password' => 'required|same:password',
            // 'first_name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] =  $user->name;
        event(new Registered($user));
        return $this->handleResponse($success, 'User successfully registered!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $orders = Order::with('product', 'user', 'user.company')
            ->where('user_id', $id)
            ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $user = User::find($user);

        $request->validate([
            'surname' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'birthday' => 'required|date',
            'role' => 'required|string',
        ], [
            'surname.required' => "Vous devez saisir un nom de famille",
            'first_name.required' => "Vous devez saisir un prénom",
            'email.required' => "Vous devez saisir un email",
            'password.required' => "Vous devez saisir un mot de passe",
            'birthday.required' => "Vous devez saisir une date de naissance",
            'role.required' => "Vous devez choisir un role."
        ]);

        $user->surname = $request->surname;
        $user->first_name = $request->first_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->birthday = $request->birthday;
        $user->role = $request->role;

        $user->save();


        if ($user) {
            $data = [
                'status' => '1',
                'msg' => 'success'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'fail'
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = User::findOrFail($id)->delete();

        if ($res) {
            $data = [
                'status' => '1',
                'msg' => 'success'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'fail'
            ];
        }

        return response()->json($data);
    }

    public function resetPassword(Request $request, $id){
        //dd($request->input());
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

    }
}
