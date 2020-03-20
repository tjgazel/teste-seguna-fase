<template>
  <div>
    <v-list dense>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="title">
            <v-icon left>fas fa-user</v-icon>
            {{user.name}}
          </v-list-item-title>
          <v-list-item-subtitle class="ml-8">
            {{user.email}}
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
    </v-list>

    <v-divider></v-divider>

    <v-list dense>
      <v-subheader>MENU PRINCIPAL</v-subheader>
      <div v-for="(item, i) in items" :key="item.text+''+i">
        <v-list-item v-if="!item.children" link :to="item.link">
          <v-list-item-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>{{ item.text }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-group v-else-if="item.children"
                      :prepend-icon="item.icon">
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title>{{ item.text }}</v-list-item-title>
            </v-list-item-content>
          </template>
          <v-list-item v-for="(child, j) in item.children" :key="child.text+''+j" link :to="child.link">
            <v-list-item-action>
              <v-icon class="ml-md-5">{{ child.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{ child.text }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-group>
      </div>
    </v-list>

  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'PainelDefaultNavigationDrawerContent',

  data: () => ({
    items: [
      {
        icon: 'fas fa-tachometer-alt',
        text: 'Dashbord',
        link: { name: 'painel.dashbord' }
      },

      {
        icon: 'fas fa-building',
        text: 'Prédios',
        link: { name: 'painel.predios' },
      }

      /* {
        icon: 'fas fa-circle',
        text: 'Example',
        children: [
          {
            icon: 'fas fa-circle',
            text: 'Example 1',
            link: {
              name: 'painel.example1'
            }
          },
          {
            icon: 'fas fa-circle',
            text: 'Example 2',
            link: {
              name: 'painel.example 2'
            }
          }
        ]
      } */
    ]
  }),

  computed: {
    ...mapState(['user'])
  },
}
</script>
