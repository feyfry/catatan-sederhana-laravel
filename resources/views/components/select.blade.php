<!-- resources/views/components/select.blade.php -->
@props(['disabled' => false, 'field' => '', 'value' => ''])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
    <option value="">{{ __('Select an option') }}</option>
    {{ $slot }}
</select>

@error($field)
<div class="text-red-600 text-sm">{{ $message }}</div>
@enderror