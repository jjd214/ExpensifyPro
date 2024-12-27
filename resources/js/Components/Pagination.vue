<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    categories: Object,
});
</script>

<template>
    <Link
        v-for="link in categories"
        :key="link.label"
        v-html="link.label"
        :href="link.url ?? ''"
        class="p-1 mx-1"
        :class="{ 'text-slate-500': !link.url }"
    ></Link>
</template>
