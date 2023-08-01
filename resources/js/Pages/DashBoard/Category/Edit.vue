
<script setup>
  import { useForm, router } from '@inertiajs/vue3'

  import FormSection from '@/Components/FormSection.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import InputError from '@/Components/InputError.vue';
  import TextInput from '@/Components/TextInput.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import ActionMessage from '@/Components/ActionMessage.vue';
  import AppLayout from '@/Layouts/AppLayout.vue';
  
  const props = defineProps({
      category: Object,
  });
    
  const form = useForm({
    id: props.category.id,  
    title: props.category.title,
    slug: props.category.slug,
  });

  function submit() {
    form.put(route('category.update', form.id))
  }

</script>

<template>
 <AppLayout title="Create Team">
<!-- @submit.prevent="$event => form.post(route('category.store'))" -->
    <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <template #title>
            Create Category
        </template>

        <template #description>
            Create Category
        </template>

        <template #form >
              <!-- <div class="mt-6 space-y-6 mx-w-xl"> -->
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
