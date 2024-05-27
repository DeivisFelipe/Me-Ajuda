<template>

  <Head title="Cria Anúncio" />

  <v-app>
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-200 selection:bg-red-500 selection:text-white">
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

      <v-container class="mt-28 mb-10">
        <v-row>
          <v-col cols="12">
            <v-card class="pa-8">
              <v-card-title class="mt-3">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-900 text-left">Todos os seus anuncios</h1>
              </v-card-title>

              <v-card-text>
                <table class="w-full text-sm text-left">
                  <thead class="text-xs text-gray-700 uppercase">
                    <tr>
                      <th class="px-6 py-3 w-1">
                        ID
                      </th>
                      <th class="px-6 py-3">
                        Título
                      </th>
                      <th class="px-6 py-3">
                        Imagem
                      </th>
                      <th class="px-6 py-3">
                        Tipo
                      </th>
                      <th class="px-6 py-3">
                        Ações
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="anuncio in anuncios" :key="anuncio.id" class="">
                      <td>
                        {{ anuncio.id }}
                      </td>
                      <td>
                        <Link :href="route('anuncios.show', anuncio.id)" class="text-blue">
                        {{ anuncio.titulo }}
                        </Link>
                      </td>
                      <td>
                        <img :src="'/images/' + anuncio.imagem" alt="Imagem do anuncio" style="height: 100px; width: 100px;" class="pa-4" />
                      </td>
                      <td>{{ anuncio.tipo }}</td>
                      <td>
                        <Link :href="route('anuncios.destroy', anuncio.id)" class="text-red ml-3"> <v-icon icon="mdi-delete"></v-icon> </Link>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </v-app>
</template>

<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { defineProps, onMounted, ref } from "vue";

const props = defineProps({
  anuncios: {
    type: Array,
  },
});

const form = useForm({});
</script>
