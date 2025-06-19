@extends('layouts.customer')
@section('content') 
<!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4">

        <!-- Intro Section -->
        <section class="mb-10 text-center">
            <h2 class="text-3xl font-bold mb-2">Get Inspired to Paint Like a Pro!</h2>
            <p class="text-gray-600">Explore our expert tips and watch painting tutorials to elevate your painting projects.</p>
        </section>

        <!-- Tips Grid -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <div class="bg-white rounded-lg p-6 shadow">
                <h3 class="text-xl font-semibold mb-2">🪣 How to Prepare Your Wall Before Painting</h3>
                <p class="text-sm text-gray-600 mb-3">Cleaning, sanding, and priming are essential steps before applying paint. Discover how to do it right for a smooth finish.</p>
                <ul class="list-disc list-inside text-gray-700 text-sm">
                    <li>Remove dirt, grease, and mildew</li>
                    <li>Fill holes and cracks</li>
                    <li>Sand uneven surfaces</li>
                    <li>Apply a suitable primer</li>
                </ul>
            </div>

            <div class="bg-white rounded-lg p-6 shadow">
                <h3 class="text-xl font-semibold mb-2">🎯 Choosing the Right Paint for Every Surface</h3>
                <p class="text-sm text-gray-600 mb-3">Not all paints work on all surfaces. Learn how to choose between emulsion, gloss, enamel, and wood coatings.</p>
                <ul class="list-disc list-inside text-gray-700 text-sm">
                    <li>Use emulsion for interior walls</li>
                    <li>Gloss for doors and trim</li>
                    <li>Wood coatings for furniture</li>
                    <li>Metal paints for grills and gates</li>
                </ul>
            </div>
        </section>

        <!-- Video Tutorials Section -->
        <section class="mb-10">
            <h2 class="text-2xl font-bold mb-4">📽️ Watch Painting Tutorials</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="aspect-video">
                    <iframe class="w-full h-full rounded-lg shadow"
                            src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                            title="Painting Basics"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
                <div class="aspect-video">
                    <iframe class="w-full h-full rounded-lg shadow"
                            src="https://www.youtube.com/embed/1eBDnXQYxZY"
                            title="Painting Tools Tips"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </section>

    </main>
    @endsection
