<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Models\Categorize;
use App\Models\CropCategory;
use App\Models\LastProductionDatas;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CropCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



    public function CropCategory()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed with retrieving the user's ID
            $userId = Auth::id();
    
            // Find the user based on the retrieved ID
            $admin = User::find($userId);
    
            if ($admin) {
                // Assuming you have additional logic to fetch dashboard data
             
            
              
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                // Return the view with dashboard data
                return view('crop_category.crop_create', compact('userId','admin','totalRiceProduction'));
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
    public function Cropping()
    {
        $cropcat = CropCategory::all();
     return view('crops.crops_create',compact('cropcat'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        
          
            $addCrop= new CropCategory();
            $addCrop->users_id = $request->users_id;
            // $addCrop->crop_name =$request->crop_name;
            if ($request->crop_name === 'Add') {
                $addCrop->crop_name = $request->new_crop_name; // Use the value entered in the "add_extenstion name" input field
           } else {
                $addCrop->crop_name = $request->crop_name; // Use the selected color from the dropdown
           }
            $addCrop->type_of_variety =$request->type_of_variety;
        
            // $addCrop->altitude =$request->altitude;
            // dd($addCrop);
            $addCrop->save();
            return redirect('/admin-add-new-crop')->with('message','Crop Category added successsfully');
        
        }
        catch(\Exception $ex){
            dd($ex); // Debugging statement to inspect the exception
            return redirect('/admin-add-new-crop')->with('message','Someting went wrong');
            
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('personalinfo.create')->with('personalInformations',$id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       // dd($farmer_no);
       $agridistricts =  CropCategory::where('personal_information_id',$id)->first();
     
       return view('personalinfo.edit')->with('personalInformation',$agridistricts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
            // dd(($request->all()));
            try {
                // Get validated data from the request (if you're using validation rules)
                $data = $request->validated();
            
                // If you want to use all data, use this line instead of the above line.
                // $data = $request->all();
            
                // Update the PersonalInformations table
                CropCategory::where('agri_districts_id', $id)->update($data);
            
                // Optionally, you can return a response indicating success
                return redirect('/personalinfo/create')->with('message','Personal informations updated successsfully');
            } catch (\Exception $e) {
                // Handle any exceptions that might occur during the update process
                return response()->json(['message' => 'Error updating record: ' . $e->getMessage()], 500);
            }
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $addCrop = CropCategory::where('id', $id);
        
            if ($addCrop) {
                $addCrop->delete();
                return redirect()->route('polygon.polygons_show')
                                 ->with('message', 'Crop Category deleted successfully');
            } else {
                return redirect()->route('polygon.polygons_show')
                                 ->with('message', 'Crop Category not found');
            }
        } catch (\Exception $e) {
            return redirect()->route('polygon.polygons_show')
                             ->with('message', 'Error deleting Crop Category : ' . $e->getMessage());
        }
    }
}
