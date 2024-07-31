<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParcellaryBoundariesRequest;
use App\Http\Requests\RegisterRequest;

use App\Models\FarmProfile;
use App\Models\Fertilizer;
use App\Models\FixedCost;
use App\Models\Labor;
use App\Models\FarmerOrg;

use App\Models\Barangay;
use App\Models\LastProductionDatas;
use App\Models\MachineriesUseds;
use App\Models\ParcellaryBoundaries;
use App\Models\Pesticide;
use App\Models\Seed;
use App\Models\VariableCost;
use App\Http\Requests\FarmProfileRequest;
use App\Http\Requests\FixedCostRequest;
use App\Http\Requests\MachineriesUsedtRequest;
use App\Http\Requests\UpdateMachineriesUsedRequest;
use App\Http\Requests\LastProductionDatasRequest;
use App\Http\Requests\UpdateLastProductiondatasRequest;
use App\Http\Requests\SeedRequest;
use App\Http\Requests\LaborRequest;
use App\Http\Requests\FertilizerRequest;
use App\Http\Requests\PesticidesRequest;
use App\Http\Requests\TransportRequest;
use App\Http\Requests\VariableCostRequest;
use App\Models\PersonalInformations;
use App\Http\Requests\PersonalInformationsRequest;
use App\Http\Controllers\Backend\PersonalInformationsController;
use App\Models\AgriDistrict;
use App\Models\Transport;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

use Exception;
class AdminController extends Controller
{
    // public function adminDashb(){
    //     $totalfarms= FarmProfile::count();
    //     $totalAreaPlanted = FarmProfile::sum('total_physical_area_has');
    //     $totalAreaYield = FarmProfile::sum('yield_kg_ha');
    //     $totalCost= VariableCost::sum('total_variable_cost');

    //     $yieldPerAreaPlanted = ($totalAreaPlanted != 0) ? $totalAreaYield / $totalAreaPlanted : 0;
    //     $averageCostPerAreaPlanted = ($totalAreaPlanted != 0) ? $totalCost / $totalAreaPlanted : 0;
    //     $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    //     return view('admin.index',compact('totalfarms','totalAreaPlanted','totalAreaYield','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted','totalRiceProduction'));
    // }//end method

        public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }//end 

    public function adminDashb(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed with retrieving the user's ID
            $userId = Auth::id();
    
            // Find the user based on the retrieved ID
            $admin = User::find($userId);
    
            if ($admin) {
                // Assuming you have additional logic to fetch dashboard data
                $totalfarms = FarmProfile::count();
                $totalAreaPlanted = FarmProfile::sum('total_physical_area');
                $totalAreaYield = FarmProfile::sum('yield_kg_ha');
                $totalCost = VariableCost::sum('total_variable_cost');
    
                $yieldPerAreaPlanted = ($totalAreaPlanted != 0) ? $totalAreaYield / $totalAreaPlanted : 0;
                $averageCostPerAreaPlanted = ($totalAreaPlanted != 0) ? $totalCost / $totalAreaPlanted : 0;
                $totalRiceProductionInkg = LastProductionDatas::sum('yield_tons_per_kg');
                $totalRiceProduction = $totalRiceProductionInkg / 100000; // Convert to kilograms
                $districts = AgriDistrict::all();
                $totalfarm = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'vitali')
                    ->distinct()
                    ->count('personal_informations.id');
    
                // Fetch filter inputs
                $selectedCrop = $request->input('crop', 'Rice'); // Default to Rice if no crop is selected
                $selectedDate = $request->input('harvestDate', ''); // Default to empty string if no date is selected
                $selectedCycle = $request->input('croppingCycle', ''); // Default to empty string if no cycle is selected
    
                // Define static data for crops
                $allData = [
                    'Rice' => [
                        'Ayala' => [
                            'Inbrid' => 103,
                            'Hybrid' => 99,
                            'Not specified' => 1,
                        ],
                        'Culianan' => [
                            'Inbrid' => 258,
                            'Hybrid' => 24,
                            'Not specified' => 13,
                        ],
                        'Curuan' => [
                            'Inbrid' => 95,
                            'Hybrid' => 26,
                            'Not specified' => 1,
                        ],
                        'Manicahan' => [
                            'Inbrid' => 258,
                            'Hybrid' => 9,
                            'Not specified' => 4,
                        ],
                        'Tumaga' => [
                            'Inbrid' => 132,
                            'Hybrid' => 78,
                            'Not specified' => 0,
                        ],
                        'Vitali' => [
                            'Inbrid' => 330,
                            'Hybrid' => 0,
                            'Not specified' => 0,
                        ]
                    ],
                    'Corn' => [
                        // Add data for Corn
                    ],
                    'Coconut' => [
                        // Add data for Coconut
                    ],
                    'Other' => [
                        // Add data for Other crops
                    ]
                ];
    
                // Get data based on selected crop
                $data = $allData[$selectedCrop] ?? [];
    
                // Define yield data
                $yieldData = [
                    'Ayala' => ['yield' => 500, 'cycle' => 'Cycle 1', 'harvest_date' => '2024-01-01'],
                    'Tumaga' => ['yield' => 600, 'cycle' => 'Cycle 1', 'harvest_date' => '2024-01-01'],
                    'Culianan' => ['yield' => 550, 'cycle' => 'Cycle 1', 'harvest_date' => '2024-02-01'],
                    'Manicahan' => ['yield' => 700, 'cycle' => 'Cycle 1', 'harvest_date' => '2024-03-01'],
                    'Curuan' => ['yield' => 650, 'cycle' => 'Cycle 1', 'harvest_date' => '2024-01-01'],
                    'Vitali' => ['yield' => 580, 'cycle' => 'Cycle 1', 'harvest_date' => '2024-01-01'],
                ];
    
                // Filter yield data based on selected date and cropping cycle
                if (!empty($selectedDate)) {
                    $yieldData = array_filter($yieldData, function ($entry) use ($selectedDate) {
                        return $entry['harvest_date'] === $selectedDate;
                    });
                }
    
                if (!empty($selectedCycle)) {
                    $yieldData = array_filter($yieldData, function ($entry) use ($selectedCycle) {
                        return $entry['cycle'] === $selectedCycle;
                    });
                }
    
                // Return the view with dashboard data
                return view('admin.index', compact(
                    'data', 'yieldData', 'selectedCrop', 'selectedDate', 'selectedCycle', 'totalfarm', 'districts', 'admin',
                    'totalfarms', 'totalAreaPlanted', 'totalAreaYield', 'totalCost', 'yieldPerAreaPlanted',
                    'averageCostPerAreaPlanted', 'totalRiceProduction'
                ));
            } else {
                // Handle the case where the user is not found
                return redirect()->route('login')->with('error', 'User not found.');
            }
        } else {
            // Handle the case where the user is not authenticated
            return redirect()->route('login');
        }
    }
    
    // public function getFarmerReports($district)
    // {
    //     // Fetch farmer reports based on the selected district
    //     $FarmersData = DB::table('personal_informations')
    //         ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
    //         ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
    //         ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
    //         ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
    //         ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
    //         ->select(
    //             'personal_informations.*',
    //             'farm_profiles.*',
    //             'fixed_costs.*',
    //             'machineries_useds.*',
    //             'variable_costs.*',
    //             'last_production_datas.*'
    //         )
    //         ->where('farm_profiles.district', $district)
    //         ->orderBy('personal_informations.id', 'desc')
    //         ->get();

    //     return response()->json($FarmersData);
    // }





    public function AdminLogin(){
         return view('admin.admin_login');
    }//end

 
    // update the profile data 
    public function AdminProfile()
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
                return view('admin.admin_profile', compact('admin','totalRiceProduction'));
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
    

    public function update(Request $request){
        
        try {
            $id =Auth::user()->id;
       $data= User:: find($id);
       if ($data) {
           // Check if a file is present in the request and if it's valid
           if ($request->hasFile('image') && $request->file('image')->isValid()) {
               // Retrieve the image file from the request
               $image = $request->file('image');
   
               // Generate a unique image name using current timestamp and file extension
               $imagename = time() . '.' . $image->getClientOriginalExtension();
   
               // Move the uploaded image to the 'productimages' directory with the generated name
               $image->move('adminimages', $imagename);
   
               // Delete the previous image file, if exists
               if ($data->image) {
                   Storage::delete('adminimages/' . $data->image);
               }
   
               // Set the image name in the Product data
               $data->image = $imagename;
           }
   
       $data->name= $request->name;
       $data->email= $request->email;
       $data->agri_district= $request->agri_district;
       $data->password= $request->password;
       $data->role= $request->role;
    
        
      $data->save();
        // Redirect back after processing
        return redirect()->route('admin.admin_profile')->with('message', 'Profile updated successfully');
       } else {
           // Redirect back with error message if product not found
           return redirect()->back()->with('error', 'Product not found');
       }
   } catch (Exception $e) {
       dd($e);
       // Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error updating product: ' . $e->getMessage());
   }
   }





   
 
//    parcel boarders 
   public function ParcelBoarders()
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
   
               // Fetch user's information
               $user_id = $user->id;
               $agri_districts = $user->agri_district;
               $agri_districts_id = $user->agri_districts_id;
   
               // Find the user by their ID and eager load the personalInformation relationship
               $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
               $agridistricts = AgriDistrict::all();
               $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
               // Return the view with the fetched data
               return view('parcels.new_parcels', compact('agri_districts','agridistricts', 'agri_districts_id', 'admin', 'profile','totalRiceProduction'));
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


public function newparcels(ParcellaryBoundariesRequest $request)
{
    try {
        // Get validated data
        $data = $request->validated();

        // Create new ParcellaryBoundaries object
        $parcel=ParcellaryBoundaries::create([
                        'users_id' => $request->input('users_id'),
                        'agri_districts_id'=>$request->input('agri_districts_id'),
                        'ricefield_boarders_id'=>$request->input('ricefield_boarders_id'),
                        'parcel_name' => $request->input('parcel_name'),
                        'area' => $request->input('area'),
                        'lot_no' => $request->input('lot_no'),
                        'tct_no' => $request->input('tct_no'),
                        'brgy_name' => $request->input('brgy_name'),
                        'atdn' => $request->input('atdn'),
                        'arpowner_na' => $request->input('arpowner_na'),
                        'pkind_desc' => $request->input('pkind_desc'),
                        'puse_desc' => $request->input('puse_desc'),
                        'actual_used' => $request->input('actual_used'),
                        'parcolor' => $request->input('parcolor'),
                        'parone_latitude' => $request->input('parone_latitude'),
                        'parone_longitude' => $request->input('parone_longitude'),
                        'partwo_latitude' => $request->input('partwo_latitude'),
                        'partwo_longitude' => $request->input('partwo_longitude'),
                        'parthree_latitude' => $request->input('parthree_latitude'),
                        'parthree_longitude' => $request->input('parthree_longitude'),
                        'parfour_latitude' => $request->input('parfour_latitude'),
                        'parfour_longitude' => $request->input('parfour_longitude'),
                        'parfive_latitude' => $request->input('parfive_latitude'),
                        'parfive_longitude' => $request->input('parfive_longitude'),
                        'parsix_latitude' => $request->input('parsix_latitude'),
                        'parsix_longitude' => $request->input('parsix_longitude'),
                        'parseven_latitude' => $request->input('parseven_latitude'),
                        'parseven_longitude' => $request->input('parseven_longitude'),
                        'pareight_latitude' => $request->input('pareight_latitude'),
                        'pareight_longitude' => $request->input('pareight_longitude'),
                        'parnine_latitude'=>$request->input('parnine_latitude'),
                        'parnine_longitude'=>$request->input('parnine_longitude'),
                        'parten_latitude'=>$request->input('parten_latitude'),
                        'parten_longitude'=>$request->input('parten_longitude'),
                        'pareleven_latitude'=>$request->input('pareleven_latitude'),
                        'pareleven_longitude'=>$request->input('pareleven_longitude'),
                        'partwelve_latitude'=>$request->input('partwelve_latitude'),
                        'partwelve_longitude'=>$request->input('partwelve_longitude')
            
                      ]);

        // Redirect with success message
        return redirect('/admin-view-polygon')->with('message', 'Parcelary Boundaries added successfully');
    } catch (Exception $ex) {
        // Debugging statement to inspect the exception
        dd($ex);
        // Redirect with error message
        return redirect('/admin-add-parcel')->with('message', 'Something went wrong');
    }
}



// admin cost view

public function Parcelshow()
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
   
               // Fetch user's information
               $user_id = $user->id;
               $agri_districts = $user->agri_district;
               $agri_districts_id = $user->agri_districts_id;
   
               // Find the user by their ID and eager load the personalInformation relationship
               $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
               $parcels=ParcellaryBoundaries::orderBy('id','desc')->paginate(20);
               $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
               // Return the view with the fetched data
               return view('parcels.show', compact('agri_districts', 'agri_districts_id', 'admin', 'profile',
            'parcels','totalRiceProduction'));
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
// admin cost update

public function ParcelEdit($id)
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
   
               // Fetch user's information
               $user_id = $user->id;
               $agri_districts = $user->agri_district;
               $agri_districts_id = $user->agri_districts_id;
   
               // Find the user by their ID and eager load the personalInformation relationship
               $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
               $parcels=ParcellaryBoundaries::find($id);
               $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
               // Return the view with the fetched data
               return view('parcels.parcels_edit', compact('agri_districts', 'agri_districts_id', 'admin', 'profile',
            'parcels','totalRiceProduction'));
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


public function ParcelUpdates(ParcellaryBoundariesRequest $request,$id)
{

    try{
        

        $data= $request->validated();
        $data= $request->all();
        
        $data= ParcellaryBoundaries::find($id);

        $data-> agri_districts_id=$request->agri_districts_id;
      
        $data->parcel_name = $request->parcel_name;
        $data->area = $request->area;
        $data->lot_no = $request->lot_no;
        $data-> tct_no = $request->tct_no;
        $data->brgy_name = $request->brgy_name;
       
        $data->arpowner_na = $request->arpowner_na;
        $data->pkind_desc = $request->pkind_desc;
        $data-> puse_desc = $request->puse_desc;
        $data-> actual_used = $request->actual_used;
        $data->parcolor = $request->parcolor;
        $data->parone_latitude = $request->parone_latitude;
        $data->parone_longitude = $request->parone_longitude;
        $data->partwo_latitude = $request->partwo_latitude;
        $data->partwo_longitude = $request->partwo_longitude;
        $data->parthree_latitude = $request->parthree_latitude;
        $data->parthree_longitude = $request->parthree_longitude;
        $data->parfour_latitude = $request->parfour_latitude;
        $data->parfour_longitude = $request->parfour_longitude;
        $data-> parfive_latitude = $request->parfive_latitude;
        $data->parfive_longitude = $request->parfive_longitude;
        $data->parsix_latitude = $request->parsix_latitude;
        $data->parsix_longitude = $request->parsix_longitude;
        $data->parseven_latitude = $request->parseven_latitude;
        $data->parseven_longitude = $request->parseven_longitude;
        $data->pareight_latitude = $request->pareight_latitude;
        $data-> pareight_longitude = $request->pareight_longitude;
        $data->parnine_latitude=$request->parnine_latitude;
        $data->parnine_longitude=$request->parnine_longitude;
        $data->parten_latitude=$request->parten_latitude;
        $data->parten_longitude=$request->parten_longitude;
        $data->pareleven_latitude=$request->pareleven_latitude;
        $data->pareleven_longitude=$request->pareleven_longitude;
        $data->partwelve_latitude=$request->partwelve_latitude;
        $data->partwelve_longitude=$request->partwelve_longitude;
  
       


        $data->save();     
        
    
        return redirect('/admin-view-polygon')->with('message','Parcellary Boundaries Data Updated successsfully');
    
    }
    catch(Exception $ex){
        dd($ex); // Debugging statement to inspect the exception
        return redirect('/edit-parcel-boarders/{parcels}')->with('message','Someting went wrong');
        
    }   
} 






public function Parceldelete($id) {
    try {
        // Find the personal information by ID
       $parcels = ParcellaryBoundaries::find($id);

        // Check if the personal information exists
        if (!$parcels) {
            return redirect()->back()->with('error', 'Farm Profilenot found');
        }

        // Delete the personal information data from the database
       $parcels->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Parcellary Boundaries deleted Successfully');

    } catch (Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}

// creatinng new users account

public function newAccounts()
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
   
               // Fetch user's information
               $user_id = $user->id;
               $agri_districts = $user->agri_district;
               $agri_districts_id = $user->agri_districts_id;
   
               // Find the user by their ID and eager load the personalInformation relationship
               $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
              
               $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
               // Return the view with the fetched data
               return view('admin.create_account.new_accounts', compact('agri_districts', 'agri_districts_id', 'admin', 'profile',
            'totalRiceProduction'));
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
            //create new accounts
            public function NewUsers(RegisterRequest $request){
                try{
                    // dd($request->all());
                    $data= $request->validated();
                    $data= $request->all();
                    $user = new User;
                  
                    $user->first_name = $request['first_name'];
                    $user->last_name = $request['last_name'];
                    $user->email = $request['email'];
                    $user->agri_district = $request['agri_district'];
                    $user->password = bcrypt($request['password']); // Hash the password for security
                    $user->role = $request['role'];
                    // dd($user);
                    $user->save();
                    return redirect('/view-accounts')->with('message','Account Added Successsfully');
                
                }
                catch(Exception $ex){
                    dd($ex);
                    return redirect('/new-accounts')->with('message','Someting went wrong');
                }

                
             }
            //  users view by admin 
            public function Accountview(Request $request)
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
            
                        // Fetch user's information
                        $user_id = $user->id;
                        $agri_districts = $user->agri_district;
                        $agri_districts_id = $user->agri_districts_id;
            
                        // Find the user by their ID and eager load the personalInformation relationship
                        $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
                        $users=User::orderBy('id','desc')->paginate(20);
                           // Query for transports with search functionality
                           $usersQuery = User::query();
                           if ($request->has('search')) {
                               $searchTerm = $request->input('search');
                               $usersQuery->where(function($query) use ($searchTerm) {
                                   $query->where('email', 'like', "%$searchTerm%")
                                       ->orWhere('name', 'like', "%$searchTerm%")
                                       ->orWhere('agri_district', 'like', "%$searchTerm%");
                               });
                           }
                           $users = $usersQuery->orderBy('id','asc')->paginate(10);
                        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                        // Return the view with the fetched data
                        return view('admin.create_account.display_users', compact('agri_districts', 'agri_districts_id', 'admin', 'profile',
                       'totalRiceProduction','users'));
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

                        
                        // admin cost update
        

                        public function  editAccount($id)
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
                        
                                    // Fetch user's information
                                    $user_id = $user->id;
                                    $agri_districts = $user->agri_district;
                                    $agri_districts_id = $user->agri_districts_id;
                        
                                    // Find the user by their ID and eager load the personalInformation relationship
                                    $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
                                    $users=User::find($id);
                                    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                                    // Return the view with the fetched data
                                    return view('admin.create_account.edit_accounts', compact('agri_districts', 'agri_districts_id', 'admin', 'profile',
                                    'totalRiceProduction','users'));
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
            public function updateAccounts(Request $request, $id){
                    
                try {
                    
            $data= User:: find($id);
            if ($data) {
                // Check if a file is present in the request and if it's valid
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    // Retrieve the image file from the request
                    $image = $request->file('image');

                    // Generate a unique image name using current timestamp and file extension
                    $imagename = time() . '.' . $image->getClientOriginalExtension();

                    // Move the uploaded image to the 'productimages' directory with the generated name
                    $image->move('adminimages', $imagename);

                    // Delete the previous image file, if exists
                    if ($data->image) {
                        Storage::delete('adminimages/' . $data->image);
                    }

                    // Set the image name in the Product data
                    $data->image = $imagename;
                }

                // $data->name = $request['name'];
                $data->first_name = $request['first_name'];
                $data->last_name = $request['last_name'];
                $data->email = $request['email'];
                $data->agri_district = $request['agri_district'];
                // $data->password = bcrypt($request['password']); // Hash the password for security
                $data->role = $request['role'];
                // dd($data);
                $data->save();

                // Redirect back after processing
                return redirect('/view-accounts')->with('message', 'Account updated successfully');
            } 
            } catch (Exception $e) {
            //    dd($e);
            // Handle any exceptions and redirect back with error message
            return redirect('/edit-accounts/{users}')->with('error', 'Error updating product: ' . $e->getMessage());
            }
            }







// Delete users access by admin
public function deleteusers($id) {
    try {
        // Find the personal information by ID
       $users = User::find($id);

        // Check if the personal information exists
        if (!$users) {
            return redirect()->back()->with('error', 'Farm Profilenot found');
        }

        // Delete the personal information data from the database
       $users->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Parcellary Boundaries deleted Successfully');

    } catch (Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}


// farmers info per agri district
 

 public function farmerAyalas()
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
 
             // Find the farm profile using the fetched farm ID
             $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
 
       
 
             // Fetch ayala farmers fetching  data
             $FarmersData = DB::table('personal_informations')
             ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
             ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
             ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
             ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
             ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
             ->select(
                 'personal_informations.*',
                 'farm_profiles.*',
                 'fixed_costs.*',
                 'machineries_useds.*',
                 'variable_costs.*',
                 'last_production_datas.*'
             )
             ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
             ->get();
             // Specify the agri district you want to filter by
                 // Calculate the age for each farmer
                 foreach ($FarmersData as $farmer) {
                     // Calculate the age for each farmer
                     $dateOfBirth = $farmer->date_of_birth;
                     $age = Carbon::parse($dateOfBirth)->age;
 
                     // Add the age to the farmer object
                     $farmer->age = $age;
                 }
             // Count the number of farmers in the "ayala" district
             $totalfarms = DB::table('personal_informations')
             ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
             ->where('farm_profiles.agri_districts', 'ayala')
             ->distinct()
             ->count('personal_informations.id');
 
               // Calculate the total area planted in the "ayala" district
             $totalAreaPlantedAyala = DB::table('farm_profiles')
             ->where('agri_districts', 'ayala')
             ->sum('total_physical_area');
             $totalAreaYieldAyala = DB::table('farm_profiles')
             ->where('agri_districts', 'ayala')
             ->sum('yield_kg_ha');
          
              // Calculate the total fixed cost in the "ayala" district
             $totalFixedCostAyala = DB::table('fixed_costs')
             ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'fixed_costs.personal_informations_id')
             ->where('farm_profiles.agri_districts', 'ayala')
             ->sum('fixed_costs.total_amount');
             
                   // Calculate the total machineries cost in the "ayala" district
                   $totalMachineriesUsedAyala= DB::table('machineries_useds')
                   ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','machineries_useds.personal_informations_id')
                   ->where('farm_profiles.agri_districts', 'ayala')
                   ->sum('machineries_useds.total_cost_for_machineries');
 
                 // Calculate the total variable cost in the "ayala" district
                 $totalVariableCostAyala = DB::table('variable_costs')
                 ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','variable_costs.personal_informations_id')
                 ->where('farm_profiles.agri_districts', 'ayala')
                 ->sum('variable_costs.total_variable_cost');
 
                     // Calculate the total rice production in the Ayala district
                     $totalRiceProductionAyala = LastProductionDatas::join('farm_profiles', 'last_production_datas.personal_informations_id', '=', 'farm_profiles.personal_informations_id')
                     ->where('farm_profiles.agri_districtS', 'Ayala')
                     ->sum('last_production_datas.yield_tons_per_kg');
 
 
                               // Count owner tenants
                             $countOwnerTenants = DB::table('personal_informations')
                             ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                             ->where('farm_profiles.agri_districts', 'ayala')
                             ->where('farm_profiles.tenurial_status', 'owner')
                             ->distinct()
                             ->count('farm_profiles.tenurial_status');
 
                             // Count tiller tenant tenants
                             $countTillerTenantTenants = DB::table('personal_informations')
                             ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                             ->where('farm_profiles.agri_districts', 'ayala')
                             ->where('farm_profiles.tenurial_status', 'tiller tenant')
                             ->distinct()
                             ->count('farm_profiles.tenurial_status');
 
                             // Count tiller tenants
                             $countTillerTenants = DB::table('personal_informations')
                             ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                             ->where('farm_profiles.agri_districts', 'ayala')
                             ->where('farm_profiles.tenurial_status', 'tiller')
                             ->distinct()
                             ->count('farm_profiles.tenurial_status');
 
                             // Count lease tenants
                             $countLeaseTenants = DB::table('personal_informations')
                             ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                             ->where('farm_profiles.agri_districts', 'ayala')
                             ->where('farm_profiles.tenurial_status', 'lease')
                             ->distinct()
                             ->count('farm_profiles.tenurial_status');
                         // Count owner tenants
                     $countOwner = DB::table('personal_informations')
                     ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                     ->where('farm_profiles.agri_districts', 'ayala')
                     ->where('farm_profiles.tenurial_status', 'owner')
                     ->distinct()
                     ->count('farm_profiles.tenurial_status');
 
                     // total farmers organizattion
                     $countorg = DB::table('personal_informations')
                     ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                     ->where('farm_profiles.agri_districts', 'ayala')
                     ->distinct('personal_informations.nameof_farmers_ass_org_coop')
                     ->count('personal_informations.nameof_farmers_ass_org_coop');
 
 
                 // Calculate rice productivity in the Ayala district
                 $riceProductivityAyala = ($totalAreaPlantedAyala > 0) ? $totalRiceProductionAyala / $totalAreaPlantedAyala : 0;
 
                  // Assuming $personalinformation->date_of_birth contains the date of birth in "YYYY-MM-DD" format
      
             $totalAreaPlanted = FarmProfile::sum('total_physical_area');
             $totalAreaYield = FarmProfile::sum('yield_kg_ha');
             $totalCost= VariableCost::sum('total_variable_cost');
                 
             $yieldPerAreaPlanted = ($totalAreaPlantedAyala!= 0) ?  $totalAreaYieldAyala/ $totalAreaPlantedAyala : 0;
             $averageCostPerAreaPlanted = ($totalAreaPlantedAyala != 0) ? $totalVariableCostAyala / $totalAreaPlantedAyala : 0;
             $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
 
             // Return the view with the fetched data
             return view('admin.Agri_district.ayala_farmer', compact('admin', 'profile', 'farmProfile','FarmersData','totalRiceProduction',
             'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
             'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
             'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
             'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner','countorg'));
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
 
//  tumaga farmers info view by admin


public function FarmerTumagainfo()
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

            // Find the farm profile using the fetched farm ID
            $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();

      

            // Fetch ayala farmers fetching  data
            $FarmersData = DB::table('personal_informations')
            ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
            ->select(
                'personal_informations.*',
                'farm_profiles.*',
                'fixed_costs.*',
                'machineries_useds.*',
                'variable_costs.*',
                'last_production_datas.*'
            )
            ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
            ->get();
            // Specify the agri district you want to filter by
                // Calculate the age for each farmer
                foreach ($FarmersData as $farmer) {
                    // Calculate the age for each farmer
                    $dateOfBirth = $farmer->date_of_birth;
                    $age = Carbon::parse($dateOfBirth)->age;

                    // Add the age to the farmer object
                    $farmer->age = $age;
                }
            // Count the number of farmers in the "ayala" district
            $totalfarms = DB::table('personal_informations')
            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->where('farm_profiles.agri_districts', 'tumaga')
            ->distinct()
            ->count('personal_informations.id');

              // Calculate the total area planted in the "tumaga" district
            $totalAreaPlantedAyala = DB::table('farm_profiles')
            ->where('agri_districts', 'tumaga')
            ->sum('total_physical_area');
            $totalAreaYieldAyala = DB::table('farm_profiles')
            ->where('agri_districts', 'tumaga')
            ->sum('yield_kg_ha');
         
             // Calculate the total fixed cost in the "tumaga" district
            $totalFixedCostAyala = DB::table('fixed_costs')
            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'fixed_costs.personal_informations_id')
            ->where('farm_profiles.agri_districts', 'tumaga')
            ->sum('fixed_costs.total_amount');
            
                  // Calculate the total machineries cost in the "tumaga" district
                  $totalMachineriesUsedAyala= DB::table('machineries_useds')
                  ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','machineries_useds.personal_informations_id')
                  ->where('farm_profiles.agri_districts', 'tumaga')
                  ->sum('machineries_useds.total_cost_for_machineries');

                // Calculate the total variable cost in the "tumaga" district
                $totalVariableCostAyala = DB::table('variable_costs')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','variable_costs.personal_informations_id')
                ->where('farm_profiles.agri_districts', 'tumaga')
                ->sum('variable_costs.total_variable_cost');

                    // Calculate the total rice production in the Ayala district
                    $totalRiceProductionAyala = LastProductionDatas::join('farm_profiles', 'last_production_datas.personal_informations_id', '=', 'farm_profiles.personal_informations_id')
                    ->where('farm_profiles.agri_districtS', 'tumaga')
                    ->sum('last_production_datas.yield_tons_per_kg');


                              // Count owner tenants
                            $countOwnerTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'tumaga')
                            ->where('farm_profiles.tenurial_status', 'owner')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count tiller tenant tenants
                            $countTillerTenantTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'tumaga')
                            ->where('farm_profiles.tenurial_status', 'tiller tenant')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count tiller tenants
                            $countTillerTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'tumaga')
                            ->where('farm_profiles.tenurial_status', 'tiller')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count lease tenants
                            $countLeaseTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'tumaga')
                            ->where('farm_profiles.tenurial_status', 'lease')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');
                        // Count owner tenants
                    $countOwner = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'tumaga')
                    ->where('farm_profiles.tenurial_status', 'owner')
                    ->distinct()
                    ->count('farm_profiles.tenurial_status');

                    // total farmers organizattion
                    $countorg = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'tumaga')
                    ->distinct('personal_informations.nameof_farmers_ass_org_coop')
                    ->count('personal_informations.nameof_farmers_ass_org_coop');


                // Calculate rice productivity in the Ayala district
                $riceProductivityAyala = ($totalAreaPlantedAyala > 0) ? $totalRiceProductionAyala / $totalAreaPlantedAyala : 0;

                 // Assuming $personalinformation->date_of_birth contains the date of birth in "YYYY-MM-DD" format
     
            $totalAreaPlanted = FarmProfile::sum('total_physical_area');
            $totalAreaYield = FarmProfile::sum('yield_kg_ha');
            $totalCost= VariableCost::sum('total_variable_cost');
                
            $yieldPerAreaPlanted = ($totalAreaPlantedAyala!= 0) ?  $totalAreaYieldAyala/ $totalAreaPlantedAyala : 0;
            $averageCostPerAreaPlanted = ($totalAreaPlantedAyala != 0) ? $totalVariableCostAyala / $totalAreaPlantedAyala : 0;
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');

            // Return the view with the fetched data
            return view('admin.Agri_district.tumaga_farmer', compact('admin', 'profile', 'farmProfile','FarmersData','totalRiceProduction',
            'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
            'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
            'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
            'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner','countorg'));
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

// culianan rice farmers view by admin
            
public function FarmerCulianansInfo()
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

            // Find the farm profile using the fetched farm ID
            $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();

      

            // Fetch ayala farmers fetching  data
            $FarmersData = DB::table('personal_informations')
            ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
            ->select(
                'personal_informations.*',
                'farm_profiles.*',
                'fixed_costs.*',
                'machineries_useds.*',
                'variable_costs.*',
                'last_production_datas.*'
            )
            ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
            ->get();
            // Specify the agri district you want to filter by
                // Calculate the age for each farmer
                foreach ($FarmersData as $farmer) {
                    // Calculate the age for each farmer
                    $dateOfBirth = $farmer->date_of_birth;
                    $age = Carbon::parse($dateOfBirth)->age;

                    // Add the age to the farmer object
                    $farmer->age = $age;
                }
            // Count the number of farmers in the "ayala" district
            $totalfarms = DB::table('personal_informations')
            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->where('farm_profiles.agri_districts', 'culianan')
            ->distinct()
            ->count('personal_informations.id');

              // Calculate the total area planted in the "culianan" district
            $totalAreaPlantedAyala = DB::table('farm_profiles')
            ->where('agri_districts', 'culianan')
            ->sum('total_physical_area');
            $totalAreaYieldAyala = DB::table('farm_profiles')
            ->where('agri_districts', 'culianan')
            ->sum('yield_kg_ha');
         
             // Calculate the total fixed cost in the "culianan" district
            $totalFixedCostAyala = DB::table('fixed_costs')
            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'fixed_costs.personal_informations_id')
            ->where('farm_profiles.agri_districts', 'culianan')
            ->sum('fixed_costs.total_amount');
            
                  // Calculate the total machineries cost in the "culianan" district
                  $totalMachineriesUsedAyala= DB::table('machineries_useds')
                  ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','machineries_useds.personal_informations_id')
                  ->where('farm_profiles.agri_districts', 'culianan')
                  ->sum('machineries_useds.total_cost_for_machineries');

                // Calculate the total variable cost in the "culianan" district
                $totalVariableCostAyala = DB::table('variable_costs')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','variable_costs.personal_informations_id')
                ->where('farm_profiles.agri_districts', 'culianan')
                ->sum('variable_costs.total_variable_cost');

                    // Calculate the total rice production in the Ayala district
                    $totalRiceProductionAyala = LastProductionDatas::join('farm_profiles', 'last_production_datas.personal_informations_id', '=', 'farm_profiles.personal_informations_id')
                    ->where('farm_profiles.agri_districtS', 'culianan')
                    ->sum('last_production_datas.yield_tons_per_kg');


                              // Count owner tenants
                            $countOwnerTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'culianan')
                            ->where('farm_profiles.tenurial_status', 'owner')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count tiller tenant tenants
                            $countTillerTenantTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'culianan')
                            ->where('farm_profiles.tenurial_status', 'tiller tenant')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count tiller tenants
                            $countTillerTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'culianan')
                            ->where('farm_profiles.tenurial_status', 'tiller')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count lease tenants
                            $countLeaseTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'culianan')
                            ->where('farm_profiles.tenurial_status', 'lease')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');
                        // Count owner tenants
                    $countOwner = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'culianan')
                    ->where('farm_profiles.tenurial_status', 'owner')
                    ->distinct()
                    ->count('farm_profiles.tenurial_status');

                    // total farmers organizattion
                    $countorg = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'culianan')
                    ->distinct('personal_informations.nameof_farmers_ass_org_coop')
                    ->count('personal_informations.nameof_farmers_ass_org_coop');


                // Calculate rice productivity in the Ayala district
                $riceProductivityAyala = ($totalAreaPlantedAyala > 0) ? $totalRiceProductionAyala / $totalAreaPlantedAyala : 0;

                 // Assuming $personalinformation->date_of_birth contains the date of birth in "YYYY-MM-DD" format
     
            $totalAreaPlanted = FarmProfile::sum('total_physical_area');
            $totalAreaYield = FarmProfile::sum('yield_kg_ha');
            $totalCost= VariableCost::sum('total_variable_cost');
                
            $yieldPerAreaPlanted = ($totalAreaPlantedAyala!= 0) ?  $totalAreaYieldAyala/ $totalAreaPlantedAyala : 0;
            $averageCostPerAreaPlanted = ($totalAreaPlantedAyala != 0) ? $totalVariableCostAyala / $totalAreaPlantedAyala : 0;
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');

            // Return the view with the fetched data
            return view('admin.Agri_district.culianan_farmer', compact('admin', 'profile', 'farmProfile','FarmersData','totalRiceProduction',
            'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
            'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
            'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
            'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner','countorg'));
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
        // manicahan famrers info view by admin
        public function FarmerManicahanInfo()
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
        
                    // Find the farm profile using the fetched farm ID
                    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
        
              
        
                    // Fetch ayala farmers fetching  data
                    $FarmersData = DB::table('personal_informations')
                    ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                    ->select(
                        'personal_informations.*',
                        'farm_profiles.*',
                        'fixed_costs.*',
                        'machineries_useds.*',
                        'variable_costs.*',
                        'last_production_datas.*'
                    )
                    ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
                    ->get();
                    // Specify the agri district you want to filter by
                        // Calculate the age for each farmer
                        foreach ($FarmersData as $farmer) {
                            // Calculate the age for each farmer
                            $dateOfBirth = $farmer->date_of_birth;
                            $age = Carbon::parse($dateOfBirth)->age;
        
                            // Add the age to the farmer object
                            $farmer->age = $age;
                        }
                    // Count the number of farmers in the "ayala" district
                    $totalfarms = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'manicahan')
                    ->distinct()
                    ->count('personal_informations.id');
        
                      // Calculate the total area planted in the "manicahan" district
                    $totalAreaPlantedAyala = DB::table('farm_profiles')
                    ->where('agri_districts', 'manicahan')
                    ->sum('total_physical_area');
                    $totalAreaYieldAyala = DB::table('farm_profiles')
                    ->where('agri_districts', 'manicahan')
                    ->sum('yield_kg_ha');
                 
                     // Calculate the total fixed cost in the "manicahan" district
                    $totalFixedCostAyala = DB::table('fixed_costs')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'fixed_costs.personal_informations_id')
                    ->where('farm_profiles.agri_districts', 'manicahan')
                    ->sum('fixed_costs.total_amount');
                    
                          // Calculate the total machineries cost in the "manicahan" district
                          $totalMachineriesUsedAyala= DB::table('machineries_useds')
                          ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','machineries_useds.personal_informations_id')
                          ->where('farm_profiles.agri_districts', 'manicahan')
                          ->sum('machineries_useds.total_cost_for_machineries');
        
                        // Calculate the total variable cost in the "manicahan" district
                        $totalVariableCostAyala = DB::table('variable_costs')
                        ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','variable_costs.personal_informations_id')
                        ->where('farm_profiles.agri_districts', 'manicahan')
                        ->sum('variable_costs.total_variable_cost');
        
                            // Calculate the total rice production in the Ayala district
                            $totalRiceProductionAyala = LastProductionDatas::join('farm_profiles', 'last_production_datas.personal_informations_id', '=', 'farm_profiles.personal_informations_id')
                            ->where('farm_profiles.agri_districtS', 'culianan')
                            ->sum('last_production_datas.yield_tons_per_kg');
        
        
                                      // Count owner tenants
                                    $countOwnerTenants = DB::table('personal_informations')
                                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                    ->where('farm_profiles.agri_districts', 'manicahan')
                                    ->where('farm_profiles.tenurial_status', 'owner')
                                    ->distinct()
                                    ->count('farm_profiles.tenurial_status');
        
                                    // Count tiller tenant tenants
                                    $countTillerTenantTenants = DB::table('personal_informations')
                                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                    ->where('farm_profiles.agri_districts', 'manicahan')
                                    ->where('farm_profiles.tenurial_status', 'tiller tenant')
                                    ->distinct()
                                    ->count('farm_profiles.tenurial_status');
        
                                    // Count tiller tenants
                                    $countTillerTenants = DB::table('personal_informations')
                                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                    ->where('farm_profiles.agri_districts', 'manicahan')
                                    ->where('farm_profiles.tenurial_status', 'tiller')
                                    ->distinct()
                                    ->count('farm_profiles.tenurial_status');
        
                                    // Count lease tenants
                                    $countLeaseTenants = DB::table('personal_informations')
                                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                                    ->where('farm_profiles.agri_districts', 'manicahan')
                                    ->where('farm_profiles.tenurial_status', 'lease')
                                    ->distinct()
                                    ->count('farm_profiles.tenurial_status');
                                // Count owner tenants
                            $countOwner = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'manicahan')
                            ->where('farm_profiles.tenurial_status', 'owner')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');
        
                            // total farmers organizattion
                            $countorg = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'manicahan')
                            ->distinct('personal_informations.nameof_farmers_ass_org_coop')
                            ->count('personal_informations.nameof_farmers_ass_org_coop');
        
        
                        // Calculate rice productivity in the Ayala district
                        $riceProductivityAyala = ($totalAreaPlantedAyala > 0) ? $totalRiceProductionAyala / $totalAreaPlantedAyala : 0;
        
                         // Assuming $personalinformation->date_of_birth contains the date of birth in "YYYY-MM-DD" format
             
                    $totalAreaPlanted = FarmProfile::sum('total_physical_area');
                    $totalAreaYield = FarmProfile::sum('yield_kg_ha');
                    $totalCost= VariableCost::sum('total_variable_cost');
                        
                    $yieldPerAreaPlanted = ($totalAreaPlantedAyala!= 0) ?  $totalAreaYieldAyala/ $totalAreaPlantedAyala : 0;
                    $averageCostPerAreaPlanted = ($totalAreaPlantedAyala != 0) ? $totalVariableCostAyala / $totalAreaPlantedAyala : 0;
                    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        
                    // Return the view with the fetched data
                    return view('admin.Agri_district.manicahan_farmer', compact('admin', 'profile', 'farmProfile','FarmersData','totalRiceProduction',
                    'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
                    'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
                    'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
                    'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner','countorg'));
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
        // curuan farmers info view by admin

        
public function FarmercuruanInfo()
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

            // Find the farm profile using the fetched farm ID
            $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();

      

            // Fetch ayala farmers fetching  data
            $FarmersData = DB::table('personal_informations')
            ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
            ->select(
                'personal_informations.*',
                'farm_profiles.*',
                'fixed_costs.*',
                'machineries_useds.*',
                'variable_costs.*',
                'last_production_datas.*'
            )
            ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
            ->get();
            // Specify the agri district you want to filter by
                // Calculate the age for each farmer
                foreach ($FarmersData as $farmer) {
                    // Calculate the age for each farmer
                    $dateOfBirth = $farmer->date_of_birth;
                    $age = Carbon::parse($dateOfBirth)->age;

                    // Add the age to the farmer object
                    $farmer->age = $age;
                }
            // Count the number of farmers in the "ayala" district
            $totalfarms = DB::table('personal_informations')
            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->where('farm_profiles.agri_districts', 'curuan')
            ->distinct()
            ->count('personal_informations.id');

              // Calculate the total area planted in the "curuan" district
            $totalAreaPlantedAyala = DB::table('farm_profiles')
            ->where('agri_districts', 'curuan')
            ->sum('total_physical_area');
            $totalAreaYieldAyala = DB::table('farm_profiles')
            ->where('agri_districts', 'curuan')
            ->sum('yield_kg_ha');
         
             // Calculate the total fixed cost in the "curuan" district
            $totalFixedCostAyala = DB::table('fixed_costs')
            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'fixed_costs.personal_informations_id')
            ->where('farm_profiles.agri_districts', 'curuan')
            ->sum('fixed_costs.total_amount');
            
                  // Calculate the total machineries cost in the "curuan" district
                  $totalMachineriesUsedAyala= DB::table('machineries_useds')
                  ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','machineries_useds.personal_informations_id')
                  ->where('farm_profiles.agri_districts', 'curuan')
                  ->sum('machineries_useds.total_cost_for_machineries');

                // Calculate the total variable cost in the "curuan" district
                $totalVariableCostAyala = DB::table('variable_costs')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','variable_costs.personal_informations_id')
                ->where('farm_profiles.agri_districts', 'curuan')
                ->sum('variable_costs.total_variable_cost');

                    // Calculate the total rice production in the Ayala district
                    $totalRiceProductionAyala = LastProductionDatas::join('farm_profiles', 'last_production_datas.personal_informations_id', '=', 'farm_profiles.personal_informations_id')
                    ->where('farm_profiles.agri_districtS', 'curuan')
                    ->sum('last_production_datas.yield_tons_per_kg');


                              // Count owner tenants
                            $countOwnerTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'curuan')
                            ->where('farm_profiles.tenurial_status', 'owner')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count tiller tenant tenants
                            $countTillerTenantTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'curuan')
                            ->where('farm_profiles.tenurial_status', 'tiller tenant')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count tiller tenants
                            $countTillerTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'curuan')
                            ->where('farm_profiles.tenurial_status', 'tiller')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count lease tenants
                            $countLeaseTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'curuan')
                            ->where('farm_profiles.tenurial_status', 'lease')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');
                        // Count owner tenants
                    $countOwner = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'curuan')
                    ->where('farm_profiles.tenurial_status', 'owner')
                    ->distinct()
                    ->count('farm_profiles.tenurial_status');

                    // total farmers organizattion
                    $countorg = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'curuan')
                    ->distinct('personal_informations.nameof_farmers_ass_org_coop')
                    ->count('personal_informations.nameof_farmers_ass_org_coop');


                // Calculate rice productivity in the Ayala district
                $riceProductivityAyala = ($totalAreaPlantedAyala > 0) ? $totalRiceProductionAyala / $totalAreaPlantedAyala : 0;

                 // Assuming $personalinformation->date_of_birth contains the date of birth in "YYYY-MM-DD" format
     
            $totalAreaPlanted = FarmProfile::sum('total_physical_area');
            $totalAreaYield = FarmProfile::sum('yield_kg_ha');
            $totalCost= VariableCost::sum('total_variable_cost');
                
            $yieldPerAreaPlanted = ($totalAreaPlantedAyala!= 0) ?  $totalAreaYieldAyala/ $totalAreaPlantedAyala : 0;
            $averageCostPerAreaPlanted = ($totalAreaPlantedAyala != 0) ? $totalVariableCostAyala / $totalAreaPlantedAyala : 0;
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');

            // Return the view with the fetched data
            return view('admin.Agri_district.curuan_farmer', compact('admin', 'profile', 'farmProfile','FarmersData','totalRiceProduction',
            'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
            'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
            'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
            'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner','countorg'));
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
        //vitalifarmers view by users
    
    

public function VitaliInfoFarmer()
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

            // Find the farm profile using the fetched farm ID
            $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();

      

            // Fetch ayala farmers fetching  data
            $FarmersData = DB::table('personal_informations')
            ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
            ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
            ->select(
                'personal_informations.*',
                'farm_profiles.*',
                'fixed_costs.*',
                'machineries_useds.*',
                'variable_costs.*',
                'last_production_datas.*'
            )
            ->orderBy('personal_informations.id', 'desc') // Order by the ID of personal_informations table in descending order
            ->get();
            // Specify the agri district you want to filter by
                // Calculate the age for each farmer
                foreach ($FarmersData as $farmer) {
                    // Calculate the age for each farmer
                    $dateOfBirth = $farmer->date_of_birth;
                    $age = Carbon::parse($dateOfBirth)->age;

                    // Add the age to the farmer object
                    $farmer->age = $age;
                }
            // Count the number of farmers in the "ayala" district
            $totalfarms = DB::table('personal_informations')
            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
            ->where('farm_profiles.agri_districts', 'ayala')
            ->distinct()
            ->count('personal_informations.id');

              // Calculate the total area planted in the "vitali" district
            $totalAreaPlantedAyala = DB::table('farm_profiles')
            ->where('agri_districts', 'vitali')
            ->sum('total_physical_area');
            $totalAreaYieldAyala = DB::table('farm_profiles')
            ->where('agri_districts', 'vitali')
            ->sum('yield_kg_ha');
         
             // Calculate the total fixed cost in the "vitali" district
            $totalFixedCostAyala = DB::table('fixed_costs')
            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'fixed_costs.personal_informations_id')
            ->where('farm_profiles.agri_districts', 'vitali')
            ->sum('fixed_costs.total_amount');
            
                  // Calculate the total machineries cost in the "vitali" district
                  $totalMachineriesUsedAyala= DB::table('machineries_useds')
                  ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','machineries_useds.personal_informations_id')
                  ->where('farm_profiles.agri_districts', 'vitali')
                  ->sum('machineries_useds.total_cost_for_machineries');

                // Calculate the total variable cost in the "vitali" district
                $totalVariableCostAyala = DB::table('variable_costs')
                ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=','variable_costs.personal_informations_id')
                ->where('farm_profiles.agri_districts', 'vitali')
                ->sum('variable_costs.total_variable_cost');

                    // Calculate the total rice production in the Ayala district
                    $totalRiceProductionAyala = LastProductionDatas::join('farm_profiles', 'last_production_datas.personal_informations_id', '=', 'farm_profiles.personal_informations_id')
                    ->where('farm_profiles.agri_districtS', 'vitali')
                    ->sum('last_production_datas.yield_tons_per_kg');


                              // Count owner tenants
                            $countOwnerTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'vitali')
                            ->where('farm_profiles.tenurial_status', 'owner')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count tiller tenant tenants
                            $countTillerTenantTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'vitali')
                            ->where('farm_profiles.tenurial_status', 'tiller tenant')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count tiller tenants
                            $countTillerTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'vitali')
                            ->where('farm_profiles.tenurial_status', 'tiller')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');

                            // Count lease tenants
                            $countLeaseTenants = DB::table('personal_informations')
                            ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                            ->where('farm_profiles.agri_districts', 'vitali')
                            ->where('farm_profiles.tenurial_status', 'lease')
                            ->distinct()
                            ->count('farm_profiles.tenurial_status');
                        // Count owner tenants
                    $countOwner = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'vitali')
                    ->where('farm_profiles.tenurial_status', 'owner')
                    ->distinct()
                    ->count('farm_profiles.tenurial_status');

                    // total farmers organizattion
                    $countorg = DB::table('personal_informations')
                    ->join('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                    ->where('farm_profiles.agri_districts', 'vitali')
                    ->distinct('personal_informations.nameof_farmers_ass_org_coop')
                    ->count('personal_informations.nameof_farmers_ass_org_coop');


                // Calculate rice productivity in the Ayala district
                $riceProductivityAyala = ($totalAreaPlantedAyala > 0) ? $totalRiceProductionAyala / $totalAreaPlantedAyala : 0;

                 // Assuming $personalinformation->date_of_birth contains the date of birth in "YYYY-MM-DD" format
     
            $totalAreaPlanted = FarmProfile::sum('total_physical_area');
            $totalAreaYield = FarmProfile::sum('yield_kg_ha');
            $totalCost= VariableCost::sum('total_variable_cost');
                
            $yieldPerAreaPlanted = ($totalAreaPlantedAyala!= 0) ?  $totalAreaYieldAyala/ $totalAreaPlantedAyala : 0;
            $averageCostPerAreaPlanted = ($totalAreaPlantedAyala != 0) ? $totalVariableCostAyala / $totalAreaPlantedAyala : 0;
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');

            // Return the view with the fetched data
            return view('admin.Agri_district.vitali_farmer', compact('admin', 'profile', 'farmProfile','FarmersData','totalRiceProduction',
            'totalfarms','totalAreaPlantedAyala','totalAreaYieldAyala',
            'totalFixedCostAyala','totalCost','yieldPerAreaPlanted','averageCostPerAreaPlanted',
            'totalMachineriesUsedAyala','totalVariableCostAyala','riceProductivityAyala',
            'countOwnerTenants','countTillerTenantTenants','countTillerTenants','countLeaseTenants','countOwner','countorg'));
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


    // crop varietys per agri district access by admin

    // rice varieties per agri-district view by admin
    
public function FarmersRiceVarietyDistrict()
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

            // Find the farm profile using the fetched farm ID
            $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();

      

            // Fetch inbred variety data
            $inbredData = DB::table('personal_informations')
                ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.agri_district',
                    'farm_profiles.type_rice_variety',
                    'farm_profiles.prefered_variety'
                )
                ->orderBy('personal_informations.agri_district')
                ->get();

            // Group the data by district
            $InbredInfo = [];
            foreach ($inbredData as $data) {
                $typeVariety = $data->type_rice_variety;
                $preferedVariety = $data->prefered_variety;

                // If type of variety is "N/A", use preferred variety
                if (strtolower($typeVariety) === 'n/a' || strtolower($typeVariety) === 'na') {
                    $variety = $preferedVariety;
                } else {
                    $variety = $typeVariety;
                }

                if (!isset($InbredInfo[$data->agri_district][$variety])) {
                    $InbredInfo[$data->agri_district][$variety] = ['count' => 0, 'percentage' => 0];
                }

                $InbredInfo[$data->agri_district][$variety]['count']++;
            }

            // Calculate percentage for each rice variety in each district
            foreach ($InbredInfo as $district => &$varieties) {
                $totalRiceVarietiesInDistrict = array_sum(array_column($varieties, 'count'));
                foreach ($varieties as &$data) {
                    $percentage = ($totalRiceVarietiesInDistrict > 0) ? ($data['count'] / $totalRiceVarietiesInDistrict) * 100 : 0;
                    $data['percentage'] = number_format($percentage, 2);
                }
            }
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('admin.rice_varieties.rice_varietydistrict', compact('admin', 'profile', 'farmProfile', 'InbredInfo','totalRiceProduction'));
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

    public function Plantingschedrice(){
        try {
            $farmersData = DB::table('personal_informations')
                ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.agri_district',
                    'last_production_datas.date_planted',
                    'farm_profiles.*',
                    'personal_informations.last_name',
                    'personal_informations.first_name',
                    'farm_profiles.type_rice_variety',
                    'farm_profiles.prefered_variety',
                )
                ->orderBy('personal_informations.agri_district')
                ->get();
    
            // Group the data by district
            $plantingSchedule = [];
            foreach ($farmersData as $data) {
                $plantingSchedule[$data->agri_district][] = [
                    'last_name' => $data->last_name,
                    'first_name' => $data->first_name,
                    'date_planted' => $data->date_planted,
                    'type_rice_variety' => $data->type_rice_variety,
                    'prefered_variety' => $data->prefered_variety,
                ];
            }
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            return view('admin.rice_schedule.rice_planting', compact('plantingSchedule','totalRiceProduction'));
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            dd($ex);
            return redirect()->back()->with('message', 'Something went wrong');
        }
       
    }

    

    // rice harvest
    public function HarvestSchedRices(){
        try {
            $harvestData = DB::table('personal_informations')
            ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                ->select(
                    'personal_informations.agri_district',
                    'personal_informations.last_name',
                    'personal_informations.first_name',
                    'last_production_datas.date_harvested',
                    'farm_profiles.type_rice_variety',
                    'farm_profiles.prefered_variety',
                    
                )
                ->orderBy('personal_informations.agri_district')
                ->get();
    
            // Group the data by district
            $harvestSchedule = [];
            foreach ($harvestData as $data) {
                $harvestSchedule[$data->agri_district][] = [
                    'last_name' => $data->last_name,
                    'first_name' => $data->first_name,
                    'date_harvested' => $data->date_harvested,
                    'type_rice_variety' => $data->type_rice_variety,
                    'prefered_variety' => $data->prefered_variety,
                ];
            }
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            return view('admin.rice_schedule.rice_harvest', compact('harvestSchedule','totalRiceProduction'));
        } catch (\Exception $ex) {
            // Log the exception for debugging purposes
            dd($ex);
            return redirect()->back()->with('message', 'Something went wrong');
        }
        
    }

    // crop production per district
   
    public function ProductionperRice()
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
    
                // Find the farm profile using the fetched farm ID
                $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
    
          
    
                // Fetch last production data  farmers fetching  data
                $riceProductionData = DB::table('personal_informations')
                ->leftJoin('farm_profiles', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('fixed_costs', 'fixed_costs.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('machineries_useds', 'machineries_useds.personal_informations_id', '=', 'personal_informations.id')
                ->leftJoin('variable_costs', 'variable_costs.personal_informations_id', '=', 'personal_informations.id')
                    ->leftJoin('last_production_datas', 'last_production_datas.personal_informations_id', '=', 'personal_informations.id')
                    ->select(
                        'personal_informations.*',
                        'farm_profiles.*',
                        'fixed_costs.*',
                        'machineries_useds.*',
                        'variable_costs.*',
                        'personal_informations.agri_district',
                
                        'personal_informations.last_name',
                        'personal_informations.first_name',
                        'last_production_datas.date_planted',
                        'last_production_datas.date_harvested',
                        'last_production_datas.yield_tons_per_kg',
                        'last_production_datas.unit_price_palay_per_kg',
                        'last_production_datas.unit_price_rice_per_kg',
                        'last_production_datas.gross_income_palay',
                        'last_production_datas.gross_income_rice',
                        'last_production_datas.type_of_product'
                    )
                    // ->where('last_production_datas.type_of_product', 'rice',) // Filter for rice production only
                    ->orderBy('personal_informations.agri_district')
                    ->get();
        
                // Group the data by district
                $riceProductionSchedule = [];
                foreach ($riceProductionData as $data) {
                    $riceProductionSchedule[$data->agri_district][] = [
                        'last_name' => $data->last_name,
                        'first_name' => $data->first_name,
                        'date_planted' => $data->date_planted,
                        'date_harvested' => $data->date_harvested,
                        'yield_tons_per_kg' => $data->yield_tons_per_kg,
                        'unit_price_palay_per_kg' => $data->unit_price_palay_per_kg,
                        'unit_price_rice_per_kg' => $data->unit_price_rice_per_kg,
                        'gross_income_palay' => $data->gross_income_palay,
                        'gross_income_rice' => $data->gross_income_rice,
                        'type_of_product' => $data->type_of_product
                    ];
                }
                 // Initialize an array to store total rice production per district
            $totalRiceProductionPerDistrict = [];

            // Group the data by district and calculate total rice production per district
            foreach ($riceProductionData as $data) {
                $district = $data->agri_district;
                $riceProduction = $data->yield_tons_per_kg;

                // If the district is not already in the array, initialize it with the rice production
                if (!isset($totalRiceProductionPerDistrict[$district])) {
                    $totalRiceProductionPerDistrict[$district] = $riceProduction;
                } else {
                    // If the district is already in the array, add the rice production to the existing total
                    $totalRiceProductionPerDistrict[$district] += $riceProduction;
                }
            }
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                // Return the view with the fetched data
                return view('admin.crop_production.rice_crops', compact('admin', 'profile', 'farmProfile','totalRiceProduction',
               'riceProductionSchedule','totalRiceProductionPerDistrict'
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
    
    // multiple of data to database
    public function ExcelFile()
{
    // Check if the user is authenticated
    if (Auth::check()) {
        // User is authenticated, proceed with retrieving the user's ID
        $userId = Auth::id();

        // Find the user based on the retrieved ID
        $agent = User::find($userId);

        if ($agent) {
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

            // Find the farm profile using the fetched farm ID
            $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();

      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('agent.mutipleFile.import_excelFile', compact('agent', 'profile', 'farmProfile','totalRiceProduction'
            
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
    // farmers report
    // public function FarmersReport(){
    //     $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    //     return view
    // }


        // admin view corn map farmers
        public function CornMap(){
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

            // Find the farm profile using the fetched farm ID
            $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();

      

            
            $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
            // Return the view with the fetched data
            return view('map.cornmap', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
            ,'userId'));
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

   // admin view coconut map farmers
   public function CoconutMap(){
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

    // Find the farm profile using the fetched farm ID
    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();



    
    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    // Return the view with the fetched data
    return view('map.coconutmap', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
    
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


   // admin view Chicken map farmers
   public function ChickenMap(){
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

    // Find the farm profile using the fetched farm ID
    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();



    
    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    // Return the view with the fetched data
    return view('map.chickenmap', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
    
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

   // admin view Hogs map farmers
   public function HogsMap(){
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

    // Find the farm profile using the fetched farm ID
    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();



    
    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    // Return the view with the fetched data
    return view('map.hogsmap', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
    
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


        // ADMIN CORN
          // admin view CORN REPORT/AGRIDISTRICT
   public function ayalaCorn(){
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

    // Find the farm profile using the fetched farm ID
    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();



    
    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    // Return the view with the fetched data
    return view('admin.corn.districtreport.ayala', compact('admin','userId', 'profile', 'farmProfile','totalRiceProduction'
    
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

        // admin view forms
              // ADMIN CORN
          // admin view CORN REPORT/AGRIDISTRICT
   public function CornForm(){
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

    // Find the farm profile using the fetched farm ID
    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();



    
    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
    // Return the view with the fetched data
    return view('admin.corn.forms.corn_form', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
    ,'userId'));
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





// // corn saving farmers info
// public function CornSave(Request $request)
//     {
      
//         try{
        
//           // Access the primary key of the PersonalInformations model instance

//     $existingPersonalInformations = PersonalInformations::where([
//         ['first_name', '=', $request->input('first_name')],
//         ['middle_name', '=', $request->input('middle_name')],
//         ['last_name', '=', $request->input('last_name')],
       
       
    
      
//         // Add other fields here
//     ])->first();
    
//     if ($existingPersonalInformations) {
//         // FarmProfile with the given personal_informations_id and other fields already exists
//         // You can handle this scenario here, for example, return an error message
//         return redirect('/add-personal-info')->with('error', 'Farm Profile with this information already exists.');
//     }
    
//     // $personalInformation= $request->validated();
//     // $personalInformation= $request->all();
//            $personalInformation= new PersonalInformations;
//         //    dd($request->all());
     
//   // Check if a file is present in the request and if it's valid
// if ($request->hasFile('image') && $request->file('image')->isValid()) {
//     // Retrieve the image file from the request
//     $image = $request->file('image');
    
//     // Generate a unique image name using current timestamp and file extension
//     $imagename = time() . '.' . $image->getClientOriginalExtension();
    
//     // Move the uploaded image to the 'personalInfoimages' directory with the generated name
//     $image->move('personalInfoimages', $imagename);
    
//     // Set the image name in the PersonalInformation model
//     $personalInformation->image = $imagename;
// } 
//             $personalInformation->users_id =$request->users_id;
//             $personalInformation->first_name= $request->first_name;
//             $personalInformation->middle_name= $request->middle_name;
//             $personalInformation->last_name=  $request->last_name;

//             if ($request->extension_name === 'others') {
//                 $personalInformation->extension_name = $request->add_extName; // Use the value entered in the "add_extenstion name" input field
//            } else {
//                 $personalInformation->extension_name = $request->extension_name; // Use the selected color from the dropdown
//            }
//             $personalInformation->country=  $request->country;
//             $personalInformation->province=  $request->province;
//             $personalInformation->city=  $request->city;
//             $personalInformation->agri_district=  $request->agri_district;
//             $personalInformation->barangay=  $request->barangay;
            
//              $personalInformation->home_address=  $request->home_address;
//              $personalInformation->sex=  $request->sex;

//              if ($request->religion=== 'other') {
//                 $personalInformation->religion= $request->add_Religion; // Use the value entered in the "religion" input field
//            } else {
//                 $personalInformation->religion= $request->religion; // Use the selected religion from the dropdown
//            }
//              $personalInformation->date_of_birth=  $request->date_of_birth;
            
//              if ($request->place_of_birth=== 'Add Place of Birth') {
//                 $personalInformation->place_of_birth= $request->add_PlaceBirth; // Use the value entered in the "place_of_birth" input field
//            } else {
//                 $personalInformation->place_of_birth= $request->place_of_birth; // Use the selected place_of_birth from the dropdown
//            }
//              $personalInformation->contact_no=  $request->contact_no;
//              $personalInformation->civil_status=  $request->civil_status;
//              $personalInformation->name_legal_spouse=  $request->name_legal_spouse;

//              if ($request->no_of_children=== 'Add') {
//                 $personalInformation->no_of_children= $request->add_noChildren; // Use the value entered in the "no_of_children" input field
//                 } else {
//                         $personalInformation->no_of_children= $request->no_of_children; // Use the selected no_of_children from the dropdown
//                 }
    
//              $personalInformation->mothers_maiden_name=  $request->mothers_maiden_name;
//              if ($request->highest_formal_education=== 'Other') {
//                 $personalInformation->highest_formal_education= $request->add_formEduc; // Use the value entered in the "highest_formal_education" input field
//                 } else {
//                         $personalInformation->highest_formal_education= $request->highest_formal_education; // Use the selected highest_formal_education from the dropdown
//                 }
//              $personalInformation->person_with_disability=  $request->person_with_disability;
//              $personalInformation->pwd_id_no=  $request->pwd_id_no;
//              $personalInformation->government_issued_id=  $request->government_issued_id;
//              $personalInformation->id_type=  $request->id_type;
//              $personalInformation->gov_id_no=  $request->gov_id_no;
//              $personalInformation->member_ofany_farmers_ass_org_coop=  $request->member_ofany_farmers_ass_org_coop;
             
//              if ($request->nameof_farmers_ass_org_coop === 'add') {
//                 $personalInformation->nameof_farmers_ass_org_coop = $request->add_FarmersGroup; // Use the value entered in the "add_extenstion name" input field
//            } else {
//                 $personalInformation->nameof_farmers_ass_org_coop = $request->nameof_farmers_ass_org_coop; // Use the selected color from the dropdown
//            }
//              $personalInformation->name_contact_person=  $request->name_contact_person;
      
//              $personalInformation->cp_tel_no=  $request->cp_tel_no;
//              $personalInformation->date_interview=  $request->date_interview;
//              $personalInformation->crop_type=  $request->crop_type;
//              $personalInformation->livestock_type=  $request->livestock_type;


        
//             dd($personalInformation);
//              $personalInformation->save();
//             return redirect('/admin-view-forms')->with('message',' Corn Personal informations Added successsfully');
        
//         }
//         catch(\Exception $ex){
//             // dd($ex); // Debugging statement to inspect the exception
//             return redirect('/admin-view-forms')->with('message','Please Try Again');
            
//         }   
        
// } 




public function CornSave(Request $request)
{
    $personalInformation = new PersonalInformations([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
    ]);
    $personalInformation->save();

    $farmProfile = new FarmProfile([
        'personal_information_id' => $personalInformation->id,
        'farm_name' => $request->input('farm_name'),
        'location' => $request->input('location'),
    ]);
    $farmProfile->save();;

 
        // Log::error('Error saving form data: ' . $e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' );
    }



    // patials form steps
     // farmers informations
     public function Getforms(){
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

        // Find the farm profile using the fetched farm ID
        $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();



        
        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
        // Return the view with the fetched data
        return view('admin.corn.forms.partials.forms-steps', compact('admin','userId' ,'profile', 'farmProfile','totalRiceProduction'
        
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



            // farmers informations
            public function FarmerInformations(){
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

                // Find the farm profile using the fetched farm ID
                $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();



                
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                // Return the view with the fetched data
                return view('admin.corn.farmersInfo.information', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
                
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

            
            // farmers informations
            public function Varieties(){
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

                // Find the farm profile using the fetched farm ID
                $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();

               

                
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                // Return the view with the fetched data
                return view('admin.corn.variety.varieties', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
                
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
            // admin view production
            public function Productions(){
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

                // Find the farm profile using the fetched farm ID
                $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();



                
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                // Return the view with the fetched data
                return view('admin.corn.production.reportsproduce', compact('admin', 'profile', 'farmProfile','totalRiceProduction'
                
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



            // barangay form add access by admin

            public function barangayForm(){
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
            
                // Find the farm profile using the fetched farm ID
                $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
                $agriDistrict = AgriDistrict::all();
            
            
                
                $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                // Return the view with the fetched data
                return view('admin.barangay.add_form', compact('agriDistrict' ,'userId','admin', 'profile', 'farmProfile','totalRiceProduction'
                ,'userId'));
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


            public function newBarangay(Request $request)
            {
                try{
                
                    // $data= $request->validated([]);
                    // $data= $request->all();
        
                    
                    $barangay= new Barangay;
                    $barangay->users_id = $request->users_id;
                    $barangay->agri_districts_id =$request->agri_districts_id ;
                    $barangay->barangay_name =$request->barangay_name;
                   
                    // $barangay->altitude =$request->altitude;
                    // dd($barangay);
                    $barangay->save();
                    return redirect('/admin-view-barangays')->with('message','barangay added successsfully');
                
                }
                catch(\Exception $ex){
                    dd($ex); // Debugging statement to inspect the exception
                    return redirect('/admin-view-barangays')->with('message','Someting went wrong');
                    
                }   
            }



                 // view barangay form access by admin

                 public function viewBaranagay(Request $request){
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
                
                    // Find the farm profile using the fetched farm ID
                    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
                // Query for labors with search functionality
                $barangaysQuery = Barangay::query();
                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $barangaysQuery->where(function($query) use ($searchTerm) {
                        $query->where('no_of_person', 'like', "%$searchTerm%")
                            ->orWhere('total_labor_cost', 'like', "%$searchTerm%")
                            ->orWhere('rate_per_person', 'like', "%$searchTerm%");
                    });
                }
                $barangays = $barangaysQuery->orderBy('id','asc')->paginate(10);
                // $productions = LastProductionDatas::with('personalinformation', 'farmprofile','agridistrict')
                // ->orderBy('id', 'asc');
                
                $agriDistrict = AgriDistrict::all();
                    
                    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                    // Return the view with the fetched data
                    return view('admin.barangay.view_forms', compact('agriDistrict','barangays','userId','admin', 'profile', 'farmProfile','totalRiceProduction'
                    ,'userId'));
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


                    // view barangay form access by admin

                    public function EditBrgy($id){
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
                    
                        // Find the farm profile using the fetched farm ID
                        $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
                        
                    
                        $barangay= Barangay::find($id);
                        $agriDistrict = AgriDistrict::all();
                        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                        // Return the view with the fetched data
                        return view('admin.barangay.edit_barangay', compact('agriDistrict','barangay','userId','admin', 'profile', 'farmProfile','totalRiceProduction'
                        ,'userId'));
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

                    public function updateBarangay(Request $request,$id)
                    {
                        try{
                        
                            // $data= $request->validated([]);
                            // $data= $request->all();
                
                            
                            $barangay= Barangay::find($id);
                            $barangay->users_id = $request->users_id;
                            $barangay->agri_districts_id =$request->agri_districts_id ;
                            $barangay->barangay_name =$request->barangay_name;
                           
                            // $barangay->altitude =$request->altitude;
                            // dd($barangay);
                            $barangay->save();
                            return redirect('/admin-view-barangays')->with('message','barangay updated successsfully');
                        
                        }
                        catch(\Exception $ex){
                            dd($ex); // Debugging statement to inspect the exception
                            return redirect('/admin-view-barangays')->with('message','Someting went wrong');
                            
                        }   
                    }
                    // delete baranay here below 
                    public function destroy(string $id)
                    {
                        try {
                            $barangay = Barangay::where('id', $id);
                        
                            if ($barangay) {
                                $barangay->delete();
                                return redirect()->route('admin.barangay.view_forms')
                                                 ->with('message', 'barangay data deleted successfully');
                            } else {
                                return redirect()->route('admin.barangay.view_forms')
                                                 ->with('message', 'barangay data not found');
                            }
                        } catch (\Exception $e) {
                            return redirect()->route('admin.barangay.view_forms')
                                             ->with('message', 'Error deleting barangay data : ' . $e->getMessage());
                        }
                    }
                    // end barangay



                        // view farmers org access by admin

                 public function addFamerOrg(){
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
                
                    // Find the farm profile using the fetched farm ID
                    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
                
                
                
                    $agriDistrict = AgriDistrict::all();
                    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                    // Return the view with the fetched data
                    return view('admin.farmerOrg.add_org', compact('agriDistrict','userId','admin', 'profile', 'farmProfile','totalRiceProduction'
                    ,'userId'));
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


                public function saveFarmerOrg(Request $request
                )
                {
                    try{
                    
                        // $data= $request->validated([]);
                        // $data= $request->all();
            
                        
                        $barangay= new FarmerOrg;
                        $barangay->users_id = $request->users_id;
                        $barangay->agri_districts_id =$request->agri_districts_id;
                        $barangay->org_name =$request->org_name;
                       
                        // $barangay->altitude =$request->altitude;
                        // dd($barangay);
                        $barangay->save();
                        return redirect('/admin-view-farmer-org')->with('message','Farmer Organization updated successsfully');
                    
                    }
                    catch(\Exception $ex){
                        dd($ex); // Debugging statement to inspect the exception
                        return redirect('/admin-view-farmer-org')->with('message','Someting went wrong');
                        
                    }   
                }

                    // view farmers org form access by admin

                    public function viewfarmersOrg(Request $request){
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
                    
                        // Find the farm profile using the fetched farm ID
                        $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
                    
                        $FarmerOrgQuery = FarmerOrg::query();
                        if ($request->has('search')) {
                            $searchTerm = $request->input('search');
                            $FarmerOrgQuery->where(function($query) use ($searchTerm) {
                                $query->where('no_of_person', 'like', "%$searchTerm%")
                                    ->orWhere('total_labor_cost', 'like', "%$searchTerm%")
                                    ->orWhere('rate_per_person', 'like', "%$searchTerm%");
                            });
                        }
                        $FarmerOrg = $FarmerOrgQuery->orderBy('id','asc')->paginate(10);
                    
                        
                        $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                        // Return the view with the fetched data
                        return view('admin.farmerOrg.view_orgs', compact('FarmerOrg','userId','admin', 'profile', 'farmProfile','totalRiceProduction'
                        ,'userId'));
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


                        // view barangay form access by admin

                 public function EditOrg($id){
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
                
                    // Find the farm profile using the fetched farm ID
                    $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
                
                    $farmerOrg = FarmerOrg::find($id);
                    $agriDistrict = AgriDistrict::all();
                    
                    $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                    // Return the view with the fetched data
                    return view('admin.farmerOrg.edit_org', compact('farmerOrg','userId','admin', 'profile', 
                    'farmProfile','totalRiceProduction','agriDistrict'
                    ,'userId'));
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

                
                public function updateFarmerOrg(Request $request,$id
                )
                {
                    try{
                    
                        // $data= $request->validated([]);
                        // $data= $request->all();
            
                        
                        $barangay= FarmerOrg::find($id);
                        $barangay->users_id = $request->users_id;
                        $barangay->agri_districts_id =$request->agri_districts_id;
                        $barangay->org_name =$request->org_name;
                       
                        // $barangay->altitude =$request->altitude;
                        // dd($barangay);
                        $barangay->save();
                        return redirect('/admin-view-farmer-org')->with('message','Farmer Organization updated successsfully');
                    
                    }
                    catch(\Exception $ex){
                        dd($ex); // Debugging statement to inspect the exception
                        return redirect('/admin-view-farmer-org')->with('message','Someting went wrong');
                        
                    }   
                }

                // public function GenFarmers(){
                //     // Check if the user is authenticated
                // if (Auth::check()) {
                // // User is authenticated, proceed with retrieving the user's ID
                // $userId = Auth::id();
                
                // // Find the user based on the retrieved ID
                // $admin = User::find($userId);
                
                // if ($admin) {
                //     // Assuming $user represents the currently logged-in user
                //     $user = auth()->user();
                
                //     // Check if user is authenticated before proceeding
                //     if (!$user) {
                //         // Handle unauthenticated user, for example, redirect them to login
                //         return redirect()->route('login');
                //     }
                
                //     // Find the user's personal information by their ID
                //     $profile = PersonalInformations::where('users_id', $userId)->latest()->first();
                
                //     // Fetch the farm ID associated with the user
                //     $farmId = $user->farm_id;
                
                //     // Find the farm profile using the fetched farm ID
                //     $farmProfile = FarmProfile::where('id', $farmId)->latest()->first();
                
               
                //     $agriDistrict = AgriDistrict::all();
                    
                //     $totalRiceProduction = LastProductionDatas::sum('yield_tons_per_kg');
                //     // Return the view with the fetched data
                //     return view('admin.farmersdata.genfarmers', compact('userId','admin', 'profile', 
                //     'farmProfile','totalRiceProduction','agriDistrict'
                //     ,'userId'));
                // } else {
                //     // Handle the case where the user is not found
                //     // You can redirect the user or display an error message
                //     return redirect()->route('login')->with('error', 'User not found.');
                // }
                // } else {
                // // Handle the case where the user is not authenticated
                // // Redirect the user to the login page
                // return redirect()->route('login');
                // }
                // }

                



        // view the personalinfo by admin
        public function GenFarmers(Request $request)
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
        
                    // Fetch all personal information
                    $personalinfos = PersonalInformations::orderBy('id', 'asc');
        
                    // Search functionality
                    if ($request->has('search')) {
                        $keyword = $request->input('search');
                        $personalinfos->where(function ($query) use ($keyword) {
                            $query->where('last_name', 'like', "%$keyword%")
                                  ->orWhere('first_name', 'like', "%$keyword%");
                            // Add more search filters as needed
                        });
                    }
        
                    // Paginate the results
                    $personalinfos = $personalinfos->paginate(4);

                     // Fetch all farm profiles with their associated personal information and agricultural districts
                        $farmProfiles = FarmProfile::select('farm_profiles.*')
                        ->leftJoin('personal_informations', 'farm_profiles.personal_informations_id', '=', 'personal_informations.id')
                        ->with('agriDistrict')
                        ->orderBy('farm_profiles.id', 'asc');

                    // Check if a search query is provided
                    if ($request->has('search')) {
                        $keyword = $request->input('search');
                        // Apply search filters for last name and first name
                        $farmProfiles->where(function ($query) use ($keyword) {
                            $query->where('personal_informations.last_name', 'like', "%$keyword%")
                                ->orWhere('personal_informations.first_name', 'like', "%$keyword%");
                        });
                    }

                    // Paginate the results
                    $farmProfiles = $farmProfiles->paginate(20);

                      // Query for fixed costs with eager loading of related models
                    $fixedcosts = FixedCost::with('personalinformation', 'farmprofile')
                    ->orderBy('id', 'asc');

                    // Apply search functionality
                    if ($request->has('search')) {
                        $keyword = $request->input('search');
                        $fixedcosts->where(function ($query) use ($keyword) {
                            $query->whereHas('personalinformation', function ($query) use ($keyword) {
                                $query->where('last_name', 'like', "%$keyword%")
                                    ->orWhere('first_name', 'like', "%$keyword%");
                            });
                        });
                    }

                    // Paginate the results
                    $fixedcosts = $fixedcosts->paginate(20);

                      // Query for fixed costs with eager loading of related models
                            $machineries = MachineriesUseds::with('personalinformation', 'farmprofile')
                            ->orderBy('id', 'asc');

                        // Apply search functionality
                        if ($request->has('search')) {
                            $keyword = $request->input('search');
                            $machineries->where(function ($query) use ($keyword) {
                                $query->whereHas('personalinformation', function ($query) use ($keyword) {
                                    $query->where('last_name', 'like', "%$keyword%")
                                        ->orWhere('first_name', 'like', "%$keyword%");
                                });
                            });
                        }

                        // Paginate the results
                        $machineries = $machineries->paginate(20);

                            // Query for variable cost with search functionality
                                $variable = VariableCost::with('personalinformation', 'farmprofile','seeds','labors','fertilizers','pesticides','transports')
                                ->orderBy('id', 'asc');
                
                            // Apply search functionality
                            if ($request->has('search')) {
                                $keyword = $request->input('search');
                                $variable->where(function ($query) use ($keyword) {
                                    $query->whereHas('personalinformation', function ($query) use ($keyword) {
                                        $query->where('last_name', 'like', "%$keyword%")
                                            ->orWhere('first_name', 'like', "%$keyword%");
                                    });
                                });
                            }
                
                            // Paginate the results
                            $variable = $variable->paginate(20);

                            // Query for fixed costs with eager loading of related models


                            $productions = LastProductionDatas::with('personalinformation', 'farmprofile','agridistrict')
                            ->orderBy('id', 'asc');

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
                    return view('admin.farmersdata.genfarmers', compact('admin', 'profile', 'personalinfos','farmProfiles','fixedcosts','machineries','variable','productions','totalRiceProduction'));
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
