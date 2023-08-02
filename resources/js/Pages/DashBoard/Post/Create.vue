<script setup>
  import { useForm, router} from '@inertiajs/vue3'
  import FormSection from '@/Components/FormSection.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import InputError from '@/Components/InputError.vue';
  import TextInput from '@/Components/TextInput.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import AppLayout from '@/Layouts/AppLayout.vue';

  const props = defineProps({
    categories: Array
  })

  const form = useForm ({
    title: null,
    slug: null,
    image: null,
    date: null,
    text: null,
    description: null,
    posted: null,
    type: null,
    category_id: null,
  })

  function submit() {
    form.post(route('post.store'))
  }

</script>

<template>
  <AppLayout title="Create Post">
    <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <template #title>
            Create Post
        </template>submit

        <template #description>
            Create Post
        </template>

         <template #form >
          <div class="col-span-6">
              <InputLabel for="title" value="Title" />
              <TextInput
                id="title"
                ref="titleInput"
                v-model="form.title"
                type="text"
                class="mt-1 block w-full"
                autocomplete="Title"
              />
              <InputError :message="form.errors.title" class="mt-2"></InputError>
            </div>
            <div class="col-span-6">
                <InputLabel for="slug" value="Slug" />
                <TextInput
                  id="slug"
                  ref="slugInput"
                  v-model="form.slug"
                  type="text"
                  class="mt-1 block w-full"
                  autocomplete="Slug"
                />
                <InputError :message="form.errors.slug" class="mt-2"></InputError>
            </div>
            <div class="col-span-6">
                <InputLabel for="date" value="date" />
                <TextInput
                  id="date"
                  ref="dateInput"
                  v-model="form.date"
                  type="date"
                  class="mt-1 block w-full"
                  autocomplete="Date"
                />
                <InputError :message="form.errors.date" class="mt-2"></InputError>
            </div>
            <div class="col-span-6">
                <InputLabel for="text" value="Text" />
                <textarea
                  id="text"
                  ref="textInput"
                  v-model="form.text" 
                  type="text"
                  class="rounded-md border-gray-400 w-full mt-1 block "
                  autocomplete="text">
                </textarea>
                <InputError :message="form.errors.text" class="mt-2"></InputError>
            </div>
            <div class="col-span-6">
                <InputLabel for="description" value="Descripción" />
                <textarea
                  id="descripcion"
                  ref="descripcionInput"
                  v-model="form.description" 
                  class="rounded-md border-gray-400 w-full mt-1 block ">
                </textarea>
                <InputError :message="form.errors.description" class="mt-2"></InputError>
            </div>
            <div class="col-span-6">
                <InputLabel for="posted" value="Posted" />
                 <select class="rounded-md border-gray-400 w-full mt-1 block" v-model="form.posted" id="posted">
                    <option value=""></option>
                    <option value="not">No</option>
                    <option value="yes">Yes</option>
                  </select> 
                <InputError :message="form.errors.posted" class="mt-2"></InputError>
            </div>
            <div class="col-span-6">
              <InputLabel for="type" value="Type" />
                <select  class="rounded-md border-gray-400 w-full mt-1 block" v-model="form.type" id="type" >
                  <option value=""></option>
                  <option value="post">Post</option>
                  <option value="course">Course</option>
                  <option value="movie">Movie</option>
                </select> 
              <InputError :message="form.errors.type" class="mt-2"></InputError>
            </div>
            <div class="col-span-6">
              <!-- <InputLabel for="category_id" value="Category" />
                <select  class="rounded-md border-gray-400 w-full mt-1 block" v-model="form.category_id" id="category_id" >
                  <option value="1">Test_1</option>
                </select> 
              <InputError :message="form.errors.category_id" class="mt-2"></InputError> -->
              <InputLabel for="category_id" value="Category" />
               <select  
                  class="rounded-md border-gray-400 w-full mt-1 block" 
                  v-model="form.category_id"
                  id="category_id" 
                >
                  <option value=""></option>
                  <option 
                    v-for="cat in categories" :key="cat.id"
                    :value="cat.id">{{ cat.title }}</option>
                </select> 
              <InputError :message="form.errors.category_id" class="mt-2"></InputError>

              
            </div>
         </template>

          <template #actions>
            <!-- <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage> -->
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
              Save
            </PrimaryButton>
        </template>
    </FormSection>

  </AppLayout>
</template>