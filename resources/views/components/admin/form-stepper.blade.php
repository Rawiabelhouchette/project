@props(['steps', 'currentStep', 'icons' => null])

<div class="stepper-wrapper mb-5">
    <div class="stepper-progress d-none d-md-flex">
        @foreach($steps as $index => $step)
            <div class="stepper-step">
                <button type="button" 
                    class="stepper-circle {{ $currentStep > $index ? 'completed' : ($currentStep == $index ? 'active' : '') }}"
                    wire:click="$set('currentStep', {{ $index }})"
                    {{ $currentStep < $index ? 'disabled' : '' }}>
                    @if($icons)
                        <i class="fa {{ $icons[$index] }}"></i>
                    @else
                        {{ $index + 1 }}
                    @endif
                </button>
                <div class="stepper-label {{ $currentStep >= $index ? 'active' : '' }}">{{ $step }}</div>
                @if($index < count($steps) - 1)
                    <div class="stepper-line {{ $currentStep > $index ? 'completed' : '' }}"></div>
                @endif
            </div>
        @endforeach
    </div>
    
    <!-- Mobile stepper -->
    <div class="d-md-none mx-2">
        <div class="d-flex justify-content-between align-items-center">
            <span class="font-weight-medium">
                Étape {{ $currentStep + 1 }} sur {{ count($steps) }}: 
                {{ $steps[$currentStep] }}
            </span>
            <span class="badge badge-primary">{{ $currentStep + 1 }}/{{ count($steps) }}</span>
        </div>
        <div class="progress mt-2">
            <div class="progress-bar bg-vamiyi-orange" role="progressbar" 
                style="width: {{ ($currentStep + 1) * (100/count($steps)) }}%" 
                aria-valuenow="{{ ($currentStep + 1) * (100/count($steps)) }}" 
                aria-valuemin="0" 
                aria-valuemax="100">
            </div>
        </div>
    </div>
</div>