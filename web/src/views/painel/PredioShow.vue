<template>
  <div>
    <v-row>
      <v-col cols="12" class="pt-0">
        <h1>
          <v-icon large left>fas fa-building</v-icon>
          Informaçôes do prédio
        </h1>
      </v-col>
    </v-row>

    <v-divider class="mb-6"></v-divider>

    <v-card class="mb-10">
      <v-card-title><span class="font-weight-light mr-4">
        Prédio:</span> {{ predio.nome }}
        <v-spacer></v-spacer>
        <v-btn small link :to="{name: 'painel.predios'}">Voltar</v-btn>
      </v-card-title>
      <v-card-text>
        {{ enderecoPredio }}
      </v-card-text>
    </v-card>

    <v-card>
      <v-card-title>
        Lista de Apartamentos
        <v-spacer></v-spacer>
        <v-btn color="primary" small dark class="mb-2" @click="addItem">
          <v-icon small left>fas fa-plus</v-icon>
          Adicionar
        </v-btn>

        <Modal :open="modal" :title="formTitle">
          <template v-slot:container>
            <AptoForm></AptoForm>
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

          <template v-slot:item.status="{ item }">
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-icon v-on="on" :color="item.status === 0 ? 'green' : 'red'">fas fa-circle</v-icon>
              </template>
              <span>{{ item.status === 0 ? 'Disponível' : 'Indisponível' }}</span>
            </v-tooltip>
          </template>

          <template v-slot:item.actions="{ item }">
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
import {mapState, mapGetters, mapActions, mapMutations} from 'vuex'
import {FORM_TITLE, FORM_ACTION, APTO} from "../../store/apto/mutations-types";
import Modal from "../../components/Modal";
import AptoForm from "../../components/AptoForm";

export default {
  name: 'PredioShow',

  components: {Modal, AptoForm},

  data: () => ({
    modal: false,
    search: '',
    headers: [
      {text: 'Andar', value: 'andar', align: 'start'},
      {text: 'Número', value: 'numero', sortable: false},
      {text: 'Quartos', value: 'quartos', align: 'center'},
      {text: 'Banheiros', value: 'banheiros', align: 'center'},
      {text: 'Metros²', value: 'metros'},
      {text: 'Finalidade', value: 'finalidade.descricao', align: 'center'},
      {text: 'Status', value: 'status', align: 'center'},
      {text: 'Açôes', value: 'actions', align: 'end', sortable: false},
    ]
  }),

  computed: {
    ...mapState('predios', ['predio']),
    ...mapState('apto', ['apto', 'formTitle', 'formType', 'finalidades']),
    ...mapGetters('predios', ['enderecoPredio']),

    items() {
      return this.predio.apartamentos
    }
  },

  beforeMount() {
    if (!this.predio.id) {
      this.show(this.$route.params.id)
    }
    if (!this.finalidades.length) {
      this.getFinalidades()
    }
  },

  methods: {
    ...mapMutations('apto', [FORM_TITLE, FORM_ACTION, APTO]),
    ...mapActions('predios', ['show']),
    ...mapActions('apto', ['save', 'remove', 'getFinalidades']),

    saveItem() {
      this.save()
        .then(res => {
          if (res) {
            this.show(this.$route.params.id)
            this.close()
          }
        })
    },

    addItem() {
      this.APTO({...this.apto, predio_id: this.predio.id})
      this.FORM_TITLE('Adicionar novo Apartamento')
      this.FORM_ACTION('add')
      this.modal = true
    },

    editItem(item) {
      this.APTO(item)
      this.FORM_TITLE(`Editar Apartamento: ${item.numero} - ${item.andar} andar`)
      this.FORM_ACTION('edit')
      this.modal = true
    },

    removeItem(item) {
      if (confirm(`Deseja excluír o apartamento ${item.numero} - ${item.andar} andar`)) {
        this.APTO(item)
        this.FORM_ACTION('remove')
        this.remove()
          .then(res => {
            if (res) {
              this.show(this.$route.params.id)
              this.close()
            }
          })
      } else {
        this.close()
      }
    },

    close() {
      this.APTO()
      this.FORM_TITLE()
      this.FORM_ACTION()
      this.modal = false
    }
  }

}
</script>
