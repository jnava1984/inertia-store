
<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Pagination from '@/Shared/Pagination.vue';
    import ConfirmationModal from '@/Components/ConfirmationModal.vue';


    import { ref } from 'vue';
    import { Link, router } from '@inertiajs/vue3'

    const props = defineProps({
        posts: Array,
    })

    const confirmDeleteActive = ref(false)
    const deletePostRow = ref("")


    const deletePost = () => {
      router.delete(route('post.destroy', deletePostRow.value))
      confirmDeleteActive.value = false
    }
  
</script>

<template>

     <!-- <o-modal v-model:active="confirmDeleteActive" >
          <p class="p-4">
              ¿Esta seguro, que desea eliminar el elemento?
          </p>
            <div class="flex flex-row-reverse gap-2 bg-gray-100 p-3">
              <o-button @click="deletePost" variant="danger" > Delete</o-button>
              <o-button @click="confirmDeleteActive = false" > Cancelar</o-button>
            </div>
     </o-modal> -->

    <ConfirmationModal :show="confirmDeleteActive" >
      <template v-slot:title> Confirmation</template>
      
      <template v-slot:content>
        <p class="p-4">
            ¿Esta seguro, que desea eliminar el elemento?
        </p>   
      </template>
      
      <template v-slot:footer>
        <div class="flex flex-row-reverse gap-2 bg-gray-100 p-3">
          <o-button @click="deletePost" variant="danger" > Delete</o-button>
          <o-button @click="confirmDeleteActive = false" > Cancelar</o-button>
        </div>
      </template>
     </ConfirmationModal>
<!-- 
     <Modal :show="true">
      test modal
     </Modal> -->


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
                    <Link class="text-sm text-purple-400 hover:text-purple-700 mr-4" :href="route('post.edit', post.id)">Edit</Link>
                    <!-- <Link as="button" type="button" method="delete" class="text-sm text-red-400 hover:text-red-700 ml-2"  :href="route('post.destroy', post.id)">Delete</Link> -->
                      <o-button
                        iconLeft="delete"
                        rounded
                        size="small"
                        variant="danger"
                        @click="confirmDeleteActive = true; deletePostRow = post.id"
                      >
                        Delete
                      </o-button>
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

