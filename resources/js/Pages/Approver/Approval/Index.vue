<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ApprovalList from "./Partials/ApprovalList.vue";
import ApprovalSearchField from "./Partials/ApprovalSearchField.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    approvals: Object,
});
</script>
<template>
    <Head title="Approvals" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-semibold leading-tight text-gray-800">
                    Approvals
                </h1>

                <!-- <Link
                    :href="route('approver.approval.create')"
                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    >Create approval</Link
                > -->
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <!-- Add any additional content here -->
                </div>

                <!-- Approval Search -->
                <div class="my-4">
                    <ApprovalSearchField />
                </div>

                <!-- Approvals list -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <ApprovalList :approvals="props.approvals.data" />
                </div>

                <!-- Pagination -->
                <div class="my-4">
                    <Pagination :links="props.approvals.meta" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
