<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Textarea from '@/Components/Textarea.vue';
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import useSlugify from '@/Composables/useSlugify'
import { watch } from 'vue'

const props = defineProps({
    currencies: Object,
    categories: Object,
    stores: Object,
})

const form = useForm({
    name: '',
    slug: '',
    description: '',
    stock_quantity: '',
    unit_price: '',
    currency_id: '',
    category_id: '',
    store_id: '',
});

// Auto-slugifying watcher
const { slugify } = useSlugify()
watch(
	() => form.name,
	(newName, _) => {
		form.slug = slugify(newName)
	}
)

const submit = () => {
    form.post(route('products.store'));
};
</script>

<template>
    <Head title="Loomo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Product</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="submit" class="mt-6 space-y-6">
                    <div v-if="categories.length">
                        <InputLabel for="category_id" value="Category" />
                        <select name="category_id" id="category_id" v-model="form.category_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="category in categories" :key="category.id" :value="category.id" v-text="category.name"></option>
                        </select>
                        <InputError :message="form.errors.category_id" class="mt-2" />
                    </div>

                    <div v-if="stores.length">
                        <InputLabel for="store_id" value="Store" />
                        <select name="store_id" id="store_id" v-model="form.store_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="store in stores" :key="store.id" :value="store.id" v-text="store.name"></option>
                        </select>
                        <InputError :message="form.errors.store_id" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="name" value="Name" />
                        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" autocomplete="name"/>
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="slug" value="Slug" />
                        <TextInput id="slug" v-model="form.slug" type="text" class="mt-1 block w-full" />
                        <InputError :message="form.errors.slug" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="description" value="Description" />
                        <Textarea id="description" v-model="form.description" type="text" class="mt-1 block w-full" />
                        <InputError :message="form.errors.description" class="mt-2" />
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

                    <div v-if="currencies.length">
                        <InputLabel for="currency_id" value="Currency" />
                        <select name="currency_id" id="currency_id" v-model="form.currency_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="currency in currencies" :key="currency.id" :value="currency.id" v-text="currency.name"></option>
                        </select>
                        <InputError :message="form.errors.currency_id" class="mt-2" />
                    </div>

                    <PrimaryButton :disabled="form.processing" type="submit">Save</PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>