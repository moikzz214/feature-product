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
        <exterior-panel :auth-user="authUser" :product="this.$route.params.id" />
      </v-col>
      <v-col v-if="activateInterior == true" cols="9">
        <interior-panel :product="this.$route.params.id" />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import SceneSettings from "./edit/SceneSettings";
import ExteriorPanel from "./edit/ExteriorPanel";
import InteriorPanel from "./edit/InteriorPanel";
export default {
  props: {
    authUser: {
      type: Object,
      default: null,
    },
  },
  components: {
    SceneSettings,
    ExteriorPanel,
    InteriorPanel,
  },
  data() {
    return {
      activateExterior: false,
      activateInterior: true,
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
