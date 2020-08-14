<template>
  <div>
    <v-navigation-drawer v-model="drawer" app clipped width="200px">
      <v-list dense>
        <v-list-item v-for="item in items" :key="item.text" link :to="item.location">
          <v-list-item-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>{{ item.text }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-spacer></v-spacer>
        <v-subheader class="mt-4 mt-auto grey--text text--darken-1">Settings</v-subheader>
        <v-list-item link>
          <v-list-item-action>
            <v-icon color="grey darken-1">mdi-cog</v-icon>
          </v-list-item-action>
          <v-list-item-title class="grey--text text--darken-1">Account Settings</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar app clipped-left color="indigo darken-4" dense>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" color="white"></v-app-bar-nav-icon>
      <v-toolbar-title class="mr-12 align-center">
        <span class="title white--text">Product Feature</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-row align="center" style="max-width: 650px"></v-row>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  data() {
    return {
      drawer: null,
      items: [
        {
          icon: "mdi-view-dashboard",
          text: "Dashboard",
          location: "/builder/dashboard",
        },
        {
          icon: "mdi-diamond-stone",
          text: "Products",
          location: "/builder/products",
        },
        // { icon: "mdi-history", text: "History" },
        // { icon: "mdi-playlist-play", text: "Playlists" },
        // { icon: "mdi-clock", text: "Watch Later" },
      ],
      items2: [
        { picture: 28, text: "Joseph" },
        { picture: 38, text: "Apple" },
      ],
    };
  },
  // methods: {
  //   drawerToggle() {
  //     this.mini = !this.mini;
  //     this.drawer = !this.drawer;
  //   },
  // },
  mounted() {
    // console.log("Component mounted.");
  },
};
</script>
