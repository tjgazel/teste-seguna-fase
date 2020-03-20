<template>
  <v-app id="sandbox">
    <v-navigation-drawer
      v-model="primaryDrawer.model"
      :clipped="primaryDrawer.clipped"
      :floating="primaryDrawer.floating"
      :mini-variant="primaryDrawer.mini"
      :permanent="primaryDrawer.type === 'permanent'"
      :temporary="primaryDrawer.type === 'temporary'"
      app
      overflow
    >
      <DefaultNavigationDrawerContent/>

      <template v-slot:append>
        <div class="pa-2">
          <v-btn color="red" block small outlined @click="logout">
            <v-icon small left>fas fa-sign-out-alt</v-icon>
            SAIR
          </v-btn>
        </div>
      </template>
    </v-navigation-drawer>

    <v-app-bar :clipped-left="primaryDrawer.clipped" app dark color="primary">
      <v-app-bar-nav-icon v-if="primaryDrawer.type !== 'permanent'"
                          color="white" @click.stop="primaryDrawer.model = !primaryDrawer.model"/>
      <v-avatar size="35px" item class="ml-6 mr-1">
        <v-img :src="require('@/assets/logo.png')"/>
      </v-avatar>
      <v-toolbar-title>App Imobiliário</v-toolbar-title>
      <v-spacer/>
      <v-btn text small class="d-none d-sm-flex" @click="logout">
        <v-icon small left>fas fa-sign-out-alt</v-icon>
        Sair
      </v-btn>
    </v-app-bar>

    <v-content>
      <v-container fluid>
        <router-view/>
      </v-container>
    </v-content>

    <v-footer :inset="footer.inset" app class="px-4">
      <v-row align="center">
        <v-col cols="12" md="9" align-self="center" class="py-0 text-center text-sm-left">
          &copy; {{ new Date().getFullYear() }} appimobiliario.com.br
        </v-col>
        <v-col cols="12" md="3" align="center" class="py-0 text-center text-sm-right font-weight-bold">
          Versão: {{ version }}
        </v-col>
      </v-row>
    </v-footer>
  </v-app>
</template>

<script>
import DefaultNavigationDrawerContent from './DefaultNavigationDrawerContent'
import {version} from '../../config'
import {logout} from '../../services/auth-service'

export default {
  name: 'PainelDefault',
  components: {DefaultNavigationDrawerContent},

  data: () => ({
    primaryDrawer: {
      model: true,
      type: 'default',
      clipped: true,
      floating: false,
      mini: false
    },
    footer: {
      inset: true
    },
    version: version
  }),

  methods: {
    logout() {
      logout()
      this.$router.push({name: 'login'})
    }
  }
}
</script>
