<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    symbolPosition: Object
})

const form = useForm({
    name: '',
    iso_code: '',
    symbol: '',
    enabled: false,
    symbol_position: 'right'
});

const submit = () => {
    form.post(route('currencies.store'));
};
</script>

<template>
    <Head title="Loomo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add currency</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="submit" class="mt-6 space-y-6">
                    <div>
                        <InputLabel for="name" value="Name" />
                        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" autocomplete="name"/>
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="iso_code" value="ISO code" />
                        <TextInput id="iso_code" v-model="form.iso_code" type="text" class="mt-1 block w-full" />
                        <InputError :message="form.errors.iso_code" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="symbol" value="Symbol" />
                        <TextInput id="symbol" v-model="form.symbol" type="text" class="mt-1 block w-full" />
                        <InputError :message="form.errors.symbol" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="symbol_position" value="Symbol position" />
                        <select name="symbol_position" id="symbol_position" v-model="form.symbol_position" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="(value, name) in symbolPosition" :key="name" :value="name" v-text="value"></option>
                        </select>
                        <InputError :message="form.errors.symbol_position" class="mt-2" />
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