@extends('layouts.builder')

@section('content')
<v-main>
  <v-container class="fill-height">
    <v-row justify="center" align="center">
      <v-col class="px-5">
        <router-view></router-view>
      </v-col>
    </v-row>
  </v-container>
</v-main>
@endsection