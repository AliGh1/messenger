<script setup>
defineProps({
    chat: Object
})
</script>
<template>
    <div class="flex p-4 items-center hover:bg-gray-50 transition-colors">
        <img class="h-11 w-11 rounded-full object-cover" :src="chat.profile_photo_url" :alt="chat.name">
        <div class="ml-4 flex flex-col">
            <span class="text-gray-900">
                {{ chat.name }}
            </span>
            <span class="text-gray-500 text-sm">
                @{{ chat.username }}
            </span>
        </div>
        <span class="text-gray-500 text-sm self-start ml-auto">
            {{ chat.updated_at }}
        </span>
    </div>
</template>
