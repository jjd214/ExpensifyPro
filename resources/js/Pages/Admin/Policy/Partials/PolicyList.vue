<script setup>
import { Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps({
    policies: Array,
});

const deleteCategoryHandler = (id) => {
    if (confirm(`Are you sure you want to delete this category?`)) {
        router.delete(route("admin.category.destroy", id), {
            onSuccess: () => {
                toast.success("Category deleted successfully.");
            },
        });
    }
};
</script>

<template>
    <table
        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
    >
        <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
            <tr>
                <th scope="col" class="px-6 py-3">Category name</th>
                <th scope="col" class="px-6 py-3">Limit</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Date added</th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through categories dynamically -->
            <tr
                v-for="policy in policies"
                :key="policy.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
            >
                <td
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >
                    {{ policy.category.name }}
                </td>
                <td class="px-6 py-4">
                    {{ policy.limit }}
                </td>
                <td class="px-6 py-4">
                    {{ policy.description }}
                </td>
                <td class="px-6 py-4">
                    {{ policy.created_at }}
                </td>
                <td class="px-6 py-4 text-center">
                    <Link
                        :href="route('admin.policy.edit', policy.id)"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                    >
                        Edit
                    </Link>
                    <button
                        type="button"
                        @click="deletePolicyHandler(policy.id)"
                        class="font-medium text-red-600 dark:text-red-500 hover:underline"
                    >
                        Delete
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
