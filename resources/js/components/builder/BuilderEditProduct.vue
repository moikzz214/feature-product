<template>
  <div>
    <v-row class="px-3">
      <div class="col-12">
        <v-btn
          large
          :color="`${activateExterior == true ? 'yellow accent-4' : 'primary' }`"
          @click="activateExterior = true; activateInterior = false;"
        >Exterior</v-btn>
        <v-btn
          large
          :color="`${activateInterior == true ? 'yellow accent-4' : 'primary' }`"
          @click="activateInterior = true; activateExterior = false"
        >Interior</v-btn>
      </div>
    </v-row>
    <v-divider></v-divider>
    <v-row v-if="activateInterior == true" class="px-3">
      <div class="col-12">
        <Scenes :product="this.$route.params.id" />
      </div>
      <div class="col-2">
        <scene-settings :product="this.$route.params.id"></scene-settings>
      </div>
      <div class="col-10">
        <v-card class="mr-auto pa-3 d-flex justify-center align-center" style="min-height:480px;">
          <v-card-text class="text-center">
            <p>Upload your Panoramic Image</p>
            <v-btn large color>Upload</v-btn>
          </v-card-text>
        </v-card>
      </div>
    </v-row>
    <v-row v-if="activateExterior == true" class="px-3">
      <div class="col-2">
        <scene-settings :product="this.$route.params.id"></scene-settings>
      </div>
      <div class="col-10">
        <scene-panel></scene-panel>
      </div>
    </v-row>
  </div>
</template>

<script>
import Scenes from "./edit/Scenes";
import SceneSettings from "./edit/SceneSettings";
import ScenePanel from "./edit/ScenePanel";
export default {
  components: {
    Scenes,
    SceneSettings,
    ScenePanel,
  },
  data() {
    return {
      activateExterior: true,
      activateInterior: false,
    };
  },
  methods: {},
  mounted() {
    // console.log(this.$route.params.id);
  },
};
</script>
