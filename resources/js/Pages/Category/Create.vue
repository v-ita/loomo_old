<script setup>
import InputError from '@/Components/InputError.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import useSlugify from '@/Composables/useSlugify'
import { watch } from 'vue'

const props = defineProps({
    categories: Object
})

const form = useForm({
    name: '',
    slug: '',
    enabled: false,
    parent_id: ''
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
    form.post(route('categories.store'));
};
</script>

<template>
    <Head title="Loomo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create category</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="submit" class="mt-6 space-y-6">
                    <div v-if="categories.length">
                        <InputLabel for="parent_id" value="Parent" />
                        <select name="parent_id" id="parent_id" v-model="form.parent_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="category in categories" :key="category.id" :value="category.id" v-text="category.name"></option>
                        </select>
                        <InputError :message="form.errors.parent_id" class="mt-2" />
                    </div>
                    <div>
                        <InputLabel for="name" value="Name" />
                        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full"
                            autocomplete="name" />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="slug" value="Slug" />
                        <TextInput id="slug" v-model="form.slug" type="text" class="mt-1 block w-full" />
                        <InputError :message="form.errors.slug" class="mt-2" />
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