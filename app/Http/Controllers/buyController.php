<?php

namespace App\Http\Controllers;

use App\Models\buy;
use App\Models\construction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class buyController extends Controller
{
    public function index(){
        $data=buy::all();
         return response()->json([
            'mesg'=>"Getting data successfully",
         ]);
    }


    public function store(Request $request){
           $validator =Validator($request->all(),[
           'type'=>'required',
           'location'=>'required',
           'area'=>'required',
           'budget'=>'required',
           'your_name'=>'required',
           'contact'=>'required',
           ] );

            if($validator ->passes()){
                $data=buy::create([
                    'type'=>$request->type,
                    'location'=>$request->location,
                    'area'=>$request->area,
                    'budget'=>$request->budget,
                    'your_name'=>$request->your_name,
                    'contact'=>$request->contact,
                ]);

                return response()->json([
                    'msg'=>"Record added successfully",
                    'data'=>$data,
                ]);
            }

            return response()->json([
                'error'=>$validator->errors(),

            ],422);
    }

    public function delete($id){
              $data=buy::find($id);
              $data->delete();
              return response()->json([
                'msg'=>"Record deletd successfully",
              ]);

    }

    public function edit($id){
        $data=buy::find($id);
         return response()->json([
            'data'=>$data,
         ]);
    }

    public function update(Request $request,$id){
        $data=buy::find($id);
        $validator=Validator::make($request->all(),[
            'type'=>'required',
            'location'=>'required',
            'area'=>'required',
            'budget'=>'required',
            'your_name'=>'required',
            'contact'=>'required',
        ]);

        if($validator ->passes()){
            $data->update([
                'type'=>$request->plot_area,
                'location'=>$request->construction_area,
                'area'=>$request->budget,
                'budget'=>$request->location,
                'your_name'=>$request->your_name,
                'contact'=>$request->contact,
            ]);
             

            return response()->json([
                'msg'=>"Record Updated successfully",
                'data'=>$data,
            ]);
        }

        return response()->json([
            'error'=>$validator->errors(),

        ],422);

    }
}
