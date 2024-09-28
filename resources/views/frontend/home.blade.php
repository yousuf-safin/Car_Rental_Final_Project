<x-app-layout>
    <div class="py-12 dark:text-white max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Homepage Title Section -->
        <div class="text-center">
            <h2 class="text-7xl font-bold mb-8 text-indigo-600 dark:text-indigo-300">
                Welcome to Our Car Rental Service
            </h2>
            <p class="text-lg text-gray-700 dark:text-gray-400 max-w-2xl mx-auto mb-8">
                Experience the best car rental service with a wide range of vehicles to choose from. Whether it's for business, vacation, or a quick trip, we've got you covered with our top-notch rental service.
            </p>
            <!-- Button to Rentals Page -->
            <a href="{{ route('frontedrentals') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-full text-lg font-semibold hover:bg-indigo-700 transition duration-300 ease-in-out">
                View Available Rentals
            </a>
        </div>

        <!-- Additional Information Section -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 text-gray-800 dark:text-white">
                <h3 class="text-3xl font-semibold mb-4">Why Choose Us?</h3>
                <p class="text-lg">
                    We offer the most convenient and affordable rental options with flexible booking and cancellation policies. Our fleet consists of luxury, economy, and SUV models to suit your needs, whether for leisure or work.
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 text-gray-800 dark:text-white">
                <h3 class="text-3xl font-semibold mb-4">Wide Range of Cars</h3>
                <p class="text-lg">
                    From luxury sedans to economy cars, we provide various vehicle categories that are maintained in perfect condition for your ultimate driving experience. No matter your preference, we have the right car for you.
                </p>
            </div>
        </div>

       <!-- Image Slider Section -->
<div class="mt-16 relative w-full overflow-hidden rounded-lg shadow-lg" x-data="{ currentSlide: 0 }" x-init="setInterval(() => currentSlide = (currentSlide + 1) % 4, 6000)">
    <!-- Slider Images -->
    <div class="flex transition-transform duration-500 ease-in-out" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
        <img class="w-full h-auto" src="{{ asset('storage/img/11.jpg') }}" alt="Slide 1">
        <img class="w-full h-auto" src="{{ asset('storage/img/2.jpg') }}" alt="Slide 2">
        <img class="w-full h-auto" src="{{ asset('storage/img/3.jpg') }}" alt="Slide 3">
        <img class="w-full h-auto" src="{{ asset('storage/img/4.jpg') }}" alt="Slide 4">
    </div>

    <!-- Previous Button -->
    <button @click="currentSlide = (currentSlide === 0) ? 3 : currentSlide - 1" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded-full hover:bg-gray-700">
        &#10094;
    </button>

    <!-- Next Button -->
    <button @click="currentSlide = (currentSlide + 1) % 4" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded-full hover:bg-gray-700">
        &#10095;
    </button>

    <!-- Indicator Dots -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <template x-for="i in 4">
            <div :class="{'bg-indigo-600': currentSlide === i - 1, 'bg-gray-300': currentSlide !== i - 1}" @click="currentSlide = i - 1" class="w-3 h-3 rounded-full cursor-pointer"></div>
        </template>
    </div>
</div>

    </div>
</x-app-layout>
