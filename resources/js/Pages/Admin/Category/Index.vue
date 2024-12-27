<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import CategoryList from "./Partials/CategoryList.vue";
import CategorySearchField from "./Partials/CategorySearchField.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    categories: {
        type: Object,
        required: false,
    },
});
</script>

<template>
    <Head title="Category" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Category
                </h2>
                <Link
                    :href="route('admin.category.create')"
                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                >
                    Create Category
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <!-- Add any additional content here -->
                </div>

                <!-- Search field -->
                <div class="my-4">
                    <CategorySearchField />
                </div>

                <!-- Category table -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <CategoryList :categories="props.categories.data" />
                </div>

                <!-- Pagination -->
                <div class="my-4">
                    <Pagination :links="props.categories.meta" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
