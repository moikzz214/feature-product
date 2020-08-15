<template>
  <v-row class="px-3">
    <!-- <div class="col-12">
      <div class="d-flex align-center">
        <h3 class="font-weight-light">Edit Product</h3>
      </div>
    </div> -->
    <div class="col-12">
      <Scenes :product="this.$route.params.id" />
      <v-divider></v-divider>
    </div>
    <div class="col-2">
      <scene-settings :product="this.$route.params.id"></scene-settings>
    </div>
    <div class="col-10">
      <scene-panel></scene-panel>
    </div>
  </v-row>
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
    return {};
  },
  methods: {},
  mounted() {
    // console.log(this.$route.params.id);
  },
};
</script>
