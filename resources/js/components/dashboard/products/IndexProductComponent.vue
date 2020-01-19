<template>
  <v-data-table
    :headers="headers"
    :items="products"
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
<!--        <v-btn color="primary" dark class="mb-2" @click="deleteItem">Borrar Producto</v-btn>-->
<!--        <v-btn color="primary" dark class="mb-2" @click="updateItem">Actualizar Producto</v-btn>-->
<!--        <v-btn color="primary" dark class="mb-2" @click="newItem">Nuevo Producto</v-btn>-->
        <v-dialog v-model="dialog" max-width="700px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on"> Nuevo Producto </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="4" md="4">
                    <v-text-field v-model="editedItem.product_name" label="Nombre del producto"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="4" md="4">
                    <v-text-field v-model="editedItem.description" label="Descripcion"></v-text-field>
                  </v-col>
                   <v-col cols="12" sm="4" md="4">
                    <v-text-field v-model="editedItem.video" label="video(url)"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="4" md="4">
                     <v-select :items="items" v-model="editedItem.is_special" label="Special"></v-select>
                  </v-col>
                  <v-col cols="12" sm="4" md="4">
                    <v-text-field v-model="editedItem.stock" label="stock" min="0" step="1" type="number"></v-text-field>
                  </v-col>

<!--                    <v-col cols="12" sm="4" md="4">-->
<!--                        <v-file-input v-model="editedItem.image"  label="Imagen"></v-file-input>-->
<!--                    </v-col>-->
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
          <v-dialog
              v-model="dialog2"
              max-width="500px"
          >
              <v-card>
                  <v-card-title>
                     Subir imagen
                  </v-card-title>
                  <v-card-text>
                      <v-file-input  id="logoImg"  accept="image/png" @click="" @change="uploadImage('logoImg',item)" outlined show-size label="Imagen"></v-file-input>

                  </v-card-text>
                  <v-card-actions>
                      <v-btn
                          color="primary"
                          text
                          @click="dialog2 = false"
                      >
                          Close
                      </v-btn>
                      <v-btn color="primary" dark @click="">Subir imagen</v-btn>
                  </v-card-actions>
              </v-card>
          </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.action="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)">edit</v-icon>
      <v-icon small @click="deleteItem(item)">delete</v-icon>
        <v-icon small @click="publishComic(item)">storefront </v-icon>
        <v-icon small @click="dialog2=true">image</v-icon>

    </template>
  </v-data-table>


</template>
<script>
  export default {
    data: () => ({
      dialog: false,
        dialog2:false,
      headers: [
        {
          text: 'Nombre',
          align: 'left',
          sortable: false,
          value: 'product_name',
        },
        { text: 'Guid', value: 'product_guid' },
        { text: 'Creador por', value: 'id_user_maker' },
        { text: 'Publicado por', value: 'id_user_publisher' },
        { text: 'Descripción', value: 'description' },
        { text: 'Especial', value: 'is_special', sortable: false },
        { text: 'Stock', value: 'stock', sortable: false },
        { text: 'Precio', value: 'price', sortable: false },
        { text: 'Fecha de creación', value: 'created_at', sortable: false },
        { text: 'Fecha de publicación', value: 'published_at', sortable: false },
          { text: 'Actions', value: 'action', sortable: false }
      ],
      products: [],
      editedIndex: -1,
      editedItem: {
        product_name: '',
        image: '',
        video: '',
        stock: 0,
        price:0,
      },
      defaultItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },
      items: ['0','1'],
        search:'',

    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Nuevo Comic' : 'Editar Comic'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    created () {

      this.getItems();
    },

    methods: {
      initialize () {
         this.getItems();


      },

      editItem (item) {
        this.editedIndex = this.products.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.products.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
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
                  product_name : this.editedItem.product_name,
                  video: this.editedItem.video,
                  stock: this.editedItem.stock,
                  price: this.editedItem.price,
                  is_special : this.editedItem.is_special,
                  description : this.editedItem.description

              }

              let response = await axios.post('/dashboard/products/update', form);

              console.log(response)

          }
          else{

              let form = {

                  product_name : this.editedItem.product_name,
                  video: this.editedItem.video,
                  stock: this.editedItem.stock,
                  price: this.editedItem.price,
                  is_special : this.editedItem.is_special,
                  description : this.editedItem.description

              }
              let response = await axios.post('/dashboard/products/create', form);
              this.getItems();
              console.log(response);
          }

      },

      async getItems () {
          let response = await axios.get('/dashboard/products/show').then(response=>{
              this.products = response.data.data;
          })

      },



      async updateItem (item) {
          console.log('Actualizar')
          let form = {
              product_guid:'item.product_guid',
              product_name: "product_name",
              image:'image2.jpg',
              video:'youtube.com',
              stock:30,
              price:150,
              is_special:'0',
              description:'Comic de Batman Day One'
          }

          let response = await axios.post('/dashboard/products/update', form);

          console.log(response.data)
      },

      async deleteItem (item) {
           console.log('Borrar')
           let response = await axios.post('/dashboard/products/delete', {guid:item.product_guid});
           confirm(`Desea eliminar el comic ${item.pruduct_name}`)
          console.log(item.product_guid)
      },

      async publishComic(item){
          console.log(item)
          let response = await axios.post('/dashboard/products/publish',{guid:item.product_guid});
          console.log(item.product_guid)

      },
        uploadImage(id,item) {
            let el =  window[id]
            if (el.files.length > 0) {
                const reader = new FileReader()
                reader.readAsDataURL(el.files[0])
                reader.onload = () => {
                    this[id] = reader.result
                    console.log(reader.result);
                    let response =  axios.post('/dashboard/products/image',{guid:item.product_guid,image:this[id]})
                    console.log(response)

                }
            } else {
                this[id] = ''
            }
        },
    },
  }
</script>
