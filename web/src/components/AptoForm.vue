<template>
  <div>
    <v-row>
      <v-col cols="12" sm="6" lg="3">
        <v-text-field label="Andar" v-model="andar" :rules="rules.required"
                      :error-messages="errors.andar ? errors.andar[0] : ''"/>
      </v-col>
      <v-col cols="12" sm="6" lg="3">
        <v-text-field label="Numero" v-model="numero" :rules="rules.required"
                      :error-messages="errors.numero ? errors.numero[0] : ''"/>
      </v-col>
      <v-col cols="12" sm="6" lg="3">
        <v-text-field label="Quartos" v-model="quartos" :rules="rules.required"
                      :error-messages="errors.quartos ? errors.quartos[0] : ''"/>
      </v-col>
      <v-col cols="12" sm="6" lg="3">
        <v-text-field label="Banheiros" v-model="banheiros" :rules="rules.required"
                      :error-messages="errors.banheiros ? errors.banheiros[0] : ''"/>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" sm="6" lg="3">
        <v-text-field label="Metros²" v-model="metros" :rules="rules.required"
                      :error-messages="errors.metros ? errors.metros[0] : ''"/>
      </v-col>
      <v-col cols="12" sm="6" lg="3">
        <v-select label="Finalidade" v-model="finalidade_id" :items="finalidades"
                  item-text="descricao" item-value="id" :rules="rules.required"></v-select>
      </v-col>
      <v-col cols="12" sm="6" lg="3">
        <v-select label="Status" v-model="status" :items="statusList"
                  item-text="text" item-value="id" :rules="rules.required"></v-select>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import {mapState, mapMutations} from 'vuex'
import {APTO} from "../store/apto/mutations-types"

export default {
  name: 'AptoForm',

  data: () => ({
    statusList: [
      {id: '0', text: 'Disponível'},
      {id: '1', text: 'Indisponível'}
    ],
    rules: {
      required: [v => !!v || 'Campo obrigatório']
    }
  }),
  computed: {
    ...mapState('apto', ['apto', 'errors', 'finalidades']),

    andar: {
      get() {
        return this.apto.andar
      },
      set(andar) {
        this.APTO({...this.apto, andar})
      }
    },

    numero: {
      get() {
        return this.apto.numero
      },
      set(numero) {
        this.APTO({...this.apto, numero})
      }
    },

    quartos: {
      get() {
        return this.apto.quartos
      },
      set(quartos) {
        this.APTO({...this.apto, quartos})
      }
    },

    banheiros: {
      get() {
        return this.apto.banheiros
      },
      set(banheiros) {
        this.APTO({...this.apto, banheiros})
      }
    },

    metros: {
      get() {
        return this.apto.metros
      },
      set(metros) {
        this.APTO({...this.apto, metros})
      }
    },

    finalidade_id: {
      get() {
        return this.apto.finalidade_id
      },
      set(finalidade_id) {
        this.APTO({...this.apto, finalidade_id})
      }
    },

    status: {
      get() {
        return this.apto.status
      },
      set(status) {
        this.APTO({...this.apto, status})
      }
    }
  },

  methods: {
    ...mapMutations('apto', [APTO])
  }
}
</script>
