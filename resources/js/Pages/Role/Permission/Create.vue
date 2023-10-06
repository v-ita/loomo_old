<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    roles: Object,
    permissions: Object
})

const form = useForm({
    permission_id: '',
    role_id: '',
});

const submit = () => {
    form.post(route('roles.permissions.store', {
        role: form.role_id,
        permission: form.permission_id
    }));
};
</script>

<template>
    <Head title="Loomo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Assign permission to role</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form @submit.prevent="submit" class="mt-6 space-y-6">
                    <div>
                        <InputLabel for="permission_id" value="Permission" />
                        <select name="permission_id" id="permission_id" v-model="form.permission_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="permission in permissions" :key="permission.id" :value="permission.id" v-text="permission.name ?? 'no name'"></option>
                        </select>
                        <InputError :message="form.errors.permission_id" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="role_id" value="Role" />
                        <select name="role_id" id="role_id" v-model="form.role_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="role in roles" :key="role.id" :value="role.id" v-text="role.name"></option>
                        </select>
                        <InputError :message="form.errors.role_id" class="mt-2" />
                    </div>

                    <PrimaryButton :disabled="form.processing" type="submit">Save</PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>