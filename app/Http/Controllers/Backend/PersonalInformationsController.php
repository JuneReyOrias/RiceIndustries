<?php

namespace App\Http\Controllers\Backend;
use App\Models\FixedCost;
use App\Models\LastProductionDatas;
use App\Models\MachineriesUseds;
use App\Models\PersonalInformations;
use App\Models\VariableCost;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\MultipleFile;
use App\Models\ParcellaryBoundaries;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalInformationsRequest;
use App\Http\Requests\UpdatePersonalInformationRequest;
use App\Models\Crop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Strings;
use App\Models\KmlFile;
use App\Models\User;

use App\Models\FarmProfile;
use Illuminate\Support\Facades\Auth;

class PersonalInformationsController extends Controller
{

protected $personalInformations;
public function __construct() {
    $this->personalInformations = new PersonalInformations;

}


// join table for farmprfofiles


    //join all table and then fetch specific column
public function Personalfarms() {

    try { 

    $personalInformations = DB::table('personal_informations')
    ->leftJoin('farm_profiles', 'farm_profiles.id', '=', 'personal_informations.id')
    ->leftJoin('fixed_costs', 'fixed_costs.id', '=', 'personal_informations.id')
    ->leftJoin('machineries_useds', 'machineries_useds.id', '=', 'personal_informations.id')
    ->leftJoin('seeds', 'seeds.id', '=', 'personal_informations.id')
    ->leftJoin('fertilizers', 'fertilizers.id', '=', 'personal_informations.id')
    ->leftJoin('labors', 'labors.id', '=', 'personal_informations.id')
    ->leftJoin('pesticides', 'pesticides.id', '=', 'personal_informations.id')
    ->leftJoin('transports', 'transports.id', '=', 'personal_informations.id')
    ->leftJoin('variable_costs', 'variable_costs.id', '=', 'personal_informations.id')
    ->leftJoin('last_production_datas', 'last_production_datas.id', '=', 'personal_informations.id')
    ->select(
        'personal_informations.*',
        'farm_profiles.*',
        'fixed_costs.*',
        'machineries_useds.*', // Select all columns from machineries_useds
        'seeds.*',
        'fertilizers.*',
        'labors.*',
        'pesticides.*',
        'transports.*',
        'variable_costs.*',
        'last_production_datas.*', 
        )
    ->get();
  
    return view('farm-table.join_table',['personalInformations' => $personalInformations]);
} catch (\Exception $ex) {
    // Log the exception for debugging purposes
    dd($ex);
    return redirect()->back()->with('message', 'Something went wrong');
}
 
// }
    }
   
    public function Gmap()
    {
     $personalInformations= PersonalInformations::all();
     $parcels= ParcellaryBoundaries::all();
   
        // Fetch the latest uploaded KML file from the database
        $kmlFile = KmlFile::latest()->first();

       
    

     return view('map.gmap',compact('personalInformations','parcels','kmlFile'));
    }


        // view the personalinfo by admin
        public function PersonalInfo()
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
                    $agri_district = $admin->agri_district;
                    // Check if user is authenticated before proceeding
                    if (!$user) {
                        // Handle unauthenticated user, for example, redirect them to login
                        return redirect()->route('login');
                    }
        
                    // Find the user's personal information by their ID
                    $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
        
                    // Fetch the farm ID associated with the user
                    $farmId = $user->farm_id;
        
                    // Find the farm profile using the fetched farm ID
                    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
                 
                    $personalInformation= PersonalInformations::all();
        
                    
                    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                    // Return the view with the fetched data
                    return view('personalinfo.index', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
                    ,'personalInformation','userId','agri_district'
                    
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

    public function Agent(): View
    {
        $personalInformation= PersonalInformations::all();
    return view('personalinfo.index_agent',compact('personalInformation'));
    }
   

    public function PersonalInfoCrud():View{
        $personalInformations= PersonalInformations::latest()->get();
        return view('personalinfo.create',compact('personalInformations'));
    }

    //agent form personal info form
    public function PersonalInfoCrudAgent():View{
        $personalInformations= PersonalInformations::latest()->get();
        return view('personalinfo.show_agent',compact('personalInformations'));
    }
   


    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonalInformationsRequest $request): RedirectResponse
    {
      
        try{
        
          // Access the primary key of the PersonalInformations model instance

    $existingPersonalInformations = PersonalInformations::where([
        ['first_name', '=', $request->input('first_name')],
        ['middle_name', '=', $request->input('middle_name')],
        ['last_name', '=', $request->input('last_name')],
       
       
    
      
        // Add other fields here
    ])->first();
    
    if ($existingPersonalInformations) {
        // FarmProfile with the given personal_informations_id and other fields already exists
        // You can handle this scenario here, for example, return an error message
        return redirect('/add-personal-info')->with('error', 'Farm Profile with this information already exists.');
    }
    
    // $personalInformation= $request->validated();
    // $personalInformation= $request->all();
           $personalInformation= new PersonalInformations;
        //    dd($request->all());
     
  // Check if a file is present in the request and if it's valid
if ($request->hasFile('image') && $request->file('image')->isValid()) {
    // Retrieve the image file from the request
    $image = $request->file('image');
    
    // Generate a unique image name using current timestamp and file extension
    $imagename = time() . '.' . $image->getClientOriginalExtension();
    
    // Move the uploaded image to the 'personalInfoimages' directory with the generated name
    $image->move('personalInfoimages', $imagename);
    
    // Set the image name in the PersonalInformation model
    $personalInformation->image = $imagename;
} 
            $personalInformation->users_id =$request->users_id;
            $personalInformation->first_name= $request->first_name;
            $personalInformation->middle_name= $request->middle_name;
            $personalInformation->last_name=  $request->last_name;

            if ($request->extension_name === 'others') {
                $personalInformation->extension_name = $request->add_extName; // Use the value entered in the "add_extenstion name" input field
           } else {
                $personalInformation->extension_name = $request->extension_name; // Use the selected color from the dropdown
           }
            $personalInformation->country=  $request->country;
            $personalInformation->province=  $request->province;
            $personalInformation->city=  $request->city;
            $personalInformation->agri_district=  $request->agri_district;
            $personalInformation->barangay=  $request->barangay;
            
             $personalInformation->home_address=  $request->home_address;
             $personalInformation->sex=  $request->sex;

             if ($request->religion=== 'other') {
                $personalInformation->religion= $request->add_Religion; // Use the value entered in the "religion" input field
           } else {
                $personalInformation->religion= $request->religion; // Use the selected religion from the dropdown
           }
             $personalInformation->date_of_birth=  $request->date_of_birth;
            
             if ($request->place_of_birth=== 'Add Place of Birth') {
                $personalInformation->place_of_birth= $request->add_PlaceBirth; // Use the value entered in the "place_of_birth" input field
           } else {
                $personalInformation->place_of_birth= $request->place_of_birth; // Use the selected place_of_birth from the dropdown
           }
             $personalInformation->contact_no=  $request->contact_no;
             $personalInformation->civil_status=  $request->civil_status;
             $personalInformation->name_legal_spouse=  $request->name_legal_spouse;

             if ($request->no_of_children=== 'Add') {
                $personalInformation->no_of_children= $request->add_noChildren; // Use the value entered in the "no_of_children" input field
                } else {
                        $personalInformation->no_of_children= $request->no_of_children; // Use the selected no_of_children from the dropdown
                }
    
             $personalInformation->mothers_maiden_name=  $request->mothers_maiden_name;
             if ($request->highest_formal_education=== 'Other') {
                $personalInformation->highest_formal_education= $request->add_formEduc; // Use the value entered in the "highest_formal_education" input field
                } else {
                        $personalInformation->highest_formal_education= $request->highest_formal_education; // Use the selected highest_formal_education from the dropdown
                }
             $personalInformation->person_with_disability=  $request->person_with_disability;
             $personalInformation->pwd_id_no=  $request->pwd_id_no;
             $personalInformation->government_issued_id=  $request->government_issued_id;
             $personalInformation->id_type=  $request->id_type;
             $personalInformation->gov_id_no=  $request->gov_id_no;
             $personalInformation->member_ofany_farmers_ass_org_coop=  $request->member_ofany_farmers_ass_org_coop;
             
             if ($request->nameof_farmers_ass_org_coop === 'add') {
                $personalInformation->nameof_farmers_ass_org_coop = $request->add_FarmersGroup; // Use the value entered in the "add_extenstion name" input field
           } else {
                $personalInformation->nameof_farmers_ass_org_coop = $request->nameof_farmers_ass_org_coop; // Use the selected color from the dropdown
           }
             $personalInformation->name_contact_person=  $request->name_contact_person;
      
             $personalInformation->cp_tel_no=  $request->cp_tel_no;
            



        
            dd($personalInformation);
             $personalInformation->save();
            return redirect('/admin-farmprofile')->with('message','Personal informations Added successsfully');
        
        }
        catch(\Exception $ex){
            // dd($ex); // Debugging statement to inspect the exception
            return redirect('/admin-add-personalinformation')->with('message','Please Try Again');
            
        }   
        
        
               
          
  

} 
    

        // view the personalinfo by admin
            // production view
        public function  productionview (Request $request, $id)
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
                    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
                    $farmData = FarmProfile::find($id);
                // Fetch farmer's information based on ID
                $cropData = Crop::find($id);
                $cropName = $request->input('crop_name');

                // Fetch farm profile data
             
            
                //  Fetch all crop data or filter based on the selected crop name
                 if ($cropName && $cropName != 'All') {
                    $cropData = Crop::where('farm_profiles_id', $id)
                                    ->where('crop_name', $cropName)
                                    
                                    ->get();
                } else {
                    $cropData = Crop::where('farm_profiles_id', $id)
                                    ->with( 'farmprofile')
                                    ->get();
                }
                $productionData = LastProductionDatas::where('crops_farms_id', $id)
                                                ->with('crop')
                                                ->get();
           
               
                // fixed cost
                $FixedData = FixedCost::where('last_production_datas_id', $id)
           
                ->get();

                $machineriesData =MachineriesUseds::where('last_production_datas_id', $id)
           
                ->get();
                $variableData =VariableCost::where('last_production_datas_id', $id)
           
                ->get();
      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('admin.farmersdata.production', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
            ,'userId','agri_district','agri_districts_id','cropData','id','productionData','FixedData'
            ,'farmData','machineriesData','variableData'
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
        
        // edit page for admin
        public function  PersonalInfoEdit($id)
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
                    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
                    $personalinfos= PersonalInformations::find($id);
              
        
                    
                    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                    // Return the view with the fetched data
                    return view('personalinfo.edit_info', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
                    ,'personalinfos','userId','agri_district','agri_districts_id'
                    
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
        // new update store by admin FOR PERSONAL INFO
        public function PersonalInfoUpdate(Request $request,$id)
        {
  
             try{
        

                    // $data= $request->validated();
                    // $data= $request->all();
                    $data= PersonalInformations::find($id);
                    
                   
  // Check if a file is present in the request and if it's valid
if ($request->hasFile('image') && $request->file('image')->isValid()) {
    // Retrieve the image file from the request
    $image = $request->file('image');
    
    // Generate a unique image name using current timestamp and file extension
    $imagename = time() . '.' . $image->getClientOriginalExtension();
    
    // Move the uploaded image to the 'personalInfoimages' directory with the generated name
    $image->move('personalInfoimages', $imagename);
    
    // Set the image name in the PersonalInformation model
    $data->image = $imagename;
} 
            $data->users_id =$request->users_id;
            $data->first_name= $request->first_name;
            $data->middle_name= $request->middle_name;
            $data->last_name=  $request->last_name;

            if ($request->extension_name === 'others') {
                $data->extension_name = $request->add_extName; // Use the value entered in the "add_extenstion name" input field
           } else {
                $data->extension_name = $request->extension_name; // Use the selected color from the dropdown
           }
            $data->country=  $request->country;
            $data->province=  $request->province;
            $data->city=  $request->city;
            $data->agri_district=  $request->agri_district;
            $data->barangay=  $request->barangay;
            
             $data->home_address=  $request->home_address;
             $data->sex=  $request->sex;

             if ($request->religion=== 'other') {
                $data->religion= $request->add_Religion; // Use the value entered in the "religion" input field
           } else {
                $data->religion= $request->religion; // Use the selected religion from the dropdown
           }
             $data->date_of_birth=  $request->date_of_birth;
            
             if ($request->place_of_birth=== 'Add Place of Birth') {
                $data->place_of_birth= $request->add_PlaceBirth; // Use the value entered in the "place_of_birth" input field
           } else {
                $data->place_of_birth= $request->place_of_birth; // Use the selected place_of_birth from the dropdown
           }
             $data->contact_no=  $request->contact_no;
             $data->civil_status=  $request->civil_status;
             $data->name_legal_spouse=  $request->name_legal_spouse;

             if ($request->no_of_children=== 'Add') {
                $data->no_of_children= $request->add_noChildren; // Use the value entered in the "no_of_children" input field
                } else {
                        $data->no_of_children= $request->no_of_children; // Use the selected no_of_children from the dropdown
                }
    
             $data->mothers_maiden_name=  $request->mothers_maiden_name;
             if ($request->highest_formal_education=== 'Other') {
                $data->highest_formal_education= $request->add_formEduc; // Use the value entered in the "highest_formal_education" input field
                } else {
                        $data->highest_formal_education= $request->highest_formal_education; // Use the selected highest_formal_education from the dropdown
                }
             $data->person_with_disability=  $request->person_with_disability;
             $data->pwd_id_no=  $request->pwd_id_no;
             $data->government_issued_id=  $request->government_issued_id;
             $data->id_type=  $request->id_type;
             $data->gov_id_no=  $request->gov_id_no;
             $data->member_ofany_farmers_ass_org_coop=  $request->member_ofany_farmers_ass_org_coop;
             
             if ($request->nameof_farmers_ass_org_coop === 'add') {
                $data->nameof_farmers_ass_org_coop = $request->add_FarmersGroup; // Use the value entered in the "add_extenstion name" input field
           } else {
                $data->nameof_farmers_ass_org_coop = $request->nameof_farmers_ass_org_coop; // Use the selected color from the dropdown
           }
             $data->name_contact_person=  $request->name_contact_person;
      
             $data->cp_tel_no=  $request->cp_tel_no;
            



                    dd($data);
                    $data->save();     
                    
                
                    return redirect('/admin-view-personalinfo')->with('message','Personal informations Updated successsfully');
                
                }
                catch(\Exception $ex){
                    // dd($ex); // Debugging statement to inspect the exception
                    return redirect('/admin-update-personalinfo/{personalinfos}')->with('message','Someting went wrong');
                    
                }   
            } 

            // deleting personal info by admin
            public function DeletePersonalInfo($id) {
                try {
                    // Find the personal information by ID
                    $personalinformations = PersonalInformations::find($id);
            
                    // Check if the personal information exists
                    if (!$personalinformations) {
                        return redirect()->back()->with('error', 'Personal information not found');
                    }
            
                    // Delete the personal information data from the database
                    $personalinformations->delete();
            
                    // Redirect back with success message
                    return redirect()->back()->with('message', 'Personal information deleted successfully');
            
                } catch (\Exception $e) {
                    // Handle any exceptions and redirect back with error message
                    return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
                }
            }




    

// all farmers data view ny the users 
public function forms() {

    try { 

    $allfarmers = DB::table('personal_informations')
    ->leftJoin('farm_profiles', 'farm_profiles.id', '=', 'personal_informations.id')
    ->leftJoin('fixed_costs', 'fixed_costs.id', '=', 'personal_informations.id')
    ->leftJoin('machineries_useds', 'machineries_useds.id', '=', 'personal_informations.id')
    ->leftJoin('seeds', 'seeds.id', '=', 'personal_informations.id')
    ->leftJoin('fertilizers', 'fertilizers.id', '=', 'personal_informations.id')
    ->leftJoin('labors', 'labors.id', '=', 'personal_informations.id')
    ->leftJoin('pesticides', 'pesticides.id', '=', 'personal_informations.id')
    ->leftJoin('transports', 'transports.id', '=', 'personal_informations.id')
    ->leftJoin('variable_costs', 'variable_costs.id', '=', 'personal_informations.id')
    ->leftJoin('last_production_datas', 'last_production_datas.id', '=', 'personal_informations.id')
    ->select(
        'personal_informations.*',
        'farm_profiles.*',
        'fixed_costs.*',
        'machineries_useds.*', // Select all columns from machineries_useds
        'seeds.*',
        'fertilizers.*',
        'labors.*',
        'pesticides.*',
        'transports.*',
        'variable_costs.*',
        'last_production_datas.*', 
        )->paginate(10)
;
  
    return view('user.forms_data',compact('allfarmers'));
} catch (\Exception $ex) {
    // Log the exception for debugging purposes
    dd($ex);
    return redirect()->back()->with('message', 'Something went wrong');
}



}

// viewing the all farmers in farm profile
public function profileFarmer($id) {
   
            try { 
        
            $allfarmers =PersonalInformations:: find($id)
            ->leftJoin('farm_profiles', 'farm_profiles.id', '=', 'personal_informations.id')
            ->leftJoin('fixed_costs', 'fixed_costs.id', '=', 'personal_informations.id')
            ->leftJoin('machineries_useds', 'machineries_useds.id', '=', 'personal_informations.id')
            ->leftJoin('seeds', 'seeds.id', '=', 'personal_informations.id')
            ->leftJoin('fertilizers', 'fertilizers.id', '=', 'personal_informations.id')
            ->leftJoin('labors', 'labors.id', '=', 'personal_informations.id')
            ->leftJoin('pesticides', 'pesticides.id', '=', 'personal_informations.id')
            ->leftJoin('transports', 'transports.id', '=', 'personal_informations.id')
            ->leftJoin('variable_costs', 'variable_costs.id', '=', 'personal_informations.id')
            ->leftJoin('last_production_datas', 'last_production_datas.id', '=', 'personal_informations.id')
           
            ->select(
                'personal_informations.*',
                'farm_profiles.*',
                'fixed_costs.*',
                'machineries_useds.*', // Select all columns from machineries_useds
                'seeds.*',
                'fertilizers.*',
                'labors.*',
                'pesticides.*',
                'transports.*',
                'variable_costs.*',
                'last_production_datas.*', 
                ) ->first();
          
            return view('agent.allfarmersinfo.profile',compact('allfarmers'));
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            dd($ex);
            return redirect()->back()->with('message', 'Something went wrong');
        }
    
    
    
    }


// admin farmers data display
public function FarmersInfo() {

    try { 

    $allfarmers = DB::table('personal_informations')
    ->leftJoin('farm_profiles', 'farm_profiles.id', '=', 'personal_informations.id')
    ->leftJoin('fixed_costs', 'fixed_costs.id', '=', 'personal_informations.id')
    ->leftJoin('machineries_useds', 'machineries_useds.id', '=', 'personal_informations.id')
    ->leftJoin('seeds', 'seeds.id', '=', 'personal_informations.id')
    ->leftJoin('fertilizers', 'fertilizers.id', '=', 'personal_informations.id')
    ->leftJoin('labors', 'labors.id', '=', 'personal_informations.id')
    ->leftJoin('pesticides', 'pesticides.id', '=', 'personal_informations.id')
    ->leftJoin('transports', 'transports.id', '=', 'personal_informations.id')
    ->leftJoin('variable_costs', 'variable_costs.id', '=', 'personal_informations.id')
    ->leftJoin('last_production_datas', 'last_production_datas.id', '=', 'personal_informations.id')
    ->select(
        'personal_informations.*',
        'farm_profiles.*',
        'fixed_costs.*',
        'machineries_useds.*', // Select all columns from machineries_useds
        'seeds.*',
        'fertilizers.*',
        'labors.*',
        'pesticides.*',
        'transports.*',
        'variable_costs.*',
        'last_production_datas.*', 
        )->paginate(10)
;
  
    return view('admin.allfarmersdata.farmers_info',compact('allfarmers'));
} catch (\Exception $ex) {
    // Log the exception for debugging purposes
    // dd($ex);
    return redirect()->back()->with('message', 'Something went wrong');
}



}



public function  farmview($id)
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
            $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
           // Fetch farmer's information based on ID
    $personalinfos = PersonalInformations::find($id);

    // Fetch farm data based on the farmer's ID
    $farmData = FarmProfile::where('personal_informations_id', $id)->get();
      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('admin.farmersdata.farm', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
            ,'personalinfos','userId','agri_district','agri_districts_id','farmData'
            
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


public function  cropview(Request $request, $id)
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
                    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();

                // Fetch farmer's information based on ID
                $farmData = FarmProfile::find($id);
                $cropName = $request->input('crop_name');

                // Fetch farm profile data
                $farmData = FarmProfile::find($id);
            
                 // Fetch all crop data or filter based on the selected crop name
                 if ($cropName && $cropName != 'All') {
                    $cropData = Crop::where('farm_profiles_id', $id)
                                    ->where('crop_name', $cropName)
                                    
                                    ->get();
                } else {
                    $cropData = Crop::where('farm_profiles_id', $id)
                                    ->with( 'farmprofile')
                                    ->get();
                }

      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('admin.farmersdata.crop', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
            ,'farmData','userId','agri_district','agri_districts_id','cropData','id'
            
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

        // production view
        public function  productionview (Request $request, $id)
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
                    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
                    $farmData = FarmProfile::find($id);
                // Fetch farmer's information based on ID
                $cropData = Crop::find($id);
                $cropName = $request->input('crop_name');

                // Fetch farm profile data
             
            
                 // Fetch all crop data or filter based on the selected crop name
                 if ($cropName && $cropName != 'All') {
                    $cropData = Crop::where('farm_profiles_id', $id)
                                    ->where('crop_name', $cropName)
                                    
                                    ->get();
                } else {
                    $cropData = Crop::where('farm_profiles_id', $id)
                                    ->with( 'farmprofile')
                                    ->get();
                }
                $productionData = LastProductionDatas::where('crops_farms_id', $id)
           
                ->get();
                // fixed cost
                $FixedData = FixedCost::where('last_production_datas_id', $id)
           
                ->get();

                $machineriesData =MachineriesUseds::where('last_production_datas_id', $id)
           
                ->get();
                $variableData =VariableCost::where('last_production_datas_id', $id)
           
                ->get();
      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('admin.farmersdata.production', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
            ,'userId','agri_district','agri_districts_id','cropData','id','productionData','FixedData'
            ,'farmData','machineriesData','variableData'
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


// samplefolder
public function  samplefolder (Request $request)
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
                    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
                //     $farmData = FarmProfile::find($id);
                // // Fetch farmer's information based on ID
                // $cropData = Crop::find($id);
                // $cropName = $request->input('crop_name');

                // // Fetch farm profile data
             
            
                //  // Fetch all crop data or filter based on the selected crop name
                //  if ($cropName && $cropName != 'All') {
                //     $cropData = Crop::where('farm_profiles_id', $id)
                //                     ->where('crop_name', $cropName)
                                    
                //                     ->get();
                // } else {
                //     $cropData = Crop::where('farm_profiles_id', $id)
                //                     ->with( 'farmprofile')
                //                     ->get();
                // }
                // $productionData = LastProductionDatas::where('crops_farms_id', $id)
           
                // ->get();
                // // fixed cost
                // $FixedData = FixedCost::where('last_production_datas_id', $id)
           
                // ->get();

                // $machineriesData =MachineriesUseds::where('last_production_datas_id', $id)
           
                // ->get();
                // $variableData =VariableCost::where('last_production_datas_id', $id)
           
                // ->get();
      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('admin.farmersdata.samplefolder.farm_edit', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
            ,'userId','agri_district','agri_districts_id'
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
}
