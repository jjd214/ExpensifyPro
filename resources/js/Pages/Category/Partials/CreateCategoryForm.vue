<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const toast = useToast();

const form = useForm({
    name: "",
    description: "",
});

const submitForm = () => {
    form.post(route("category.store"), {
        onSuccess: () => {
            toast.success("Category created successfully.");
            Inertia.visit(route("category.index"));
        },
    });
};
</script>

<template>
    <div class="grid grid-3 gap-2">
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <InputLabel for="name" value="Category name" />
                <TextInput
                    type="text"
                    class="mt-1 block w-full"
                    id="name"
                    v-model="form.name"
                    autocomplete="name"
                />
                <span class="text-red-600"
                    ><small>{{ form.errors.name }}</small></span
                >
            </div>
            <div class="mb-4">
                <InputLabel for="description" value="Category description" />
                <TextInput
                    type="text"
                    class="mt-1 block w-full"
                    id="description"
                    v-model="form.description"
                    autocomplete="description"
                />
                <span class="text-red-600"
                    ><small>{{ form.errors.description }}</small></span
                >
            </div>
            <div class="mb-4">
                <button
                    type="submit"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                    :disabled="form.processing"
                >
                    Create
                </button>
            </div>
        </form>
    </div>
</template>
