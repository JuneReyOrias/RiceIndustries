<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LastProductionDatasRequest;
use App\Http\Requests\UpdateLastProductiondatasRequest;
use App\Models\LastProductionData;
use App\Models\LastProductionDatas;
use Illuminate\Http\Request;
use App\Models\MachineriesUseds;

use App\Models\AgriDistrict;
use App\Models\FarmProfile;
use App\Http\Requests\FarmProfileRequest;
use App\Http\Requests\UpdateFarmProfileRequest;
use App\Models\PersonalInformations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Optional;
use App\Models\KmlFile;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LastProductionDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function  ProductionForms()
    {
       // Check if the user is authenticated
    if (Auth::check()) {
        // User is authenticated, proceed with retrieving the user's ID
        $userId = Auth::id();

        // Find the user based on the retrieved ID
        $admin = User::find($userId);

        if ($admin) {
            // Assuming $user represents the currently logged-in user
            $user = auth()->user();

            // Check if user is authenticated before proceeding
            if (!$user) {
                // Handle unauthenticated user, for example, redirect them to login
                return redirect()->route('login');
            }
            $agri_districts = $user->agri_district;
            $agri_districts_id = $user->agri_districts_id;
            // Find the user's personal information by their ID
            $profile = PersonalInformations::where('users_id', $userId)->latest()->first();

            // Fetch the farm ID associated with the user
            $farmId = $user->id;

            // Find the farm profile using the fetched farm ID
            $farmprofile = FarmProfile::where('users_id', $farmId)->latest()->first();
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('production_data.production_index', compact('admin', 'profile', 'farmprofile','totalRiceProduction','userId','agri_districts_id','agri_districts'));
        } else {
            // Handle the case where the user is not found
            // You can redirect the user or display an error message
            return redirect()->route('login')->with('error', 'User not found.');
        }
    } else {
        // Handle the case where the user is not authenticated
        // Redirect the user to the login page
        return redirect()->route('login');
    }
}
    
    /**
     * Show the form for creating a new resource.
     */
    public function ProductionDataCrud()
    {
        $lastproductiondata= LastProductionDatas::latest()->get();
        return view('production_data.production_create',compact('lastproductiondata'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(LastProductionDatasRequest $request)
    {
        try{
            $existingLastProductionDatas =  LastProductionDatas::where([
                ['personal_informations_id', '=', $request->input('personal_informations_id')],
                ['farm_profiles_id', '=', $request->input('farm_profiles_id')],
                ['agri_districts_id', '=', $request->input('agri_districts_id')],
            
    
                // Add other fields here
            ])->first();
            
            if ($existingLastProductionDatas) {
                // FarmProfile with the given personal_informations_id and other fields already exists
                // You can handle this scenario here, for example, return an error message
                return redirect('admin-lastproduction-data')->with('error', 'Farm Profile with this information already exists.');
            }
    


            $data= $request->validated();
            $data= $request->all();
           $lastproduction= new LastProductionDatas;

           $lastproduction->personal_informations_id = $request->personal_informations_id;
           $lastproduction->farm_profiles_id = $request->farm_profiles_id;
           $lastproduction->agri_districts_id = $request->agri_districts_id;
           $lastproduction->seeds_typed_used = $request->seeds_typed_used;
           $lastproduction->seeds_used_in_kg = $request->seeds_used_in_kg;
           $lastproduction->seed_source = $request->seed_source=== 'Add' ? $request->add_seedsource : $request->seed_source;
           $lastproduction->no_of_fertilizer_used_in_bags = $request->no_of_fertilizer_used_in_bags;
                
           $lastproduction->no_of_pesticides_used_in_l_per_kg = $request->no_of_pesticides_used_in_l_per_kg;
           $lastproduction->no_of_insecticides_used_in_l = $request->no_of_insecticides_used_in_l;
           $lastproduction->area_planted = $request->area_planted;
           $lastproduction->date_planted = $request->date_planted;
           $lastproduction->date_harvested = $request->date_harvested;
           $lastproduction->yield_tons_per_kg = $request->yield_tons_per_kg;
        
           $lastproduction->unit_price_palay_per_kg = $request->unit_price_palay_per_kg;
           $lastproduction->unit_price_rice_per_kg = $request->unit_price_rice_per_kg;
           $lastproduction->type_of_product = $request->type_of_product;
           $lastproduction->sold_to = $request->sold_to;
           $lastproduction->if_palay_milled_where =  $request->if_palay_milled_where;
           $lastproduction->gross_income_palay = $request->gross_income_palay;
           $lastproduction->gross_income_rice =  $request->gross_income_rice;
        
            // dd($lastproduction);
            $lastproduction->save();

    
            return redirect('/admin-add-personalinformation')->with('message','Rice Survey Form Completed successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex);
            return redirect('admin-lastproduction-data')->with('message','Someting went wrong');
        }
    }

  
// last production view

public function  Productionview(Request $request)
{
    // Check if the user is authenticated
    if (Auth::check()) {
        // User is authenticated, proceed with retrieving the user's ID
        $userId = Auth::id();

        // Find the user based on the retrieved ID
        $admin = User::find($userId);

        if ($admin) {
            // Assuming $user represents the currently logged-in user
            $user = auth()->user();

            // Check if user is authenticated before proceeding
            if (!$user) {
                // Handle unauthenticated user, for example, redirect them to login
                return redirect()->route('login');
            }

            // Find the user's personal information by their ID
            $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
          
            // Query for fixed costs with eager loading of related models


            $productions = LastProductionDatas::with('personalinformation', 'farmprofile','agridistrict')
                ->orderBy('id', 'desc');

            // Apply search functionality
            if ($request->has('search')) {
                $keyword = $request->input('search');
                $productions->where(function ($query) use ($keyword) {
                    $query->whereHas('personalinformation', function ($query) use ($keyword) {
                        $query->where('last_name', 'like', "%$keyword%")
                              ->orWhere('first_name', 'like', "%$keyword%");
                    });
                });
            }

            // Paginate the results
            $productions = $productions->paginate(20);

            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');

            // Return the view with the fetched data
            return view('production_data.production_create', compact('admin', 'profile', 'productions', 'totalRiceProduction'));
        } else {
            // Handle the case where the user is not found
            // You can redirect the user or display an error message
            return redirect()->route('login')->with('error', 'User not found.');
        }
    } else {
        // Handle the case where the user is not authenticated
        // Redirect the user to the login page
        return redirect()->route('login');
    }
}
// last prduction view update

 public function Prodedit($id)
        {
            // Check if the user is authenticated
            if (Auth::check()) {
                // User is authenticated, proceed with retrieving the user's ID
                $userId = Auth::id();
        
                // Find the user based on the retrieved ID
                $admin = User::find($userId);
        
                if ($admin) {
                    // Assuming $user represents the currently logged-in user
                    $user = auth()->user();
        
                    // Check if user is authenticated before proceeding
                    if (!$user) {
                        // Handle unauthenticated user, for example, redirect them to login
                        return redirect()->route('login');
                    }
        
                    // Find the user's personal information by their ID
                    $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
        
                    // Fetch the farm ID associated with the user
                    $farmId = $user->farm_id;
                    $agri_district = $user->agri_district;
                    $agri_districts_id = $user->agri_districts_id;
                    // Find the farm profile using the fetched farm ID
                    $farmprofile = FarmProfile::where('id', $farmId)->latest()->first();
                    $productions= LastProductionDatas::find($id);
              
        
                    
                    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                    // Return the view with the fetched data
                    return view('production_data.production_edit', compact('admin', 'profile', 'farmprofile','totalRiceProduction'
                    ,'productions','userId','agri_district','agri_districts_id'
                    
                    ));
                } else {
                    // Handle the case where the user is not found
                    // You can redirect the user or display an error message
                    return redirect()->route('login')->with('error', 'User not found.');
                }
            } else {
                // Handle the case where the user is not authenticated
                // Redirect the user to the login page
                return redirect()->route('login');
            }
        }
 public function Proddataupdate(LastProductionDatasRequest $request,$id)
{

    try{
        

        $data= $request->validated();
        $data= $request->all();
        
        $data=LastProductionDatas::find($id);

         $data->personal_informations_id = $request->personal_informations_id;
           $data->farm_profiles_id = $request->farm_profiles_id;
           $data->agri_districts_id = $request->agri_districts_id;
           $data->seeds_typed_used = $request->seeds_typed_used;
           $data->seeds_used_in_kg = $request->seeds_used_in_kg;
           $data->seed_source = $request->seed_source=== 'Add' ? $request->add_seedsource : $request->seed_source;
           $data->no_of_fertilizer_used_in_bags = $request->no_of_fertilizer_used_in_bags;
                
           $data->no_of_pesticides_used_in_l_per_kg = $request->no_of_pesticides_used_in_l_per_kg;
           $data->no_of_insecticides_used_in_l = $request->no_of_insecticides_used_in_l;
           $data->area_planted = $request->area_planted;
           $data->date_planted = $request->date_planted;
           $data->date_harvested = $request->date_harvested;
           $data->yield_tons_per_kg = $request->yield_tons_per_kg;
        
           $data->unit_price_palay_per_kg = $request->unit_price_palay_per_kg;
           $data->unit_price_rice_per_kg = $request->unit_price_rice_per_kg;
           $data->type_of_product = $request->type_of_product;
           $data->sold_to = $request->sold_to;
           $data->if_palay_milled_where =  $request->if_palay_milled_where;
           $data->gross_income_palay = $request->gross_income_palay;
           $data->gross_income_rice =  $request->gross_income_rice;
        
            // dd($data);
            $data->save();
        
    
        return redirect('/admin-view-personalinfo')->with('message','Last Production Data Updated successsfully');
    
    }
    catch(\Exception $ex){
        // dd($ex); // Debugging statement to inspect the exception
        return redirect('/admin-edit-lastproduction-data/{productions}')->with('message','Someting went wrong');
        
    }   
} 






public function ProdDestroy($id) {
    try {
        // Find the personal information by ID
       $productions =LastProductionDatas::find($id);

        // Check if the personal information exists
        if (! $productions) {
            return redirect()->back()->with('error', 'Farm Profilenot found');
        }

        // Delete the personal information data from the database
       $productions->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Last Production Data deleted Successfully');

    } catch (\Exception $e) {
        dd($e);// Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}
}
