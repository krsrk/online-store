<template>
    <v-data-table
        :headers="headers"
        :items="users"
        :search="search"
        sort-by="calories"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Producto</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
                <v-spacer></v-spacer>

                <v-dialog v-model="dialog" max-width="700px">
                    <template v-slot:activator="{ on }">
                        <v-btn color="primary" dark class="mb-2" v-on="on"> Nuevo Usuario </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="4" md="4">
                                        <v-text-field v-model="editedItem.name" label="Nombre"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="4" md="4">
                                        <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="4" md="4">
                                        <v-text-field v-model="editedItem.password" type="password" label="Contraseña"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="4" md="4">
                                        <v-select :items="items" v-model="editedItem.rol_id" label="Rol"></v-select>
                                    </v-col>
                                    <v-col cols="12" sm="4" md="4">
                                        <v-select :items="status" v-model="editedItem.status" label="status" ></v-select>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="save">Guardar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </template>
        <template v-slot:item.action="{ item }">
            <v-icon  class="mr-2" @click="editItem(item)">edit</v-icon>
            <v-icon  @click="deleteItem(item)">delete</v-icon>
            <v-icon  @click="suspend(item)">supervised_user_circle </v-icon>
        </template>
    </v-data-table>
</template>
<script>
    export default {
        data: () => ({
            dialog: false,
            headers: [
                {
                    text: 'Nombre',
                    align: 'left',
                    sortable: false,
                    value: 'name',
                },
                { text: 'Correo electronico', value: 'email' },
                { text: 'Rol', value: 'rol_id' },
                { text: 'ip ', value: 'ip' },
                { text: 'status', value: 'status' },
                { text: 'Fecha de creación', value: 'created_at', sortable: false },
                { text: 'Actions', value: 'action', sortable: false }
            ],
            users: [],
            editedIndex: -1,
            editedItem: {
                name: '',
                email: '',
                rol_id: '',
                ip : '',
                status:'',
            },
            defaultItem: {
                name: '',
                email: '',
                rol_id: '',
                ip : '',
                status:'',
            },
            items: ['0','1'],
            status:['1','2','3'],
            search:'',

        }),

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Nuevo Usuario' : 'Editar Usuario'
            },
        },

        watch: {
            dialog (val) {
                val || this.close()
            },
        },

        created () {

            this.getUsers();
        },

        methods: {
            initialize () {
                this.getUsers();


            },

            editItem (item) {
                this.editedIndex = this.users.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem (item) {
                const index = this.users.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.users.splice(index, 1)
            },

            close () {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },

            async save () {
                if (this.editedIndex > -1){

                    let form = {
                        name : this.editedItem.name,
                        email: this.editedItem.email,
                        password: this.editedItem.password,
                        rol_id: this.editedItem.rol_id,
                        status : this.editedItem.status,

                    }

                    let response = await axios.post('/dashboard/users/update', form);

                    console.log(response)

                }
                else{

                    let form = {
                        name : this.editedItem.name,
                        email: this.editedItem.email,
                        password: this.editedItem.password,
                        rol_id: this.editedItem.rol_id,
                        status : this.editedItem.status,

                    }
                    let response = await axios.post('/dashboard/users/store', form);
                    this.getUsers();
                    console.log(response);
                }

            },

            async getUsers () {
                let response = await axios.get('/dashboard/users/show').then(response=>{
                    this.users = response.data.data;
                })

            },



            async updateItem (item) {
                console.log('Actualizar')
                let form = {
                    name : this.editedItem.name,
                    email: this.editedItem.email,
                    password: this.editedItem.password,
                    rol_id: this.editedItem.rol_id,
                    status : this.editedItem.status,
                }

                let response = await axios.post('/dashboard/users/update', form);

                console.log(response.data)
            },

            async deleteItem (item) {
                console.log(item.id)
                let response = await axios.post('/dashboard/users/delete', {id:item.id});
                confirm(`Desea eliminar el usuario ${item.name}`)

            },

            async suspend(item){
                console.log(item)
                let response = await axios.post('/dashboard/users/suspend',{id:item.id});
                console.log(item.id)

            }
        },
    }
</script>

