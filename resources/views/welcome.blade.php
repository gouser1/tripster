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
            .footer {
    background-color: #5D8C81;
    text-align: center;
    justify-content: center;

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
    <v-btn flat href="{{ url('/home') }}">My Dashboard</v-btn>
    <v-btn flat href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</v-btn> <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form> 
    @else
      <v-btn flat href="{{ route('login') }}">Login</v-btn>
      @if (Route::has('register'))
      <v-btn flat href="{{ route('register') }}">Register</v-btn>
   
      @endif
                    @endauth
                    @endif
      <v-btn flat href="#" v-scroll-to="{ el: '#aboutScroll', duration: 1000}">About</v-btn>
      <v-btn flat href="#" v-scroll-to="{ el: '#contactScroll', duration: 2000}">Contact</v-btn>
      
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
        
   
    <v-flex xs12>
      <section>
        <v-parallax src="img/cover.jpg" height="700">
          <v-layout
            column
            align-center
            justify-center
            class="black--text"
          >
            <img src="img/logo23.png" alt="Vuetify.js" height="200" id="logo" class="hidden-xs-only">
            <img src="img/logo23.png" alt="Vuetify.js" height="90" width="300" id="logo" class="hidden-sm-and-up">
            
      

            <h2 class="black--text mb-2 display-1 text-xs-center">The best way to travel</h2>
            <div id="aboutScroll"></div>
            <v-btn
              class="blue lighten-2 mt-5"
              dark
              large
              href="{{ route('login') }}"
            >
              Get Started
            </v-btn>
          </v-layout>
        </v-parallax>
        </v-flex>

      </section>
     
      <section>
        <v-layout
          column
          wrap
          class="my-5"
          align-center
        >
          <v-flex xs12 sm4 class="my-3">
            <div class="text-xs-center">
            
              <h2 class="headline">Start your road trip with friends today!</h2>
             
            </div>
          </v-flex>
          <v-flex xs12>
            <v-container grid-list-xl>
              <v-layout row wrap align-center>
                <v-flex xs12 md4>
                  <v-card  data-aos="fade-up" class="elevation-0 transparent">
                    <v-card-text class="text-xs-center">
                      <v-icon x-large class="blue--text text--lighten-2">color_lens</v-icon>
                    </v-card-text>
                    <v-card-title primary-title class="layout justify-center">
                      <div class="headline text-xs-center">Material Design</div>
                    </v-card-title>
                    <v-card-text>
                      Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. 
                      Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                      Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti. 
                    </v-card-text>
                  </v-card>
                </v-flex>
                <v-flex xs12 md4>
                  <v-card  data-aos="fade-up" class="elevation-0 transparent">
                    <v-card-text class="text-xs-center">
                      <v-icon x-large class="blue--text text--lighten-2">flash_on</v-icon>
                    </v-card-text>
                    <v-card-title primary-title class="layout justify-center">
                      <div class="headline">Fast development</div>
                    </v-card-title>
                    <v-card-text>
                      Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. 
                      Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                      Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti. 
                    </v-card-text>
                  </v-card>
                </v-flex>
                <v-flex xs12 md4>
                  <v-card  data-aos="fade-up" class="elevation-0 transparent">
                    <v-card-text class="text-xs-center">
                      <v-icon x-large class="blue--text text--lighten-2">build</v-icon>
                    </v-card-text>
                    <v-card-title primary-title class="layout justify-center">
                      <div class="headline text-xs-center">Completely Open Sourced</div>
                    </v-card-title>
                    <v-card-text>
                      Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. 
                      Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                      Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti. 
                    </v-card-text>
                  </v-card>
              
                </v-flex>
              </v-layout>
            </v-container>
          </v-flex>
        </v-layout>
      </section>

      <section>
        <v-parallax src="img/cover2.jpg" height="380">
          <v-layout data-aos="fade-up" column align-center justify-center>
            <div class="headline black--text mb-3 text-xs-center">Starting your journey could not be easier!</div>
            <v-btn
              class="blue lighten-2 mt-5"
              dark
              large
              href="{{ route('login') }}"
            >
              Start Journey
            </v-btn>
          </v-layout>
        </v-parallax>
      </section>

      <section>
      <div id="contactScroll"></div>
        <v-container grid-list-xl>
          <v-layout row wrap justify-center class="my-5">
            <v-flex xs12 sm4>
              <v-card class="elevation-0 transparent">
                <v-card-title primary-title class="layout justify-center">
                  <div class="headline">Company info</div>
                </v-card-title>
                <v-card-text>
                  Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. 
                  Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                  Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti. 
                </v-card-text>
              </v-card>
            </v-flex>
            <v-flex xs12 sm4 offset-sm1>
              <v-card class="elevation-0 transparent">
                <v-card-title primary-title class="layout justify-center">
                  <div class="headline">Contact us</div>
                </v-card-title>
                <v-card-text>
                  Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                </v-card-text>
                <v-list class="transparent">
                  <v-list-tile>
                    <v-list-tile-action>
                      <v-icon class="blue--text text--lighten-2">phone</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                      <v-list-tile-title>777-867-5309</v-list-tile-title>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-action>
                      <v-icon class="blue--text text--lighten-2">place</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                      <v-list-tile-title>Chicago, US</v-list-tile-title>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-action>
                      <v-icon class="blue--text text--lighten-2">email</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                      <v-list-tile-title>john@vuetifyjs.com</v-list-tile-title>
                    </v-list-tile-content>
                  </v-list-tile>
                </v-list>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      
       
        
      </section>

      <v-footer dark height="auto">

      
        <v-card class="flex" flat tile>
        
        
            <v-card-actions class="footer">
               
              
             
    @if (Route::has('login'))
    @auth
    <v-btn flat href="{{ url('/home') }}">My Dashboard</v-btn>
    <v-btn flat href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</v-btn> <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form> 
    @else
      <v-btn flat href="{{ route('login') }}">Login</v-btn>
      @if (Route::has('register'))
      <v-btn flat href="{{ route('register') }}">Register</v-btn>
   
      @endif
                    @endauth
                    @endif
      <v-btn flat href="#" v-scroll-to="{ el: '#aboutScroll', duration: 1000}">About</v-btn>
      <v-btn flat href="#" v-scroll-to="{ el: '#contactScroll', duration: 2000}">Contact</v-btn>
      
  
            </v-card-actions>
        </v-card>
    </v-footer>
    </v-content>
  </v-app>
 </div>
 <script src="https://unpkg.com/vue/dist/vue.js"></script>
 <script src="https://unpkg.com/vuetify/dist/vuetify.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-scrollto"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>


 
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
      }
    
  })
 </script>
</body>
</html>