@extends('layouts.builder')

@section('content')
<v-main>
  <v-container class="fill-height">
    <router-view></router-view>
  </v-container>
</v-main>
@endsection