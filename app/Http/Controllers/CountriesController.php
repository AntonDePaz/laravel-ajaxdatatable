<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;


use DataTables;

class CountriesController extends Controller
{
    public function index(){
        return view('countries-list');
    }
    public function addCountry(Request $request){

        $validator = \Validator::make($request->all(),[
            'country_name' => 'required',
            'capital_city' => 'required',
        ]); 

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
           $country = new Country();
           $country->country_name = $request->country_name;
           $country->capital_city = $request->capital_city;
           $query = $country->save();

           if(!$query){
             return response()->json(['code'=>0,'msg'=>'Something went wrong']);
           }
           else{
             return response()->json(['code'=>1,'msg'=>'Country Successfully Added!']);
           }

        }
    }


    public function getCountriesList(){

        $countries = Country::all();
        return DataTables::of($countries)
                ->addIndexColumn()
                ->addColumn('actions',function($row){
                    return '<div class="btn-group">
                                <button class="btn btn-sm btn-primary" data-id="'.$row['id'].'" id="edit" >Edit</button>
                                <button class="btn btn-sm btn-danger" data-id="'.$row['id'].'" id="delete">Delete</button>
                            </div>';
                })->rawColumns(['actions'])
                ->make(true);

    }

    public function getCountryDetails(Request $request){

        $country_id = $request->country_id;
        $countryDetails = Country::find($country_id);
        return response()->json(['details'=>$countryDetails]);

    }

    public function updateCountry(Request $request){

        $country_id = $request->cid;

        $validator = \Validator::make($request->all(),[
            'country_name' => 'required',
            'capital_city' => 'required',
        ]); 

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
           $country = Country::find($country_id);
           $country->country_name = $request->country_name;
           $country->capital_city = $request->capital_city;
           $query = $country->save();

           if(!$query){
             return response()->json(['code'=>0,'msg'=>'Something went wrong']);
           }
           else{
             return response()->json(['code'=>1,'msg'=>'Country Successfully Updated!']);
           }

        }


    }


    public function deleteCountry(Request $request){

        $country_id = $request->country_id;
        $query = Country::find($country_id)->delete();
        if(!$query){
            return response()->json(['code'=>0,'msg'=>'Something went wrong']);
          }
          else{
            return response()->json(['code'=>1,'msg'=>'Country Successfully Deleted!']);
          }

    }




}
