<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const props = defineProps({
    categories: {
        type: Object,
        required: false,
    },
});

const toast = useToast();

const form = useForm({
    category_id: "",
    limit: "",
    currency: "",
    description: "",
    errors: {},
    processing: false,
});

const submitForm = () => {
    form.post(route("admin.policy.store"), {
        onSuccess: () => {
            toast.success("Policy created successfully.");
            form.reset();
        },
    });
};
</script>

<template>
    <div class="grid grid-3 gap-2">
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <InputLabel for="category" value="Category" />
                <select
                    id="category"
                    class="block w-full mt-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    v-model="form.category_id"
                    autocomplete="category"
                >
                    <option value="" disabled selected>
                        Please select an option
                    </option>
                    <option
                        v-for="category in props.categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
                <span class="text-red-600 text-sm">{{
                    form.errors.category_id
                }}</span>
            </div>
            <div class="mb-4">
                <InputLabel for="limit" value="Limit amount" />
                <TextInput
                    type="text"
                    class="mt-1 block w-full"
                    id="limit"
                    v-model="form.limit"
                    autocomplete="limit"
                />
                <span class="text-red-600">
                    <small>{{ form.errors.limit }}</small>
                </span>
            </div>
            <div class="mb-4">
                <InputLabel for="currency" value="Currency" />
                <TextInput
                    type="text"
                    class="mt-1 block w-full"
                    id="description"
                    v-model="form.currency"
                    autocomplete="currency"
                />
                <span class="text-red-600">
                    <small>{{ form.errors.currency }}</small>
                </span>
            </div>
            <div class="mb-4">
                <InputLabel for="description" value="Description" />
                <TextInput
                    type="text"
                    class="mt-1 block w-full"
                    id="description"
                    v-model="form.description"
                    autocomplete="description"
                />
                <span class="text-red-600">
                    <small>{{ form.errors.description }}</small>
                </span>
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
