@extends('layouts.app')
@section('content')
    <!-- hero section -->
    <div class="flex justify-center items-center text-center px-4 py-12" id="hero">
        <div class="flex flex-col items-center">
            <h1 class="text-6xl font-extrabold text-white mb-6 flex gap-4">
                Stop <span class="animated-gradient text-transparent bg-clip-text" style="background-clip:text;">Procrastinating</span>
            </h1>
            <p class="text-lg text-white mb-8">Don't let ADHD, Depression, or Laziness stay in your way to achieve your goals.</p>
            <a href="#"
               class="relative inline-block px-8 py-4 font-semibold text-white rounded-full overflow-hidden group no-underline">
                <span class="absolute inset-0 bg-gradient-to-r from-pink-300 via-purple-300 to-pink-300 bg-[length:200%_200%] transition-all duration-500 group-hover:animate-gradient-hover"></span>
                <span class="relative z-10">Start now!</span>
            </a>
        </div>
    </div>
    <!-- features section -->
    <div class="flex flex-col items-center justify-center text-center px-4 py-12 bg-gradient-to-bl from-[#aef4cf] to-[#65a9c7]" id="features">
        <h2 class="text-4xl font-bold text-white mb-6">Features</h2>
        <p class="text-lg text-white mb-8">Discover the features that will help you stay focused and productive.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Feature 1</h3>
                <p class="text-gray-700">Description of feature 1.</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Feature 2</h3>
                <p class="text-gray-700">Description of feature 2.</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Feature 3</h3>
                <p class="text-gray-700">Description of feature 3.</p>
            </div>
        </div>
    </div>
    <!-- testimonials -->
    <div
        x-data="{ active: 0, testimonials: [
        { name: 'Steve', avatar: '/images/steve.jpeg', text: `I used to be a lazy boy. Then I started to use Willy's app. Today I am CEO of my own company and I wear clean underwear daily.` },
        { name: `Steve's mom`, avatar: '/images/stevesmom.jpg', text: `My boy is totally changed. I barely recognize him. He does all his chores, helps me around and I finally got time for my 2 passions: sudokus and postmodern epistemology.` },
        { name: 'Hugh Janus', avatar: '/images/hugh.webp', text: `A must-have for anyone struggling with ADHD. This app changed my life.` }
    ] }"
        class="relative w-full max-w-3xl mx-auto px-4 py-16 text-white text-center"
        id="testimonials"
    >
        <h2 class="text-4xl font-bold mb-6">Testimonials</h2>
        <p class="text-lg mb-8">What our users say about us.</p>

        <!-- Testimonial Slide -->
        <template x-for="(testimonial, index) in testimonials" :key="index">
            <div x-show="active === index" x-transition class="bg-white text-gray-800 rounded-xl shadow-xl p-8">
                <img :src="testimonial.avatar" alt="" class="w-16 h-16 mx-auto mb-4 rounded-full object-cover border-2 border-gray-300" />
                <p class="text-lg italic mb-4" x-text="testimonial.text"></p>
                <p class="font-semibold text-indigo-700" x-text="`- ${testimonial.name}`"></p>
            </div>
        </template>

        <!-- Navigation Arrows -->
        <div class="absolute top-1/2 transform -translate-y-1/2 w-full flex justify-between px-4">
            <button
                @click="active = (active - 1 + testimonials.length) % testimonials.length"
                class="bg-white bg-opacity-20 hover:bg-opacity-40 transition text-white rounded-full p-2"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button
                @click="active = (active + 1) % testimonials.length"
                class="bg-white bg-opacity-20 hover:bg-opacity-40 transition text-white rounded-full p-2"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
    <!-- call to action -->
    <div class="flex flex-col items-center justify-center text-center px-4 py-12 bg-gradient-to-br from-[#65a9c7] to-[#3c6f86]" id="cta">
        <h2 class="text-4xl font-bold text-white mb-6">Ready to get started?</h2>
        <p class="text-lg text-white mb-8">Join our community and start achieving your goals today!</p>
        <a href="#"
           class="relative inline-block px-8 py-4 font-semibold text-white rounded-full overflow-hidden group no-underline">
            <span class="absolute inset-0 bg-gradient-to-r from-pink-300 via-purple-300 to-pink-300 bg-[length:200%_200%] transition-all duration-500 group-hover:animate-gradient-hover"></span>
            <span class="relative z-10">Get Started</span>
        </a>
    </div>

@endsection
