<script setup>
import { reactive, onMounted } from "vue";

// Define props
const props = defineProps({
    category: Object, // Ensure category is an object
});

// Reactive form data
const form = reactive({
    name: "",
    description: "",
    errors: {},
    processing: false,
});

onMounted(() => {
    if (props.category) {
        form.name = props.category.name || "";
        form.description = props.category.description || "";
    }
});

// Form submission handler
const submitForm = async () => {
    form.processing = true;
    try {
        // Simulate API call or Inertia POST
        console.log("Submitting form with data:", form);
        // Reset errors on success
        form.errors = {};
    } catch (error) {
        // Handle validation errors
        form.errors = error.response?.data?.errors || {};
    } finally {
        form.processing = false;
    }
};
</script>

<template>
    <div class="grid grid-cols-1 gap-4">
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label
                    for="name"
                    class="block text-sm font-medium text-gray-700"
                >
                    Category Name
                </label>
                <input
                    id="name"
                    type="text"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    v-model="form.name"
                />
                <span class="text-red-600 text-sm">{{ form.errors.name }}</span>
            </div>
            <div class="mb-4">
                <label
                    for="description"
                    class="block text-sm font-medium text-gray-700"
                >
                    Category Description
                </label>
                <input
                    id="description"
                    type="text"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    v-model="form.description"
                />
                <span class="text-red-600 text-sm">{{
                    form.errors.description
                }}</span>
            </div>
            <div class="mb-4">
                <button
                    type="submit"
                    class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5"
                    :disabled="form.processing"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
</template>
