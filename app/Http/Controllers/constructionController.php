<?php

namespace App\Http\Controllers;

use App\Models\construction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class constructionController extends Controller
{
    public function index(){
        $data=construction::all();
         return response()->json([
            'mesg'=>"Getting data successfully",
         ]);
    }


    public function store(Request $request){
           $validator =Validator($request->all(),[
           'plot_area'=>'required',
           'construction_area'=>'required',
           'budget'=>'required',
           'location'=>'required',
           'your_name'=>'required',
           'contact'=>'required',
           ] );

            if($validator ->passes()){
                $data=construction::create([
                    'plot_area'=>$request->plot_area,
                    'construction_area'=>$request->construction_area,
                    'budget'=>$request->budget,
                    'location'=>$request->location,
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
              $data=construction::find($id);
              $data->delete();
              return response()->json([
                'msg'=>"Record deletd successfully",
              ]);

    }

    public function edit($id){
        $data=construction::find($id);
         return response()->json([
            'data'=>$data,
         ]);
    }

    public function update(Request $request,$id){
        $data=construction::find($id);
        $validator=Validator::make($request->all(),[
            'plot_area'=>'required',
            'construction_area'=>'required',
            'budget'=>'required',
            'location'=>'required',
            'your_name'=>'required',
            'contact'=>'required',
        ]);

        if($validator ->passes()){
            $data->update([
                'plot_area'=>$request->plot_area,
                'construction_area'=>$request->construction_area,
                'budget'=>$request->budget,
                'location'=>$request->location,
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
