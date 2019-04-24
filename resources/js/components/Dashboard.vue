<template>
  <div>
    <v-container grid-list-lg v-if="$gate.isInParty()">
      <h2
        v-for="party in party_info"
        :key="party.party_id"
        class="text-xs-center"
      >{{party.party_name}}</h2>

      <v-divider></v-divider>

      <v-layout row wrap>
        <v-flex
          xs4
          class="text-xs-center font-weight-black"
          v-for="party in party_users"
          :key="party.id"
        >
          <v-card color="blue-grey lighten-1">
            <v-responsive>
              <v-avatar size="72" class="my-3"></v-avatar>
            </v-responsive>
            <v-card-text class="title">{{ party.name }}</v-card-text>

            <v-card-text class="subheading grey lighten-2">Email</v-card-text>
            <v-card-text class="grey lighten-2">{{ party.email}}</v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>

    <v-form v-if="$gate.isNotInParty()">
      <v-container>
        <v-layout>
          <v-flex xs12 md4>
            <v-text-field v-model="form.party_name" label="Party Name" required></v-text-field>
          </v-flex>

          <v-flex xs12 md4>
            <v-text-field v-model="form.friends_emails" label="Friends Emails" required></v-text-field>
          </v-flex>

          <v-flex xs12 md4>
            <v-btn @click.prevent="submit">submit</v-btn>
          </v-flex>
        </v-layout>
      </v-container>
    </v-form>
  </div>
</template>




<script>
export default {
  data() {
    return {
      party_info: [],
      party_users: [],
      form: new Form({
        party_name: "",
        friends_emails: ""
      })
    };
  },

  created() {
    // Get data from api.php & then assign data from response to party array
    axios.get("/api/Party").then(({ data }) => {
      // Party information is stored in the first index of the response array
      this.party_info.push(data[0]);

      // Users are stored after the first index
      var i;
      for (i = 1; i < data.length; i++) {
        this.party_users.push(data[i]);
      }
    });
    var test = this.$gate.isInParty();
  },
  methods: {
    submit() {
      this.form.post("api/Party").then(function(res) {
        if (res.status === 200) {
          location.reload();
        }
      });
    }
  }
};
</script>

