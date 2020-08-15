<template>
  <div>
    <div class="d-flex align-center mb-5">
      <h4 class="font-weight-light">Settings</h4>
      <v-btn
        @click.stop="0"
        class="ml-3 text--primary"
        elevation="2"
        small
        rounded
        color="white"
      >Hotspots</v-btn>
      <v-btn
        @click.stop="0"
        class="ml-3 text--primary"
        elevation="2"
        small
        rounded
        color="white"
      >Preview</v-btn>
    </div>
    <v-card class="mr-auto pa-3" style="min-height:480px;">
      <v-card-text>This is the builder</v-card-text>
    </v-card>
    <v-sheet elevation="0" class="mt-3 w-100" color="grey lighten-4">
      <v-slide-group v-model="model" class="pa-1" active-class="success" show-arrows>
        <v-slide-item v-for="n in 15" :key="n" v-slot:default="{ active, toggle }">
          <v-card
            :color="active ? undefined : 'grey lighten-1'"
            class="ma-1"
            height="100"
            width="100"
            @click="toggle"
          >
            <v-row class="fill-height" align="center" justify="center">
              <v-scale-transition>
                <v-icon v-if="active" color="white" size="48" v-text="'mdi-close-circle-outline'"></v-icon>
              </v-scale-transition>
            </v-row>
          </v-card>
        </v-slide-item>
      </v-slide-group>
    </v-sheet>
  </div>
</template>

<script>
export default {
  data() {
    return {
      model: null,
    };
  },
};
</script>

<style>
</style>
