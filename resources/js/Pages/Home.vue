<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  anuncios: {
    type: Array,
  },
});

function formataDescricao(descricao) {
  return descricao.length > 100
    ? descricao.substring(0, 100) + "..."
    : descricao;
}
</script>

<template>

  <Head title="Welcome" />

  <v-app>
    <div class="min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-200 selection:bg-red-500 selection:text-white">
      <v-app-bar class="pt-2 pb-2 ps-5 pe-5" :elevation="2" height="80" color="#161D29" dark>
        <Link :href="route('home')">
        <img src="/logo_MeAjuda_horizontal.png" alt="Logo" class="w-60 h-28 mr-10" />
        </Link>
        <v-spacer></v-spacer>
        <template v-if="$page.props.auth.user">
          <Link :href="route('anuncios')" class="font-semibold text-white hover:text-gray-900 dark:text-white dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Meus Anúncios</Link>
          <Link :href="route('criaAnuncio')" class="ms-4 font-semibold text-white hover:text-gray-900 dark:text-white dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
          Criar Anúncio
          </Link>
          <Link :href="route('logout')" class="ms-4 font-semibold text-white hover:text-gray-900 dark:text-white dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
          Sair
          </Link>
        </template>
        <template v-else>
          <Link :href="route('login')" class="font-semibold text-white hover:text-gray-900 dark:text-white dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Entrar</Link>

          <Link v-if="canRegister" :href="route('register')" class="ms-4 font-semibold text-white hover:text-gray-900 dark:text-white dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registrar</Link>
        </template>
      </v-app-bar>

      <v-container class="mt-28 mb-28">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-900 text-left mb-10">Anúncios</h1>
        <v-row>
          <v-col v-for="anuncio in anuncios" :key="'anuncion-' + anuncio.id" cols="3">
            <v-card class="mx-auto" max-width="344">
              <v-img height="200px" :src="'/images/' + anuncio.imagem" cover></v-img>

              <v-card-title>
                {{ anuncio.titulo }}
              </v-card-title>

              <v-card-subtitle>
                {{ formataDescricao(anuncio.descricao) }}
              </v-card-subtitle>

              <v-card-actions>
                <Link :href="route('anuncios.show', anuncio.id)">
                <v-btn color="#0000FF" text>
                  Ver mais
                </v-btn>
                </Link>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </v-app>
</template>
