<template>
  <v-dialog persistent :value="open" :width="width || '998px'" :max-width="maxWidth || '100%'">
    <v-card>
      <v-card-title>
        <span class="headline">{{ title }}</span>
      </v-card-title>

      <v-card-text>
        <v-container>
          <slot name="container"></slot>
        </v-container>
      </v-card-text>

      <v-card-actions>
        <slot name="actions"></slot>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: 'Modal',
  props: ['title', 'open', 'width', 'maxWidth']
}
</script>
