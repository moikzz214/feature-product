<template>
  <div>
    <v-card class="mr-auto d-flex justify-center align-center">
      <upload-form></upload-form>
    </v-card>

    <v-card class="mr-auto d-flex justify-center align-center">
      <div style="width:800px; height:450px; margin:0 auto; background-color:#eee;border-radius:0;">
        <v-btn large @click="getImagesByProduct">Load Images</v-btn>
      </div>
    </v-card>
    <v-sheet elevation="0" class="mt-3 w-100" color="grey lighten-4">
      <v-slide-group v-model="model" class="pa-1" active-class="success" show-arrows>
        <v-slide-item v-for="n in 50" :key="n" v-slot:default="{ active, toggle }">
          <v-card
            :color="active ? undefined : 'grey lighten-1'"
            class="ma-1"
            height="75"
            width="75"
            @click="toggle"
          >
            <v-card-text>{{n}}</v-card-text>
          </v-card>
        </v-slide-item>
      </v-slide-group>
    </v-sheet>
  </div>
</template>

<script>
import UploadForm from "./UplooadForm";
export default {
  props: ['product'],
  components: {
    UploadForm,
  },
  data() {
    return {
      model: null,
    };
  },
  methods: {
    getImagesByProduct() {
      axios
        .get("/items/by-product/" + this.product)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
};
</script>