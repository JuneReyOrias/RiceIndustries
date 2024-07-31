$(document).ready(function() {
    $(document).on('click', '.btn-submit', function(event) {
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


document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#datepicker", {
        dateFormat: "Y-m-d", // Date format (YYYY-MM-DD)
        // Additional options can be added here
    });
}); <


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






// <?php

// $manicahanData = $personalinfos->barangay;

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
    // var manicahan = <?php echo json_encode($manicahanData); ?>;
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
            organizations = ["Org Manicahan 1", "Org Manicahan 2"];
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