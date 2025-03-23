<template>
    <div class="p-4">
      <div class="mb-4">
        <Button label="Novo Cliente" icon="pi pi-plus" @click="openNew" />
      </div>
  
      <DataTable :value="clients" class="p-datatable-sm" stripedRows>
        <Column field="name" header="Nome"></Column>
        <Column field="email" header="Email"></Column>
        <Column field="phone" header="Telefone"></Column>
        <Column field="address" header="Endereço"></Column>
        <Column header="Ações">
          <template #body="slotProps">
            <Button icon="pi pi-pencil" class="p-button-rounded p-button-success mr-2" 
                    @click="editClient(slotProps.data)"/>
            <Button icon="pi pi-trash" class="p-button-rounded p-button-danger" 
                    @click="deleteClient(slotProps.data.id)"/>
          </template>
        </Column>
      </DataTable>
  
      <Dialog v-model:visible="clientDialog" :header="formTitle" :modal="true">
        <div class="p-fluid">
          <div class="field">
            <label for="name">Nome</label>
            <InputText id="name" v-model="client.name" />
          </div>
          <div class="field">
            <label for="email">Email</label>
            <InputText id="email" v-model="client.email" />
          </div>
          <div class="field">
            <label for="phone">Telefone</label>
            <InputText id="phone" v-model="client.phone" />
          </div>
          <div class="field">
            <label for="address">Endereço</label>
            <InputText id="address" v-model="client.address" />
          </div>
        </div>
        <template #footer>
          <Button label="Cancelar" icon="pi pi-times" @click="closeDialog" class="p-button-text"/>
          <Button label="Salvar" icon="pi pi-check" @click="saveClient" autofocus />
        </template>
      </Dialog>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  const clients = ref([]);
  const clientDialog = ref(false);
  const editing = ref(false);
  const client = ref({});
  
  const formTitle = ref('Novo Cliente');
  
  onMounted(() => {
    loadClients();
  });
  
  const loadClients = async () => {
    const response = await axios.get('/api/clients');
    clients.value = response.data;
  };
  
  const openNew = () => {
    client.value = {};
    editing.value = false;
    formTitle.value = 'Novo Cliente';
    clientDialog.value = true;
  };
  
  const editClient = (cli) => {
    client.value = { ...cli };
    editing.value = true;
    formTitle.value = 'Editar Cliente';
    clientDialog.value = true;
  };
  
  const saveClient = async () => {
    if (editing.value) {
      await axios.put(`/api/clients/${client.value.id}`, client.value);
    } else {
      await axios.post('/api/clients', client.value);
    }
    closeDialog();
    loadClients();
  };
  
  const deleteClient = async (id) => {
    if (confirm('Tem certeza que deseja excluir?')) {
      await axios.delete(`/api/clients/${id}`);
      loadClients();
    }
  };
  
  const closeDialog = () => {
    clientDialog.value = false;
  };
  </script>