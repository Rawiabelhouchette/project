@props(['title', 'name', 'options', 'required' => false])

<div class="col-md-4 col-xs-12">
    <div wire:ignore style="padding: 0 2rem;">
        <h3 class="">{{ $title }}
            @if ($required)
                <b style="color: red; font-size: 100%;">*</b>
            @endif
        </h3>
        <h4 style="font-family: 'Poppins', sans-serif;font-weight: normal;font-size: 14px;opacity: 0.5;padding: 1rem 0 3rem 0;">Sélectionnez un élément dans la liste</h4>

        <div class="custom-select-container" x-data="{
            open: false,
            isMobile: window.innerWidth < 768,
            selected: @entangle('$name').defer,
            init() {
                window.addEventListener('resize', () => {
                    this.isMobile = window.innerWidth < 768;
                });
            },
            toggleOption(id) {
                if (Array.isArray(this.selected)) {
                    if (this.selected.includes(id)) {
                        this.selected = this.selected.filter(item => item !== id);
                    } else {
                        this.selected = [...this.selected, id];
                    }
                } else {
                    this.selected = [id];
                }
                // Send the updated value to Livewire component immediately
                @this.set('{{ $name }}', this.selected);
            },
            isSelected(id) {
                return Array.isArray(this.selected) && this.selected.includes(id);
            },
            getSelectedLabels() {
                return @js($options).filter(option =>
                    Array.isArray(this.selected) && this.selected.includes(option.id)
                ).map(option => option.valeur);
            }
        }" @click.away="open = false">
            <!-- Selected items display -->
            <div
                class="form-control select-display"
                @click="open = true"
                :class="{ 'has-selections': selected && selected.length > 0 }"
            >
                <template x-if="selected && selected.length > 0">
                    <div class="selected-items">
                        <template x-for="(label, index) in getSelectedLabels()" :key="index">
                            <div class="selected-tag">
                                <span x-text="label"></span>
                                <button type="button" class="remove-tag" @click.stop="toggleOption(@js($options).find(o => o.valeur === label).id)">×</button>
                            </div>
                        </template>
                    </div>
                </template>
                <div class="select-arrow" :class="{ 'open': open }">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                </div>
            </div>

            <!-- Desktop dropdown -->
            <div
                x-show="open && !isMobile"
                class="select-dropdown"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                style="display: none;"
            >
                @foreach ($options as $option)
                    <div
                        class="select-option"
                        @click.stop="toggleOption({{ $option->id }}); $event.preventDefault();"
                        :class="{ 'selected': isSelected({{ $option->id }}) }"
                    >
                        {{ $option->valeur }}
                    </div>
                @endforeach
            </div>

            <!-- Mobile modal -->
            <div
                x-show="open && isMobile"
                class="select-modal-backdrop"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                style="display: none;"
            >
                <div
                    class="select-modal"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-10"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-10"
                    @click.stop
                >
                    <div class="select-modal-header">
                        <h3>{{ $title }}</h3>
                        <button type="button" class="close-modal" @click="open = false">×</button>
                    </div>
                    <div class="select-modal-body">
                        @foreach ($options as $option)
                            <div
                                class="select-option"
                                @click.stop="toggleOption({{ $option->id }})"
                                :class="{ 'selected': isSelected({{ $option->id }}) }"
                            >
                                {{ $option->valeur }}
                            </div>
                        @endforeach
                    </div>
                    <div class="select-modal-footer">
                        <button type="button" class="btn theme-btn" @click="open = false">Confirmer</button>
                    </div>
                </div>
            </div>

            <!-- Hidden actual select for form submission -->
            <select 
                class="hidden-select" 
                multiple 
                name="{{ $name }}[]" 
                x-model="selected"
            >
                @foreach ($options as $option)
                    <option value="{{ $option->id }}">{{ $option->valeur }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="px-2">
        @error($name)
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<style>
.custom-select-container {
    position: relative;
    width: 100%;
}

.select-display {
    display: flex;
    align-items: center;
    min-height: 38px;
    padding: 0.375rem 0.75rem;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    background-color: #fff;
    cursor: pointer;
    position: relative;
}

.select-display.has-selections {
    height: auto;
    min-height: 38px;
}

.selected-items {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    width: 100%;
}

.selected-tag {
    display: inline-flex;
    align-items: center;
    background-color: #e9ecef;
    border-radius: 4px;
    padding: 2px 8px;
    margin-right: 5px;
    margin-bottom: 5px;
}

.remove-tag {
    background: none;
    border: none;
    color: #6c757d;
    font-size: 16px;
    line-height: 1;
    padding: 0 0 0 5px;
    cursor: pointer;
}

.placeholder {
    color: #fff;
}

.select-arrow {
    margin-left: auto;
    transition: transform 0.2s;
}

.select-arrow.open {
    transform: rotate(180deg);
}

.select-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 1000;
    max-height: 250px;
    overflow-y: auto;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    margin-top: 2px;
}

.select-option {
    padding: 8px 12px;
    cursor: pointer;
}

.select-option:hover {
    background-color: #f8f9fa;
}

.select-option.selected {
    background-color: #de6600;
    color: white;
}

.hidden-select {
    display: none;
}

/* Mobile modal styles */
.select-modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1050;
    display: flex;
    align-items: flex-end;
    justify-content: center;
}

.select-modal {
    background-color: #fff;
    border-radius: 10px 10px 0 0;
    width: 100%;
    max-height: 80vh;
    display: flex;
    flex-direction: column;
}

.select-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid #dee2e6;
}

.select-modal-header h3 {
    margin: 0;
    font-size: 18px;
}

.close-modal {
    background: none;
    border: none;
    font-size: 24px;
    line-height: 1;
    cursor: pointer;
}

.select-modal-body {
    overflow-y: auto;
    max-height: 60vh;
}

.select-modal-footer {
    padding: 15px;
    border-top: 1px solid #dee2e6;
    text-align: center;
}

.btn-confirm {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 8px 16px;
    cursor: pointer;
}
</style>
