<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use Illuminate\Http\Request;
use App\Http\Requests\ParcellaryBoundariesRequest;
use App\Http\Requests\RegisterRequest;

use App\Models\FarmProfile;
use App\Models\Fertilizer;
use App\Models\FixedCost;
use App\Models\Labor;
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
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function LandingPage()
    {
      
        return view('landing-page.page');
    }


    
    public function addHomepage(){
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
        return view('landing-page.add_homepage', compact('userId','admin', 'profile', 'farmProfile','totalRiceProduction'
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
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
   
     public function viewHomepage(){
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
        return view('landing-page.view_homepage', compact('userId','admin', 'profile', 'farmProfile','totalRiceProduction'
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


    /**
     * Show the form for editing the specified resource.
     */
   
     public function editHomepage(){
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
        return view('landing-page.edit_homepage', compact('userId','admin', 'profile', 'farmProfile','totalRiceProduction'
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
