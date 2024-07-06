<div class="form_wrap">
    <div class="form_1 data_info">
        <h2>Personal Info</h2>
        <div class="content">
            <form method="post" action{{url('store') }}>
              @csrf
              <div class="user-details">
                <div class="input-box">
                  <span class="details">First Name</span>
                  <input type="text" class="form-control light-gray-placeholder @error('first_name') is-invalid @enderror" name="first_name" placeholder="Enter your firstname"value="{{ old('first_name') }}" >
                  @error('first_name')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="input-box">
                  <span class="details">Middle Name</span>
                  <input type="text" class="form-control light-gray-placeholder @error('middle_name') is-invalid @enderror" name="middle_name" placeholder="Enter your middlename"value="{{ old('middle_name') }}" >
                  @error('middle_name')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="input-box">
                    <span class="details">Last Name</span>
                    <input type="text" class="form-control light-gray-placeholder @error('last_name') is-invalid @enderror" name="last_name" placeholder="Enter your lastname"value="{{ old('last_name') }}" >
                    @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                <div class="input-box">
                  <span class="details">Extension name</span>
                  <select class="form-control light-gray-placeholder @error('extension_name') is-invalid @enderror"  name="extension_name"id="validationCustom01" aria-label="Floating label select e">
                    <option selected disabled>Select</option>
                    <option value="Sr." {{ old('extension_name') == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                    <option value="Jr." {{ old('extension_name') == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                    <option value="II" {{ old('extension_name') == 'II' ? 'selected' : '' }}>II</option>
                    <option value="III." {{ old('extension_name') == 'III.' ? 'selected' : '' }}>III</option>
                    <option value="N/A" {{ old('extension_name') == 'N/A' ? 'selected' : '' }}>N/A</option>
                    <option value="others" {{ old('extension_name') == 'others' ? 'selected' : '' }}>others</option>
                  </select>
                </div>
               
              
                
              </div>
         

            </form>
          </div>
    </div>
    <div class="form_2 data_info" style="display: none;">
        <h2>Demographic info</h2>
        
        <div class="content">
            <form method="post" action{{url('CornSave') }}>
              @csrf
              <div class="user-details">
                <div class="input-box">
                  <span class="details">Country</span>
                  <input type="text" class="form-control light-gray-placeholder @error('first_name') is-invalid @enderror" name="country" id="validationCustom01" value="Philippines" readonly >
                  @error('first_name')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="input-box">
                  <span class="details">Province</span>
                  <input type="text" class="form-control light-gray-placeholder @error('last_name') is-invalid @enderror" name="province" id="validationCustom01" value="Zamboanga del sur" readonly >
                  @error('last_name')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="input-box">
                  <span class="details">City</span>
                  <input type="text"name="email" class="form-control light-gray-placeholder @error('email') is-invalid @enderror" name="city" id="validationCustom01" value="Zamboanga City" readonly >
                  @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
                </div>
                <div class="input-box">
                  <span class="details">Agri-District</span>
                  <select class="form-control light-gray-placeholder @error('agri_district') is-invalid @enderror"  name="agri_district"id="validationCustom01" aria-label="Floating label select e">
                    <option selected disabled>Select Agri-District</option>
                    <option value="ayala" {{ old('agri_district') == 'ayala' ? 'selected' : '' }}>Ayala Distict</option>
                    <option value="tumaga" {{ old('agri_district') == 'tumaga' ? 'selected' : '' }}>Tumaga District</option>
                    <option value="culianan" {{ old('agri_district') == 'culianan' ? 'selected' : '' }}>Culianan District</option>
                    <option value="manicahan" {{ old('agri_district') == 'manicahan' ? 'selected' : '' }}>Manicahan District</option>
                    <option value="curuan" {{ old('agri_district') == 'curuan' ? 'selected' : '' }}>Curuan District</option>
                    <option value="vitali" {{ old('agri_district') == 'vitali' ? 'selected' : '' }}>Vitali District</option>
                  </select>
                </div>
                <div class="input-box">
                    <span class="details">Barangay</span>
                    <select class="form-control light-gray-placeholder @error('barangay') is-invalid @enderror"  name="barangay"id="validationCustom01" aria-label="Floating label select e">
                      <option selected disabled>Select Agri-District</option>
                      <option value="ayala" {{ old('barangay') == 'ayala' ? 'selected' : '' }}>Ayala Distict</option>
                      <option value="tumaga" {{ old('barangay') == 'tumaga' ? 'selected' : '' }}>Tumaga District</option>
                      <option value="culianan" {{ old('barangay') == 'culianan' ? 'selected' : '' }}>Culianan District</option>
                      <option value="manicahan" {{ old('barangay') == 'manicahan' ? 'selected' : '' }}>Manicahan District</option>
                      <option value="curuan" {{ old('barangay') == 'curuan' ? 'selected' : '' }}>Curuan District</option>
                      <option value="vitali" {{ old('barangay') == 'vitali' ? 'selected' : '' }}>Vitali District</option>
                    </select>
                  </div>

                <div class="input-box">
                  <span class="details">Contact No.</span>
                  <input type="text" name="contact_no" id="contact_no" class="form-control light-gray-placeholder @error('contact_no') is-invalid @enderror" placeholder="Confirm your password" autocomplete="new-password" value="{{ old('contact_no') }}" >
                  @error('contact_no')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="input-box">
                  <span class="details">Sex</span>
                  <select class="form-control light-gray-placeholder" name="sex"id="validationCustom01" aria-label="Floating label select e">
                    <option class="form-control light-gray-placeholder" selected disabled>Select sex</option>
                    <option  class="form-control light-gray-placeholder" value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                    
                  
                  </select>
                </div>
                <div class="input-box">
                    <span class="details">Religion</span>
                    <select class="form-control light-gray-placeholder" name="religion"id="validationCustom01" aria-label="Floating label select e">
                        <option selected disabled>Select</option>
                        <option value="Roman Catholic" {{ old('religion') == 'Roman Catholic' ? 'selected' : '' }}>Roman Catholic</option>
                        <option value="Iglesia Ni Cristo" {{ old('religion') == 'Iglesia Ni Cristo' ? 'selected' : '' }}>Iglesia Ni Cristo</option>
                        <option value="Seventh-day Adventist" {{ old('religion') == 'Seventh-day Adventist' ? 'selected' : '' }}>Seventh-day Adventist</option>
                        <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Born Again CHurch" {{ old('religion') == 'Born Again CHurch' ? 'selected' : '' }}>Born Again CHurch</option>
                        <option value="N/A" {{ old('religion') == 'N/A' ? 'selected' : '' }}>N/A</option>
                        <option value="other" {{ old('religion') == 'other' ? 'selected' : '' }}>other</option>
                    </select>
                  </div>
                  <div class="input-box">
                    <span class="details">Date of Birth</span>
                    <input type="text" class="form-control light-gray-placeholder @error('contact_no') is-invalid @enderror"name="date_of_birth" id="datepicker" placeholder="Date of Birth"
                    value="{{ old('date_of_birth') }}" data-input='true'> 
                    @error('contact_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="input-box">
                    <span class="details">Place of Birth</span>
                    <select class="form-control light-gray-placeholder" name="role"id="validationCustom01" aria-label="Floating label select e">
                      <option class="form-control light-gray-placeholder" selected disabled>Select</option>
                      <option  class="form-control light-gray-placeholder" value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                      <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>agent</option>
                      <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>user</option>
                    
                    </select>
                  </div>
                  <div class="input-box">
                    <span class="details">Civil Status</span>
                    <select class="form-control light-gray-placeholder" name="role"id="validationCustom01" aria-label="Floating label select e">
                      <option class="form-control light-gray-placeholder" selected disabled>Select role</option>
                      <option  class="form-control light-gray-placeholder" value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                      <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>agent</option>
                      <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>user</option>
                    
                    </select>
                  </div>
                  <div class="input-box">
                    <span class="details">No. of Children</span>
                    <select class="form-control light-gray-placeholder" name="role"id="validationCustom01" aria-label="Floating label select e">
                      <option class="form-control light-gray-placeholder" selected disabled>Select role</option>
                      <option  class="form-control light-gray-placeholder" value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                      <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>agent</option>
                      <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>user</option>
                    
                    </select>
                  </div>

                  <div class="input-box">
                    <span class="details">Mother's Maiden Name</span>
                    <input type="text" name="mothers_maiden_name" id="mothers_maiden_name" class="form-control light-gray-placeholder @error('mothers_maiden_name') is-invalid @enderror" placeholder="Mother's Maiden Name" autocomplete="new-password" value="{{ old('mothers_maiden_name') }}" >
                    @error('mothers_maiden_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="input-box">
                    <span class="details">Highest Formal Education</span>
                    <select class="form-control light-gray-placeholder" name="role"id="validationCustom01" aria-label="Floating label select e">
                        <option value="No Formal Education" {{ old('highest_formal_education') == 'No Formal Education' ? 'selected' : '' }}>No Formal Education</option>
                        <option value="Primary Education" {{ old('highest_formal_education') == 'Primary Education' ? 'selected' : '' }}>Primary Education</option>
                        <option value="Secondary Education" {{ old('highest_formal_education') == 'Secondary Education' ? 'selected' : '' }}>Secondary Education</option>
                        <option value="Vocational Training" {{ old('highest_formal_education') == 'Vocational Training' ? 'selected' : '' }}>Vocational Training</option>
                        <option value="Bachelors Degree" {{ old('highest_formal_education') == 'Bachelors Degree' ? 'selected' : '' }}>Bachelor's Degree</option>
                        <option value="Masters Degree" {{ old('highest_formal_education') == 'Masters Degree' ? 'selected' : '' }}>Master's Degree</option>
                        <option value="Doctorate" {{ old('highest_formal_education') == 'Doctorate' ? 'selected' : '' }}>Doctorate</option>
                        <option value="Other" {{ old('highest_formal_education') == 'Other' ? 'selected' : '' }}>Other</option>
                    
                    </select>
                  </div>

                  <div class="input-box">
                    <span class="details">Person with Disability</span>
                    <select class="form-control light-gray-placeholder" name="sex"id="validationCustom01" aria-label="Floating label select e">
                        <option selected disabled>Select</option>
                        <option value="Yes" {{ old('person_with_disability') == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('person_with_disability') == 'No' ? 'selected' : '' }}>No</option>
                        
                    
                    </select>
                  </div>

                  <div class="input-box"id="YesInputSelected" style="display: none;" >
                    <span class="details">PWD ID No.</span>
                    <input type="text" name="pwd_id_no" id="pwd_id_no" class="form-control light-gray-placeholder @error('pwd_id_no') is-invalid @enderror" placeholder="Mother's Maiden Name" autocomplete="new-password" value="{{ old('pwd_id_no') }}" >
                    @error('pwd_id_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>


                  <div class="input-box" id="NoInputSelected" style="display: none;">
                    <span class="details">PWD ID No</span>
                    <select class="form-control @error('pwd_id_no') is-invalid @enderror" name="pwd_id_no"id="selectFgroups"onchange="checkfarmGroup()" aria-label="Floating label select e">
                        <option selected disabled>Select</option>
                        <option value="N/A" {{ old('pwd_id_no') == 'N/A' ? 'selected' : '' }}>N/A</option>
                        
                        
                      
                      </select>
                  </div>
               

                  <div class="input-box">
                    <span class="details">Government Issued ID</span>
                    <select class="form-control @error('government_issued_id') is-invalid @enderror"  name="government_issued_id"id="selectGov"onchange="CheckGoverniD()" aria-label="Floating label select e">
                        <option selected disabled>Select</option>
                        <option value="Yes" {{ old('government_issued_id') == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('government_issued_id') == 'No' ? 'selected' : '' }}>No</option>
                      
                      </select>
                  </div>

                  <div class="input-box" id="iDtypeSelected" style="display: none;">
                    <span class="details">Gov ID Type</span>
                    <select class="form-control @error('id_type') is-invalid @enderror" name="id_type"id="selectIDType"onchange="checkIDtype()" aria-label="Floating label select e">
                        <option selected disabled>Select</option>
                        <option value="Driver License" {{ old('id_type') == 'Driver License' ? 'selected' : '' }}>Driver License</option>
                          <option value="Passport" {{ old('id_type') == 'Passport' ? 'selected' : '' }}>Passport</option>
                          <option value="Postal ID" {{ old('id_type') == 'Postal ID' ? 'selected' : '' }}>Postal ID</option>
                          <option value="Phylsys ID" {{ old('id_type') == 'Phylsys ID' ? 'selected' : '' }}>Phylsys ID</option>
                          <option value="PRC ID" {{ old('id_type') == 'PRC ID' ? 'selected' : '' }}>PRC ID</option>
                          <option value="Brgy. ID" {{ old('id_type') == 'Brgy. ID' ? 'selected' : '' }}>Brgy. ID</option>
                          <option value="Voters ID" {{ old('id_type') == 'Voters ID' ? 'selected' : '' }}>Voters ID</option>
                          <option value="Senior ID" {{ old('id_type') == 'Senior ID' ? 'selected' : '' }}>Senior ID</option>
                          <option value="PhilHealth ID" {{ old('id_type') == 'PhilHealth ID' ? 'selected' : '' }}>PhilHealth ID</option>
                          <option value="Tin ID" {{ old('id_type') == 'Tin ID' ? 'selected' : '' }}>Tin ID</option>
                          <option value="BIR ID" {{ old('id_type') == 'BIR ID' ? 'selected' : '' }}>BIR ID</option>
                          <option value="N/A" {{ old('id_type') == 'N/A' ? 'selected' : '' }}>N/A</option>
                          <option value="add Id Type" {{ old('id_type') == 'add Id Type' ? 'selected' : '' }}>Other ID Type</option>
                        {{-- <option value="add Id Type" {{ old('id_type') == 'add Id Type' ? 'selected' : '' }}>Other ID Type</option> --}}
        
                      
                      </select>
                  @error('id_type')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                  <div class="input-box"  id="idNoInput" style="display: none;">
                    <span class="details">Gov-ID no.</span>
                    <input type="text" name="add_Idtype" id="add_Idtype" class="form-control light-gray-placeholder @error('add_Idtype') is-invalid @enderror" placeholder="gove id no" autocomplete="new-password" value="{{ old('add_Idtype') }}" >
                    @error('add_Idtype')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
               
                  <div class="input-box"  id="NoSelected" style="display: none;">
                    <span class="details">Non-Gov ID</span>
                    <input type="text" name="id_types" id="id_types" class="form-control light-gray-placeholder @error('id_types') is-invalid @enderror" placeholder="non-gov id" autocomplete="new-password" value="{{ old('id_types') }}" >
                    @error('id_types')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
               
              </div>
         

            </form>
          </div>
    </div>
    <div class="form_3 data_info" style="display: none;">
        <h2>Association Info</h2>
        <div class="content">
            <form method="post" action{{url('store') }}>
              @csrf
              <div class="user-details">
                <div class="input-box">
                    <span class="details">Member of any Farmers Ass/Org/Coop</span>
                    <select class="form-control @error('member_ofany_farmers_ass_org_coop') is-invalid @enderror" id="selectMember"onchange="checkMmbership()" name="member_ofany_farmers_ass_org_coop" aria-label="Floating label select e">
                        <option selected disabled>Select</option>
                        <option value="Yes" {{ old('member_ofany_farmers_ass_org_coop') == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('member_ofany_farmers_ass_org_coop') == 'No' ? 'selected' : '' }}>No</option>
                      
                      </select>
                      @error('member_ofany_farmers_ass_org_coop')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                  <div class="input-box" id="YesFarmersGroup" style="display: none;font-size: 12px">
                    <span class="details">Name of Farmers Ass/Org/Coop</span>
                    <select class="form-control @error('nameof_farmers_ass_org_coop') is-invalid @enderror" name="nameof_farmers_ass_org_coop"id="selectFarmgroups"onchange="checkFarmerGrp()" aria-label="Floating label select e">
                        <option selected disabled>Select</option>
                        <option value="Bagong Pag Asa Buenavista Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Bagong Pag Asa Buenavista Farmers Association' ? 'selected' : '' }}>Bagong Pag Asa Buenavista Farmers Association</option>
                        <option value="Bataan Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Bataan Farmers Association' ? 'selected' : '' }}>Bataan Farmers Association</option>
                        <option value="Bincul Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Bincul Farmers Association' ? 'selected' : '' }}>Bincul Farmers Association</option>
                        <option value="Boalan Irrigators Association" {{ old('nameof_farmers_ass_org_coop') == 'Boalan Irrigators Association' ? 'selected' : '' }}>Boalan Irrigators Association</option>
                        <option value="Buenavista Farmers Swisa" {{ old('nameof_farmers_ass_org_coop') == 'Buenavista Farmers Swisa' ? 'selected' : '' }}>Buenavista Farmers Swisa</option>
                        <option value="Cabaluay Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Cabaluay Farmers Association' ? 'selected' : '' }}>Cabaluay Farmers Association</option>
                        <option value="Camino Nuevo Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Camino Nuevo Farmers Association' ? 'selected' : '' }}>Camino Nuevo Farmers Association</option>
                        <option value="Dabuy Farmers Owners Irrigators" {{ old('nameof_farmers_ass_org_coop') == 'Dabuy Farmers Owners Irrigators' ? 'selected' : '' }}>Dabuy Farmers Owners Irrigators</option>
                        <option value="Dumalon River Irrigators Assciation" {{ old('nameof_farmers_ass_org_coop') == 'Dumalon River Irrigators Assciation' ? 'selected' : '' }}>Dumalon River Irrigators Assciation</option>
                        <option value="Guisao Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Guisao Farmers Association' ? 'selected' : '' }}>Guisao Farmers Association</option>
                        <option value="Guisao/Cabaluay Farmers Irrigators Assoc. Inc." {{ old('nameof_farmers_ass_org_coop') == 'Guisao/Cabaluay Farmers Irrigators Assoc. Inc.' ? 'selected' : '' }}>Guisao/Cabaluay Farmers Irrigators Assoc. Inc.</option>
                        <option value="Guiwan Farmers  Association" {{ old('nameof_farmers_ass_org_coop') == 'Guiwan Farmers  Association' ? 'selected' : '' }}>Guiwan Farmers  Association</option>
                        <option value="Hybrid Rice & Vegetables Farmers Association Inc." {{ old('nameof_farmers_ass_org_coop') == 'Hybrid Rice & Vegetables Farmers Association Inc.' ? 'selected' : '' }}>Hybrid Rice & Vegetables Farmers Association Inc.</option>
                        <option value="Inner Mangusu & FishFolks Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Inner Mangusu & FishFolks Farmers Association' ? 'selected' : '' }}>Inner Mangusu & FishFolks Farmers Association</option>
                        <option value="Licomo Inner Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Licomo Inner Farmers Association' ? 'selected' : '' }}>Licomo Inner Farmers Association</option>
                        <option value="Lower Mangusu Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Lower Mangusu Farmers Association' ? 'selected' : '' }}>Lower Mangusu Farmers Association</option>
                        <option value="Lower Quiniput Irrigated Association" {{ old('nameof_farmers_ass_org_coop') == 'Lower Quiniput Irrigated Association' ? 'selected' : '' }}>Lower Quiniput Irrigated Association</option>
                        <option value="Lower Tigbao Tictapuk Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Lower Tigbao Tictapuk Farmers Association' ? 'selected' : '' }}>Lower Tigbao Tictapuk Farmers Association</option>
                        <option value="Lukmadalum Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Lukmadalum Farmers Association' ? 'selected' : '' }}>Lukmadalum Farmers Association</option>
                        <option value="Lunday II Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Licomo Inner Farmers Association' ? 'selected' : '' }}>Licomo Inner Farmers Association</option>
                        <option value="Mabutad Rice Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Mabutad Rice Farmers Association' ? 'selected' : '' }}>Mabutad Rice Farmers Association</option>
                        <option value="Mangusu Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Mangusu Farmers Association' ? 'selected' : '' }}>Mangusu Farmers Association</option>
                        <option value="Manicahan Busug Tadtanan Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Manicahan Busug Tadtanan Farmers Association' ? 'selected' : '' }}>Manicahan Busug Tadtanan Farmers Association</option>
                        <option value="Masaba Quiniput Irrigated Association" {{ old('nameof_farmers_ass_org_coop') == 'Masaba Quiniput Irrigated Association' ? 'selected' : '' }}>Masaba Quiniput Irrigated Association</option>
                        <option value="MCCT-IA" {{ old('nameof_farmers_ass_org_coop') == 'MCCT-IA' ? 'selected' : '' }}>MCCT-IA</option>
                        <option value="Mercedes Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Mercedes Farmers Association' ? 'selected' : '' }}>Mercedes Farmers Association</option>
                        <option value="Mialim Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Mialim Farmers Association' ? 'selected' : '' }}>Mialim Farmers Association</option>
                        <option value="Pamucutan CamaCoop Talisayan Irrigators Association" {{ old('nameof_farmers_ass_org_coop') == 'Pamucutan CamaCoop Talisayan Irrigators Association' ? 'selected' : '' }}>Pamucutan CamaCoop Talisayan Irrigators Association</option>
                        <option value="PasoMaria Farmers Irrigators Association" {{ old('nameof_farmers_ass_org_coop') == 'PasoMaria Farmers Irrigators Association' ? 'selected' : '' }}>PasoMaria Farmers Irrigators Association</option>
                        <option value="Pasonanca Irrigators Association" {{ old('nameof_farmers_ass_org_coop') == 'Pasonanca Irrigators Association' ? 'selected' : '' }}>Pasonanca Irrigators Association</option>
                        <option value="Presa Curuan Irrigation Association" {{ old('nameof_farmers_ass_org_coop') == 'Presa Curuan Irrigation Association' ? 'selected' : '' }}>Presa Curuan Irrigation Association</option>
                        <option value="Proper Mangusu Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Proper Mangusu Farmers Association' ? 'selected' : '' }}>Proper Mangusu Farmers Association</option>
                        <option value="San Isidro Bolong Association" {{ old('nameof_farmers_ass_org_coop') == 'San Isidro Bolong Association' ? 'selected' : '' }}>San Isidro Bolong Association</option>
                        <option value="San Isidro Hybrid Inbrid Rice & Vegetable Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'San Isidro Hybrid Inbrid Rice & Vegetable Farmers Association' ? 'selected' : '' }}>San Isidro Hybrid Inbrid Rice & Vegetable Farmers Association</option>
                        <option value="Sibutat Curuan Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Sibutat Curuan Farmers Association' ? 'selected' : '' }}>Sibutat Curuan Farmers Association</option>
                        <option value="Sibutat Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Sibutat Farmers Association' ? 'selected' : '' }}>Sibutat Farmers Association</option>
                        <option value="Suguinan & Compania Bunguiao Irrigators Association" {{ old('nameof_farmers_ass_org_coop') == 'Suguinan & Compania Bunguiao Irrigators Association' ? 'selected' : '' }}>Suguinan & Compania Bunguiao Irrigators Association</option>
                        <option value="Tagasilay Lowland Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Tagasilay Lowland Farmers Association' ? 'selected' : '' }}>Tagasilay Lowland Farmers Association</option>
                        <option value="Talabaan Rice Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Talabaan Rice Farmers Association' ? 'selected' : '' }}>Talabaan Rice Farmers Association</option>
                        <option value="Taloptap Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Taloptap Farmers Association' ? 'selected' : '' }}>Taloptap Farmers Association</option>
                        <option value="Tamaraan  Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Tamaraan  Farmers Association' ? 'selected' : '' }}>Tamaraan  Farmers Association</option>
                        <option value="Tamion Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Tamion Farmers Association' ? 'selected' : '' }}>Tamion Farmers Association</option>
                        <option value="Tigbao Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Tigbao Farmers Association' ? 'selected' : '' }}>Tigbao Farmers Association</option>
                        <option value="Tindalo Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Tindalo Farmers Association' ? 'selected' : '' }}>Tindalo Farmers Association</option>
                        <option value="Toctobo Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'Toctobo Farmers Association' ? 'selected' : '' }}>Toctobo Farmers Association</option>
                        <option value="UC Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'UC Farmers Association' ? 'selected' : '' }}>UC Farmers Association</option>
                        <option value="UNILE Christian Farmers Association" {{ old('nameof_farmers_ass_org_coop') == 'UNILE Christian Farmers Association' ? 'selected' : '' }}>UNILE Christian Farmers Association</option>
                        <option value="Upper and Lower Quiniput Farmers Irrigation Association" {{ old('nameof_farmers_ass_org_coop') == 'Upper and Lower Quiniput Farmers Irrigation Association' ? 'selected' : '' }}>Upper and Lower Quiniput Farmers Irrigation Association</option>
                        <option value="add" {{ old('id_type') == 'add' ? 'selected' : '' }}>Add</option>
                       
      
                      
                      </select>
                    @error('nameof_farmers_ass_org_coop')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="input-box" id="NoFarmersGroup" style="display: none;font-size: 12px">
                    <span class="details">Name of Farmers Ass/Org/Coop</span>
                    <select class="form-control @error('nameof_farmers_ass_org_coop') is-invalid @enderror" name="nameof_farmers_ass_org_coop"id="selectFgroups"onchange="checkfarmGroup()" aria-label="Floating label select e">
                        <option selected disabled>Select</option>
                        <option value="N/A" {{ old('nameof_farmers_ass_org_coop') == 'N/A' ? 'selected' : '' }}>N/A</option>
                        
                        
                      
                      </select>
                  </div>

                  <div class="input-box" id="newFarmerGroupInput" style="display: none;">
                    <span class="details">Add farmers org/assoc/Coop</span>
                    <input type="text" class="form-control light-gray-placeholder @error('add_FarmersGroup') is-invalid @enderror" name="add_FarmersGroup" placeholder="Enter your lastname"value="{{ old('add_FarmersGroup') }}" >
                    @error('add_FarmersGroup')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                <div class="input-box">
                    <span class="details">Name of Contact Person</span>
                    <input type="text" class="form-control light-gray-placeholder @error('name_contact_person') is-invalid @enderror" name="name_contact_person" placeholder="Enter your lastname"value="{{ old('name_contact_person') }}" >
                    @error('name_contact_person')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                  <div class="input-box">
                    <span class="details">Celphone/Tel.no</span>
                    <input type="text" class="form-control light-gray-placeholder @error('cp_tel_no') is-invalid @enderror" name="cp_tel_no" placeholder="Enter your lastname"value="{{ old('cp_tel_no') }}" >
                    @error('cp_tel_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
               
              
                
              </div>
         

            </form>
          </div>