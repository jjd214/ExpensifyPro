<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import PolicyList from "./Partials/PolicyList.vue";
import PolicySearchField from "./Partials/PolicySearchField.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    policies: {
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
                    Policy
                </h2>
                <Link
                    :href="route('admin.policy.create')"
                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                >
                    Create Policy
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
                    <PolicySearchField />
                </div>

                <!-- Policy table -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <PolicyList :policies="props.policies.data" />
                </div>

                <!-- Paginate -->
                <div class="my-4">
                    <Pagination :links="props.policies.meta" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
