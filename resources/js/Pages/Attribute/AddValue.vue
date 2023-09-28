<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';

const props = defineProps({
    attributes: Object,
})

const form = useForm({
    value: '',
    attribute: '',
});

const submit = () => {
    form.post(route('attributes.values.store', {
        'attribute': form.attribute
    }));
};
</script>

<template>
    <Head title="Loomo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add Attribute Value</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="submit" class="mt-6 space-y-6">
                    <div v-if="attributes.length">
                        <InputLabel for="attribute_id" value="Attribute" />
                        <select name="attribute" id="attribute_id" v-model="form.attribute" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="attribute in attributes" :key="attribute.id" :value="attribute.id" v-text="attribute.name"></option>
                        </select>
                    </div>

                    <div>
                        <InputLabel for="value" value="value" />
                        <TextInput id="value" v-model="form.value" type="text" class="mt-1 block w-full"/>
                        <InputError :message="form.errors.value" class="mt-2" />
                    </div>
                    <PrimaryButton :disabled="form.processing" type="submit">Save</PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>