import './bootstrap';

import {Alpine, Livewire} from '../../vendor/livewire/livewire/dist/livewire.esm';
import ToastComponent from '../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts';

// Make Alpine available globally
window.Alpine = Alpine;

// Register ToastComponent with Alpine before Livewire starts
Alpine.plugin(ToastComponent);

// Start Livewire - this handles initialization
Livewire.start();