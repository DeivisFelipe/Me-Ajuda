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
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-900 text-left">{{ anuncio.titulo }}</h1>
              </v-card-title>

              <v-card-text>

                <v-img :src="'/images/' + anuncio.imagem" alt="Imagem do anúncio" class="mt-4 w-96 h-96"></v-img>

                <h2 class="mt-6 text-3xl">Descrição:</h2>
                <p class="text-lg text-gray-900 dark:text-gray-900">{{ anuncio.descricao }}</p>

                <p>Cidade: {{ anuncio.cidade }}</p>

                <p>E-mail: {{ anuncio.email }}</p>

                <p>Tipo: {{ anuncio.tipo }}</p>
                <a v-if="anuncio.whatsapp" target="_blank" :href="'https://api.whatsapp.com/send?phone=55' + anuncio.telefone" class="block mt-3" style="background-color: #128C7E; color: white; border-radius: 50px; padding: 10px 30px; width: fit-content;"><v-icon icon="mdi-whatsapp"></v-icon> {{ formataNumero(anuncio.telefone) }}</a>
                <a :href="'tel:' + anuncio.telefone" target="_blank" v-else class="block mt-3" style="background-color: #666; color: white; border-radius: 50px; padding: 10px 30px; width: fit-content;"><v-icon icon="mdi-phone"></v-icon> {{ formataNumero(anuncio.telefone) }}</a>

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
  anuncio: {
    type: Object,
  },
});

function formataNumero(numero) {
  return numero.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
}
</script>
