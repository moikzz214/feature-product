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
        <span class="title white--text">Gallega Demo</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-menu
        v-model="menu"
        :close-on-content-click="false"
        :nudge-width="150"
        transition="slide-y-transition"
        offset-y
        :nudge-bottom="3"
      >
        <template v-slot:activator="{ on }">
          <v-btn text icon v-on="on">
            <v-avatar size="30">
              <img
                src="https://w5insight.com/wp-content/uploads/2014/07/placeholder-user-400x400.png"
                alt="Romel Indemne"
              />
            </v-avatar>
          </v-btn>
        </template>
        <v-card>
          <v-list>
            <v-list-item>
              <v-list-item-avatar>
                <img
                  src="https://w5insight.com/wp-content/uploads/2014/07/placeholder-user-400x400.png"
                  alt="Romel Indemne"
                />
              </v-list-item-avatar>
              <v-list-item-content>
                <v-list-item-title>{{ authUser.name }}</v-list-item-title>
                <v-list-item-subtitle>{{ authUser.email }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
          <v-divider></v-divider>
          <v-card-actions>
            <v-btn depressed v-on:click="logout" width="100%">Logout</v-btn>
          </v-card-actions>
        </v-card>
      </v-menu>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  props: ["authUser"],
  data() {
    return {
      drawer: null,
      menu: false,
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
        { icon: "mdi-cloud-upload-outline", text: "Upload Video", location: "/builder/product/upload-video" },
        // { icon: "mdi-playlist-play", text: "Playlists" },
        // { icon: "mdi-clock", text: "Watch Later" },
      ],
      items2: [
        { picture: 28, text: "Joseph" },
        { picture: 38, text: "Apple" },
      ],
    };
  },
  methods: {
    logout: function (event) {
      event.preventDefault();
      document.getElementById("logout-form").submit();
    },
    // drawerToggle() {
    //   this.mini = !this.mini;
    //   this.drawer = !this.drawer;
    // },
  },
  mounted() {
    // console.log("Component mounted.");
  },
};
</script>
