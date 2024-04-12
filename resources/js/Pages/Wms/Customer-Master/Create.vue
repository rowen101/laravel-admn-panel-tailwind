<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiAccountKey,
  mdiArrowLeftBoldOutline
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import CardBox from "@/Components/CardBox.vue"
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import FormCheckRadioGroup from '@/Components/FormCheckRadioGroup.vue'
import BaseDivider from '@/Components/BaseDivider.vue'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'

const props = defineProps({
  permissions: {
    type: Object,
    default: () => ({}),
  },
})

const form = useForm({
  cuscode:'',
  cusname: '',
  leadtime: '',
  stockfreshness: '',
  status: '1',
  created_by: 'rowen',
  updated_by: 'rowen',
  permissions: []
})
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Add customer" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiAccountKey"
        title="Add customer"
        main
      >
        <BaseButton
          :route-name="route('wms.customer-master.index')"
          :icon="mdiArrowLeftBoldOutline"
          label="Back"
          color="white"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <CardBox
        form
        @submit.prevent="form.post(route('wms.customer-master.store'))"
      >
      <FormField
          label="Customer Code"
          :class="{ 'text-red-400': form.errors.cuscode }"
        >
          <FormControl
            v-model="form.cuscode"
            type="text"
            placeholder="Enter Customer Code"
            :error="form.errors.cuscode"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.cuscode">
              {{ form.errors.cuscode }}
            </div>
          </FormControl>
        </FormField>
        <FormField
          label="Customer Name"
          :class="{ 'text-red-400': form.errors.name }"
        >
          <FormControl
            v-model="form.cusname"
            type="text"
            placeholder="Enter Customer Name"
            :error="form.errors.cusname"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.cusname">
              {{ form.errors.cusname }}
            </div>
          </FormControl>
        </FormField>
        <FormField
          label="Lead Time"
          :class="{ 'text-red-400': form.errors.leadtime }"
        >
          <FormControl
            v-model="form.leadtime"
            type="text"
            placeholder="Enter Lead Time"
            :error="form.errors.leadtime"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.leadtime">
              {{ form.errors.leadtime }}
            </div>
          </FormControl>
        </FormField>
        <FormField
          label="Stock Freshness"
          :class="{ 'text-red-400': form.errors.stockfreshness }"
        >
          <FormControl
            v-model="form.stockfreshness"
            type="text"
            placeholder="Enter Stockfreshness"
            :error="form.errors.stockfreshness"
          >
            <div class="text-red-400 text-sm" v-if="form.errors.stockfreshness">
              {{ form.errors.stockfreshness }}
            </div>
          </FormControl>
        </FormField>

        <BaseDivider />


  <FormCheckRadioGroup
    v-model="form.status"
    name="status"


  />

        <template #footer>
          <BaseButtons>
            <BaseButton
              type="submit"
              color="info"
              label="Submit"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
