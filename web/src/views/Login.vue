<template>
  <v-app>
    <v-content>
      <v-container fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12 mt-10">
              <v-toolbar color="primary" dark flat>
                <v-toolbar-title>App Imobiliário</v-toolbar-title>
              </v-toolbar>
              <v-form @submit.prevent="onSubmit">
                <v-card-text>
                  <v-text-field v-model="form.email" type="email" label="Email" name="email"
                                prepend-icon="fas fa-user" placeholder="Insira seu email"/>

                  <v-text-field v-model="form.password" type="password" label="Senha"
                                name="password" prepend-icon="fas fa-lock" placeholder="Insira sua senha"/>
                </v-card-text>
                <v-card-actions>
                  <v-spacer/>
                  <v-btn class="mr-3" color="primary" type="submit">Entrar</v-btn>
                </v-card-actions>
              </v-form>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import {mapActions, mapMutations} from 'vuex'
import {hasSession} from '../services/auth-service'
import {localManager} from '../services/storage-service'
import {storage} from '../config'
import {USER} from '../store/mutations-types'

export default {
  name: 'Login',
  data: () => ({
    form: {
      email: '',
      password: ''
    }
  }),

  beforeMount() {
    if (hasSession()) {
      this.USER(localManager.get(storage.local.tokenKey).user)
      this.$router.push({name: 'painel.dashbord'})
    }
  },

  methods: {
    ...mapMutations([USER]),
    ...mapActions(['attemptLogin']),

    async onSubmit() {
      const res = await this.attemptLogin(this.form)

      if (res.status === 200) {
        this.$router.push({name: 'painel.dashbord'})
      }
    }
  }
}
</script>
