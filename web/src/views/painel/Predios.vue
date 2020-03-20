<template>
  <div>
    <v-row>
      <v-col cols="12" class="pt-0">
        <h1>
          <v-icon large left>fas fa-building</v-icon>
          Prédios
        </h1>
      </v-col>
    </v-row>

    <v-divider class="mb-6"></v-divider>

    <v-card>
      <v-card-title>
        Lista de Prédios
        <v-spacer></v-spacer>
        <v-btn color="primary" small dark class="mb-2" @click="addItem">
          <v-icon small left>fas fa-plus</v-icon>
          Adicionar
        </v-btn>

        <Modal :open="modal" :title="formTitle">
          <template v-slot:container>
            <PredioForm></PredioForm>
          </template>
          <template v-slot:actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="close">Cancelar</v-btn>
            <v-btn color="blue darken-1" text @click="saveItem">Salvar</v-btn>
          </template>
        </Modal>

      </v-card-title>

      <v-card-text>
        <v-data-table :headers="headers" :items="items" :search="search">
          <template v-slot:top>
            <v-toolbar flat color="white">
              <v-text-field v-model="search" append-icon="fas fa-search" label="Busca"
                            single-line hide-details>
              </v-text-field>
            </v-toolbar>
          </template>

          <template v-slot:item.actions="{ item }">
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-icon small link color="primary" v-on="on" class="mx-1" @click="showItem(item)">fas fa-eye</v-icon>
              </template>
              <span>Detalhes</span>
            </v-tooltip>
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-icon small color="warning" v-on="on" class="mx-1" @click="editItem(item)">fas fa-pencil-alt</v-icon>
              </template>
              <span>Editar</span>
            </v-tooltip>
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-icon small color="red" v-on="on" class="mx-1" @click="removeItem(item)">fas fa-trash</v-icon>
              </template>
              <span>Excluir</span>
            </v-tooltip>
          </template>

          <template v-slot:no-data>
            Nada encontrado
          </template>
        </v-data-table>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import {mapState, mapMutations, mapActions} from 'vuex'
import Modal from '../../components/Modal'
import PredioForm from "../../components/PredioForm";
import {FORM_TITLE, FORM_ACTION, PREDIO} from "../../store/predios/mutations-types";

export default {
  name: 'Predios',

  components: {Modal, PredioForm},

  data: () => ({
    modal: false,
    search: '',
    headers: [
      {text: '#', value: 'id', align: 'start'},
      {text: 'Prédio', value: 'nome', align: 'start'},
      {text: 'Endereço', value: 'end', sortable: false},
      {text: 'Açôes', value: 'actions', align: 'end', sortable: false},
    ]
  }),

  computed: {
    ...mapState('predios', ['predios', 'formTitle', 'formType']),

    items() {
      return this.predios.map(e => {
        return {
          ...e,
          end: `${e.logradouro}, ${e.numero} ${e.complemento || ''}, ${e.bairro}, ${e.cidade}, ${e.estado}, ${e.cep}`
        }
      })
    }
  },

  beforeMount() {
    if (!this.predios.length) {
      this.list()
    }
  },

  methods: {
    ...mapMutations('predios', [FORM_TITLE, FORM_ACTION, PREDIO]),
    ...mapActions('predios', ['list', 'save', 'remove']),

    saveItem() {
      this.save()
        .then(res => {
          if (res) {
            this.list()
            this.close()
          }
        })
    },

    showItem(item) {
      this.PREDIO(item)
      this.$router.push({name: 'painel.predios.show', params: {id: item.id}})
    },

    addItem() {
      this.FORM_TITLE('Adicionar novo Prédio')
      this.FORM_ACTION('add')
      this.modal = true
    },

    editItem(item) {
      this.PREDIO(item)
      this.FORM_TITLE(`Editar Prédio: ${item.nome}`)
      this.FORM_ACTION('edit')
      this.modal = true
    },

    removeItem(item) {
      if (confirm(`Deseja excluír o prédio ${item.nome} e todos os seus apartamentos?`)) {
        this.PREDIO(item)
        this.FORM_ACTION('remove')
        this.remove()
          .then(res => {
            if (res) {
              this.list()
              this.close()
            }
          })
      } else {
        this.close()
      }
    },

    close() {
      this.PREDIO()
      this.FORM_TITLE()
      this.FORM_ACTION()
      this.modal = false
    }
  }
}
</script>
