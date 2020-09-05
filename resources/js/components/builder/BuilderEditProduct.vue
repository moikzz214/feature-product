<template>
  <div>
    <v-row class="px-3">
      <div class="col-12 pb-3 pa-0">
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
        <Hostspots :item="selected_item" :auth-user="authUser" :product="this.$route.params.id" @emitHotspot="hotspotToSet"/>
      </v-col>
      <v-col v-if="activateExterior == true" cols="9">
        <exterior-panel
          :auth-user="authUser"
          :product="this.$route.params.id"
          :selected-hotspot-prop="selected_hotspot_prop"
          @selectedItem="theSelectedItem"
        />
      </v-col>
      <v-col v-if="activateInterior == true" cols="9">
        <interior-panel :auth-user="authUser" :product="this.$route.params.id" />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import Hostspots from "./edit/Hostspots";
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
    Hostspots,
    ExteriorPanel,
    InteriorPanel,
  },
  data() {
    return {
      activateExterior: true,
      activateInterior: false,

      selected_item: null,
      selected_hotspot_prop: null,
    };
  },
  methods: {
    theSelectedItem(v) {
      this.selected_item = v;
    },
    hotspotToSet(v){
      this.selected_hotspot_prop = v;
    }
  },
  mounted() {
    // console.log(this.authUser);
    // console.log(this.$route.params.id);
  },
};
</script>
