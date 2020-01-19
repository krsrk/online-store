<template>
    <v-app id="keep">
        <v-app-bar
            app
            clipped-left
            color="blue darken-1"
        >
            <span class="title ml-3 mr-5" color="white">Comic&nbsp;<span class="font-weight-light">Store</span></span>
            <v-text-field
                solo-inverted
                flat
                hide-details
                label="Search"
                prepend-inner-icon="search"
            />

            <v-spacer />
        </v-app-bar>


        <v-content>
            <v-container fluid class="grey lighten-4 fill-height">
              <v-row>
                  <v-col v-for="comic in comics" :key="comic.product_id" cols="6" sm="4">
                      <v-card class="mx-auto" max-width="344">
                          <v-img src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg" height="200px"></v-img>

                          <v-card-title>{{comic.product_name}}</v-card-title>

                          <v-card-subtitle>${{comic.price}}</v-card-subtitle>

                          <v-card-actions>
                              <v-btn @click="addCart(item)" text>Comprar</v-btn>

                              <v-btn color="blue" @click="addCart(comic)" text>Agregar al carrito</v-btn>

                              <v-spacer></v-spacer>

                              <v-btn icon @click="show = !show">
                                  <v-icon>{{ show ? 'chevron-up' : 'chevron-down' }}</v-icon>
                              </v-btn>
                          </v-card-actions>

                          <v-expand-transition>
                              <div v-show="show">
                                  <v-divider></v-divider>

                                  <v-card-text>
                                    {{comic.description}}
                                  </v-card-text>
                              </div>
                          </v-expand-transition>
                      </v-card>
                  </v-col>
              </v-row>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    export default {
        props: {
            source: String,
        },
        data: () => ({
            drawer: null,
            show:false,
            comics : [],
            cart:[]

        }),
        cart:[],
        created () {

            this.getComics();
        },
        methods:{
            initialize(){
                this.getComics();
            },

            async getComics(){
                let response = await axios.get('/api/products/').then(response=>{
                    this.comics = response.data.data;
                    console.log(response.data.data)
                })
        },
            addCart(comic){
                //console.log(comic)
                this.cart.push(comic.product_guid)
                console.log(this.cart)
            }
        }
    }
</script>

<style>
    #keep .v-navigation-drawer__border {
        display: none
    }
</style>
