<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps({
    expense: {
        type: Object,
        required: true,
    },
    categories: {
        type: Object,
        required: false,
    },
});

const form = useForm({
    category_id: "",
    description: "",
    amount: "",
    currency: "",
    errors: {},
    processing: false,
});

const submitForm = () => {
    // console.log("Expense ID:", props.expense.id);
    // console.log("Route:", route("employee.expense.update", props.expense.id));

    form.put(route("employee.expense.update", props.expense.id), {
        onSuccess: () => {
            toast.success("Category updated successfully.");
        },
    });
};

onMounted(() => {
    if (props.expense) {
        form.category_id = props.expense.category.id;
        form.description = props.expense.description;
        form.amount = props.expense.amount;
        form.currency = props.expense.currency;
    }
});
</script>

<template>
    <form @submit.prevent="submitForm">
        <div class="grid grid-cols-2 gap-4">
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
                        :selected="category.id === form.category_id"
                    >
                        {{ category.name }}
                    </option>
                </select>
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
                <span class="text-red-600 text-sm">{{
                    form.errors.description
                }}</span>
            </div>
            <div class="mb-4">
                <InputLabel for="amount" value="Amount" />
                <input
                    type="text"
                    id="amount"
                    class="block w-full mt-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    v-model="form.amount"
                    autocomplete="amount"
                />
                <span class="text-red-600 text-sm">{{
                    form.errors.amount
                }}</span>
            </div>
            <div class="mb-4">
                <InputLabel for="currency" value="Currency" />
                <TextInput
                    type="text"
                    class="mt-1 block w-full"
                    id="currency"
                    v-model="form.currency"
                    auto-complete="currency"
                />
                <span class="text-red-600 text-sm">{{
                    form.errors.currency
                }}</span>
            </div>
        </div>
        <button
            type="submit"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
            :disabled="form.processing"
        >
            Save
        </button>
    </form>
</template>
