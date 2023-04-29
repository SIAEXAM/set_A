<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

Class StudentController extends Controller {
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function getUsers()
    {
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }

    public function add(Request $request){
        
        $rules = [
            'studid' => 'required|max:8',
            'lastname' => 'required|max:50',
            'firstname' => 'required|max:50',
            'middlename' => 'required|max:50',
            'age' => 'required|max:8',
        ];

        $this->validate($request,$rules);

        $user = User::create($request->all());
        return response()->json($user, 200);
 }
    public function updateUser(Request $request, $id) { //UPDATE USER
        $rules = [
            'studid' => 'required|max:8',
            'lastname' => 'required|max:50',
            'firstname' => 'required|max:50',
            'middlename' => 'required|max:50',
            'age' => 'required|max:8',
        ];

        $this->validate($request, $rules);

        $user = User::where('studid', $id)->fill($request->all());

        if ($user->isClean()) {
            return response()->json("At least one value must
            change", 403);
        } else {
            $user->save();
            return response()->json($user, 200);
        }
    }

    public function deleteUser($id) { // DELETE USER
        $user = User::where('studid', $id)->delete();

        return response()->json($user, 200);
    }
}


