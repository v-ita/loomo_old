<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    products: Object,
})

const form = useForm({
    stock_quantity: '',
    unit_price: '',
    product_id: '',
    enabled: false
});

const submit = () => {
    form.post(route('variants.store', {
        'product' : form.product_id
    }));
};
</script>

<template>
    <Head title="Loomo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create variant</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="submit" class="mt-6 space-y-6">
                    <div v-if="products.length">
                        <InputLabel for="product_id" value="Product" />
                        <select name="product_id" id="product_id" v-model="form.product_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="product in products" :key="product.id" :value="product.id" v-text="product.name"></option>
                        </select>
                        <InputError :message="form.errors.product_id" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="stock_quantity" value="Stock quantity" />
                        <TextInput id="stock_quantity" v-model="form.stock_quantity" type="numeric" class="mt-1 block w-full text-center p-2" />
                        <InputError :message="form.errors.stock_quantity" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="unit_price" value="Unit price" />
                        <TextInput id="unit_price" v-model="form.unit_price" type="numeric" class="mt-1 block w-full text-center p-2" />
                        <InputError :message="form.errors.unit_price" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox name="enabled" v-model:checked="form.enabled" />
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Enabled</span>
                        </label>
                    </div>

                    <PrimaryButton :disabled="form.processing" type="submit">Save</PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>