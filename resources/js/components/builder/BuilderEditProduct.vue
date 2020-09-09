<template>
  <div>
    <v-row class="px-3">
      <div class="col-12 pb-3 pa-0">
        <v-btn
          large
          :color="`${activateExterior == true ? 'yellow accent-4' : 'primary' }`"
          @click="selectPanel('exterior')"
        >Exterior</v-btn>
        <v-btn
          large
          :color="`${activateInterior == true ? 'yellow accent-4' : 'primary' }`"
          @click="selectPanel('interior')"
        >Interior</v-btn>
        <v-btn large color="primary" @click="0">Video</v-btn>
      </div>
    </v-row>
    <v-divider></v-divider>
    <v-row>
      <v-col cols="3">
        <Hotspots
          :item="selected_item"
          :auth-user="authUser"
          :product="this.$route.params.id"
          :current-panel="selected_panel_prop"
          @emitHotspot="hotspotToSet"
        />
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
import Hotspots from "./edit/Hotspots";
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
    Hotspots,
    ExteriorPanel,
    InteriorPanel,
  },
  data() {
    return {
      selected_panel_prop: "interior",
      activateExterior: false,
      activateInterior: true,

      selected_item: null,
      selected_hotspot_prop: null,


    };
  },
  methods: {
    theSelectedItem(v) {
      this.selected_item = v;
    },
    hotspotToSet(v) {
      // set condition
      if (JSON.stringify(this.selected_hotspot_prop) != JSON.stringify(v)) {
        this.selected_hotspot_prop = v;
      }
    },
    selectPanel(panel) {
      // Exterior
      if (panel == "exterior") {
        this.activateExterior = true;
        this.activateInterior = false;
        this.selected_panel_prop = "exterior";
      } else {
        // Interior
        this.selected_panel_prop = "interior";
        this.activateInterior = true;
        this.activateExterior = false;
      }
    }
  },
};
</script>
