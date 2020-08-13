<template>
  <v-row justify="center" align="center" class="px-3">
    <div class="col-12">
      <div class="d-flex align-center">
        <h3 class="font-weight-light">Edit Product</h3>
      </div>
    </div>
    <div class="col-3">
      <div class="d-flex align-center mb-5">
        <v-btn
          @click.stop="dialog = true"
          class="mr-3 text--primary"
          elevation="2"
          fab
          dark
          x-small
          color="white"
        >
          <v-icon dark>mdi-plus</v-icon>
        </v-btn>
        <h4 class="font-weight-light">Scenes</h4>
      </div>
      <v-card>
        <v-list two-line>
          <v-list-item v-for="item in items" :key="item.title" @click="0">
            <v-list-item-avatar>
              <v-img :src="item.avatar"></v-img>
            </v-list-item-avatar>
            <v-list-item-content>
              <v-list-item-title v-html="item.title"></v-list-item-title>
              <v-list-item-subtitle v-html="item.subtitle"></v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-card>
    </div>
    <div class="col-9">
      <v-card class="mr-auto pa-3" max-width="600"></v-card>
    </div>

    <v-dialog v-model="dialog" max-width="290">
      <create-scene></create-scene>
    </v-dialog>
  </v-row>
</template>

<script>
import CreateScene from "./CreateScene";
export default {
  components: {
    CreateScene,
  },
  data() {
    return {
      dialog: false,
      items: [
        {
          avatar: "https://cdn.vuetifyjs.com/images/lists/1.jpg",
          title: "Brunch this weekend?",
          subtitle:
            "<span class='text--primary'>Ali Connors</span> &mdash; I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
        },
        {
          avatar: "https://cdn.vuetifyjs.com/images/lists/2.jpg",
          title: 'Summer BBQ <span class="grey--text text--lighten-1">4</span>',
          subtitle:
            "<span class='text--primary'>to Alex, Scott, Jennifer</span> &mdash; Wish I could come, but I'm out of town this weekend.",
        },
        {
          avatar: "https://cdn.vuetifyjs.com/images/lists/3.jpg",
          title: "Oui oui",
          subtitle:
            "<span class='text--primary'>Sandra Adams</span> &mdash; Do you have Paris recommendations? Have you ever been?",
        },
        {
          avatar: "https://cdn.vuetifyjs.com/images/lists/4.jpg",
          title: "Birthday gift",
          subtitle:
            "<span class='text--primary'>Trevor Hansen</span> &mdash; Have any ideas about what we should get Heidi for her birthday?",
        },
        {
          avatar: "https://cdn.vuetifyjs.com/images/lists/5.jpg",
          title: "Recipe to try",
          subtitle:
            "<span class='text--primary'>Britta Holt</span> &mdash; We should eat this: Grate, Squash, Corn, and tomatillo Tacos.",
        },
      ],
    };
  },
  methods: {},
  mounted() {
    console.log(this.$route.params.slug);
  },
};
</script>