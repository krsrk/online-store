<template>
  <form>
    <v-text-field
      v-model="product_name"
      :error-messages="product_nameErrors"
      :counter="200"
      label="Nombre del producto"
      required
      @input="$v.product_name.$touch()"
      @blur="$v.product_name.$touch()"
    ></v-text-field>
    <v-text-field
      v-model="descr"
      :error-messages="descrErrors"
      label="Descripción"
      required
      @input="$v.descr.$touch()"
      @blur="$v.descr.$touch()"
    ></v-text-field>
    <v-file-input
    label="image"
    outlined dense
    @input="$v.descr.$touch()"
    @blur="$v.descr.$touch()"
    ></v-file-input>
      <v-text-field
      v-model="video"
      :error-messages="videoErrors"
      label="Video"
      @input="$v.descr.$touch()"
      @blur="$v.descr.$touch()"
    ></v-text-field>
    <v-select
      v-model="is_special"
      :items="is_special"
      :error-messages="is_specialErrors"
      label="Especial"
      required
      @change="$v.select.$touch()"
      @blur="$v.select.$touch()"
    ></v-select>
      <v-text-field
      v-model="stock"
      :error-messages="stockErrors"
      label="Stock"
      @input="$v.stock.$touch()"
      @blur="$v.stock.$touch()"
    ></v-text-field>


    <v-btn class="mr-4" @click="submit">submit</v-btn>
    <v-btn @click="clear">clear</v-btn>
  </form>
</template>

<script>
  import { validationMixin } from 'vuelidate'
  import { required, maxLength, email } from 'vuelidate/lib/validators'

  export default {
    mixins: [validationMixin],

    validations: {
      name: { required, maxLength: maxLength(10) },
      email: { required, email },
      select: { required },
      checkbox: {
        checked (val) {
          return val
        },
      },
    },

    data: () => ({
      name: '',
      email: '',
      select: null,
      items: [
        'Item 1',
        'Item 2',
        'Item 3',
        'Item 4',
      ],
      checkbox: false,
    }),

    computed: {
      checkboxErrors () {
        const errors = []
        if (!this.$v.checkbox.$dirty) return errors
        !this.$v.checkbox.checked && errors.push('You must agree to continue!')
        return errors
      },
      selectErrors () {
        const errors = []
        if (!this.$v.select.$dirty) return errors
        !this.$v.select.required && errors.push('Item is required')
        return errors
      },
      nameErrors () {
        const errors = []
        if (!this.$v.name.$dirty) return errors
        !this.$v.name.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.name.required && errors.push('Name is required.')
        return errors
      },
      emailErrors () {
        const errors = []
        if (!this.$v.email.$dirty) return errors
        !this.$v.email.email && errors.push('Must be valid e-mail')
        !this.$v.email.required && errors.push('E-mail is required')
        return errors
      },
    },

    methods: {
      submit () {
        this.$v.$touch()
      },
      clear () {
        this.$v.$reset()
        this.name = ''
        this.email = ''
        this.select = null
        this.checkbox = false
      },
    },
  }
</script>
