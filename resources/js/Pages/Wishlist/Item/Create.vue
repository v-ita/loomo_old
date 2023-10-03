<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    products: Object,
    wishlists: Object,
})

const form = useForm({
    product_id: '',
    wishlist_id: ''
});

const submit = () => {
    form.post(route('wishlists.items.store', {
        'wishlist' : form.wishlist_id
    }));
};
</script>

<template>
    <Head title="Loomo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add product to cart</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="submit" class="mt-6 space-y-6">
                    <div v-if="wishlists.length">
                        <InputLabel for="wishlist_id" value="Cart" />
                        <select name="wishlist_id" id="wishlist_id" v-model="form.wishlist_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="wishlist in wishlists" :key="wishlist.id" :value="wishlist.id" v-text="wishlist.id"></option>
                        </select>
                        <InputError :message="form.errors.wishlist_id" class="mt-2" />
                    </div>

                    <div v-if="products.length">
                        <InputLabel for="product_id" value="Product" />
                        <select name="product_id" id="product_id" v-model="form.product_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="product in products" :key="product.id" :value="product.id" v-text="product.name"></option>
                        </select>
                        <InputError :message="form.errors.product_id" class="mt-2" />
                    </div>
                    
                    <PrimaryButton :disabled="form.processing" type="submit">Save</PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>