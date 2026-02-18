<div>
    {{-- Step Navigation --}}
    <div class="mb-8 w-full">
        <nav aria-label="Progress" class="w-full">
            <div class="flex items-center w-full border-b border-gray-200">
                @foreach($stepNames as $index => $stepName)
                    @php
                        $stepIndex = $index + 1;
                        $isCurrent = $stepName === $currentStepName;
                        $currentStepIndex = $stepNames->search($currentStepName);
                        $isPast = $currentStepIndex !== false && $currentStepIndex > $index;
                        $stepLabel = $stepLabels[$stepName] ?? "Step {$stepIndex}";
                        $fullStepLabel = "Step {$stepIndex}. {$stepLabel}";
                    @endphp
                    
                    <button
                        type="button"
                        wire:click="goToStep('{{ $stepName }}')"
                        class="flex-1 py-4 px-6 text-center border-b-2 transition-colors {{ $isCurrent ? 'border-indigo-600 text-indigo-600 font-semibold' : ($isPast ? 'border-gray-300 text-gray-500 hover:text-indigo-600 hover:border-indigo-400' : 'border-transparent text-gray-400 hover:text-gray-600') }}"
                        @if($isCurrent) aria-current="step" @endif
                    >
                        <span class="text-base font-medium">
                            {{ $fullStepLabel }}
                        </span>
                    </button>
                @endforeach
            </div>
        </nav>
    </div>

    {{-- Current Step Content --}}
    <div>
        @livewire($currentStepName, $currentStepState, key($currentStepName))
    </div>
</div>
