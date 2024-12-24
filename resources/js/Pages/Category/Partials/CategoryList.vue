<script setup>
import { Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

defineProps({
    categories: Array,
});

const confirmationDelete = (event) => {
    if (!confirm(`Are you sure you want to delete this category?`)) {
        event.preventDefault();
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
                v-for="category in categories"
                :key="category.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
            >
                <td
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >
                    {{ category.name }}
                </td>
                <td class="px-6 py-4">
                    {{ category.description }}
                </td>
                <td class="px-6 py-4">
                    {{ category.created_at }}
                </td>
                <td class="px-6 py-4 text-center">
                    <Link
                        :href="route('category.edit', category.id)"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                    >
                        Edit
                    </Link>
                    <Link
                        :href="route('category.destroy', category.id)"
                        method="delete"
                        as="button"
                        type="button"
                        @click="confirmationDelete"
                        class="font-medium text-red-600 dark:text-red-500 hover:underline"
                    >
                        Delete
                    </Link>
                </td>
            </tr>
        </tbody>
    </table>
</template>
