<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\D111811131_admin;
use Illuminate\Support\Facades\Validator;

class D111811131_adminController extends Controller
{
    public function index()
    {
        $D111811131_admin = D111811131_admin::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data D111811131_admin',
            'data'    => $D111811131_admin 
        ], 200);
    }

    public function show($id)
    {
        $D111811131_admin = D111811131_admin::findOrfail($id);
        return response()->json([
         'success' => true,
         'message' => 'Detail Data D111811131_admin',
         'data'    => $D111811131_admin
        ], 200);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'   => 'required',
            'email' => 'required',
            'password'   => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        //save to database
        $D111811131_admin = D111811131_admin::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => $request->password
                        
        ]);
        if($D111811131_admin) {
            return response()->json([
                'success' => true,
                'message' => 'D111811131_admin Created',
                'data' => $D111811131_admin
            ], 201);
        }  
    }
    public function update(Request $request, D111811131_admin $D111811131_admin)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'email' => 'required',
            'password'   => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $D111811131_admin = D111811131_admin::findOrFail($D111811131_admin->id);
        if($D111811131_admin) {
            $D111811131_admin->update([
                'name' => $request->name,
                'email'=> $request->email,
                'password' => $request->password
            ]);
            return response()->json([
                'success' => true,
                'message' => 'D111811131_admin Update',
                'data' => $D111811131_admin
            ], 200);
        }
    }
    public function destroy($id)
    {
        $D111811131_admin = D111811131_admin::findOrFail($id);

        if($D111811131_admin) {
            $D111811131_admin->delete();
            return response()->json([
                'success' => true,
                'success' => 'D111811131_admin Deleted',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'D111811131_admin Not Found',
        ], 404);
    }
}
