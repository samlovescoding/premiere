DESCRIBE YOUR FEATURE HERE.

I have this schema in mind, but feel free to improve on it:
DESCRIBE YOUR SCHEMA HERE.

If you are going to write unit tests, use Pest 3 and make sure we 100% passing, do not leave failed tests. VERY IMPORTANT: Always use "php artisan test" and do not scope it or filter it other wise you wont know when some other test broke due to your changes. Lets keep it as CRUDDY as possible and use livewire to keep page interactive, if needed lets follow existing routes to add. Do not create custom modal. Always opt for flux:modal which do not need any state management. Use $this->modal('modal-name')->show();. Use modals only if needed. If not needed skip entirely. Whenver creating a form, make sure all the fields have appriopriate labels and placeholders. We need to as much accessible as possible. We must not compromise on accessibility and we must not compromise on responsiveness either. Try to use as much as FluxUI and FluxUI pro components as much possible instead of creating custom styled components. Avoid creating custom styling or custom look for components. Split large features into smaller modules using Traits.

LINK ALL THE FILES HERE.
