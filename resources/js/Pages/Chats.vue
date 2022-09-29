<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {usePage} from "@inertiajs/inertia-vue3";
import {computed} from "vue";
defineProps({
    chats: Object,
});

const user = computed(() => usePage().props.value.user)


</script>

<template>
    <AppLayout title="Chats">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chats
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid grid-cols-3">
                        <aside class="col-span-1 divide-y border-r">
                            <div v-for="chat in chats">
                                <div class="flex p-4 items-center">
                                    <img class="h-11 w-11 rounded-full object-cover" :src="chat.profile_photo_url" :alt="chat.name">
                                    <div class="ml-4 flex flex-col">
                                        <span class="text-gray-900">
                                            {{ chat.name }}
                                        </span>
                                        <span class="text-gray-500 text-sm">
                                            @{{ chat.username}}
                                        </span>
                                    </div>
                                    <span class="text-gray-500 text-sm self-start ml-auto">
                                            {{ chat.updated_at}}
                                    </span>
                                </div>
                            </div>
                        </aside>
                        <section class="col-span-2 p-4">texts</section>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
