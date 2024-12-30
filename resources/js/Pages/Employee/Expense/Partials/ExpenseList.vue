<script setup>
import { Link, router } from "@inertiajs/vue3";
import { computed } from "vue";
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps({
    expenses: Object,
});

const statusDisable = computed(() => {
    return ["Approved", "Rejected"].includes(props.expenses.status);
});

const deleteExpenseHandler = (id) => {
    if (confirm("Are you sure you want to delete this expenses?")) {
        router.delete(route("employee.expense.destroy", id), {
            onSuccess: () => {
                toast.success("Expense deleted successfully.");
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
                <th scope="col" class="px-6 py-3">Category</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Amount</th>
                <th scope="col" class="px-6 py-3">Currency</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Created at</th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through categories dynamically -->
            <tr
                v-for="expense in props.expenses"
                :key="expense.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
            >
                <td
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >
                    {{ expense.category.name }}
                </td>
                <td class="px-6 py-4">
                    {{ expense.description }}
                </td>
                <td class="px-6 py-4">
                    {{ expense.amount }}
                </td>
                <td class="px-6 py-4">
                    {{ expense.currency }}
                </td>
                <td class="px-6 py-4 flex items-center">
                    <span
                        class="flex w-3 h-3 me-3 rounded-full"
                        :class="{
                            'bg-green-500': expense.status === 'Approved',
                            'bg-indigo-500': expense.status === 'Submitted',
                            'bg-red-500': expense.status === 'Rejected',
                        }"
                    ></span>
                    {{ expense.status }}
                </td>

                <td class="px-6 py-4">
                    {{ expense.created_at }}
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex justify-center space-x-1">
                        <Link
                            :href="route('employee.expense.edit', expense.id)"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                        >
                            {{
                                expense.status === "Approved" ||
                                expense.status === "Rejected"
                                    ? "View"
                                    : "Edit"
                            }}
                        </Link>
                        <button
                            type="button"
                            @click="deleteExpenseHandler(expense.id)"
                            class="font-medium text-red-600 dark:text-red-500 hover:underline"
                        >
                            Delete
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>
