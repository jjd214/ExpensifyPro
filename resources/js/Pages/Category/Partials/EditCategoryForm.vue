<script setup>
import { useForm } from "@inertiajs/vue3";
import { reactive, onMounted } from "vue";
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps({
    category: Object,
});

const form = useForm({
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

const submitForm = () => {
    form.put(route("category.update", props.category.id), {
        onSuccess: () => {
            toast.success("Category updated successfully.");
        },
    });
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
