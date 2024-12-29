<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { useToast } from "vue-toastification";

const toast = useToast();
const page = usePage();

const props = defineProps({
    approval: {
        type: Object,
        required: true,
    },
});

const statusClass = computed(() => ({
    "text-green-600": props.approval.status === "Approved",
    "text-indigo-600": props.approval.status === "Pending",
    "text-red-600": props.approval.status === "Rejected",
}));

const form = useForm({
    status: props.approval.status,
    comment: "",
    approver_id: page.props.auth.user.id,
    errors: {},
    processing: false,
});

const approveApproval = () => {
    form.status = "approved";
    form.put(route("approver.approval.update", props.approval.id), {
        onSuccess: () => {
            toast.success("Approved success.");
        },
        preserveScroll: true,
    });
};

const rejectApproval = () => {
    form.status = "rejected";
    form.put(route("approver.approval.update", props.approval.id), {
        onSuccess: () => {
            toast.info("Rejected approval");
        },
        preserveScroll: true
    });
};
</script>

<template>
    <div class="py-12 bg-gray-50">
        <div class="mx-auto max-w-4xl">
            <!-- Invoice Card -->
            <div class="bg-white shadow-lg rounded-lg p-8">
                <!-- Header -->
                <div
                    class="flex justify-between items-center border-b-2 pb-6 mb-6"
                >
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Expense Summary
                        </h2>
                        <p class="text-sm text-gray-500">
                            Date Submitted:
                            {{ props.approval.expense.created_at }}
                        </p>
                    </div>
                    <div>
                        <span
                            :class="[
                                statusClass,
                                'px-4 py-2 rounded-full text-sm font-semibold shadow-sm bg-gray-100',
                            ]"
                        >
                            {{ props.approval.status }}
                        </span>
                    </div>
                </div>

                <!-- Details -->
                <div class="space-y-8">
                    <!-- Expense Info -->
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">
                            Expense Information
                        </h3>
                        <div class="space-y-2">
                            <p class="text-sm text-gray-600">
                                <strong>Category:</strong>
                                {{ props.approval.expense.category.name }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <strong>Description:</strong>
                                {{ props.approval.expense.description }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <strong>Amount:</strong>
                                {{ props.approval.expense.amount }}
                                {{ props.approval.expense.currency }}
                            </p>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">
                            Submitted By
                        </h3>
                        <div class="space-y-2">
                            <p class="text-sm text-gray-600">
                                <strong>Name:</strong>
                                {{ props.approval.expense.user.name }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <strong>Email:</strong>
                                {{ props.approval.expense.user.email }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <strong>Role:</strong>
                                {{ props.approval.expense.user.role }}
                            </p>
                        </div>
                    </div>

                    <!-- Approval Info -->
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">
                            Approval Information
                        </h3>
                        <div class="space-y-2">
                            <p class="text-sm text-gray-600">
                                <strong>Status:</strong>
                                {{ props.approval.status }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <strong>Approval Date:</strong>
                                {{ props.approval.approved_at }}
                            </p>
                            <p
                                v-if="props.approval.comment"
                                class="text-sm text-gray-600"
                            >
                                <strong>Previous Comment:</strong>
                                {{ props.approval.comment }}
                            </p>
                        </div>

                        <!-- Comment Input -->
                        <div class="mt-6">
                            <label
                                for="comment"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Comment
                            </label>
                            <textarea
                                id="comment"
                                v-model="form.comment"
                                rows="4"
                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                placeholder="Enter your comment here..."
                            ></textarea>
                            <span class="text-red-600 text-sm">{{
                                form.errors.comment
                            }}</span>
                            <p class="text-sm text-gray-500 mt-2">
                                This comment will be added to the expenses
                                record.
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-4 mt-6">
                            <button
                                @click="approveApproval"
                                class="px-6 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition duration-200"
                                :disabled="form.processing"
                            >
                                Approve
                            </button>
                            <button
                                @click="rejectApproval"
                                class="px-6 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition duration-200"
                                :disabled="form.processing"
                            >
                                Reject
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
