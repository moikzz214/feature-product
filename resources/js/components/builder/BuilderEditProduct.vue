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
        <v-btn
          large
          color="primary"
          @click="0"
        >Video</v-btn>
      </div>
    </v-row>
    <v-divider></v-divider>
    <v-row>
      <v-col cols="3">
        <scene-settings :product="this.$route.params.id"></scene-settings>
      </v-col>
      <v-col cols="9">
        <div v-if="activateExterior == true">
          <exterior-panel></exterior-panel>
        </div>
        <div v-if="activateInterior == true">
          <Scenes :product="this.$route.params.id" />
          <v-card class="mr-auto pa-3 d-flex justify-center align-center" style="min-height:480px;">
            <v-card-text class="text-center">
              <p>Upload your Panoramic Image</p>
              <v-btn large color>Upload</v-btn>
            </v-card-text>
          </v-card>
        </div>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import Scenes from "./edit/Scenes";
import SceneSettings from "./edit/SceneSettings";
import ExteriorPanel from "./edit/ExteriorPanel";
export default {
  components: {
    Scenes,
    SceneSettings,
    ExteriorPanel,
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
