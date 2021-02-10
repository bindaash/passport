<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\Rule;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { //echo "dnvrn"; exit;
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $name = request()->get('name');
        $email = request()->get('email');
        $password = request()->get('password');
        $rules = array(
            'name' => 'required',
            'email' => Rule::unique('users')->where(function($query) use ($email) {
                $query->where('email', $email);
            }),
            'password' => 'required',
        );

        $validator = Validator::make(request()->all(), $rules);
        if ($validator->fails()) { 
            // print_r("expressionhdgfsh634637547");exit();
            $messages = $validator->messages();
            if($messages->has('name'))
            {
                return response()->json(["statusCode"=>422,"status"=>false,"message"=>$messages->first('name')],422);
            }
            else if($messages->has('email'))
            {
                return response()->json(["statusCode"=>422,"status"=>false,"message"=>$messages->first('email')],422);
            }
            else if($messages->has('password'))
            {
                return response()->json(["statusCode"=>422,"status"=>false,"message"=>$messages->first('password')],422);
            }
        } else {
            return $request;
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
        //print_r(request()->all());exit();
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
    public function update(Request $request, $id)
    {
        //
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
