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
        <v-btn large color="primary" @click="0">Video</v-btn>
      </div>
    </v-row>
    <v-divider></v-divider>
    <v-row>
      <v-col cols="3">
        <scene-settings :product="this.$route.params.id"></scene-settings>
      </v-col>
      <v-col v-if="activateExterior == true" cols="9">
        <!-- <exterior-panel :product="this.$route.params.id" @loadedItems="itemsHasBeenLoaded"></exterior-panel> -->
        <exterior-panel :auth-user="authUser" :product="this.$route.params.id"></exterior-panel>
        <!-- <exterior-items :loadedItems="loadedItems"></exterior-items> -->
      </v-col>
      <v-col v-if="activateInterior == true" cols="9">
        <Scenes :product="this.$route.params.id" />
        <v-card class="mr-auto pa-3 d-flex justify-center align-center" style="min-height:480px;">
          <v-card-text class="text-center">
            <p>Upload your Panoramic Image</p>
            <v-btn large color>Upload</v-btn>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import Scenes from "./edit/Scenes";
import SceneSettings from "./edit/SceneSettings";
import ExteriorPanel from "./edit/ExteriorPanel";
// import ExteriorItems from "./edit/ExteriorItems";
export default {
  props: {
    authUser: {
      type: Object,
      default: null,
    },
  },
  components: {
    Scenes,
    SceneSettings,
    ExteriorPanel,
    // ExteriorItems,
  },
  data() {
    return {
      activateExterior: true,
      activateInterior: false,
      //   loadedItems: null,
    };
  },
  methods: {
    // itemsHasBeenLoaded(items) {
    // //   console.log("items: " + items);
    // },
  },
  mounted() {
    // console.log(this.authUser);
    // console.log(this.$route.params.id);
  },
};
</script>
