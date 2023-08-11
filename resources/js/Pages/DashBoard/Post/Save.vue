
<script setup>
  import { ref, watch } from 'vue'
  
  import { useForm, router, usePage } from '@inertiajs/vue3'

  import FormSection from '@/Components/FormSection.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import InputError from '@/Components/InputError.vue';
  import TextInput from '@/Components/TextInput.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import DangerButton from '@/Components/DangerButton.vue';
  import ActionMessage from '@/Components/ActionMessage.vue';
  import AppLayout from '@/Layouts/AppLayout.vue';

  import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

  const props = defineProps({
      post: {
        type: Object,
        default: {
            id: '',
            title: '',
            slug: '',
            date: '',
            text: '',
            description: '',
            posted: '',
            type: '',
            category_id: '',
            image: ''
        },
    },
    categories: Array,
  });
    
  const form = useForm({
    id: props.post.id,  
    title: props.post.title,
    slug: props.post.slug,
    date: props.post.date,
    text: props.post.text,
    description: props.post.description,
    posted: props.post.posted,
    type: props.post.type,
    category_id: props.post.category_id,
  });

  const dropFiles = ref([])

  const editor = ClassicEditor
  // const ckeditor = CKEditor.component
 
  function submit() {
    if(form.id == "")
        form.post(route('post.store'))
    else {
      //  form.put(route('post.update', form.id))
         router.post(route("post.update", form.id), {
              _method: "put",
              title: form.title,
              slug: form.slug,
              date: form.date,
              text: form.text,
              description: form.description,
              posted: form.posted,
              type: form.type,
              category_id: form.category_id,
              image: form.image,
         })
      }
  }

  watch(() => [...dropFiles.value], (currentValue, oldValue) => {
       router.post(route('post.upload', props.post.id), {
      'image': currentValue[currentValue.length - 1],
      // 'image': currentValue,
      })        
    }
  );

  // watch(() => dropFiles, (currentValue, oldValue) => {
  //   console.log(currentValue)
  //      router.post(route('post.upload', props.post.id), {
  //     'image': currentValue[currentValue.length - 1],
  //     // 'image': currentValue,
  //     })        
  //   }, { deep: true}
  // );

  const click = () => {
     alert(dropFiles.value); 
  }
</script>

<template>
 <AppLayout title="Create Team">
    <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <template #title>
            Edit Post
        </template>

        <template #description>
            Edit Post
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
                <!-- <textarea
                  id="text"
                  ref="textInput"
                  v-model="form.text" 
                  type="text"
                  class="rounded-md border-gray-400 w-full mt-1 block "
                  autocomplete="text">
                </textarea> -->
                <!-- :config="editorConfig" -->
                <ckeditor :editor="editor" v-model="form.text" ></ckeditor>
                <InputError :message="form.errors.text" class="mt-2"></InputError>
            </div>
            <div class="col-span-6">
                <InputLabel for="descripcion" value="Descripción" />
                <textarea
                  id="descripcion"
                  ref="descripcionInput"
                  v-model="form.description" 
                  type="text"
                  class="rounded-md border-gray-400 w-full mt-1 block "
                  autocomplete="Descripcion">
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
             <div class="col-span-4">
                <InputLabel for="Image" value="Image" />
                  <TextInput
                    type="file"
                      @input="form.image = $event.target.files[0]"
                      class="mt-1 w-full"
                  />
                  <InputError :message="form.errors.image" class="mt-2"></InputError>
            </div>
            <div class="col-span-4">
                <o-upload v-model="form.image">
                  <o-button tag="a" variant="primary">
                    <o-icon icon="upload"></o-icon>
                    <span>Click to upload</span>
                  </o-button>
                </o-upload>
            </div>

            <div class="col-span-6" v-if="post.id">
              <!-- multiple -->
              <o-upload v-model="dropFiles" multiple drag-drop>
                  <section class="ex-center">
                    <p>
                      <o-icon icon="upload" size="is-large">
                      </o-icon>
                    </p>
                    <p>Drop your files here or click to upload</p>
                  </section>
                </o-upload>
            </div>

      <!-- <div class="col-span-6" v-if="post.image">
        <span v-for="(file, index) in post.image" :key="index">
          {{ file.name }}
          <o-button icon-left="times" size="small" native-type="button" @click="deleteDropFile(index)">
          </o-button>
        </span>
      </div> -->
    
          <div class="col-span-6" v-if="post.id">
            <button @click="click()">
                test
            </button>
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


    <div class="container">
      <div class="card" v-if="post.image">
        <div class="card-body">
         <img class="max-w-xs rounded-md shadoe-sm" :src="'/image/post/' + post.image" alt="">
         <DangerButton class="mt-4" @click="router.post(route('post.image-delete', form.id))">Delete</DangerButton>
         
        </div>
      </div>
    </div>
</AppLayout>
        
</template>
