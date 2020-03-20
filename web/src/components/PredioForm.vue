<template>
  <div>
    <v-row>
      <v-col cols="12" lg="9">
        <v-text-field label="Nome do prédio" v-model="nome" :rules="rules.required"
                      :error-messages="errors.nome ? errors.nome[0] : ''"/>
      </v-col>
      <v-col cols="12" lg="3">
        <v-text-field type="number" max="8" label="CEP" v-model="cep" :rules="rules.cep"
                      :error-messages="errors.cep ? errors.cep[0] : ''"/>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" lg="8">
        <v-text-field label="Logradouro" v-model="logradouro" :rules="rules.required"
                      :error-messages="errors.logradouro ? errors.logradouro[0] : ''"/>
      </v-col>
      <v-col cols="12" lg="2">
        <v-text-field label="Numero" v-model="numero"
                      :error-messages="errors.numero ? errors.numero[0] : ''"/>
      </v-col>
      <v-col cols="12" lg="2">
        <v-text-field label="Complemento" v-model="complemento"/>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" lg="5">
        <v-text-field label="Bairro" v-model="bairro" :rules="rules.required"
                      :error-messages="errors.bairro ? errors.bairro[0] : ''"/>
      </v-col>
      <v-col cols="12" lg="5">
        <v-text-field label="Cidade" v-model="cidade" :rules="rules.required"
                      :error-messages="errors.cidade ? errors.cidade[0] : ''"/>
      </v-col>
      <v-col cols="12" lg="2">
        <v-text-field label="Estado" v-model="estado" :rules="rules.required"
                      :error-messages="errors.estado ? errors.estado[0] : ''"/>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import {mapState, mapMutations} from 'vuex'
import {PREDIO} from "../store/predios/mutations-types"

export default {
  name: 'PredioForm',

  data: () => ({
    rules: {
      required: [v => !!v || 'Campo obrigatório'],
      cep: [v => v && v.length === 8 || 'Cep deve conter 8 caracteres']
    }
  }),
  computed: {
    ...mapState('predios', ['predio', 'errors']),

    cep: {
      get() {
        return this.predio.cep
      },
      set(cep) {
        this.PREDIO({...this.predio, cep})
      }
    },

    nome: {
      get() {
        return this.predio.nome
      },
      set(nome) {
        this.PREDIO({...this.predio, nome})
      }
    },

    logradouro: {
      get() {
        return this.predio.logradouro
      },
      set(logradouro) {
        this.PREDIO({...this.predio, logradouro})
      }
    },

    numero: {
      get() {
        return this.predio.numero
      },
      set(numero) {
        this.PREDIO({...this.predio, numero})
      }
    },

    complemento: {
      get() {
        return this.predio.complemento
      },
      set(complemento) {
        this.PREDIO({...this.predio, complemento})
      }
    },

    bairro: {
      get() {
        return this.predio.bairro
      },
      set(bairro) {
        this.PREDIO({...this.predio, bairro})
      }
    },

    cidade: {
      get() {
        return this.predio.cidade
      },
      set(cidade) {
        this.PREDIO({...this.predio, cidade})
      }
    },

    estado: {
      get() {
        return this.predio.estado
      },
      set(estado) {
        this.PREDIO({...this.predio, estado})
      }
    }
  },

  methods: {
    ...mapMutations('predios', [PREDIO])
  }
}
</script>
