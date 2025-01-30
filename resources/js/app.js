import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

Livewire.on('userCreated', () => {
    $('#createUserModal').modal('hide');
});

Livewire.on('userEdited', () => {
    $('#editUserModal').modal('hide');
});