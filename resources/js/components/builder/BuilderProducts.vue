<template>
  <v-row>
    <v-col cols="6" class="px-5">
      <div class="d-flex align-center mb-5">
        <v-btn
          to="/builder/product/new"
          class="mr-3 text--primary"
          elevation="2"
          fab
          dark
          x-small
          color="white"
        >
          <v-icon dark>mdi-plus</v-icon>
        </v-btn>
        <h3 class="font-weight-light">Products</h3>
      </div>
      <v-card>
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
              <tr v-for="item in products" :key="item.name">
                <td>{{ item.title }}</td>
                <td
                  :class="`${item.status == 1 ? 'green--text' : 'blue--text'} text-left`"
                >{{ item.status == 1 ? 'actove' : 'inactive' }}</td>
                <td class="text-right">
                  <v-btn title="Preview" icon small :to="`/product/${item.slug}`" target="_blank" color="green">
                    <v-icon small>mdi-open-in-new</v-icon>
                  </v-btn>
                  <v-btn title="Edit" icon small @click="editProduct(item.id)" color="blue">
                    <v-icon small>mdi-pencil</v-icon>
                  </v-btn>
                  <v-btn title="Delete" icon small @click="actionFn(item.id)" color="red">
                    <v-icon small>mdi-trash-can-outline</v-icon>
                  </v-btn>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card>
      <v-pagination
        v-if="pageCount > 1"
        class="mt-3"
        v-model="page"
        :length="pageCount"
        @input="onPageChange"
      ></v-pagination>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: "Products",
  data() {
    return {
      page: 1,
      pageCount: 0,
      itemsPerPage: 10,
      products: [],
    };
  },
  methods: {
    actionFn(i) {
      console.log(i);
    },
    editProduct(i){
        this.$router.push("/builder/product/edit/" + i);
    },
    getProducts(p) {
      axios
        .get("/builder/products/all/?page=" + p)
        .then((response) => {
          this.products = response.data.data;
          this.page = response.data.current_page;
          this.pageCount = response.data.last_page;
        })
        .catch((error) => {
          console.log("Error: " + error);
        });
    },
    onPageChange() {
      this.getProducts(this.page);
    },
  },
  mounted() {
    this.getProducts(1);
  },
};
</script>

<style>
</style>
