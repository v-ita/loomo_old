<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    canCreateOrder: Boolean,
})

const form = useForm({});

const submit = () => {
    form.post(route('orders.store'));
};
</script>

<template>
    <Head title="Loomo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Order</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div v-if="!canCreateOrder">Can't create order with this cart!</div>
                <form @submit.prevent="submit" class="mt-6 space-y-6" v-else>
                    <PrimaryButton :disabled="form.processing" type="submit">Create Order</PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>