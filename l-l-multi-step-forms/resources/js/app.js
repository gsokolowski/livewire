import './bootstrap';

import {Alpine, Livewire} from '../../vendor/livewire/livewire/dist/livewire.esm';
import ToastComponent from '../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts';

// Register ToastComponent with Livewire's Alpine
Alpine.plugin(ToastComponent);

// Start Livewire (which includes Alpine)
Livewire.start();
