<!-- resources/views/form/partials/farm-steps.blade.php -->

<div class="form-step form_2">
    <h2>Step 2: Farm Information (Farm {{ $index }})</h2>
    <div class="form-group">
        <label for="farm_name_{{ $index }}">Farm Name</label>
        <input type="text" class="form-control" id="farm_name_{{ $index }}" name="farms[{{ $index }}][name]" required>
        @error('farms.' . $index . '.name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="farm_location_{{ $index }}">Farm Location</label>
        <input type="text" class="form-control" id="farm_location_{{ $index }}" name="farms[{{ $index }}][location]" required>
        @error('farms.' . $index . '.location')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form_2_btns">
        <button type="button" class="btn btn-primary btn_next">Next</button>
    </div>
</div>

<div class="form-step form_3" style="display: none;">
    <h2>Step 3: Farm Details (Farm {{ $index }})</h2>
    <div class="form-group">
        <label for="farm_size_{{ $index }}">Farm Size</label>
        <input type="text" class="form-control" id="farm_size_{{ $index }}" name="farms[{{ $index }}][size]" required>
        @error('farms.' . $index . '.size')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="farm_type_{{ $index }}">Farm Type</label>
        <input type="text" class="form-control" id="farm_type_{{ $index }}" name="farms[{{ $index }}][type]" required>
        @error('farms.' . $index . '.type')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form_3_btns" style="display: none;">
        <button type="button" class="btn btn-secondary btn_back mr-2">Back</button>
        <button type="button" class="btn btn-primary btn_next">Next</button>
    </div>
</div>

<div class="form-step form_4" style="display: none;">
    <h2>Step 4: Additional Details (Farm {{ $index }})</h2>
    <div class="form-group">
        <label for="farm_additional_{{ $index }}">Additional Information</label>
        <input type="text" class="form-control" id="farm_additional_{{ $index }}" name="farms[{{ $index }}][additional]" required>
        @error('farms.' . $index . '.additional')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form_4_btns" style="display: none;">
        <button type="button" class="btn btn-secondary btn_back mr-2">Back</button>
    </div>
</div>
