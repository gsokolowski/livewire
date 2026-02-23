import './bootstrap';
import intersect from '@alpinejs/intersect';

// Register Alpine Intersect plugin when Livewire's Alpine is about to start
document.addEventListener('alpine:init', () => {
    window.Alpine.plugin(intersect);
});