<header>


    <div onclick="goHome()" class="logo_container">
      <h1 class="logo_top" >Creator's</h1>
      <h1 class="logo_bottom">motivation</h1>

    </div>

        <!-- Responsive Settings Options -->
      
        <div class="right_container">
            <x-responsive-nav-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-responsive-nav-link>
            <span class="nav_span">=</span>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
          </form>

        </div>
  </header>
  


  <style scoped>

    .user_name{
      color: white;
      font-size: 0.8rem;
      margin-right: 1rem;
    }
    .logout{
      color: white;
      font-size: 0.8rem;
    
    }
    
    .right_container{
      color: white;
      display: flex;
      margin-right: 1rem;
    }
      header {
    
        width: 100%;
        height: 3rem;
        /* box-shadow: 0px 4px 4px 0px #00000040; */
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    
      }
      .logo_container h1 {
        font-size: 0.8rem;
        color: white;
        margin-left: 1rem;
        line-height: 0.9rem;
    
      }
      header a {
        color: white;
      }
      header a:hover {
        text-decoration: underline;
      }
      #ver{
        font-size: 0.2rem;
        margin-left: 1rem;
        color: white
      }
    
    
    </style>

    <script>
      function goHome() {
        location.href = '/';
      }
    </script>