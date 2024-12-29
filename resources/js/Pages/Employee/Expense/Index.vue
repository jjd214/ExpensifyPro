<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ExpenseList from "./Partials/ExpenseList.vue";
import Pagination from "@/Components/Pagination.vue";
import ExpenseSearchField from "./Partials/ExpenseSearchField.vue";

const props = defineProps({
    expenses: Object,
});
</script>
<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Expenses
                </h2>

                <Link
                    :href="route('employee.expense.create')"
                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    >Create Expenses</Link
                >
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <!-- Add any additional content here -->
                </div>

                <!-- Search field -->
                <div class="my-4 flex justify-between items-center">
                    <ExpenseSearchField />
                </div>
                <!-- Expense table -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <ExpenseList :expenses="props.expenses.data" />
                </div>

                <div class="my-4">
                    <Pagination :links="props.expenses.meta" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
