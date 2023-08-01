<script setup>
    import { Link } from '@inertiajs/vue3'

    const props = defineProps({
        links: Object
    })

</script>

<template>
    <div>
        <template v-for="l in links" :key="l">
            <Link v-if="!l.active" class="px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-50 ml-2" :href="l.url"  >{{ l.label }}</Link>
            <span v-else class="px-2 py-1 cursor-pointer text-grat-500"   >{{ l.label }}</span>
        </template>
    </div>
</template>