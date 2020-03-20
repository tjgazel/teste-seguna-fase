<template>
  <div>
    <v-row>
      <v-col cols="12" class="pt-0">
        <h1>
          <v-icon large left>fas fa-tachometer-alt</v-icon>
          Dashboard
        </h1>
      </v-col>
    </v-row>

    <v-divider></v-divider>

    <h3 class="mt-5">
      Resumo dos últimos prédios cadastrados
      <v-btn class="float-right" :to="{name: 'painel.predios'}">Ver Todos</v-btn>
    </h3>

    <v-row class="mt-5">
      <v-col cols="12" sm="6" md="4" lg="3" v-for="item in items" :key="item.id">
        <v-card>
          <v-list-item two-line class="grey darken-2" dark>
            <v-list-item-content>
              <v-list-item-title class="title" dark>{{ item.nome }}</v-list-item-title>
              <v-list-item-subtitle>{{ enderecoFull(item) }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>

          <v-card-text>
            <h3 class="text-center">Apartamentos: {{ item.apartamentos.length }}</h3>
            <v-divider></v-divider>
          </v-card-text>

          <v-list height="200">
            <v-list-item v-if="vendidos(item)">
              <v-list-item-content>
                Vendidos
              </v-list-item-content>
              <v-list-item-action>{{ vendidos(item) }}</v-list-item-action>
            </v-list-item>

            <v-list-item v-if="alugados(item)">
              <v-list-item-content>
                Alugados
              </v-list-item-content>
              <v-list-item-action>{{ alugados(item) }}</v-list-item-action>
            </v-list-item>

            <v-list-item v-if="vender(item)">
              <v-list-item-content>
                À Venda
              </v-list-item-content>
              <v-list-item-action>{{ vender(item) }}</v-list-item-action>
            </v-list-item>

            <v-list-item v-if="alugar(item)">
              <v-list-item-content>
                Por Alugar
              </v-list-item-content>
              <v-list-item-action>{{ alugar(item) }}</v-list-item-action>
            </v-list-item>
          </v-list>

          <v-divider></v-divider>
          <v-card-actions>
            <v-btn text link color="primary" :to="{name: 'painel.predios.show', params: {id: item.id}}">
              <v-icon left>fas fa-eye</v-icon>
              Ver detalhess
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import {mapState, mapGetters, mapActions} from 'vuex'

export default {
  name: 'Dashboard',

  computed: {
    ...mapState('predios', ['predios']),
    ...mapGetters('predios', ['enderecoFull']),

    items() {
      if (this.predios.length) {
        return this.predios.filter((e, i) => {
          return i <= 4
        })
      }

      return []
    }
  },

  beforeMount() {
    if (!this.predios.length) {
      this.list()
    }
  },

  methods: {
    ...mapActions('predios', ['list']),
    alugados(item) {
      if (item.apartamentos.length) {
        let apto = item.apartamentos.filter(e => {
          return e.finalidade_id === 1 && e.status
        })

        return apto.length || 0
      }

      return 0
    },

    alugar(item) {
      if (item.apartamentos.length) {
        let apto = item.apartamentos.filter(e => {
          return e.finalidade_id === 1 && !e.status
        })

        return apto.length || 0
      }

      return 0
    },

    vendidos(item) {
      if (item.apartamentos.length) {
        let apto = item.apartamentos.filter(e => {
          return e.finalidade_id === 2 && e.status
        })

        return apto.length || 0
      }

      return 0
    },

    vender(item) {
      if (item.apartamentos.length) {
        let apto = item.apartamentos.filter(e => {
          return e.finalidade_id === 2 && !e.status
        })

        return apto.length || 0
      }

      return 0
    }
  }
}
</script>
