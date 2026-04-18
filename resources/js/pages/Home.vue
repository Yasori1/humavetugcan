<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import WeddingInvitation from '@/components/WeddingInvitation.vue'

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <Head title="Wedding Invitation">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <WeddingInvitation />
</template>
