<template>
  <v-sheet elevation="0" class="mt-3 w-100" color="grey lighten-4">
    <v-slide-group v-model="model" class="pa-1" active-class="success" show-arrows>
      <v-slide-item v-for="item in items" :key="item.id" v-slot:default="{ active, toggle }">
        <v-card
          :color="active ? undefined : 'grey lighten-1'"
          class="ma-1"
          height="75"
          width="75"
          @click="toggle"
        >
          <v-img
            :aspect-ratio="16/9"
            class="white--text align-end"
            :src="baseUrl+'/storage/uploads/user-1/'+item.user_file.path"
          >
            <v-card-text>{{item.product}}</v-card-text>
          </v-img>
        </v-card>
      </v-slide-item>
    </v-slide-group>
  </v-sheet>
</template>

<script>
export default {
  props: ["loadedItems"],
  data() {
    return {
      model: null,
      items: this.loadedItems,
      baseUrl: window.location.origin,
    };
  },
  mounted() {
    setTimeout(() => {
      console.log(this.loadedItems);
    }, 1000);
  },
};
</script>
