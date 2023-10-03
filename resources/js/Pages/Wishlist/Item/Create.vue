<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { watch } from 'vue';

const props = defineProps({
    products: Object,
    variants: Object,
    wishlists: Object
})

const form = useForm({
    product_id: '',
    variant_id: '',
    wishlist_id: '',
    add_product: true
});

watch(
	() => form.add_product,
	(newValue, _) => {
        if (newValue) {
            form.variant_id = ''
        }else{
            form.product_id = ''
        }
	}
)

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
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add product or variant to wishlist</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="submit" class="mt-6 space-y-6">
                    <div v-if="wishlists.length">
                        <InputLabel for="wishlist_id" value="Wishlist" />
                        <select name="wishlist_id" id="wishlist_id" v-model="form.wishlist_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="wishlist in wishlists" :key="wishlist.id" :value="wishlist.id" v-text="wishlist.id"></option>
                        </select>
                        <InputError :message="form.errors.wishlist_id" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox name="enabled" v-model:checked="form.add_product" />
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Add product</span>
                        </label>
                    </div>

                    <div v-if="products.length && form.add_product">
                        <InputLabel for="product_id" value="Product" />
                        <select name="product_id" id="product_id" v-model="form.product_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="product in products" :key="product.id" :value="product.id" v-text="product.name"></option>
                        </select>
                        <InputError :message="form.errors.product_id" class="mt-2" />
                    </div>
                    
                    <div v-if="variants.length && !form.add_product">
                        <InputLabel for="variant_id" value="Variant" />
                        <select name="variant_id" id="variant_id" v-model="form.variant_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="variant in variants" :key="variant.id" :value="variant.id" v-text="variant.product.name + ' -> ' + variant.id"></option>
                        </select>
                        <InputError :message="form.errors.variant_id" class="mt-2" />
                    </div>

                    <PrimaryButton :disabled="form.processing" type="submit">Save</PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>