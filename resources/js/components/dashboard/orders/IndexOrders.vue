<template>
    <v-data-table
        :headers="headers"
        :items="users"
        :search="search"
        sort-by="created_at"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Producto</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
                <v-spacer></v-spacer>

            </v-toolbar>
        </template>
        <template v-slot:item.action="{ item }">
            <v-icon  @click="deleteItem(item)">delete</v-icon>
        </template>
    </v-data-table>
</template>
<script>
    export default {
        data: () => ({
            dialog: false,
            headers: [
                {
                    text: 'id',
                    align: 'left',
                    sortable: false,
                    value: 'id',
                },
                { text: 'folio', value: 'folio' },
                { text: 'toltal', value: 'total' },
                { text: 'items ', value: 'items' },
                { text: 'Fecha de creación', value: 'created_at', sortable: false },
                { text: 'Actions', value: 'action', sortable: false }
            ],
            orders: [],
            editedIndex: -1,
            editedItem: {
                id: '',
                folio: '',
                items: '',
                created_at : '',
            },
            defaultItem: {
                id: '',
                folio: '',
                items: '',
                created_at : '',
            },
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



            async getOrders () {
                let response = await axios.get('/dashboard/orders/show').then(response=>{
                    this.orders = response.data.data;
                })

            },


            async deleteItem (item) {
                console.log(item.id)
                let response = await axios.post('/dashboard/orders/delete', {id:item.id});
                confirm(`Desea eliminar el usuario ${item.name}`)

            },

        },
    }
</script>

