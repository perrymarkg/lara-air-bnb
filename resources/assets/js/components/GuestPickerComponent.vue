<template>
    <div class="test">
        <input type="text" placeholder="1 Guest" />
        <div class="guest-picker-dropdown border rounded p-2 bg-white">
            <div class="row mb-3">
                <div class="col-md-6">Adults</div>
                <div class="col-md-2 text-center">
                    <button class="adult-minus btn btn-sm btn-primary" disabled="">-</button>
                </div>
                <div class="col-md-2 text-center p-0">
                    <input type="number" value="1" min="1" class="adult-input border-0 p-0 text-center" readonly="">
                </div>
                <div class="col-md-2 text-center">
                    <button class="adult-add btn btn-sm btn-primary">+</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">Children</div>
                <div class="col-md-2 text-center">
                    <button class="child-minus btn btn-sm btn-primary" disabled="">-</button>
                </div>
                <div class="col-md-2 text-center p-0">
                    <input type="number" value="0" min="0" class="child-input border-0 p-0 text-center" readonly="">
                </div>
                <div class="col-md-2 text-center">
                    <button class="child-add btn btn-sm btn-primary">+</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>