<footer class="footer mt-0 py-1 bg-light float text-center ani ani_slideInUp ani_faster">
    <div class="row w-100">
        <div class="col-1">
            <span class="glow" wire:click="$emitTo('body','changeBody','create')">                        
                <i class="bi bi-plus-square-dotted fs-2 px-1"></i>
            </span>
        </div>
        <div class="col-10">
            <i aria-label="go next" class="glow mx-1 fs-2 bi bi-arrow-right" title="next" wire:click="$emitTo('body','goNext')" role="button" tabindex="0"></i>
            <i aria-label="home" class="glow mx-4 fs-2 bi bi-house cursor" wire:click="$emitTo('body','changeBody','feeds')" role="button" tabindex="0"></i>
            <i aria-label="go back" class="glow mx-1 fs-2 bi bi-arrow-left" title="back" wire:click="$emitTo('body','goBack')" role="button" tabindex="0"></i>
        </div>
    </div>
</footer>
