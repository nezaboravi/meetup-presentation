<div 
    x-data="{ 
        currentSlide: @entangle('currentSlide'),
        showOverlay: true,
        init() {
            window.addEventListener('keydown', (e) => {
                if (this.showOverlay) {
                    document.documentElement.requestFullscreen();
                    this.showOverlay = false;
                    return;
                }
                if (e.key === 'ArrowRight' || e.key === ' ') {
                    $wire.next();
                } else if (e.key === 'ArrowLeft') {
                    $wire.previous();
                }
            });
        }
    }"
    class="min-h-screen bg-[#1a1c23] text-white overflow-y-auto relative"
    @click="if (showOverlay) { document.documentElement.requestFullscreen(); showOverlay = false }"
>
    <!-- Fullscreen Overlay -->
    <div 
        x-show="showOverlay"
        class="fixed inset-0 bg-black bg-opacity-80 flex flex-col items-center justify-center z-50"
        style="backdrop-filter: blur(2px);"
    >
        <h2 class="text-3xl text-white mb-4 font-bold">Ready to Present?</h2>
        <p class="text-lg text-gray-200 mb-8">Click anywhere or press any key to enter fullscreen mode.</p>
        <svg class="w-12 h-12 text-[#ff2d20] animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4V4z"/>
        </svg>
    </div>

    {{-- Progress Bar --}}
    <div class="fixed top-0 left-0 right-0 h-1 bg-gray-800 z-20">
        <div 
            class="h-full bg-[#ff2d20] transition-all duration-300"
            :style="`width: ${((currentSlide + 1) / {{ count($slides) }}) * 100}%`"
        ></div>
    </div>

    {{-- Slide Counter --}}
    <div class="fixed bottom-4 right-4 text-sm text-gray-400 z-20">
        <span x-text="currentSlide + 1"></span>/<span>{{ count($slides) }}</span>
    </div>

    {{-- Navigation Buttons --}}
    <div class="fixed bottom-4 left-4 space-x-2 z-20">
        <button 
            wire:click="previous"
            class="px-4 py-2 bg-[#2d3748] rounded-lg hover:bg-[#4a5568] transition-colors"
            :class="{ 'opacity-50 cursor-not-allowed': currentSlide === 0 }"
            :disabled="currentSlide === 0"
        >
            Previous
        </button>
        <button 
            wire:click="next"
            class="px-4 py-2 bg-[#2d3748] rounded-lg hover:bg-[#4a5568] transition-colors"
            :class="{ 'opacity-50 cursor-not-allowed': currentSlide === {{ count($slides) - 1 }} }"
            :disabled="currentSlide === {{ count($slides) - 1 }}"
        >
            Next
        </button>
    </div>

    {{-- Slides Container --}}
    <div class="w-full flex items-center justify-center p-8">
        <div 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform -translate-x-full"
            class="w-full max-w-4xl"
        >
            @include("livewire.presentation.slides.{$slides[$currentSlide]}")
        </div>
    </div>

    {{-- Laravel Logo Watermark --}}
    <div class="fixed bottom-4 right-4 opacity-10 z-10 pointer-events-none">
        <svg class="w-8 h-8" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M49.941 11.765c0-1.5-.5-2.5-1.5-3.5l-4-4c-1-1-2-1.5-3.5-1.5h-30c-1.5 0-2.5.5-3.5 1.5l-4 4c-1 1-1.5 2-1.5 3.5v26.5c0 1.5.5 2.5 1.5 3.5l4 4c1 1 2 1.5 3.5 1.5h30c1.5 0 2.5-.5 3.5-1.5l4-4c1-1 1.5-2 1.5-3.5v-26.5zm-2 26.5c0 .5-.167.833-.5 1.167l-4 4c-.333.333-.667.5-1.167.5h-30c-.5 0-.833-.167-1.167-.5l-4-4c-.333-.334-.5-.667-.5-1.167v-26.5c0-.5.167-.833.5-1.167l4-4c.334-.333.667-.5 1.167-.5h30c.5 0 .833.167 1.167.5l4 4c.333.334.5.667.5 1.167v26.5z" fill="#FF2D20"/>
            <path d="M35.941 15.765h-22c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h22c1.1 0 2-.9 2-2v-14c0-1.1-.9-2-2-2zm-22 2h22v14h-22v-14z" fill="#FF2D20"/>
            <path d="M33.941 19.765h-18v2h18v-2zm0 4h-18v2h18v-2zm0 4h-18v2h18v-2z" fill="#FF2D20"/>
        </svg>
    </div>
</div> 