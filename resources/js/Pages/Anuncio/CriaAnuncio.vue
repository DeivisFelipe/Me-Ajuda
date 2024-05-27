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
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-900 text-left">Crie um anúncio</h1>
              </v-card-title>

              <v-card-text>
                <form @submit.prevent="createAnuncio" class="mt-6 space-y-6">

                  <div>
                    <InputLabel for="imagem" value="Imagem" required />

                    <TextInput id="imagem" type="file" @input="form.imagem = $event.target.files[0]" class="mt-1 w-full" />

                    <InputError :message="form.errors.imagem" class="mt-2" />
                  </div>

                  <div>
                    <InputLabel for="titulo" value="Título" required />

                    <TextInput id="titulo" v-model="form.titulo" class="mt-1  w-full" />

                    <InputError :message="form.errors.titulo" class="mt-2" />
                  </div>

                  <div>
                    <InputLabel for="descricao" value="Descrição" required />

                    <v-textarea id="descricao" variant="outlined" v-model="form.descricao" class="mt-1 w-full" />

                    <InputError :message="form.errors.descricao" class="mt-2" />
                  </div>

                  <div>
                    <InputLabel for="telefone" value="Telefone" required />

                    <TextInput id="telefone" v-model="form.telefone" class="mt-1 w-full" />

                    <InputError :message="form.errors.telefone" class="mt-2" />
                  </div>

                  <div>
                    <InputLabel for="whatsapp" value="Whatsapp" required />

                    <v-radio-group v-model="form.whatsapp" class="mt-1 w-full">
                      <v-radio label="Sim" value="1" />
                      <v-radio label="Não" value="0" />
                    </v-radio-group>

                    <InputError :message="form.errors.whatsapp" class="mt-2" />

                  </div>

                  <div>
                    <InputLabel for="cidade" value="Cidade" required />

                    <TextInput id="cidade" v-model="form.cidade" class="mt-1 w-full" />

                    <InputError :message="form.errors.cidade" class="mt-2" />

                  </div>

                  <div>
                    <InputLabel for="email" value="Email" required />

                    <TextInput id="email" v-model="form.email" class="mt-1 w-full" aria-autocomplete="email" />

                    <InputError :message="form.errors.email" class="mt-2" />

                  </div>

                  <div>
                    <InputLabel for="tipo" value="Tipo" required />

                    <v-select id="tipo" v-model="form.tipo" class="mt-1 w-full" variant="outlined" :items="['Ajudar', 'Precisar']" />

                    <InputError :message="form.errors.tipo" class="mt-2" />
                  </div>

                  <div class="flex items-center gap-4">
                    <PrimaryButton :disabled="form.processing">Criar</PrimaryButton>
                  </div>
                </form>
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

import { ref } from "vue";

const form = useForm({
  titulo: "",
  descricao: "",
  imagem: "",
  telefone: "",
  whatsapp: "1",
  cidade: "",
  email: "",
  tipo: "",
  processing: false,
});

const createAnuncio = () => {
  form.post(route("anuncios.store"), {
    preserveScroll: true,
    forceFormData: true,
    onError: () => {
      if (form.errors.titulo) {
        form.reset("titulo");
      }
      if (form.errors.descricao) {
        form.reset("descricao");
      }
      if (form.errors.preco) {
        form.reset("preco");
      }
      if (form.errors.categoria) {
        form.reset("categoria");
      }
      if (form.errors.cidade) {
        form.reset("cidade");
      }
      if (form.errors.estado) {
        form.reset("estado");
      }
      if (form.errors.cep) {
        form.reset("cep");
      }
      if (form.errors.telefone) {
        form.reset("telefone");
      }
      if (form.errors.email) {
        form.reset("email");
      }
      if (form.errors.imagem) {
        form.reset("imagem");
      }
    },
  });
};
</script>
