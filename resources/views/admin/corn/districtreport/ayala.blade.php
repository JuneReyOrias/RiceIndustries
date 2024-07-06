@extends('admin.dashb')

@section('admin')
    @extends('layouts._footer-script')
    @extends('layouts._head')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap');
        
        :root{
            --primary: #6b59d3;
            --fourth:#05a34a;
            --secondary: #bfc0c0;
            --third:#ffffffc5;
            --white: #fff;
            --text-clr: #5b6475;
            --header-clr: #25273d;
            --next-btn-hover: #8577d2;
            --back-btn-hover: #8b8c8c;
        }
        
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            list-style: none;
            outline: none;
            font-family: 'Open Sans', sans-serif;
        }
        
        body{
            background: var(--third);
            color: var(--text-clr);
            font-size: 16px;
            position: relative;
        }
        
        /* .card-body{
            width: 750px;
            max-width: 80%;
            background: var(--white);
            margin: 10px auto 0;
            padding: 50px;
            border-radius: 5px;
        } */
        
        .card-body .header{
            margin-bottom: 35px;
            display: flex;
            justify-content: center;
        }
        
        .card-body .header ul{
            display: flex;
        }
        
        .card-body .header ul li{
            margin-right: 50px;
            position: relative;
        }
        
        .card-body .header ul li:last-child{
            margin-right: 0;
        }
        
        .card-body .header ul li:before{
            content: "";
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 55px;
            width: 100%;
            height: 2px;
            background: var(--secondary);
        }
        
        .card-body .header ul li:last-child:before{
            display: none;
        }
        
        .card-body .header ul li div{
            padding: 5px;
            border-radius: 50%;
        }
        
        .card-body .header ul li p{
            width: 50px;
            height: 50px;
            background: var(--secondary);
            color: var(--white);
            text-align: center;
            line-height: 50px;
            border-radius: 50%;
        }
        
        .card-body .header ul li.active:before{
            background: var(--primary);
        }
        
        .card-body .header ul li.active p{
            background: var(--primary);
        }
        
        .card-body.form_wrap{
            margin-bottom: 35px;
        }
        
        .card-body .form_wrap h2{
            color: var(--header-clr);
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        
        .card-body .form_wrap .input_wrap{
            width: 350px;
            max-width: 100%;
            margin: 0 auto 20px;
        }
        
        .card-body .form_wrap .input_wrap:last-child{
            margin-bottom: 0;
        }
        
        .card-body .form_wrap .input_wrap label{
            display: block;
            margin-bottom: 5px;
        }
        .placeholder-multiform{
            border: 2px solid var(--secondary);
        }
        .card-body .form_wrap .input_wrap .form-control{
            border: 2px solid var(--secondary);
            border-radius: 3px;
            padding: 10px;
            display: block;
            height: auto;
            width: 100%;	
            font-size: 16px;
            transition: 0.5s ease;
        }
        
        .card-body .form_wrap .input_wrap .form-control:focus{
            border-color: var(--primary);
        }
        
        .card-body .btns_wrap{
            width: 350px;
            max-width: 100%;
            margin: 0 auto;
        }
        
        .card-body .btns_wrap .common_btns{
            display: flex;
            justify-content: space-between;
        }
        
        .card-body .btns_wrap .common_btns.form_1_btns{
            justify-content: flex-end;
        }
        
        .card-body .btns_wrap .common_btns button{
            border: 0;
            padding: 12px 15px;
            background: var(--fourth);
            color: var(--white);
            width: 135px;
            justify-content: center;
            display: flex;
            align-items: center;
            font-size: 16px;
            border-radius: 3px;
            transition: 0.5s ease;
            cursor: pointer;
        }
        
        .card-body .btns_wrap .common_btns button.btn_back{
            background: var(--secondary);
        }
        
        .card-body .btns_wrap .common_btns button.btn_next .icon{
            display: flex;
            margin-left: 10px;
        }
        
        .card-body .btns_wrap .common_btns button.btn_back .icon{
            display: flex;
            margin-right: 10px;
        }
        
        .card-body .btns_wrap .common_btns button.btn_next:hover,
        .card-body .btns_wrap .common_btns button.btn_done:hover{
            background: var (--next-btn-hover);
        }
        
        .card-body .btns_wrap .common_btns button.btn_back:hover{
            background: var (--back-btn-hover);
        }
        
        .modal_wrapper{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            visibility: hidden;
        }
        
        .modal_wrapper .shadow{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            opacity: 0;
            transition: 0.2s ease;
        }
        
        .modal_wrapper .success_wrap{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-800px);
            background: var(--white);
            padding: 50px;
            display: flex;
            align-items: center;
            border-radius: 5px;
            transition: 0.5s ease;
        }
        
        .modal_wrapper .success_wrap .modal_icon{
            margin-right: 20px;
            width: 30px;
            height: 50px;
            background: var(--primary);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 700;
        }
        
        .modal_wrapper.active{
            visibility: visible;
        }
        
        .modal_wrapper.active .shadow{
            opacity: 1;
        }
        
        .modal_wrapper.active .success_wrap{
            transform: translate(-50%,-50%);
        }
        .light-gray-placeholder::placeholder {
        color: lightgray;
    }



    
    </style>

<div class="page-content">
    <div class="card-forms border rounded">

    
        <div class="card-forms border rounded">

            <div class="card-body">
              
           
            <div class="content">
            <form id="multi-step-form" action{{url('CornSave')}} method="post">
                @csrf
             <!-- Step 1 -->
    <div class="form_step form_1">
        <h2>Step 1: Step Title</h2>
        <input type="text" placeholder="Field 1">
        <div class="form_btns form_1_btns">
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 2 -->
    <div class="form_step form_2">
        <h2>Step 2: Step Title</h2>
        <input type="text" placeholder="Field 2">
        <div class="form_btns form_2_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 3 -->
    <div class="form_step form_3">
        <h2>Step 3: Step Title</h2>
        <textarea placeholder="Field 3"></textarea>
        <div class="form_btns form_3_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 4 -->
    <div class="form_step form_4">
        <h2>Step 4: Step Title</h2>
        <input type="text" placeholder="Field 4">
        <div class="form_btns form_4_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 5 -->
    <div class="form_step form_5">
        <h2>Step 5: Step Title</h2>
        <input type="text" placeholder="Field 5">
        <div class="form_btns form_5_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 6 -->
    <div class="form_step form_6">
        <h2>Step 6: Step Title</h2>
        <input type="text" placeholder="Field 6">
        <div class="form_btns form_6_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 7 -->
    <div class="form_step form_7">
        <h2>Step 7: Step Title</h2>
        <input type="text" placeholder="Field 7">
        <div class="form_btns form_7_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 8 -->
    <div class="form_step form_8">
        <h2>Step 8: Step Title</h2>
        <input type="text" placeholder="Field 8">
        <div class="form_btns form_8_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 9 -->
    <div class="form_step form_9">
        <h2>Step 9: Step Title</h2>
        <input type="text" placeholder="Field 9">
        <div class="form_btns form_9_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 10 -->
    <div class="form_step form_10">
        <h2>Step 10: Step Title</h2>
        <input type="text" placeholder="Field 10">
        <div class="form_btns form_10_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 11 -->
    <div class="form_step form_11">
        <h2>Step 11: Step Title</h2>
        <input type="text" placeholder="Field 11">
        <div class="form_btns form_11_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 12 -->
    <div class="form_step form_12">
        <h2>Step 12: Step Title</h2>
        <input type="text" placeholder="Field 12">
        <div class="form_btns form_12_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 13 -->
    <div class="form_step form_13">
        <h2>Step 13: Step Title</h2>
        <input type="text" placeholder="Field 13">
        <div class="form_btns form_13_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 14 -->
    <div class="form_step form_14">
        <h2>Step 14: Step Title</h2>
        <input type="text" placeholder="Field 14">
        <div class="form_btns form_14_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Step 15 -->
    <div class="form_step form_15">
        <h2>Step 15: Step Title</h2>
        <input type="text" placeholder="Field 15">
        <div class="form_btns form_15_btns">
            <button class="btn_back">Back</button>
            <button class="btn_next">Next</button>
        </div>
    </div>

    <!-- Modal for Confirmation -->
    <div class="modal_wrapper">
        <div class="modal">
            <h2>Thank You!</h2>
            <p>Your form has been submitted.</p>
            <button class="btn_done">Close</button>
        </div>
        <div class="shadow"></div>
    </div>
</div>

            {{-- <div class="btns_wrap">
                <div class="common_btns form_1_btns">
                    <button type="button" class="btn_next">Next <span class="icon"><ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
                </div>
                <div class="common_btns form_2_btns" style="display: none;">
                    <button type="button" class="btn_back"><span class="icon"><ion-icon name="arrow-back-sharp"></ion-icon></span>Back</button>
                    <button type="button" class="btn_next">Next <span class="icon"><ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
                </div>
                <div class="common_btns form_3_btns" style="display: none;">
                    <button type="button" class="btn_back"><span class="icon"><ion-icon name="arrow-back-sharp"></ion-icon></span>Back</button>
                    <button type="submit" class="btn btn-success me-md-2 btn-submit">Done</button>
                </div>
            </div> --}}
        </div>
    </div>
        <div class="modal_wrapper">
            <div class="shadow"></div>
            <div class="success_wrap">
                <span class="modal_icon"><ion-icon name="checkmark-sharp"></ion-icon></span>
                <p>You have successfully completed the process.</p>
            </div>
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
    
{{--     
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
    </script> --}}
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
        var selectPWD = document.getElementById("selectPWD");
        var YesInputSelected = document.getElementById("YesInputSelected");
        var NoInputSelected = document.getElementById("NoInputSelected");
    
        if (selectPWD.value === "Yes") {
            YesInputSelected.style.display = "block";
            NoInputSelected.style.display = "none";
        } else if (selectPWD.value === "No") {
            NoInputSelected.style.display = "block";
            YesInputSelected.style.display = "none";
        } else {
            YesInputSelected.style.display = "none";
            NoInputSelected.style.display = "none";
        }
    }
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
        var MariedInputSelected = document.getElementById("MariedInputSelected");
        var SinWidDevInput = document.getElementById("SinWidDevInput");
    
        if (selectCivil.value === "Maried") {
            MariedInputSelected.style.display = "block";
            SinWidDevInput.style.display = "none";
        } else if (selectCivil.value === "Single" || selectCivil.value === "Widow" || selectCivil.value === "Divorced") {
            SinWidDevInput.style.display = "block";
            MariedInputSelected.style.display = "none";
        } else {
            MariedInputSelected.style.display = "none";
            SinWidDevInput.style.display = "none";
        }
    }
    
    
    
    
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
                    barangays = ["Taloptap", "Tindalo","Camino Nuevo,", "Tamion","Bataan","Tuktubo","Mialim","Lower Tigbao, Tictapul","Manguso","Inner Manguso","Bincul,Manguso","Sinalikway,Manguso","Upper Manguso","Dungcaan,Manguso", "Tamaraan, Manguso","Licomo"];
                    break;
                case 'culianan':
                    barangays = ["Barangay Culianan 1", "Barangay Culianan 2"];
                    break;
                case 'tumaga':
                    barangays = ["Boalan", "Guiwan","Cabatangan"];
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
    
        // Function to check agri_district and display barangay input accordingly
        function checkAgri() {
            var agriDistrict = document.getElementById("selectAgri").value;
            var barangayInput = document.getElementById("barangayInput");
    
            if (['ayala', 'vitali', 'culianan', 'tumaga', 'manicahan', 'curuan'].includes(agriDistrict)) {
                barangayInput.style.display = "block"; // Show barangay input
                populateBarangays(agriDistrict); // Populate barangays based on selected district
            } else {
                barangayInput.style.display = "none"; // Hide barangay input
            }
        }
    
        // Call the checkAgri function when the page loads
        window.onload = checkAgri;
    
        // Call the checkAgri function when the agri_district selection changes
        document.getElementById("selectAgri").addEventListener("change", checkAgri);
    
        // Call the handleBarangaySelection function when a barangay is selected
        document.getElementById("SelectBarangay").addEventListener("change", handleBarangaySelection);
    
    </script>

<!-- Include necessary JavaScript -->
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
            document.querySelectorAll(".progress").forEach(function(progress, index) {
                if (index <= stepIndex) {
                    progress.classList.add("active");
                } else {
                    progress.classList.remove("active");
                }
            });
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
@endsection
