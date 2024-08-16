<section class="relative h-80 bg-gradient-to-r from-blue-500 to-purple-600 flex flex-col justify-center items-center text-center space-y-6 mb-8 shadow-lg rounded-lg">
  <div class="absolute top-0 left-0 w-full h-full opacity-20 bg-cover bg-center rounded-lg"
    style="background-image: url('images/laravel-logo.png')"></div>

  <div class="z-10 px-6">
    <h1 class="text-7xl font-extrabold uppercase text-white tracking-wider">
      goood<span class="text-yellow-400">jobs</span>
    </h1>
    <p class="text-3xl text-white font-semibold mt-4">
      Find your perfect jobs
    </p>
    <div class="mt-6">
      @auth
      @else
      <a href="/register"
        class="inline-block bg-yellow-400 text-black font-bold py-3 px-6 rounded-full uppercase transition transform hover:scale-105 hover:bg-yellow-500 shadow-md">
        Sign Up to List a jobs
      </a>
      @endauth
    </div>
  </div>
</section>
