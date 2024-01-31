<div>
    <div wire:loading.delay>
        <div :style="`display: ${!isLoading ? 'flex' : 'none'};`" style="display: none;" class="loader-container">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>


    <div  :style="`display: ${isLoading ? 'flex' : 'none'};`" style="display: none;" class="loader-container">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
