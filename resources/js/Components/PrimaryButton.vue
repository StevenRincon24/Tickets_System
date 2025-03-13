<script setup>
defineProps({
	type: {
		type: String,
		default: 'submit',
	},
});
</script>

<template>
    <button :type="type" class="rounded-md bg-red-600 px-4 py-2 text-center text-sm text-white hover:bg-gray-500">
        <slot />
    </button>
</template>
