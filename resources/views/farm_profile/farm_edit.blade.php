@extends('admin.dashb')

@section('admin')
    @extends('layouts._footer-script')
    @extends('layouts._head')
    
    
 
<div class="page-content">
    <div class="card-forms border rounded">

    
        <div class="card-forms border rounded">

            <div class="card-body">
              
              <div class="content">
                <form id="multiStepForm" action{{url('PersonalInfoUpdate')}}   method="post">
                    @csrf
        

                    <!-- Step 2: Farm Profile -->
                    <div class="step active" id="step2">
                        <h2>Step 2: Farm Profile</h2>
                        <div id="farmProfiles">
                            <!-- Sample Farm Profile -->
                            <div class="user-details">
                                <div class="input-box">
                                    <label for="tenurial_status_0">Tenurial Status:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][tenurial_status]" id="tenurial_status_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="rice_farm_address_0">- Address:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][rice_farm_address]" id="rice_farm_address_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="no_of_years_as_farmers_0">Number of Years as Farmer:</label>
                                    <input type="number" class="form-control" name="farm_profiles[0][no_of_years_as_farmers]" id="no_of_years_as_farmers_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="gps_longitude_0">GPS Longitude:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][gps_longitude]" id="gps_longitude_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="gps_latitude_0">GPS Latitude:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][gps_latitude]" id="gps_latitude_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="total_physical_area_has_0">Total Physical Area (has):</label>
                                    <input type="number" class="form-control" name="farm_profiles[0][total_physical_area_has]" id="total_physical_area_has_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="rice_area_cultivated_has_0">Rice Area Cultivated (has):</label>
                                    <input type="number" class="form-control" name="farm_profiles[0][rice_area_cultivated_has]" id="rice_area_cultivated_has_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="land_title_no_0">Land Title No:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][land_title_no]" id="land_title_no_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="lot_no_0">Lot No:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][lot_no]" id="lot_no_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="area_prone_to_0">Area Prone To:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][area_prone_to]" id="area_prone_to_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="ecosystem_0">Ecosystem:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][ecosystem]" id="ecosystem_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="rsba_register_0">RSBA Register:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][rsba_register]" id="rsba_register_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="pcic_insured_0">PCIC Insured:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][pcic_insured]" id="pcic_insured_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="government_assisted_0">Government Assisted:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][government_assisted]" id="government_assisted_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="source_of_capital_0">Source of Capital:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][source_of_capital]" id="source_of_capital_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="remarks_recommendation_0">Remarks/Recommendation:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][remarks_recommendation]" id="remarks_recommendation_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="oca_district_office_0">OCA District Office:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][oca_district_office]" id="oca_district_office_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="name_technicians_0">Name of Technicians:</label>
                                    <input type="text" class="form-control" name="farm_profiles[0][name_technicians]" id="name_technicians_0" required>
                                </div>
                                <div class="input-box">
                                    <label for="date_interview_0">Date of Interview:</label>
                                    <input type="date" class="form-control" name="farm_profiles[0][date_interview]" id="date_interview_0" required>
                                </div>
                    
                                <div id="cropFarms_0">
                                    <div class="user-details">
                                        <div class="input-box">
                                            <label for="crop_type_0_0">Crop Type:</label>
                                            <input type="text" class="form-control" name="farm_profiles[0][crop_farms][0][crop_type]" id="crop_type_0_0" required>
                                        </div>
                                        <div class="input-box">
                                            <label for="crop_area_0_0">Crop Area:</label>
                                            <input type="number" class="form-control" name="farm_profiles[0][crop_farms][0][crop_area]" id="crop_area_0_0" required>
                                        </div>
                                        <div class="input-box">
                                            <label for="type_rice_variety_0_0">Rice Variety Type:</label>
                                            <input type="text" class="form-control" name="farm_profiles[0][crop_farms][0][type_rice_variety]" id="type_rice_variety_0_0" required>
                                        </div>
                                        <div class="input-box">
                                            <label for="prefered_variety_0_0">Preferred Variety:</label>
                                            <input type="text" class="form-control" name="farm_profiles[0][crop_farms][0][prefered_variety]" id="prefered_variety_0_0" required>
                                        </div>
                                        <div class="input-box">
                                            <label for="plant_schedule_wetseason_0_0">Plant Schedule (Wet Season):</label>
                                            <input type="text" class="form-control" name="farm_profiles[0][crop_farms][0][plant_schedule_wetseason]" id="plant_schedule_wetseason_0_0" required>
                                        </div>
                                        <div class="input-box">
                                            <label for="plant_schedule_dryseason_0_0">Plant Schedule (Dry Season):</label>
                                            <input type="text" class="form-control" name="farm_profiles[0][crop_farms][0][plant_schedule_dryseason]" id="plant_schedule_dryseason_0_0" required>
                                        </div>
                                        <div class="input-box">
                                            <label for="no_of_cropping_yr_0_0">Number of Cropping Years:</label>
                                            <input type="number" class="form-control" name="farm_profiles[0][crop_farms][0][no_of_cropping_yr]" id="no_of_cropping_yr_0_0" required>
                                        </div>
                                        <div class="input-box">
                                            <label for="yield_kg_ha_0_0">Yield (kg/ha):</label>
                                            <input type="number" class="form-control" name="farm_profiles[0][crop_farms][0][yield_kg_ha]" id="yield_kg_ha_0_0" required>
                                        </div>
                                        <!-- Add other fields as needed -->
                                        <button type="button" class="btn btn-danger" onclick="removeCropFarm(0, 0)">Remove Crop Farm</button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary" onclick="addCropFarm(0)">Add Another Crop Farm</button>
                                <button type="button" class="btn btn-danger mt-2" onclick="removeFarmProfile(0)">Remove Farm Profile</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" onclick="addFarmProfile()">Add Another Farm Profile</button>
                        <button type="button" class="btn btn-primary mt-2" onclick="previousStep()">Previous</button>
                        <button type="button" class="btn btn-primary mt-2" onclick="nextStep()">Next</button>
                    </div>
                    
                    <!-- Step 3: Additional Steps -->
                    <div class="step" id="step3">
                        <h2>Step 3: Productions</h2>
                        <br>
                        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
                <h3>a. Seed info and Usage details</h3>
                 <div class="user-details">
                        <div class="input-box">
                            <span class="details">Cropping no.</span>
                            <input type="text" class="form-control light-gray-placeholder gray-text @error('cropping_no') is-invalid @enderror" name="cropping_no" placeholder="First name"value="{{ old('cropping_no') }}" >
                            @error('cropping_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                          </div>
                    <div class="input-box">
                        <span class="details">Seeds Typed Variety</span>
                        <input type="text" class="form-control light-gray-placeholder gray-text @error('seeds_typed_variety') is-invalid @enderror" name="seeds_typed_variety" placeholder="First name"value="{{ old('seeds_typed_variety') }}" >
                        @error('seeds_typed_variety')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="input-box">
                        <span class="details">Seeds Used in Kg</span>
                        <input type="text" class="form-control light-gray-placeholder gray-text @error('seeds_used_in_kg') is-invalid @enderror" name="seeds_used_in_kg" placeholder="Middle name"value="{{ old('seeds_used_in_kg') }}" >
                        @error('seeds_used_in_kg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
      
      <div class="input-box">
        <span class="details">Seeds Source</span>
        <select class="form-control light-gray-placeholder gray-text @error('seed_source') is-invalid @enderror"   id="seed_source"onchange="checkSeedsrc()" name="seed_source" aria-label="Floating label select e">
            <option selected disabled>Select</option>
            <option value="Government Subsidy" {{ old('seed_source') == 'Government Subsidy' ? 'selected' : '' }}>Government Subsidy</option>
            <option value="Traders" {{ old('seed_source') == 'Traders' ? 'selected' : '' }}>Traders</option>
            <option value="Own" {{ old('seed_source') == 'Own' ? 'selected' : '' }}>Own</option>
            <option value="Add" {{ old('seed_source') == 'Add' ? 'selected' : '' }}>Add</option>
        </select>
      </div>
    
    <div class="input-box" id="SeedSrcInput" style="display: none;">
        <span class="details">Add prefer seed source</span>
        <input type="text" id="SourceCapitalInputField"  class="form-control light-gray-placeholder gray-text @error('seeds_used_in_kg') is-invalid @enderror" name="add_seedsource" placeholder=" Enter source of Capital" value="{{ old('add_seedsource') }}">
        @error('seeds_used_in_kg')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>

    <div class="input-box">
        <span class="details">No of Fertilizer used in Bags</span>
        <input type="number" class="form-control light-gray-placeholder gray-text @error('no_of_fertilizer_used_in_bags') is-invalid @enderror" name="no_of_fertilizer_used_in_bags" placeholder="Middle name"value="{{ old('no_of_fertilizer_used_in_bags') }}" >
        @error('no_of_fertilizer_used_in_bags')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>
    
    <div class="input-box">
        <span class="details">No of pesticides used in L/kg</span>
        <input type="number" class="form-control light-gray-placeholder gray-text @error('no_of_fertilizer_used_in_bags') is-invalid @enderror" name="no_of_fertilizer_used_in_bags" placeholder="Middle name"value="{{ old('no_of_fertilizer_used_in_bags') }}" >
        @error('no_of_fertilizer_used_in_bags')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>

    <div class="input-box">
        <span class="details">No of Insecticides used in L</span>
        <input type="number" class="form-control light-gray-placeholder gray-text @error('no_of_insecticides_used_in_l') is-invalid @enderror" name="no_of_insecticides_used_in_l" placeholder="Middle name"value="{{ old('no_of_insecticides_used_in_l') }}" >
        @error('no_of_insecticides_used_in_l')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>
</div>
    
  
                        <!-- Add your content for Step 3 -->
                        <button type="button" class="btn btn-primary" onclick="previousStep()">Previous</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                    </div>
        
                    <!-- Step 4: Additional Steps -->
                    <div class="step" id="step3.1">
                        <h2>Step 3: Productions</h2>
                        <br>
                        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
                <h3>b. Crop Planting Details</h3>
                     <div class="user-details">
      
      <div class="input-box">
        <span class="details">Area Planted</span>
        <input type="text" class="form-control light-gray-placeholder gray-text @error('area_planted') is-invalid @enderror" name="area_planted" placeholder="area planted"value="{{ old('area_planted') }}" >
        @error('area_planted')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="input-box">
        <span class="details">Date Planted</span>
        <input type="text" class="form-control light-gray-placeholder gray-text @error('date_planted') is-invalid @enderror" name="date_planted"placeholder="date planted"
        value="{{ old('date_planted') }}" id="datepicker" data-input='true'>
        @error('date_planted')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="input-box">
          <span class="details">Date Harvested</span>
          <input type="text" class="form-control light-gray-placeholder gray-text @error('date_harvested') is-invalid @enderror" name="date_harvested" id="datepicker" placeholder="date harvested"
          value="{{ old('date_harvested') }}" data-input='true' >
          @error('date_harvested')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
        <div class="input-box">
            <span class="details">Yield (tons/kg)</span>
            <input type="text" class="form-control light-gray-placeholder gray-text @error('yield_tons_per_kg') is-invalid @enderror" name="yield_tons_per_kg" placeholder="yield tons/kg"value="{{ old('yield_tons_per_kg') }}" >
            @error('yield_tons_per_kg')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
          </div>
          <div class="input-box">
            <span class="details">Unit Price of Palay per kg</span>
            <input type="text" class="form-control light-gray-placeholder gray-text @error('unit_price_palay_per_kg') is-invalid @enderror" name="unit_price_palay_per_kg" placeholder="Unit Price of Palay per kg"value="{{ old('unit_price_palay_per_kg') }}" >
            @error('unit_price_palay_per_kg')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
          </div>

          <div class="input-box">
            <span class="details">Unit price of Rice/kgs(PHP)</span>
            <input type="text" class="form-control light-gray-placeholder gray-text @error('unit_price_rice_per_kg') is-invalid @enderror" name="unit_price_rice_per_kg" placeholder="Unit Price of rice per kg"value="{{ old('unit_price_rice_per_kg') }}" >
            @error('unit_price_rice_per_kg')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
          </div>

          
          <div class="input-box">
            <span class="details">Type of Product</span>
            <input type="text" class="form-control light-gray-placeholder gray-text @error('type_of_product') is-invalid @enderror" name="type_of_product" placeholder="Unit Price of rice per kg"value="{{ old('type_of_product') }}" >
            @error('type_of_product')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
          </div>
      <div class="input-box">
        <span class="details">Sold To</span>
        <select class="form-control light-gray-placeholder gray-text @error('sold_to') is-invalid @enderror"  name="extension_name"id="validationCustom01" aria-label="Floating label select e">
          <option selected disabled>Select</option>
          <option value="Palay" {{ old('sold_to') == 'Palay' ? 'selected' : '' }}>Palay</option>
        <option value="Rice" {{ old('sold_to') == 'Rice' ? 'selected' : '' }}>Rice</option>
        </select>
      </div>
      <div class="input-box" id="PalayInput" style="display: none;">
        <span class="details">If palay milled where?</span>
        <input type="text" id="OthersInput" class="form-control light-gray-placeholder gray-text @error('type_of_product') is-invalid @enderror" id="sold_to"onchange="checkSoldTo()" name="sold_to" aria-label="Floating label select e" >
        @error('type_of_product')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
   
    <div class="input-box">
      <span class="details">If palay milled where?</span>
      <select class="form-control light-gray-placeholder gray-text @error('if_palay_milled_where') is-invalid @enderror"  id="if_palay_milled_where"onchange="checkSoldTo()" name="if_palay_milled_where" aria-label="Floating label select e">
        <option selected disabled>Select</option>
        <option value="N/A" {{ old('sold_to') == 'N/A' ? 'selected' : '' }}>N/A</option>
      </select>
    </div>

    <div class="input-box">
        <span class="details">Gross Income (Palay)PHP</span>
        <input type="text" class="form-control light-gray-placeholder gray-text @error('gross_income_palay') is-invalid @enderror" name="gross_income_palay" placeholder="gross income palay"value="{{ old('gross_income_palay') }}" >
        @error('gross_income_palay')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>

      <div class="input-box">
        <span class="details">Gross Income (Rice)PHP</span>
        <input type="text" class="form-control light-gray-placeholder gray-text @error('gross_income_rice') is-invalid @enderror" name="gross_income_rice" placeholder="gross income rice"value="{{ old('gross_income_rice') }}" >
        @error('gross_income_rice')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
    </div>
      
                        <!-- Add your content for Step 4 -->
                        <button type="button" class="btn btn-primary" onclick="previousStep()">Previous</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                    </div>
                            <!-- Step 4: Additional Steps -->
                            <div class="step" id="step4">
                                <h2>Step 4: Fixed Cost</h2>
                                <br>
                                <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
                        <h3>Farmers Fixed Cost</h3>
                             <div class="user-details">
              
              
             
               
                  
        
                  
        
                  
              <div class="input-box">
                <span class="details">Particular (Fixed Cost)</span>
                <select class="form-control light-gray-placeholder gray-text @error('particular') is-invalid @enderror"  name="particular" id="selectParticular" onchange="checkParticular()" aria-label="label select e">
                    <option value="Land Rental Cost" {{ old('particular') == 'Land Rental' ? 'selected' : '' }}>Land Rental</option>
                  <option value="Land Ownership Cost" {{ old('particular') == 'Land Ownership Cost' ? 'selected' : '' }}>Land Ownership Cost</option>
                  <option value="Equipment Costs" {{ old('particular') == 'Equipment Costs' ? 'selected' : '' }}>Equipment Costs</option>
                  <option value="Infrastructure Costs" {{ old('particular') == 'Infrastructure Costs' ? 'selected' : '' }}>Infrastructure Costs</option>
                  <option value="Other" {{ old('particular') == 'Other' ? 'selected' : '' }}>Others</option>
              </select>
              </div>
              <div class="input-box" id="ParticularInput" style="display: none;">
                <span class="details">Others(Input here)</span>
                <input type="text"  id="ParticularInputField"class="form-control light-gray-placeholder gray-text @error('type_of_product') is-invalid @enderror" name="Add_Particular" placeholder=" Enter particular(fixed cost)" value="{{ old('Add_Particular') }}">
                @error('type_of_product')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
           
            
        
            <div class="input-box">
                <span class="details">No. of Has</span>
                <input type="text" class="form-control light-gray-placeholder gray-text @error('gross_income_palay') is-invalid @enderror" name="no_of_ha" id="no_of_ha" placeholder="Enter No. of Has" value="{{ old('no_of_ha') }}">
                @error('gross_income_palay')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
        
              <div class="input-box">
                <span class="details">Cost/Has(Has)PHP</span>
                <input type="text" class="form-control light-gray-placeholder gray-text @error('gross_income_rice') is-invalid @enderror"name="cost_per_ha" id="cost_per_ha" placeholder="Enter Cost/Has" value="{{ old('cost_per_ha') }}" >
                @error('gross_income_rice')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
              <div class="input-box">
                <span class="details">Total Amount PHP</span>
                <input type="text" class="form-control light-gray-placeholder gray-text @error('gross_income_rice') is-invalid @enderror" name="total_amount" id="total_amount" placeholder="Enter total amount" value="{{ old('total_amount') }}" >
                @error('gross_income_rice')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
              </div>
            </div>
              
                                <!-- Add your content for Step 4 -->
                                <button type="button" class="btn btn-primary" onclick="previousStep()">Previous</button>
                                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                            </div>
                    <!-- Step 5: Additional Steps -->
                    <div class="step" id="step5">
                        <h2>Step 5: Machineries Used</h2>
                        <br>
                        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
                <h3>a.Plowing Machineries </h3>
                     <div class="user-details">
      
                        <div class="input-box">
                            <span class="details">Plowing Machineries Used</span>
                            <select class="form-control light-gray-placeholder gray-text @error('harro_ownership_status') is-invalid @enderror"  name="harro_ownership_status" id="selectPlowing" onchange="checkPlowing()" aria-label="label select e">
                              <option selected disabled>Select</option>
                              <option value="Hand Tractor" {{ old('harro_ownership_status') == 'Hand Tractor' ? 'selected' : '' }}>Hand Tractor</option>
                              <option value="Four-Wheel Tractors" {{ old('harro_ownership_status') == 'Four-Wheel Tractors' ? 'selected' : '' }}>Four-Wheel Tractors</option>
                              <option value="Compact Tractors:" {{ old('harro_ownership_status') == 'Compact Tractors:' ? 'selected' : '' }}>Compact Tractors:</option>
                              <option value="Rice Transplanters" {{ old('harro_ownership_status') == 'Rice Transplanters' ? 'selected' : '' }}>Rice Transplanters</option>
                              <option value="Crawler Tractors" {{ old('harro_ownership_status') == 'Crawler Tractors' ? 'selected' : '' }}>Crawler Tractors</option>
                              <option value="OthersPlowing" {{ old('harro_ownership_status') == 'OthersPlowing' ? 'selected' : '' }}>Others</option>
                            </select>
                          </div>
                          <div class="input-box" id="PlowingStatusInput" style="display: none;">
                            <span class="details">Others(Input here)</span>
                            <input type="text"  id="PlowingStatusInputField" class="form-control light-gray-placeholder gray-text @error('type_of_product') is-invalid @enderror"  name="add_PlowingStatus" placeholder=" Enter ownership status" value="{{ old('add_PlowingStatus') }}">
                            @error('type_of_product')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                          </div>
                          <div class="input-box">
                            <span class="details">Ownership Status</span>
                            <select class="form-control light-gray-placeholder gray-text @error('plowing_machineries_used') is-invalid @enderror"  name="plo_ownership_status" id="selectPlowingStatus" onchange="checkPlowingStatus()" aria-label="label select e">
                              <option selected disabled>Select</option>
                              <option value="Own" {{ old('plo_ownership_status') == 'Own' ? 'selected' : '' }}>Own</option>
                              <option value="Rent" {{ old('plo_ownership_status') == 'Rent' ? 'selected' : '' }}>Rent</option>
                              <option value="Other" {{ old('plo_ownership_status') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                          </div>
      <div class="input-box" id="PlowingStatusInput" style="display: none;">
        <span class="details">Other(input here)</span>
        <input type="text" class="form-control light-gray-placeholder gray-text @error('middle_name') is-invalid @enderror"id="PlowingStatusInputField" name="add_PlowingStatus" placeholder=" Enter ownership status" value="{{ old('add_PlowingStatus') }}" >
        @error('middle_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
      <div class="input-box">
          <span class="details">No. of Plowing</span>
          <input type="text" class="form-control light-gray-placeholder gray-text @error('last_name') is-invalid @enderror"name="no_of_plowing" id="noPlowing" placeholder="Enter no. of plowing" value="{{ old('no_of_plowing') }}" >
          @error('last_name')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
        <div class="input-box">
            <span class="details">Cost per Plowing</span>
            <input type="text" class="form-control light-gray-placeholder gray-text @error('plowing_cost') is-invalid @enderror"name="plowing_cost" id="plowingperCostInput" placeholder="Enter plowing per cost" value="{{ old('plowing_cost') }}">
            @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
          </div>

          <div class="input-box">
            <span class="details">Total Plowing Cost</span>
            <input type="text" class="form-control light-gray-placeholder gray-text @error('last_name') is-invalid @enderror"name="plowing_cost" id="plowingCostInput" placeholder="Enter plowing cost" value="{{ old('plowing_cost') }}">
            @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
          </div>
    
    </div>
    
      
                        <!-- Add your content for Step 5 -->
                        <button type="button" class="btn btn-primary" onclick="previousStep()">Previous</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                    </div>


                    <!-- Step 5: Additional Steps -->
                    <div class="step" id="step5.1">
                        <h2>Step 5: Machineries Used</h2>
                        <br>
                        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
                <h3>b.Harrowing Machineries </h3>
                     <div class="user-details">
      
                        <div class="input-box">
                            <span class="details">Harrowing Machineries Used</span>
                            <select class="form-control light-gray-placeholder gray-text @error('harrowing_machineries_used') is-invalid @enderror"  name="harrowing_machineries_used" id="selectPlowing" onchange="checkPlowing()" aria-label="label select e">
                              <option selected disabled>Select</option>
                              <option value="Hand Tractor" {{ old('harrowing_machineries_used') == 'Hand Tractor' ? 'selected' : '' }}>Hand Tractor</option>
                              <option value="Four-Wheel Tractors" {{ old('harrowing_machineries_used') == 'Four-Wheel Tractors' ? 'selected' : '' }}>Four-Wheel Tractors</option>
                              <option value="Compact Tractors:" {{ old('harrowing_machineries_used') == 'Compact Tractors:' ? 'selected' : '' }}>Compact Tractors:</option>
                              <option value="Rice Transplanters" {{ old('harrowing_machineries_used') == 'Rice Transplanters' ? 'selected' : '' }}>Rice Transplanters</option>
                              <option value="Crawler Tractors" {{ old('harrowing_machineries_used') == 'Crawler Tractors' ? 'selected' : '' }}>Crawler Tractors</option>
                              <option value="OthersPlowing" {{ old('harrowing_machineries_used') == 'OthersPlowing' ? 'selected' : '' }}>Others</option>
                            </select>
                          </div>
                          <div class="input-box" id="HarrowingmachineriesInput" style="display: none;">
                            <span class="details">Others(Input here)</span>
                            <input type="text"  id="HarrowingmachineriesInputField" class="form-control light-gray-placeholder gray-text @error('type_of_product') is-invalid @enderror"  name="Add_HarrowingMachineries" placeholder=" Enter harrowing machineries used" value="{{ old('Add_HarrowingMachineries') }}">
                            @error('type_of_product')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                          </div>
                          <div class="input-box">
                            <span class="details">Ownership Status</span>
                            <select class="form-control light-gray-placeholder gray-text @error('harro_ownership_status') is-invalid @enderror"  name="plo_ownership_status" id="selectPlowingStatus" onchange="checkPlowingStatus()" aria-label="label select e">
                              <option selected disabled>Select</option>
                              <option value="Own" {{ old('plo_ownership_status') == 'Own' ? 'selected' : '' }}>Own</option>
                              <option value="Rent" {{ old('plo_ownership_status') == 'Rent' ? 'selected' : '' }}>Rent</option>
                              <option value="Other" {{ old('plo_ownership_status') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                          </div>
    
      <div class="input-box">
          <span class="details">No. of Harrowing</span>
          <input type="text" class="form-control light-gray-placeholder gray-text @error('last_name') is-invalid @enderror"name="no_of_harrowing" id="noHarrowing" placeholder="Enter no. of harrowing" value="{{ old('no_of_harrowing') }}" >
          @error('last_name')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
        <div class="input-box">
            <span class="details">Cost per Harrowing</span>
            <input type="text" class="form-control light-gray-placeholder gray-text @error('plowing_cost') is-invalid @enderror"name="harrowing_cost" id="costPerHarrowingInput" placeholder="Enter no. of harrowing">
            @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
          </div>

          <div class="input-box">
            <span class="details">Total Harrowing Cost</span>
            <input type="text" class="form-control light-gray-placeholder gray-text @error('harrowing_cost_total') is-invalid @enderror"name="harrowing_cost" id="harrowingCostInput" placeholder="Enter harrowing cost">
            @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
          </div>
    
    </div>
    
      
                        <!-- Add your content for Step 5 -->
                        <button type="button" class="btn btn-primary" onclick="previousStep()">Previous</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                    </div>
    

                    <div class="step" id="step5.2">
                        <h2>Step 5: Machineries Used</h2>
                        <br>
                        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
                <h3>b.Harvesting Machineries </h3>
                     <div class="user-details">
      
                        <div class="input-box">
                            <span class="details">Harvesting Machineries Used</span>
                            <select class="form-control light-gray-placeholder gray-text @error('harrowing_machineries_used') is-invalid @enderror"  name="harrowing_machineries_used" id="selectPlowing" onchange="checkPlowing()" aria-label="label select e">
                              <option selected disabled>Select</option>
                              <option value="Hand Tractor" {{ old('harrowing_machineries_used') == 'Hand Tractor' ? 'selected' : '' }}>Hand Tractor</option>
                              <option value="Four-Wheel Tractors" {{ old('harrowing_machineries_used') == 'Four-Wheel Tractors' ? 'selected' : '' }}>Four-Wheel Tractors</option>
                              <option value="Compact Tractors:" {{ old('harrowing_machineries_used') == 'Compact Tractors:' ? 'selected' : '' }}>Compact Tractors:</option>
                              <option value="Rice Transplanters" {{ old('harrowing_machineries_used') == 'Rice Transplanters' ? 'selected' : '' }}>Rice Transplanters</option>
                              <option value="Crawler Tractors" {{ old('harrowing_machineries_used') == 'Crawler Tractors' ? 'selected' : '' }}>Crawler Tractors</option>
                              <option value="OthersPlowing" {{ old('harrowing_machineries_used') == 'OthersPlowing' ? 'selected' : '' }}>Others</option>
                            </select>
                          </div>
                          <div class="input-box" id="HarrowingmachineriesInput" style="display: none;">
                            <span class="details">Others(Input here)</span>
                            <input type="text"  id="HarrowingmachineriesInputField" class="form-control light-gray-placeholder gray-text @error('type_of_product') is-invalid @enderror"  name="Add_HarrowingMachineries" placeholder=" Enter harrowing machineries used" value="{{ old('Add_HarrowingMachineries') }}">
                            @error('type_of_product')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                          </div>
                          <div class="input-box">
                            <span class="details">Ownership Status</span>
                            <select class="form-control light-gray-placeholder gray-text @error('harro_ownership_status') is-invalid @enderror"  name="plo_ownership_status" id="selectPlowingStatus" onchange="checkPlowingStatus()" aria-label="label select e">
                              <option selected disabled>Select</option>
                              <option value="Own" {{ old('plo_ownership_status') == 'Own' ? 'selected' : '' }}>Own</option>
                              <option value="Rent" {{ old('plo_ownership_status') == 'Rent' ? 'selected' : '' }}>Rent</option>
                              <option value="Other" {{ old('plo_ownership_status') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                          </div>
    
      <div class="input-box">
          <span class="details">No. of Harvesting</span>
          <input type="text" class="form-control light-gray-placeholder gray-text @error('last_name') is-invalid @enderror"name="no_of_harrowing" id="noHarrowing" placeholder="Enter no. of harrowing" value="{{ old('no_of_harrowing') }}" >
          @error('last_name')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
        </div>
        <div class="input-box">
            <span class="details">Cost per Harvesting</span>
            <input type="text" class="form-control light-gray-placeholder gray-text @error('plowing_cost') is-invalid @enderror"name="harrowing_cost" id="costPerHarrowingInput" placeholder="Enter no. of harrowing">
            @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
          </div>

          <div class="input-box">
            <span class="details">Total Harvesting</span>
            <input type="text" class="form-control light-gray-placeholder gray-text @error('harrowing_cost_total') is-invalid @enderror"name="harrowing_cost" id="harrowingCostInput" placeholder="Enter harrowing cost">
            @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
          </div>
    
    </div>
    
      
                        <!-- Add your content for Step 5 -->
                        <button type="button" class="btn btn-primary" onclick="previousStep()">Previous</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                    </div>
        
                    <!-- Step 6: Additional Steps -->
                    <div class="step" id="step6">
                        <h2>Step 6: Variable Cost</h2>
                        <br>
                        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
                <h3>a. Seeds</h3>
                     <div class="user-details">
          <div class="input-box" >
        <span class="details">Seed Variety</span>
        <select class="form-control light-gray-placeholder gray-text @error('seed_type') is-invalid @enderror"  name="seed_type" id="selectseedVariety" onchange="checkseedVariety()" aria-label="label select e">
          <option selected disabled>Select</option>
          <option value="Inbred Rice Seeds" {{ old('seed_type') == 'Inbred Rice Seeds' ? 'selected' : '' }}>Inbred Rice Seeds</option>
          <option value="Hybrid Rice Seeds" {{ old('seed_type') == 'Hybrid Rice Seeds' ? 'selected' : '' }}>Hybrid Rice Seeds</option>
          <option value="N/A" {{ old('seed_type') == 'N/A' ? 'selected' : '' }}>N/A</option>

          <option value="OtherseedVariety" {{ old('seed_type') == 'OtherseedVariety' ? 'selected' : '' }}>Others</option>
        </select>
      </div>

      <div class="input-box"id="OthersInput" style="display: none;">
        <span class="details">Others(input here)</span>
        <input type="text"  id="OthersInputField" class="form-control light-gray-placeholder gray-text" name="AddRiceVariety" placeholder=" Enter rice seed" variety value="{{ old('AddRiceVariety') }}">
      
      </div>
  {{-- inbred serlcet variety --}}
      <div class="input-box" id="seedInput" style="display: none;">
        <span class="details">Seed Name</span>
        <select class="form-control light-gray-placeholder gray-text @error('seed_name') is-invalid @enderror"  name="seed_name" id="selectseedName" onchange="checkseedName()" aria-label="label select e">
          <option selected disabled>Select</option>
          <option value="NSIC Rc222" {{ old('seed_name') == 'NSIC Rc222' ? 'selected' : '' }}>NSIC Rc222</option>
          <option value="NSIC Rc18" {{ old('seed_name') == 'NSIC Rc18' ? 'selected' : '' }}>NSIC Rc18</option>
         
          <option value="NSIC Rc160" {{ old('seed_name') == 'NSIC Rc160' ? 'selected' : '' }}>NSIC Rc160</option>
          <option value="PSB Rc82" {{ old('seed_name') == 'PSB Rc82' ? 'selected' : '' }}>PSB Rc82</option>
          <option value="OtherseedName" {{ old('seed_name') == 'OtherseedName' ? 'selected' : '' }}>Others</option>
        </select>
      </div>
     {{-- hybrid --}}
      <div class="input-box" id="seedInput" style="display: none;">
        <span class="details">Seed Name</span>
        <select class="form-control light-gray-placeholder gray-text @error('seed_name') is-invalid @enderror"  name="seed_name" id="selectseedVarie" onchange="checkseedVarie()" aria-label="label select e">
          <option selected disabled>Select</option>
          <option value="NSIC Rc298" {{ old('seed_name') == 'NSIC Rc298' ? 'selected' : '' }}>NSIC Rc298</option>
          <option value="NSIC RC 262H (MESTISO 38)" {{ old('seed_name') == 'NSIC RC 262H (MESTISO 38)' ? 'selected' : '' }}>NSIC RC 262H (MESTISO 38)</option>
          <option value="NSIC RC 408H (MESTISO 68)" {{ old('seed_name') == 'NSIC RC 408H (MESTISO 68)' ? 'selected' : '' }}>NSIC RC 408H (MESTISO 68)</option>
          <option value="OtherseedVarie" {{ old('seed_name') == 'OtherseedVarie' ? 'selected' : '' }}>Others</option>
        </select>
      </div>
      
      <div class="input-box" id="HybridNameInput" style="display: none;">
          <span class="details">Others(input here)</span>
          <input type="text" id="HybridNameInputField" class="form-control light-gray-placeholder gray-text"  name="add_newInbreed" placeholder=" Enter seed name" >
        
        </div>

        <div class="input-box" >
            <span class="details">Unit</span>
            <input type="text" id="HybridNameInputField" class="form-control light-gray-placeholder gray-text"  name="unit" id="validationCustom01" placeholder="Enter unit" value="{{ old('unit') }}" >
          
          </div>

          <div class="input-box" >
            <span class="details">Quantity </span>
            <input type="text"class="form-control light-gray-placeholder gray-text"   name="quantity" id="quantityInput" placeholder="Enter quantity" value="{{ old('quantity') }}"  >
          
          </div>

          <div class="input-box" >
            <span class="details">Unit Price(PHP)</span>
            <input type="text"class="form-control light-gray-placeholder gray-text"  name="unit_price" id="unitPriceInput" placeholder="Enter unit price" value="{{ old('unit_price') }}" >
          
          </div>
          <div class="input-box" >
            <span class="details">Total Seed Cost(PHP)</span>
            <input type="text"class="form-control light-gray-placeholder gray-text"  name="total_seed_cost" id="totalSeedCostInput" placeholder="Enter total seed cost" value="{{ old('total_seed_cost') }}">
          
          </div>
        </div>
        <br>
          <h3>b. Labor</h3><br>

          <div class="user-details">
          <div class="input-box" >
            <span class="details">No of Person</span>
            <input type="text"class="form-control light-gray-placeholder gray-text" name="no_of_person" id="quantityInput" placeholder="Enter no_of_person" value="{{ old('no_of_person') }}">
          
          </div>

          <div class="input-box" >
            <span class="details">Rate per Person</span>
            <input type="text"class="form-control light-gray-placeholder gray-text" name="rate_per_person" id="unitPriceInput" placeholder="Enter rate/person" value="{{ old('rate_per_person') }}" >
          
          </div>
          <div class="input-box" >
            <span class="details">Total Labor Cost</span>
            <input type="text"class="form-control light-gray-placeholder gray-text" name="total_labor_cost" id="totalLaborCostInput" placeholder="Enter total labor cost" value="{{ old('total_labor_cost') }}" >
          
          </div>
    </div>
    
      
                        <!-- Add your content for Step 6 -->
                        <button type="button" class="btn btn-primary" onclick="previousStep()">Previous</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                    </div>
        
                    <!-- Step 7: Loan Information -->
                    <div class="step" id="step7">
                        <h2>Step6: Variable Cost</h2>
                        <br>
                        <p class="text-success">Provide clear and concise responses to each section, ensuring accuracy and relevance. If certain information is not applicable, write N/A.</p><br>
                <h3>c. Fertilizers </h3>
                     <div class="user-details">
          <div class="input-box" >
        <span class="details">Name Of Fertilizer</span>
        <select class="form-control light-gray-placeholder gray-text @error('seed_type') is-invalid @enderror"  name="name_of_fertilizer" id="selectpostharvest" onchange="checkpostharvest()" aria-label="label select e">
          <option selected disabled>Select</option>
          <option value="Nitrogen Fertilizers" {{ old('name_of_fertilizer') == 'Nitrogen Fertilizers' ? 'selected' : '' }}>Nitrogen Fertilizers</option>
          <option value="Phosphorus Fertilizers" {{ old('name_of_fertilizer') == 'Phosphorus Fertilizers' ? 'selected' : '' }}>Phosphorus Fertilizers</option>
          <option value="Potassium Fertilizers" {{ old('name_of_fertilizer') == 'Potassium Fertilizers' ? 'selected' : '' }}>Potassium Fertilizers</option>
          <option value="Compound Fertilizers" {{ old('name_of_fertilizer') == 'Compound Fertilizers' ? 'selected' : '' }}>Compound Fertilizers</option>
          <option value="Organic Fertilizers" {{ old('name_of_fertilizer') == 'Organic Fertilizers' ? 'selected' : '' }}>Organic Fertilizers</option>
          <option value="Slow-Release Fertilizers" {{ old('name_of_fertilizer') == 'Slow-Release Fertilizers' ? 'selected' : '' }}>Slow-Release Fertilizers</option>
          <option value="Micronutrient Fertilizers" {{ old('name_of_fertilizer') == 'Micronutrient Fertilizers' ? 'selected' : '' }}>Micronutrient Fertilizers</option>
          <option value="Liquid Fertilizers" {{ old('name_of_fertilizer') == 'Liquid Fertilizers' ? 'selected' : '' }}>Liquid Fertilizers</option>
          <option value="other" {{ old('name_of_fertilizer') == 'other' ? 'selected' : '' }}>other</option>
         
        </select>
      </div>

      <div class="input-box"id="additionalFertilizerField" style="display: none;">
        <span class="details">Other(input here)</span>
        <input type="text"  id="OthersInputField" class="form-control light-gray-placeholder gray-text" name="additionalFertilizer" id="additionalFertilizer"placeholder="Enter fertilizer name">
      
      </div>
  {{-- SELECT TYPE OF FERTILIZER --}}
      <div class="input-box" id="fertilizerInput" style="display: none;">
        <span class="details">Type of Fertilizer</span>
        <select class="form-control light-gray-placeholder gray-text @error('seed_name') is-invalid @enderror"  name="type_of_fertilizer" id="SelectFertilizer">
            <option selected disabled>Select</option>
            <!-- Options will be dynamically populated based on the selected fertilizer category -->
        </select>
      </div>
               
  
      
      <div class="input-box" id="preferFertilizerinput" style="display: none;">
          <span class="details">Others(input here)</span>
          <input type="text" id="preferFertilizerinput" class="form-control light-gray-placeholder gray-text" name="type_of_fertilizers" placeholder=" Enter type of fertilizer" value="{{ old('type_of_fertilizers') }}">
        
        </div>

        <div class="input-box" >
            <span class="details">No. of Sacks</span>
            <input type="text" id="HybridNameInputField" class="form-control light-gray-placeholder gray-text"  name="no_ofsacks" id="no_ofsacks" placeholder="Enter no of sacks" value="{{ old('no_ofsacks') }}" >
          
          </div>

          <div class="input-box" >
            <span class="details">Unit Price per sacks(PHP) </span>
            <input type="text"class="form-control light-gray-placeholder gray-text"   name="unitprice_per_sacks" id="unitprice_per_sacks" placeholder="Enter unit price/sacks" value="{{ old('unitprice_per_sacks') }}"  >
          
          </div>

          
          <div class="input-box" >
            <span class="details">Total Cost Fertilizers(PHP)</span>
            <input type="text"class="form-control light-gray-placeholder gray-text" name="total_cost_fertilizers" id="total_cost_fertilizers" placeholder="Enter total cost" value="{{ old('total_cost_fertilizers') }}" >
          
          </div>
        </div>
        <br>
          <h3>d. Pesticides</h3><br>

          <div class="user-details">

            <div class="input-box" >
                <span class="details">Pesticides Name</span>
                <select class="form-control light-gray-placeholder gray-text @error('seed_type') is-invalid @enderror" name="pesticides_name"id="selectPesticideName"onchange="checkIPesticideName()" aria-label="Floating label select e">
                    <option selected disabled>Select</option>
                    <option value="Glyphosate" {{ old('pesticides_name') == 'Glyphosate' ? 'selected' : '' }}>Glyphosate</option>
                      <option value="Malathion" {{ old('pesticides_name') == 'Malathion' ? 'selected' : '' }}>Malathion</option>
                      <option value="Diazinon" {{ old('pesticides_name') == 'Diazinon' ? 'selected' : '' }}>Diazinon</option>
                      <option value="Chlorpyrifos" {{ old('pesticides_name') == 'Chlorpyrifos' ? 'selected' : '' }}>Chlorpyrifos</option>
                      <option value="Lambda-cyhalothrin" {{ old('pesticides_name') == 'Lambda-cyhalothrin' ? 'selected' : '' }}>Lambda-cyhalothrin</option>
                      <option value="Imidacloprid" {{ old('pesticides_name') == 'Imidacloprid' ? 'selected' : '' }}>Imidacloprid</option>
                      <option value="Cypermethrin" {{ old('pesticides_name') == 'Cypermethrin' ? 'selected' : '' }}>Cypermethrin</option>
                      <option value="N/A" {{ old('pesticides_name') == 'N/A' ? 'selected' : '' }}>N/A</option>
                    <option value="OtherPestName" {{ old('pesticides_name') == 'OtherPestName' ? 'selected' : '' }}>Others</option>
    
                  
                  </select>
   
              </div>

          <div class="input-box" >
            <span class="details">Number of L or kg</span>
            <input type="text"class="form-control light-gray-placeholder gray-text"name="no_of_l_kg" id="no_of_l_kg" placeholder="Enter no of L or Kg" value="{{ old('no_of_l_kg') }}" >
          
          </div>

          <div class="input-box" >
            <span class="details">Unit Price of Pesticides(PHP)</span>
            <input type="text"class="form-control light-gray-placeholder gray-text"  name="unitprice_ofpesticides" id="unitprice_ofpesticides" placeholder="Enter unit price pesticides" value="{{ old('unitprice_ofpesticides') }}" >
          
          </div>
          <div class="input-box" >
            <span class="details">Total Cost Pesticides(PHP)</span>
            <input type="text"class="form-control light-gray-placeholder gray-text"  name="total_cost_pesticides" id="total_cost_pesticides" placeholder="Enter total cost" value="{{ old('total_cost_pesticides') }}">
          
          </div>
    </div>

    <h3>e. Transport & Variable Cost Total</h3><br>

    <div class="user-details">
    <div class="input-box" >
      <span class="details">Name of Vehicle</span>
      <input type="text"class="form-control light-gray-placeholder gray-text"name="type_of_vehicle" id="unitPriceInput" placeholder="Enter type of vehicle" value="{{ old('type_of_vehicle') }}">
    
    </div>

    <div class="input-box" >
      <span class="details">Total DeliveryCost(PHP)</span>
      <input type="text"class="form-control light-gray-placeholder gray-text" name="total_transport_per_deliverycost" id="totalLaborCostInput" placeholder="Enter total transport cost" value="{{ old('total_transport_per_deliverycost') }}" >
    
    </div>
    <div class="input-box" >
      <span class="details">Total Machineries Fuel Cost</span>
      <input type="text"class="form-control light-gray-placeholder gray-text" name="total_machinery_fuel_cost" id="total_machinery_fuel_cost" placeholder="Enter total fuel cost" value="{{ old('total_machinery_fuel_cost') }}" >
    
    </div>

    <div class="input-box" >
        <span class="details">Total Variable Cost</span>
        <input type="text"class="form-control light-gray-placeholder gray-text" name="total_variable_cost" id="total_variable_cost" placeholder="Enter total variable cost" value="{{ old('total_variable_cost') }}"  >
      
      </div>
</div>
                        <!-- Add other fields -->
                        <button type="button" class="btn btn-primary" onclick="previousStep()">Previous</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        
        
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var formSteps = document.querySelectorAll(".form_step");
                var formNavButtons = document.querySelectorAll(".form_btns .btn_next, .form_btns .btn_back");
                var modalWrapper = document.querySelector(".modal_wrapper");
                var shadow = document.querySelector(".shadow");
                var currentStep = 0;
        
                function showStep(stepIndex) {
                    formSteps.forEach(function(step) {
                        step.style.display = "none";
                    });
                    formSteps[stepIndex].style.display = "block";
                    updateProgress(stepIndex);
                }
        
                function updateProgress(stepIndex) {
                    document.querySelectorAll(".progress").forEach(function(progress) {
                        progress.classList.remove("active");
                    });
                    document.querySelector(`.form_${stepIndex + 1}_progessbar`).classList.add("active");
                } 
        
                function initializeFormNavigation() {
                    showStep(currentStep);
                    formNavButtons.forEach(function(button) {
                        button.addEventListener("click", function() {
                            if (button.classList.contains("btn_next")) {
                                if (currentStep < formSteps.length - 1) {
                                    currentStep++;
                                    showStep(currentStep);
                                }
                            } else if (button.classList.contains("btn_back")) {
                                if (currentStep > 0) {
                                    currentStep--;
                                    showStep(currentStep);
                                }
                            }
                        });
                    });
                }
        
                var submitButton = document.querySelector(".form_15_btns .btn_next");
                submitButton.addEventListener("click", function() {
                    modalWrapper.style.display = "flex"; // Show modal
                });
        
                var modalCloseButton = document.querySelector(".btn_done");
                modalCloseButton.addEventListener("click", function() {
                    modalWrapper.style.display = "none"; // Close modal
                });
        
                shadow.addEventListener("click", function() {
                    modalWrapper.style.display = "none"; // Close modal on shadow click
                });
        
                initializeFormNavigation();
            });
        </script>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    
    
    <script type="text/javascript">
      $(document).ready(function() {
          $(document).on('click', '.btn-submit', function(event){
              var form = $(this).closest("form");
              
              event.preventDefault(); // Prevent the default button action
              
              swal({
                  title: "Are you sure you want to submit this form?",
                  text: "Please confirm your action.",
                  icon: "warning",
                  buttons: {
                      cancel: "Cancel",
                      confirm: {
                          text: "Yes, Continue!",
                          value: true,
                          visible: true,
                          className: "btn-success", // Add the success class to the button
                          closeModal: false // Prevent dialog from closing on confirmation
                      }
                  },
                  dangerMode: true,
              }).then((willSubmit) => {
                  if (willSubmit) {
                      // Display loading indicator
                      swal({
                          title: "Processing...",
                          text: "Please wait.",
                          buttons: false,
                          closeOnClickOutside: false,
                          closeOnEsc: false,
                          icon: "info",
                          timerProgressBar: true,
                      });
    
                      // Submit the form after a short delay to allow the loading indicator to be shown
                      setTimeout(function() {
                          form.submit(); // Submit the form
                      }, 500);
                  }
              });
          });
      });
    
      // Function to handle successful form submission
      function handleFormSubmissionSuccess() {
          swal({
              title: "Personal Informations completed successfully!",
              text: "Thank you for your submission.",
              icon: "success",
          });
      }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          flatpickr("#datepicker", {
              dateFormat: "Y-m-d", // Date format (YYYY-MM-DD)
              // Additional options can be added here
          });
      });
    </script>
    <script>
     
  // selecting add to no. of children
  function checkChildren() {
        var childrenSelect = document.getElementById("childrenSelect");
        var otherchilderInputContainer = document.getElementById("otherchilderInputContainer");
        if (childrenSelect.value === "Add") {
            otherchilderInputContainer.style.display = "block";
        } else {
            otherchilderInputContainer.style.display = "none";
        }
    }

// selecting a highest formal edu
function checkFormalEduc() {
        var selectEduc = document.getElementById("selectEduc");
        var otherformInputContainer = document.getElementById("otherformInputContainer");
        if (selectEduc.value === "Other") {
           otherformInputContainer.style.display = "block";
        } else {
           otherformInputContainer.style.display = "none";
        }
    }

    // ad  new farmers name of Org, Coop, Assoc
    function checkFarmerGrp() {
        var selectFarmgroups = document.getElementById("selectFarmgroups");
        var newFarmerGroupInput = document.getElementById("newFarmerGroupInput");
        if (selectFarmgroups.value === "add") {
           newFarmerGroupInput.style.display = "block";
        } else {
           newFarmerGroupInput.style.display = "none";
        }
    }
    


// selected a place of birth
function checkPlaceBirth() {
        var selectplacebrth = document.getElementById("selectplacebrth");
        var AddBirthInput = document.getElementById("AddBirthInput");
        if (selectplacebrth.value === "Add Place of Birth") {
           AddBirthInput.style.display = "block";
        } else {
           AddBirthInput.style.display = "none";
        }
    }

    // check the pwde when users click yes will  open new input box to add the pwd id no.
    function checkPWD() {
    const selectPWD = document.getElementById('selectPWD').value;
    const yesInput = document.getElementById('YesInputSelected');
    const noInput = document.getElementById('NoInputSelected');

    if (selectPWD === '1') {
        yesInput.style.display = 'block';
        noInput.style.display = 'none';
    } else if (selectPWD === '0') {
        yesInput.style.display = 'none';
        noInput.style.display = 'block';
    } else {
        yesInput.style.display = 'none';
        noInput.style.display = 'none';
    }
}

// Initialize the display based on the current selection
document.addEventListener('DOMContentLoaded', checkPWD);


// check  mebership yes or no selections
function checkMmbership() {
    var selectMember = document.getElementById("selectMember");
    var YesFarmersGroup = document.getElementById("YesFarmersGroup");
    var NoFarmersGroup = document.getElementById("NoFarmersGroup");

    if (selectMember.value === "Yes") {
        YesFarmersGroup.style.display = "block";
        NoFarmersGroup.style.display = "none";
    } else if (selectMember.value === "No") {
        NoFarmersGroup.style.display = "block";
        YesFarmersGroup.style.display = "none";
    } else {
        YesFarmersGroup.style.display = "none";
        NoFarmersGroup.style.display = "none";
    }
}

// check the seleced government id
function CheckGoverniD() {
    var selectGov = document.getElementById("selectGov");
    var iDtypeSelected = document.getElementById("iDtypeSelected");
    var NoSelected = document.getElementById("NoSelected");

    if (selectGov.value === "Yes") {
        iDtypeSelected.style.display = "block";
        NoSelected.style.display = "none";
    } else if (selectGov.value === "No") {
        NoSelected.style.display = "block";
        iDtypeSelected.style.display = "none";
    } else {
        iDtypeSelected.style.display = "none";
        NoSelected.style.display = "none";
    }
}
// check selected GOV ID TYPE then input n/a
function checkIDtype() {
    var selectIDType = document.getElementById("selectIDType");
    var idNoInput = document.getElementById("idNoInput");
    var OthersInput = document.getElementById("OthersInput");
    var OtherIDInput = document.getElementById("OtherIDInput");

    if (selectIDType.value === "Driver License" || selectIDType.value === "Passport" || selectIDType.value === "Postal ID" || selectIDType.value === "Phylsys ID" || selectIDType.value === "PRC ID" || selectIDType.value === "Brgy. ID" || selectIDType.value === "Voters ID" || selectIDType.value === "Senior ID" || selectIDType.value === "PhilHealth ID" || selectIDType.value === "Tin ID" || selectIDType.value === "BIR ID") {
        idNoInput.style.display = "block";
        OthersInput.style.display = "none";
        OtherIDInput.style.display = "none";
    } else if (selectIDType.value === "add Id Type") {
        OthersInput.style.display = "block";
        OtherIDInput.style.display = "block";
        idNoInput.style.display = "none";
    } else {
        idNoInput.style.display = "none";
        OthersInput.style.display = "none";
        OtherIDInput.style.display = "none";
    }
}






// check selected in  civil status if  ist is single, married, widow ordivorced
function checkCivil() {
    var selectCivil = document.getElementById("selectCivil");
    var MarriedInputSelected = document.getElementById("MarriedInputSelected");
    var SinWidDevInput = document.getElementById("SinWidDevInput");

    if (selectCivil.value === "Married") {
        MarriedInputSelected.style.display = "block";
        SinWidDevInput.style.display = "none";
    } else if (selectCivil.value === "Single" || selectCivil.value === "Widow" || selectCivil.value === "Divorced") {
        SinWidDevInput.style.display = "block";
        MarriedInputSelected.style.display = "none";
    } else {
        MarriedInputSelected.style.display = "none";
        SinWidDevInput.style.display = "none";
    }
}

// Call the function to set the initial state based on the current value
document.addEventListener("DOMContentLoaded", function() {
    checkCivil();
});




// adding new extend name when the users click  others 
function checkExtendN() {
        var selectExtendName = document.getElementById("selectExtendName");
        var OthersInputField = document.getElementById("OthersInputField");
        if (selectExtendName.value === "others") {
           OthersInputField.style.display = "block";
        } else {
           OthersInputField.style.display = "none";
        }
    }

    // adding new extend name when the users clicl  others 
function checkReligion() {
        var selectReligion = document.getElementById("selectReligion");
        var ReligionInputField = document.getElementById("ReligionInputField");
        if (selectReligion.value === "other") {
           ReligionInputField.style.display = "block";
        } else {
           ReligionInputField.style.display = "none";
        }
    }


    
    
    
    
 
// Function to check membership and display organization input accordingly
function checkMmbership() {
    var membership = document.getElementById("selectMember").value;
    var organizationInput = document.getElementById("YesFarmersGroup");

    if (membership === "1") { // Yes
        organizationInput.style.display = "block"; // Show organization input
        checkAgri(); // Call checkAgri to populate organizations based on selected agri_district
    } else {
        organizationInput.style.display = "none"; // Hide organization input
    }
}

// Function to check agri_district and display barangay and organization inputs accordingly
function checkAgri() {
    var agriDistrict = document.getElementById("selectAgri").value;
    var barangayInput = document.getElementById("barangayInput");
    var organizationInput = document.getElementById("YesFarmersGroup");

    if (['ayala', 'vitali', 'culianan', 'tumaga', 'manicahan', 'curuan'].includes(agriDistrict)) {
        barangayInput.style.display = "block"; // Show barangay input
        populateBarangays(agriDistrict); // Populate barangays based on selected district
        if (document.getElementById("selectMember").value === "1") {
            populateOrganizations(agriDistrict); // Populate organizations based on selected district
        }
    } else {
        barangayInput.style.display = "none"; // Hide barangay input
    }
}

// Function to populate barangays based on agri_district
function populateBarangays(agriDistrict) {
    var barangaySelect = document.getElementById("SelectBarangay");
   
    // Clear previous options
    barangaySelect.innerHTML = '';

    // Populate barangays based on selected district
    var barangays = [];
    switch (agriDistrict) {
        case 'ayala':
            barangays = ["Barangay 1", "Barangay 2"];
            break;
        case 'vitali':
            barangays = ["Taloptap", "Tindalo", "Camino Nuevo", "Tamion", "Bataan", "Tuktubo", "Mialim", "Lower Tigbao", "Tictapul", "Manguso", "Inner Manguso", "Bincul, Manguso", "Sinalikway, Manguso", "Upper Manguso", "Dungcaan, Manguso", "Tamaraan, Manguso", "Licomo"];
            break;
        case 'culianan':
            barangays = ["Barangay Culianan 1", "Barangay Culianan 2"];
            break;
        case 'tumaga':
            barangays = ["Boalan", "Guiwan", "Cabatangan"];
            break;
        case 'manicahan':
            barangays = ["Barangay Manicahan 1", "Barangay Manicahan 2"];
            break;
        case 'curuan':
            barangays = ["Barangay Curuan 1", "Barangay Curuan 2"];
            break;
        default:
            break;
    }

    // Populate dropdown with barangays
    barangays.forEach(function(barangay) {
        var option = document.createElement("option");
        option.text = barangay;
        option.value = barangay;
        barangaySelect.appendChild(option); // Append option to select element
    });

    // Add an option to add new barangay
    var addNewOption = document.createElement("option");
    addNewOption.text = "Add New Barangay";
    addNewOption.value = "addNew";
    barangaySelect.appendChild(addNewOption);
}

// Function to handle the barangay selection
function handleBarangaySelection() {
    var barangaySelect = document.getElementById("SelectBarangay");
    var selectedOption = barangaySelect.value;

    if (selectedOption === "addNew") {
        var newBarangay = prompt("Enter new barangay name:");
        if (newBarangay !== null && newBarangay !== "") {
            // Add the new barangay to the dropdown
            var option = document.createElement("option");
            option.text = newBarangay;
            option.value = newBarangay;
            barangaySelect.insertBefore(option, barangaySelect.lastChild); // Add option before the last option ("Add New Barangay")
            // Select the newly added barangay
            barangaySelect.value = newBarangay;
        }
    }
}

// Function to populate organizations based on agri_district
function populateOrganizations(agriDistrict) {
    var organizationSelect = document.getElementById("SelectOrganization");
   
    // Clear previous options
    organizationSelect.innerHTML = '';

    // Populate organizations based on selected district
    var organizations = [];
    switch (agriDistrict) {
        case 'ayala':
            organizations = ["Organization 1", "Organization 2"];
            break;
        case 'vitali':
            organizations = ["Org Taloptap", "Org Tindalo", "Org Camino Nuevo"];
            break;
        case 'culianan':
            organizations = ["Org Culianan 1", "Org Culianan 2"];
            break;
        case 'tumaga':
            organizations = ["Org Boalan", "Org Guiwan", "Org Cabatangan"];
            break;
        case 'manicahan':
            organizations = [ "Org Manicahan 1", "Org Manicahan 2"];
            break;
        case 'curuan':
            organizations = ["Org Curuan 1", "Org Curuan 2"];
            break;
        default:
            break;
    }

    // Populate dropdown with organizations
    organizations.forEach(function(organization) {
        var option = document.createElement("option");
        option.text = organization;
        option.value = organization;
        organizationSelect.appendChild(option); // Append option to select element
    });

    // Add an option to add new organization
    var addNewOption = document.createElement("option");
    addNewOption.text = "Add New Organization";
    addNewOption.value = "addNew";
    organizationSelect.appendChild(addNewOption);
}

// Function to handle the organization selection
function handleOrganizationSelection() {
    var organizationSelect = document.getElementById("SelectOrganization");
    var selectedOption = organizationSelect.value;

    if (selectedOption === "addNew") {
        var newOrganization = prompt("Enter new organization name:");
        if (newOrganization !== null && newOrganization !== "") {
            // Add the new organization to the dropdown
            var option = document.createElement("option");
            option.text = newOrganization;
            option.value = newOrganization;
            organizationSelect.insertBefore(option, organizationSelect.lastChild); // Add option before the last option ("Add New Organization")
            // Select the newly added organization
            organizationSelect.value = newOrganization;
        }
    }
}

// Call the checkAgri and checkMmbership functions when the page loads
window.onload = function() {
    checkAgri();
    checkMmbership();
};

// Call the checkAgri function when the agri_district selection changes
document.getElementById("selectAgri").addEventListener("change", checkAgri);

// Call the handleBarangaySelection function when a barangay is selected
document.getElementById("SelectBarangay").addEventListener("change", handleBarangaySelection);

// Call the handleOrganizationSelection function when an organization is selected
document.getElementById("SelectOrganization").addEventListener("change", handleOrganizationSelection);


    let currentStep = 0;
    const steps = document.querySelectorAll('.step');

    function showStep(step) {
        steps.forEach((stepElement, index) => {
            stepElement.classList.toggle('active', index === step);
        });
    }

    function nextStep() {
        if (validateStep(currentStep)) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function previousStep() {
        currentStep--;
        showStep(currentStep);
    }

    function validateStep(step) {
        const currentStepElement = steps[step];
        const inputs = currentStepElement.querySelectorAll('input');
        let isValid = true;
        inputs.forEach(input => {
            if (!input.checkValidity()) {
                isValid = false;
            }
        });
        return isValid;
    }

    function addFarmProfile() {
        const farmProfiles = document.getElementById('farmProfiles');
        const index = farmProfiles.children.length;

        const farmProfile = document.createElement('div');
        farmProfile.className = 'user-details';

        // Column layout for farm profile
        const farmProfileCol = document.createElement('div');
        farmProfileCol.className = 'input-box';

        const farmProfileContainer = document.createElement('div');
        farmProfileContainer.className = 'user-details';

        addInputField(farmProfileContainer, 'Farm Size:', 'number', `farm_profiles[${index}][farm_size]`, `farm_size_${index}`);
        addInputField(farmProfileContainer, 'Farm Location:', 'text', `farm_profiles[${index}][farm_location]`, `farm_location_${index}`);
        addInputField(farmProfileContainer, 'Rice Farm Address:', 'text', `farm_profiles[${index}][rice_farm_address]`, `rice_farm_address_${index}`);
        addInputField(farmProfileContainer, 'Number of Years as Farmer:', 'number', `farm_profiles[${index}][no_of_years_as_farmers]`, `no_of_years_as_farmers_${index}`);
        addInputField(farmProfileContainer, 'GPS Longitude:', 'text', `farm_profiles[${index}][gps_longitude]`, `gps_longitude_${index}`);
        addInputField(farmProfileContainer, 'GPS Latitude:', 'text', `farm_profiles[${index}][gps_latitude]`, `gps_latitude_${index}`);
        addInputField(farmProfileContainer, 'Total Physical Area (has):', 'number', `farm_profiles[${index}][total_physical_area_has]`, `total_physical_area_has_${index}`);
        addInputField(farmProfileContainer, 'Rice Area Cultivated (has):', 'number', `farm_profiles[${index}][rice_area_cultivated_has]`, `rice_area_cultivated_has_${index}`);
        addInputField(farmProfileContainer, 'Land Title No:', 'text', `farm_profiles[${index}][land_title_no]`, `land_title_no_${index}`);
        addInputField(farmProfileContainer, 'Lot No:', 'text', `farm_profiles[${index}][lot_no]`, `lot_no_${index}`);
        addInputField(farmProfileContainer, 'Area Prone To:', 'text', `farm_profiles[${index}][area_prone_to]`, `area_prone_to_${index}`);
        addInputField(farmProfileContainer, 'Ecosystem:', 'text', `farm_profiles[${index}][ecosystem]`, `ecosystem_${index}`);
        addInputField(farmProfileContainer, 'RSBA Register:', 'text', `farm_profiles[${index}][rsba_register]`, `rsba_register_${index}`);
        addInputField(farmProfileContainer, 'PCIC Insured:', 'text', `farm_profiles[${index}][pcic_insured]`, `pcic_insured_${index}`);
        addInputField(farmProfileContainer, 'Government Assisted:', 'text', `farm_profiles[${index}][government_assisted]`, `government_assisted_${index}`);
        addInputField(farmProfileContainer, 'Source of Capital:', 'text', `farm_profiles[${index}][source_of_capital]`, `source_of_capital_${index}`);
        addInputField(farmProfileContainer, 'Remarks/Recommendation:', 'text', `farm_profiles[${index}][remarks_recommendation]`, `remarks_recommendation_${index}`);
        addInputField(farmProfileContainer, 'OCA District Office:', 'text', `farm_profiles[${index}][oca_district_office]`, `oca_district_office_${index}`);
        addInputField(farmProfileContainer, 'Name of Technicians:', 'text', `farm_profiles[${index}][name_technicians]`, `name_technicians_${index}`);
        addInputField(farmProfileContainer, 'Date of Interview:', 'date', `farm_profiles[${index}][date_interview]`, `date_interview_${index}`);

        // Crop Farms Section
        const cropFarms = document.createElement('div');
        cropFarms.setAttribute('id', `cropFarms_${index}`);
        cropFarms.className = 'user-details';

        // Initial Crop Farm
        addCropFarmFields(cropFarms, index, 0);

        const addCropFarmButton = document.createElement('button');
        addCropFarmButton.setAttribute('type', 'button');
        addCropFarmButton.setAttribute('class', 'btn btn-secondary mt-2');
        addCropFarmButton.textContent = 'Add Another Crop Farm';
        addCropFarmButton.addEventListener('click', () => addCropFarm(index));
        cropFarms.appendChild(addCropFarmButton);

        const removeFarmProfileButton = document.createElement('button');
        removeFarmProfileButton.setAttribute('type', 'button');
        removeFarmProfileButton.setAttribute('class', 'btn btn-danger mt-2');
        removeFarmProfileButton.textContent = 'Remove Farm Profile';
        removeFarmProfileButton.addEventListener('click', () => removeFarmProfile(index));
        farmProfileCol.appendChild(removeFarmProfileButton);

        farmProfileCol.appendChild(farmProfileContainer);
        farmProfileCol.appendChild(cropFarms);
        farmProfiles.appendChild(farmProfileCol);
    }

    function addInputField(parent, labelText, type, name, id) {
        const col = document.createElement('div');
        col.className = 'input-box';

        const label = document.createElement('label');
        label.setAttribute('for', id);
        label.textContent = labelText;
        col.appendChild(label);

        const input = document.createElement('input');
        input.setAttribute('type', type);
        input.setAttribute('class', 'form-control');
        input.setAttribute('name', name);
        input.setAttribute('id', id);
        input.required = true;
        col.appendChild(input);

        parent.appendChild(col);
    }

    function addCropFarm(farmProfileIndex) {
        const cropFarms = document.getElementById(`cropFarms_${farmProfileIndex}`);
        const index = cropFarms.children.length;
        const cropFarm = document.createElement('div');
        cropFarm.className = 'user-details';

        addCropFarmFields(cropFarm, farmProfileIndex, index);

        const removeCropFarmButton = document.createElement('button');
        removeCropFarmButton.setAttribute('type', 'button');
        removeCropFarmButton.setAttribute('class', 'btn btn-danger mt-2');
        removeCropFarmButton.textContent = 'Remove Crop Farm';
        removeCropFarmButton.addEventListener('click', () => removeCropFarm(farmProfileIndex, index));
        cropFarm.appendChild(removeCropFarmButton);

        cropFarms.appendChild(cropFarm);
    }

    function addCropFarmFields(parent, farmProfileIndex, index) {
        addInputField(parent, 'Crop Type:', 'text', `farm_profiles[${farmProfileIndex}][crop_farms][${index}][crop_type]`, `crop_type_${farmProfileIndex}_${index}`);
        addInputField(parent, 'Crop Area:', 'number', `farm_profiles[${farmProfileIndex}][crop_farms][${index}][crop_area]`, `crop_area_${farmProfileIndex}_${index}`);
        addInputField(parent, 'Type Rice Variety:', 'text', `farm_profiles[${farmProfileIndex}][crop_farms][${index}][type_rice_variety]`, `type_rice_variety_${farmProfileIndex}_${index}`);
        addInputField(parent, 'Preferred Variety:', 'text', `farm_profiles[${farmProfileIndex}][crop_farms][${index}][prefered_variety]`, `prefered_variety_${farmProfileIndex}_${index}`);
        addInputField(parent, 'Plant Schedule (Wet Season):', 'text', `farm_profiles[${farmProfileIndex}][crop_farms][${index}][plant_schedule_wetseason]`, `plant_schedule_wetseason_${farmProfileIndex}_${index}`);
        addInputField(parent, 'Plant Schedule (Dry Season):', 'text', `farm_profiles[${farmProfileIndex}][crop_farms][${index}][plant_schedule_dryseason]`, `plant_schedule_dryseason_${farmProfileIndex}_${index}`);
        addInputField(parent, 'Number of Cropping Years:', 'number', `farm_profiles[${farmProfileIndex}][crop_farms][${index}][no_of_cropping_yr]`, `no_of_cropping_yr_${farmProfileIndex}_${index}`);
        addInputField(parent, 'Yield (kg/ha):', 'number', `farm_profiles[${farmProfileIndex}][crop_farms][${index}][yield_kg_ha]`, `yield_kg_ha_${farmProfileIndex}_${index}`);
    }

    function removeFarmProfile(index) {
        const farmProfiles = document.getElementById('farmProfiles');
        farmProfiles.removeChild(farmProfiles.children[index]);
    }

    function removeCropFarm(farmProfileIndex, index) {
        const cropFarms = document.getElementById(`cropFarms_${farmProfileIndex}`);
        cropFarms.removeChild(cropFarms.children[index]);
    }

    showStep(currentStep);
</script>


<script src="../assets/js/form.js"></script>


@endsection
