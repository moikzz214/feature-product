<template>
  <v-row>
    <v-col cols="12" class="px-5">
      <h3 class="font-weight-light mb-5">Teams</h3>
      <v-card>
        <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Email</th>
                <th class="text-left">Status</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in orgUsers" :key="item.id">
                <td>{{ item.name }}</td>
                <td>{{ item.email }}</td>
                <td
                  :class="`${item.status == 1 ? 'green--text' : 'blue--text'} text-left`"
                >{{ item.status == 1 ? 'active' : 'inactive' }}</td>
                <td class="text-right">
                  <v-btn title="Edit" icon small @click="editUser(item.id)" color="blue">
                    <v-icon small>mdi-pencil</v-icon>
                  </v-btn>
                  <v-btn title="Delete" icon small @click="deleteUser(item.id)" color="red">
                    <v-icon small>mdi-trash-can-outline</v-icon>
                  </v-btn>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  props: {
    authUser: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      orgUsers: [], // Company Users
    };
  },
  methods: {
    getOrgUsers() {
      axios
        .get("/settings/get-org-users/" + this.authUser.company_id)
        .then((response) => {
          this.orgUsers = response.data;
          console.log(response);
        })
        .catch((error) => {
          console.log("Error Fetching Org Users");
          console.log("Error: " + error);
        });
    },
    deleteUser() {},
    editUser() {},
  },
  created() {
    this.getOrgUsers();
  },
};
</script>

<style>
</style>
