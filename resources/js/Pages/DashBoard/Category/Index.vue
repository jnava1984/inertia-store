
<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Pagination from '@/Shared/Pagination.vue';
    import { ref } from 'vue';
    import { Link, router } from '@inertiajs/vue3'

    const props = defineProps({
        categories: Array
    })

    const confirmDeleteActive = ref(false)
    const deletePostRow = ref("")

    const deleteCategory = () => {
      router.delete(route('category.destroy', deletePostRow.value))
      confirmDeleteActive.value = false
    }

</script>


<template>

    <o-modal v-model:active="confirmDeleteActive" >
      <p class="p-4">
          ¿Esta seguro, que desea eliminar la categoria?
      </p>
        <div class="flex flex-row-reverse gap-2 bg-gray-100 p-3">
          <o-button @click="deleteCategory" variant="danger" > Delete</o-button>
          <o-button @click="confirmDeleteActive = false" > Cancelar</o-button>
        </div>
     </o-modal>

    <AppLayout title="Category">
      <!-- m-auto -->
      <div class="container">
        <div class="card">
          <div class="card-body">
             
               <Link class="link-button-default my-3" :href="route('category.create')">Create</Link>
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
                <tr v-for="category in props.categories.data" :key="category.id" class="border-b">
                  <th class="p-2">{{ category.id }}</th>
                  <th class="p-2">{{ category.title }}</th>
                  <th class="p-2">{{ category.slug }}</th>
                  <th class="p-2">
                    <Link class="text-sm text-purple-400 hover:text-purple-700 mr-4" :href="route('category.edit', category.id)">Edit</Link>
                    <!-- <Link as="button" type="button" method="delete" class="text-sm text-red-400 hover:text-red-700 ml-2"  :href="route('category.destroy', category.id)">Delete</Link> -->

                    <o-button
                      iconLeft="delete"
                      rounded
                      size="small"
                      variant="danger"
                      @click="confirmDeleteActive = true; deletePostRow = category.id"
                    >
                      Delete
                    </o-button>
                  </th>
                </tr>
              </tbody>
            </table>

              <Pagination class="my-4" :links="props.categories.links"/>
          </div>
        </div>

      
      </div>
   
    </AppLayout>
</template>

