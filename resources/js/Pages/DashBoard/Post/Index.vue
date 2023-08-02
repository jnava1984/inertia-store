
<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Pagination from '@/Shared/Pagination.vue';
    
    import { Link } from '@inertiajs/vue3'

    const props = defineProps({
        posts: Array
    })
</script>

<template>
    <AppLayout title="Post">
      <!-- m-auto -->
      <div class="container">
        <div class="card">
          <div class="card-body">
               <Link class="link-button-default my-3" :href="route('post.create')">Create</Link>
              <table class="w-full border">
              <thead class="bg-gray-100">
                <tr class="border-b">
                  <th class="p3">Id</th>
                  <th class="p3">Title</th>
                  <th class="p3">Slug</th>
                  <th class="p3">Actions</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="post in props.posts.data" :key="post.id" class="border-b">
                  <th class="p-2">{{ post.id }}</th>
                  <th class="p-2">{{ post.title }}</th>
                  <th class="p-2">{{ post.slug }}</th>
                  <th class="p-2">
                    <Link class="text-sm text-purple-400 hover:text-purple-700" :href="route('post.edit', post.id)">Edit</Link>
                    <Link as="button" type="button" method="delete" class="text-sm text-red-400 hover:text-red-700 ml-2"  :href="route('post.destroy', post.id)">Delete</Link>
                  </th>
                </tr>
              </tbody>
            </table>
              <Pagination class="my-4" :links="props.posts.links"/>
          </div>
        </div>
      </div>
    </AppLayout>
</template>

