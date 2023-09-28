<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    variants: Object,
    attributeValues: Object,
})

const form = useForm({
    variant_id: '',
    attribute_value_id: '',
    extra_price: '',
    enabled: false
});

const submit = () => {
    form.post(route('variants.attributes.store', {
        'variant' : form.variant_id
    }));
};
</script>

<template>
    <Head title="Loomo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add Attribute Variant</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="submit" class="mt-6 space-y-6">
                    <div v-if="variants.length">
                        <InputLabel for="variant_id" value="Variant" />
                        <select name="variant_id" id="variant_id" v-model="form.variant_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="variant in variants" :key="variant.id" :value="variant.id" v-text="variant.product.name"></option>
                        </select>
                        <InputError :message="form.errors.variant_id" class="mt-2" />
                    </div>

                    <div v-if="attributeValues.length">
                        <InputLabel for="attribute_value_id" value="Attribute value" />
                        <select name="attribute_value_id" id="attribute_value_id" v-model="form.attribute_value_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="attributeValue in attributeValues" :key="attributeValue.id" :value="attributeValue.id" v-text="attributeValue.value"></option>
                        </select>
                        <InputError :message="form.errors.attribute_value_id" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="extra_price" value="Extra price" />
                        <TextInput id="extra_price" v-model="form.extra_price" type="numeric" class="mt-1 block w-full text-center p-2" />
                        <InputError :message="form.errors.extra_price" class="mt-2" />
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