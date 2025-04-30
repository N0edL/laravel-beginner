{{-- Active Prop --}}
@props(['active'])

{{-- This component is used to create a navigation link. It accepts an 'active' prop to determine if the link is active or not. --}}

{{-- The 'href' prop is used to set the URL of the link. --}}

{{-- The 'active' prop is used to set the class of the link based on whether it is active or not. --}}

{{-- The 'slot' is used to display the text of the link. --}}

{{-- The component uses Tailwind CSS classes for styling. --}}

{{-- The component also uses the 'dark' variant of Tailwind CSS for dark mode support. --}}

<a>  {{ $slot }}
</a>
