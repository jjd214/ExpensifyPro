<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    approvals: Object,
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
                <th scope="col" class="px-6 py-3">Employee</th>
                <th scope="col" class="px-6 py-3">Approver</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Approved at</th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="approval in props.approvals"
                :key="approval.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
            >
                <td
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >
                    {{ approval.expense.category.name }}
                </td>
                <td class="px-6 py-4">
                    {{ approval.expense.description }}
                </td>
                <td class="px-6 py-4">
                    {{ approval.expense.user.name }}
                </td>
                <td class="px-6 py-4">
                    {{
                        approval.approver
                            ? approval.approver.name
                            : "No approver"
                    }}
                </td>
                <td class="px-6 py-4 flex items-center">
                    <span
                        class="flex w-3 h-3 me-3 rounded-full"
                        :class="{
                            'bg-indigo-500': approval.status === 'Pending',
                            'bg-green-500': approval.status === 'Approved',
                            'bg-red-500': approval.status === 'Rejected',
                        }"
                    ></span>
                    {{ approval.status }}
                </td>
                <td class="px-6 py-4">
                    {{ approval.approved_at }}
                </td>

                <td class="px-6 py-4 text-center">
                    <Link
                        :href="route('approver.approval.show', approval.id)"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                    >
                        View
                    </Link>
                </td>
            </tr>
        </tbody>
    </table>
</template>
