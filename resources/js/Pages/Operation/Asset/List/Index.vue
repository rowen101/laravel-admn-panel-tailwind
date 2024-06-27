<script setup>
import { Head, Link, useForm, usePage, router } from "@inertiajs/vue3";
import { ref } from "vue";
import {
    mdiAccountKey,
    mdiPlus,
    mdiSquareEditOutline,
    mdiTrashCan,
    mdiAlertBoxOutline,
    mdiTableBorder,
    mdiCloudDownloadOutline,
    mdiFileEditOutline,
    mdiDeleteCircleOutline,
} from "@mdi/js";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import BaseButton from "@/Components/BaseButton.vue";
import CardBox from "@/Components/CardBox.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import NotificationBar from "@/Components/NotificationBar.vue";
import Pagination from "@/Components/Admin/Pagination.vue";
import Sort from "@/Components/Admin/Sort.vue";
import CoreTable from "@/Components/CoreTable.vue"; // Ensure this is correctly imported
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import CardBoxModal from "@/Components/CardBoxModal.vue";

const props = defineProps({ users: Array });
const title = "List Assets"
const dialogVisible = ref(false);
const isAddProduct = ref(false);
const editMode = ref(false);
//products from data
const id = ref("");
const name = ref("");
const email = ref("");

const productImages = ref([]);
//open add modal
const openAddModal = () => {
    isAddProduct.value = true;
    dialogVisible.value = true;
    editMode.value = false;
};

//add product method
const AddProduct = async () => {

    const formData = new FormData();
    formData.append("email", email.value);
    formData.append("name", name.value);
    clea();
    try {
        await router.post("products/store", formData, {
            onSuccess: (page) => {
                Swal.fire({
                    toast: true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    title: page.props.flash.success,
                    // title:'Created Product Success'
                });
                dialogVisible.value = false;
                resetFormData();
            },
        });
    } catch (err) {
        consol.log(err);
    }
};

//rest data after added
const resetFormData = () => {
    id.value = "";
    name.value = "";
    email.value = "";
};

//Edit
const openEditModal = (item) => {
    console.log("Editing row:", item);
    if (item) {
        editMode.value = true;
        isAddProduct.value = false;
        dialogVisible.value = true;

        // Update data
        id.value = item.id;
        email.value = item.email;
        name.value = item.name;
    } else {
        console.error("Row data is undefined");
    }
};

//delete
const deleteItem = (item, index) => {
    Swal.fire({
        toast: true,
        icon: "warning",
        showConfirmButton: true,
        title: "Are you sure",
        text: "This actions cannot be undo!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "no",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            try {
                router.delete("list/" + item.id, {
                    onSuccess: (page) => {
                        this.delete(item, index);
                        Swal.fire({
                            toast: true,
                            icon: "success",
                            position: "top-end",
                            showConfirmButton: false,
                            title: page.props.flash.success,
                        });
                    },
                });
            } catch (err) {
                console.log(err);
            }
        }
    });
};

const headers = [
    { label: "Email", fieldName: "email" },
    { label: "Name", fieldName: "name" },
    { label: "Action", type: "slot" },
];

const formDelete = useForm({});

function destroy(id) {
    if (confirm("Are you sure you want to delete?")) {
        formDelete.delete(route("admin.user.destroy", id));
    }
}

const confirm = () => {
    console.log("Retrieve Records");
};
</script>

<template>
    <LayoutAuthenticated>
        <Head :title="title" />
        <SectionMain>
            <SectionTitleLineWithButton
                :icon="mdiAccountKey"
                :title="title"
                main
            >
            </SectionTitleLineWithButton>
            <NotificationBar
                :key="Date.now()"
                v-if="$page.props.flash.message"
                color="success"
                :icon="mdiAlertBoxOutline"
            >
                {{ $page.props.flash.message }}
            </NotificationBar>

            <CardBox class="mb-6" has-table>
                <CoreTable
                    :table-rows="props.users"
                    :table-header="headers"
                    table-name="users"
                    searchable-fields="email,name"
                    :is-paginated="true"
                >
                    <template #table-action>
                        <BaseButton
                            :icon="mdiPlus"
                            class="mr-1"
                            title="Add Asset"
                            color="whiteDark"
                            @click="openAddModal"
                        />
                    </template>
                    <template #row-action="slotProp">
                        <BaseButtons>
                            <BaseButton
                                :icon="mdiFileEditOutline"
                                class="mr-1"
                                title="Edit"
                                color="whiteDark"
                                @click="() => openEditModal(slotProp.slotProp)"
                            />
                            <BaseButton
                                :icon="mdiDeleteCircleOutline"
                                title="Delete Count"
                                color="whiteDark"
                                @click="() => deleteItem(slotProp.slotProp)"
                            />
                        </BaseButtons>
                    </template>
                </CoreTable>
            </CardBox>
        </SectionMain>
        <CardBoxModal v-model="dialogVisible" :title="editMode ? 'Edit User' : 'Add User'"
        buttonLabel="Submit" button="info"
        has-cancel  @click="confirm">
            <FormField label="Enter Name">
                <FormControl v-model="name" type="text" placeholder="Name">
                </FormControl>
            </FormField>
            <FormField label="Enter Email">
                <FormControl v-model="email" type="text" placeholder="Name">
                </FormControl>
            </FormField>

        </CardBoxModal>
    </LayoutAuthenticated>
</template>
