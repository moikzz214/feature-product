<template>
  <div>
    <div class="d-flex align-center mb-5">
      <v-btn to="/builder/product/new" class="mr-3 text--primary" elevation="2" fab dark x-small color="white">
        <v-icon dark>mdi-plus</v-icon>
      </v-btn>
      <h3 class="font-weight-light">Products</h3>
    </div>
    <v-card class="mr-auto" max-width="600">
      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">Product Name</th>
              <th class="text-left">Status</th>
              <th class="text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in desserts" :key="item.name">
              <td>{{ item.name }}</td>
              <td>{{ item.calories }}</td>
              <td class="text-right">
                <v-btn title="Preview" icon small @click="actionFn(item.name)" color="green">
                  <v-icon small>mdi-eye-outline</v-icon>
                </v-btn>
                <v-btn title="Edit" icon small @click="actionFn(item.name)" color="blue">
                  <v-icon small>mdi-pencil</v-icon>
                </v-btn>
                <v-btn title="Delete" icon small @click="actionFn(item.name)" color="red">
                  <v-icon small>mdi-trash-can-outline</v-icon>
                </v-btn>
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    </v-card>
  </div>
</template>

<script>
export default {
  name: "Products",
  data() {
    return {
      desserts: [
        {
          name: "Frozen Yogurt",
          calories: "active",
        },
        {
          name: "Ice cream sandwich",
          calories: "active",
        },
        {
          name: "Eclair",
          calories: "inactive",
        },
        {
          name: "Cupcake",
          calories: "inactive",
        },
        {
          name: "Gingerbread",
          calories: "active",
        },
        {
          name: "Jelly bean",
          calories: "active",
        },
        {
          name: "Lollipop",
          calories: "active",
        },
        {
          name: "Honeycomb",
          calories: "active",
        },
        {
          name: "Donut",
          calories: "active",
        },
        {
          name: "KitKat",
          calories: "active",
        },
      ],
    };
  },
  methods: {
    actionFn(i) {
      console.log(i);
    },
  },
};
</script>

<style>
</style>