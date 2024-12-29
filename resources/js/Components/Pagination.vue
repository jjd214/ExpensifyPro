<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    links: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="flex justify-between items-center w-full">
        <!-- Links at the left corner -->
        <div class="flex">
            <Link
                v-for="link in links.links"
                :key="link.label"
                v-html="link.label"
                :href="link.url ?? ''"
                class="p-1 mx-1"
                :class="{
                    'text-slate-500': !link.url,
                    'text-blue-500 font-medium': link.active,
                }"
            ></Link>
        </div>

        <!-- Results information at the right corner -->
        <p class="text-slate-600 text-sm">
            Showing {{ links.from }} to {{ links.to }} of
            {{ links.total }} results.
        </p>
    </div>
</template>
