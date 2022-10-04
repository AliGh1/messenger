<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {usePage} from "@inertiajs/inertia-vue3";
import ChatItem from "@/Components/ChatItem.vue";
import {computed} from "vue";

defineProps({
    chats: Array,
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
                            <ChatItem :chat="chat" v-for="chat in chats" :key="chat.id"/>
                        </aside>
                        <section class="col-span-2 grid place-content-center">
                            <span class="px-4 py-1 bg-gray-100 text-gray-500 rounded-full">Select a chat to start messaging</span>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
