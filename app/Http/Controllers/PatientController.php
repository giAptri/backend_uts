<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(){
        $patients = Patient::all();
        $data = [
            'message' => 'Get All Resource', 'data' => $patients
        ];

        return response()->json($data,200);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'numeric|required',
            'address' => 'required',
            'status' => 'required',
            'in_date_at' => 'required',
            'out_date_at' => 'required'
        ]);

        $patients = Patient::create($validatedData);

        $data = [
            'message' => 'Resouce is Added Sucsessfully',
            'data' => $patients,
        ];

        return response()->json($data, 201);
    }

    public function show ($id){
        $patients = Patient::find($id);

        if ($patients) {
            $data = [
                'message' => 'get detail Resource',
                'data' => $patients,
            ];

            return response()->json($data, 200);

        }

        else {
            $data = [
                'message' => 'Resource Not Found',
            ];

            return response()->json($data, 404);
        }
    }

    public function update(Request $request, $id) {
        $patients = Patient::find($id);

        if($patients) {
            $input = [
                'name' => $request->name ?? $patients->name,
                'phone' => $request->phone ?? $patients->phone,
                'address' => $request->address ?? $patients->address,
                'status' => $request->status ?? $patients->status,
                'in_date_at' => $request->in_date_at ?? $patients->in_date_out,
                'out_date_at' => $request->out_date_at ?? $patients->out_date_at,
            ];

            $patients->update($input);

            $data = [
                'message' => 'Resource is Update Succsesfully',
                'data' => $patients
            ];

            return response()->json($data, 200);
        }

        else{
            $data = [
                'message' => 'Resource Not Found'
            ];

            return response()->json($data, 404);
        }
    }

    public function destroy($id){
        $patients = Patient::find($id);

        if ($patients) {
            $patients->delete();

            $data = [
                'message' => 'Resource is Delete Successfully',

            ];

            return response()->json($data, 200);

        }

        else{
            $data = [
                'messasge' => 'Resource Not Found',

            ];

            return response()->json($data, 404);
        }
    }

    public function search($name){

        $patients = Patient::where('name', 'like', '%' . $name . '%')
            ->orWhere('phone', 'like', '%' . $name . '%')
            ->orWhere('address', 'like', '%' . $name . '%')
            ->orWhere('status', 'like', '%' . $name . '%')
            ->orWhere('in_date_at', 'like', '%' . $name . '%')
            ->orWhere('out_date_at', 'like', '%' . $name . '%')
            ->get();

        $data = [
            'message' => 'Search Results',
            'data' => $patients,
         ];

         return response()->json($data, 200);
    }

    public function positive(){
          $patients=Patient::where('status', 'positive')->get();
          
          if($patients->count()){
            $data=[
                'message' => 'data positive',
                'data' => $patients
            ];

            return response()->json($data,200);
          }
          else{
            $data = [
                'messasge' => 'Resource Not Found',

            ];

            return response()->json($data, 404);
        }
    }

    public function recovered(){
        $patients=Patient::where('status', 'recovered')->get();
          
        if($patients->count()){
          $data=[
              'message' => 'data recovered',
              'data' => $patients
          ];

          return response()->json($data,200);
        }
        else{
          $data = [
              'messasge' => 'Resource Not Found',

          ];

          return response()->json($data, 404);
      }
    }

    public function dead(){
        $patients=Patient::where('status', 'dead')->get();
          
          if($patients->count()){
            $data=[
                'message' => 'data dead',
                'data' => $patients
            ];

            return response()->json($data,200);
          }
          else{
            $data = [
                'messasge' => 'Resource Not Found',

            ];

            return response()->json($data, 404);
        }
    }


}











