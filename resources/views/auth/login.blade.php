@extends('layouts.app')
<!DOCTYPE html>
<html>
   <head>
      <title>Tripster</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
      <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
      <style>
      a {
         color: black;
         font-size: 20px;
         font-weight: 500;
         font-family: 'Roboto', sans-serif;
         text-decoration: none;
         }
         a:visited {
         color: black;
         }
         a:hover {
         color: #A3675A;
         }
         .home-page {
         background-color: #5D8C81;
         background-size: cover;
         width: 100%;
         height: 100%;
         }
         .login-page {
         width: 360px;
         padding: 0 0 0;
         margin: auto;
         }
         .form {
         position: relative;
         z-index: 1;
         background: #FFFFFF;
         max-width: 360px;
         margin: 0 auto 100px;
         padding: 45px;
         text-align: center;
         box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
         }
         .form input {
         font-family: "Roboto", sans-serif;
         outline: 0;
         background: #f2f2f2;
         width: 100%;
         border: 0;
         margin: 0 0 15px;
         padding: 15px;
         box-sizing: border-box;
         font-size: 14px;
         }
         .form button {
         font-family: "Roboto", sans-serif;
         text-transform: uppercase;
         outline: 0;
         background: #4CAF50;
         width: 100%;
         border: 0;
         padding: 15px;
         color: #FFFFFF;
         font-size: 14px;
         -webkit-transition: all 0.3 ease;
         transition: all 0.3 ease;
         cursor: pointer;
         }
         .form button:hover,.form button:active,.form button:focus {
         background: #43A047;
         }
      </style>
   </head>
   <body>
      <div id="app">
         <v-app light>
            <v-toolbar>
               <v-toolbar-side-icon class="hidden-md-and-up grey--text" @click="drawer = !drawer"></v-toolbar-side-icon>
               <a href="{{ url('') }}">Tripster</a>
               <v-spacer></v-spacer>
               <v-toolbar-items class="hidden-sm-and-down">
                  @if (Route::has('login'))
                  @auth
                  <v-btn flat href="{{ url('/home') }}">Start Trip</v-btn>
                  <v-btn flat href="{{ route('logout') }}"  onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                  </v-btn>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                  </form>
                  @else
                  <v-btn flat href="{{ route('login') }}">Login</v-btn>
                  @if (Route::has('register'))
                  <v-btn flat href="{{ route('register') }}">Register</v-btn>
                  @endif
                  @endauth
                  @endif
               </v-toolbar-items>
            </v-toolbar>
            <v-navigation-drawer v-model="drawer" app temporary>
               <v-list>
                  <v-list-tile>
                     <v-list-tile-content>
                        <v-list-tile-title>
                           <span>Menu</span>
                        </v-list-tile-title>
                     </v-list-tile-content>
                  </v-list-tile>
                  <v-divider></v-divider>
                  <template v-for="(item, index) in items">
                     <v-list-tile :href="item.href" :to="{name: item.href}" :key="index">
                        <v-list-tile-action>
                           <v-icon light v-html="item.icon"></v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                           <v-list-tile-title v-html="item.title"></v-list-tile-title>
                        </v-list-tile-content>
                     </v-list-tile>
                  </template>
               </v-list>
            </v-navigation-drawer>
            <v-content>
               <v-container fluid fill-height class="home-page" style="max-height:100vh;">
                  <v-layout justify-center align-center column pa-5>
                     <form method="POST" action="{{ route('login') }}">
                        <div class="login-page">
                           <div class="form">
                              <h1>Login</h1>
                              <br>
                              @csrf
                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                              @if ($errors->has('email'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                              </span>
                              @endif
                              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                              @if ($errors->has('password'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                              </span>
                              @endif
                              <button type="submit" class="btn btn-primary">
                              {{ __('Login') }}
                              </button>
                              @if (Route::has('password.request'))
                              <a class="btn btn-link" href="{{ route('password.request') }}">
                              {{ __('Forgot Your Password?') }}
                              </a>
                              @endif
                     </form>
                     </div>
                     </div>
                  </v-layout>
               </v-container>
            </v-content>
         </v-app>
      </div>
      <script src="https://unpkg.com/vue/dist/vue.js"></script>
      <script src="https://unpkg.com/vuetify/dist/vuetify.js"></script>
      <script>
         new Vue({
          el: '#app',
          data () {
            return {
              title: 'Tripster',
              drawer: false,
            items: [{
              href: 'home',
              router: true,
              title: 'Home',
              icon: 'home',
            }, {
              href: 'examples',
              router: true,
              title: 'Login',
              icon: 'insert_emoticon',
            },
            {
              href: 'examples',
              router: true,
              title: 'About',
              icon: 'info',
            }, 
            {
              href: 'examples',
              router: true,
              title: 'Contact',
              icon: 'phone',
            }], 
            
          };
            },
           
          
         })
      </script>
   </body>
</html>