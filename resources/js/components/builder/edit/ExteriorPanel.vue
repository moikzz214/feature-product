<template>
  <div>
    <v-card class="mr-auto d-flex justify-center align-center">
      <upload-form></upload-form>
    </v-card>
    <!-- <v-sheet elevation="0" class="mt-3 w-100" color="grey lighten-4">
      <v-slide-group v-model="model" class="pa-1" active-class="success" show-arrows>
        <v-slide-item v-for="n in 50" :key="n" v-slot:default="{ active, toggle }">
          <v-card
            :color="active ? undefined : 'grey lighten-1'"
            class="ma-1"
            height="100"
            width="100"
            @click="toggle"
          >
            <v-card-text>{{n}}</v-card-text>
          </v-card>
        </v-slide-item>
      </v-slide-group>
    </v-sheet> -->
  </div>
</template>

<script>
import UploadForm from "./UplooadForm";
export default {
  components: {
    UploadForm
  },
  data() {
    return {
      model: null,
    };
  },
  methods: {},
};
</script>