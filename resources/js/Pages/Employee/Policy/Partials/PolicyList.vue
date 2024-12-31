<script setup>
import { Link, router } from "@inertiajs/vue3";
import { computed } from "vue";
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps({
    policies: Object,
});
</script>

<template>
    <table
        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
    >
        <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
            <tr>
                <th scope="col" class="px-6 py-3">Category</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Limit</th>
                <th scope="col" class="px-6 py-3">Currency</th>
                <th scope="col" class="px-6 py-3">Created at</th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through categories dynamically -->
            <tr
                v-for="policy in props.policies"
                :key="policy.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
            >
                <td
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >
                    {{ policy.category.name }}
                </td>
                <td class="px-6 py-4">
                    {{ policy.description }}
                </td>
                <td class="px-6 py-4">
                    {{ policy.limit }}
                </td>
                <td class="px-6 py-4">
                    {{ policy.currency }}
                </td>
                <td class="px-6 py-4">
                    {{ policy.created_at }}
                </td>
                <td class="px-6 py-4 text-center">
                    <Link
                        :href="route('employee.policy.show', policy.id)"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                    >
                        View
                    </Link>
                </td>
            </tr>
        </tbody>
    </table>
</template>
