@extends('public.layouts.app')
@section('title', 'Sejarah Desa - Desa Tanjung Selamat')
@section('description', 'Sejarah Desa Tanjung Selamat - Dari kebun teh Belawan State hingga menjadi Desa yang mandiri.')
@section('content')
<!-- Hero Section with Parallax Effect -->
<section class="bg-gradient-to-r from-emerald-500 via-green-600 to-green-700 text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10 z-0"></div>
    <div class="min-h-[166px] mx-auto px-4 sm:px-6 lg:px-10 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 animate-fadeInDown">Sejarah Desa Tanjung Selamat</h1>
            <p class="text-xl text-white max-w-2xl mx-auto animate-fadeInUp delay-100">
                Melacak jejak sejarah dari kebun teh Belawan State hingga menjadi desa mandiri
            </p>
        </div>
    </div>
</section>

<!-- Profil Desa Section -->
<section class="py-16 bg-gradient-to-b from-white to-emerald-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header with decorative elements -->
            <div class="text-center mb-12 relative animate-fadeIn">
                <h2 class="text-3xl md:text-4xl font-bold text-emerald-800 mb-4 relative inline-block">
                    <span class="relative z-10 animate-underline">SEJARAH DESA</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto animate-fadeIn delay-150">Menelusuri jejak perjalanan desa dari masa ke masa</p>
            </div>

            <!-- History Content Container -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-popIn">
                <!-- Content -->
                <div class="p-6 md:p-8">
                    <!-- Timeline style history -->
                    <div class="relative pl-8 border-l-2 border-emerald-200 space-y-8">
                        <!-- Item 1 -->
                        <div class="relative animate-slideInLeft">
                            <div class="absolute -left-8 top-1 w-4 h-4 rounded-full bg-emerald-600 border-4 border-white animate-pulse"></div>
                            <div class="bg-gray-50 p-5 rounded-lg transition-all duration-300 hover:shadow-md">
                                <h3 class="text-xl font-semibold text-emerald-700 mb-2">Era Kebun Teh Belawan State</h3>
                                <p class="text-gray-700">
                                    Pada masa yang lalu, wilayah Tanjung Selamat merupakan Kebun Teh yang disekitarnya terdapat beberapa Kampung antara lain: Kampung La Mente, Kampung Tampok, Kampung Kuala, Kloni Satu, Kloni Dua, dan Kampung Pokok Pinang. Nama kebun Teh tersebut diatas adalah Kebun Belawan State karena di tengah-tengah kebun tersebut aliran Sungai Belawan.
                                </p>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="relative animate-slideInRight delay-100">
                            <div class="absolute -left-8 top-1 w-4 h-4 rounded-full bg-emerald-600 border-4 border-white animate-pulse"></div>
                            <div class="bg-gray-50 p-5 rounded-lg transition-all duration-300 hover:shadow-md">
                                <h3 class="text-xl font-semibold text-emerald-700 mb-2">Tahun 1951 - Penutupan Kebun Teh</h3>
                                <p class="text-gray-700">
                                    Pada Tahun 1951 kebun Belawan State tutup, maka seluruh tanahnya diserahkan kepada masyarakat dengan cara mematok masing-masing. Setelah tanah kebun dikuasai oleh masyarakat, maka bergabunglah beberapa kampung tersebut menjadi Kampung Tanjung Selamat.
                                </p>
                            </div>
                        </div>

                        <!-- Special Highlight -->
                        <div class="relative animate-slideInLeft delay-150">
                            <div class="absolute -left-8 top-1 w-4 h-4 rounded-full bg-emerald-600 border-4 border-white animate-pulse"></div>
                            <div class="bg-emerald-50 border border-emerald-100 p-5 rounded-lg shadow-inner transition-all duration-300 hover:shadow-lg">
                                <div class="flex items-start">
                                    <div class="mr-4 text-emerald-600 animate-bounce">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold text-emerald-800 mb-2">Asal Usul Nama Tanjung Selamat</h3>
                                        <p class="text-gray-700">
                                            Adapun nama Tanjung Selamat diperoleh dari narasumber yakni orang-orang tua yang masih hidup sekarang menerangkan bahwasanya dahulu ada tumbuh Pohon Bunga Tanjung di tepi Sungai Belawan dan anehnya Pohon tersebut tetap berdiri tegak (tidak rusak) walaupun beberapa kali dilanda banjir yang cukup besar yang menghanyutkan pohon-pohon besar lain yang ada disekitarnya. Karena memperhatikan dan melihat fenomena keanehan tersebut, maka tokoh-tokoh masyarakat pada waktu itu bermusyawarah dan sepakat untuk menamakan kampungnya menjadi Kampung Tanjung Selamat (yang berarti Pohon Bunga Tanjung yang selamat dari banjir).
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="relative animate-slideInRight delay-200">
                            <div class="absolute -left-8 top-1 w-4 h-4 rounded-full bg-emerald-600 border-4 border-white animate-pulse"></div>
                            <div class="bg-gray-50 p-5 rounded-lg transition-all duration-300 hover:shadow-md">
                                <h3 class="text-xl font-semibold text-emerald-700 mb-2">Perubahan Administratif</h3>
                                <p class="text-gray-700 mb-4">
                                    Beberapa tahun kemudian dari beberapa kampung yang disebut diatas tadi ada kampung yang memisahkan diri dari Kampung Tanjung Selamat yakni Kampung La Mente menjadi Tanjung Anom (sekarang Desa Tanjung Anom Kecamatan Pancur Batu).
                                </p>
                                <p class="text-gray-700">
                                    Kemudian pada Tahun 1979 sebahagian wilayah Kampung Tanjung Selamat bergabung dengan Kota Madya Medan (tepatnya wilayah batas Sungai Belawan yang sekarang menjadi Kelurahan Tanjung Selamat Kecamatan Medan Tuntungan). Dan Kampung Tanjung Selamat pun berubah menjadi Desa Tanjung Selamat Kecamatan Sunggal Kabupaten Deli Serdang.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer with decorative element -->
                <div class="px-6 pb-6 md:px-8 md:pb-8 animate-fadeIn delay-300">
                    <div class="border-t-2 border-dashed border-emerald-200 pt-6 text-center">
                        <p class="text-sm text-gray-500 italic">"Sejarah adalah cermin untuk melihat masa depan"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Timeline Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12 animate-fadeIn">
                <h2 class="text-3xl font-bold text-emerald-700 mb-2">Kilas Sejarah</h2>
                <p class="text-gray-600">Perjalanan penting Desa Tanjung Selamat</p>
                <div class="w-20 h-1 bg-emerald-500 mx-auto mt-4 animate-scaleX"></div>
            </div>

            <div class="relative">
                <!-- Timeline line -->
                <div class="absolute left-1/2 w-1 h-full bg-emerald-200 transform -translate-x-1/2 animate-drawLine hidden md:block"></div>

                <!-- Timeline items -->
                <div class="space-y-8">
                    <!-- Item 1 -->
                    <div class="relative timeline-item animate-slideInLeft">
                        <div class="timeline-dot bg-emerald-600 animate-pingOnce"></div>
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 md:w-[calc(50%-2rem)] md:ml-auto border-l-4 border-emerald-500 hover:-translate-y-1">
                            <h3 class="text-xl font-semibold text-emerald-700 mb-2">Era Kebun Teh Belawan State</h3>
                            <p class="text-gray-600">Wilayah ini awalnya merupakan kebun teh yang dikelilingi beberapa kampung seperti La Mente, Tampok, Kuala, Kloni 1 & 2, dan Pokok Pinang.</p>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="relative timeline-item animate-slideInRight delay-100">
                        <div class="timeline-dot bg-emerald-600 animate-pingOnce delay-300"></div>
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 md:w-[calc(50%-2rem)] md:mr-auto border-l-4 border-emerald-500 hover:-translate-y-1">
                            <h3 class="text-xl font-semibold text-emerald-700 mb-2">Tahun 1951 - Penutupan Kebun Teh</h3>
                            <p class="text-gray-600">Kebun Belawan State tutup dan tanahnya diserahkan kepada masyarakat. Kampung-kampung bergabung menjadi Kampung Tanjung Selamat.</p>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="relative timeline-item animate-slideInLeft delay-200">
                        <div class="timeline-dot bg-emerald-600 animate-pingOnce delay-600"></div>
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 md:w-[calc(50%-2rem)] md:ml-auto border-l-4 border-emerald-500 hover:-translate-y-1">
                            <h3 class="text-xl font-semibold text-emerald-700 mb-2">Asal Nama Tanjung Selamat</h3>
                            <p class="text-gray-600">Berasal dari Pohon Bunga Tanjung yang tetap tegak meski diterjang banjir besar, menjadi simbol keteguhan masyarakat.</p>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="relative timeline-item animate-slideInRight delay-300">
                        <div class="timeline-dot bg-emerald-600 animate-pingOnce delay-900"></div>
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 md:w-[calc(50%-2rem)] md:mr-auto border-l-4 border-emerald-500 hover:-translate-y-1">
                            <h3 class="text-xl font-semibold text-emerald-700 mb-2">Tahun 1979 - Perubahan Administratif</h3>
                            <p class="text-gray-600">Sebagian wilayah bergabung dengan Kota Medan, sisanya menjadi Desa Tanjung Selamat, Kecamatan Sunggal, Kabupaten Deli Serdang.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kepala Desa Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-emerald-700 mb-2">Daftar Kepala Desa</h2>
                <p class="text-gray-600">Para pemimpin yang pernah memimpin Desa Tanjung Selamat</p>
                <div class="w-20 h-1 bg-emerald-500 mx-auto mt-4"></div>
            </div>

            <div class="overflow-x-auto bg-white rounded-xl shadow-md">
                <table class="min-w-full">
                    <thead class="bg-emerald-600">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Masa Jabatan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @php
                            $data = [
                                ['SAWINANGUN', '1953 s/d 1961', 'Wakil Kampung'],
                                ['SARNO', '1961 s/d 1968', 'Wakil Kampung'],
                                ['BEJO', '1968 s/d 1973', 'Kepala Kampung'],
                                ['M. YUSUF', '1973 s/d 1981', 'Kepala Kampung'],
                                ['POLEN PERANGIN-ANGIN', '1982 s/d 1987', 'Pjs. Kepala Desa'],
                                ['POLEN PERANGIN-ANGIN', '1988 s/d 1989', 'Pejabat Kecamatan'],
                                ['JONI TARIGAN', '1989 s/d 1992', 'Kepala Desa'],
                                ['-', '1993', 'Caretaker'],
                                ['JONI TARIGAN', '1993 s/d 2002', 'Kepala Desa'],
                                ['KAMTA SEMBIRING', '2002', 'Caretaker'],
                                ['NURAIDI', '2002 s/d 2007', 'Kepala Desa'],
                                ['SAKIMAN', '2008', 'Caretaker'],
                                ['HARIONO', '2008', 'Caretaker'],
                                ['NURAIDI', '2009 s/d 2015', 'Kepala Desa'],
                                ['ESTER PARDEDE, S.Sos', '2016', 'Plt Kepala Desa'],
                                ['NURAIDI', '2016 s/d 2022', 'Kepala Desa'],
                                ['SAPII ANDINATA', '2022 s/d 2030', 'Kepala Desa'],
                            ];
                        @endphp
                        @foreach($data as $index => $d)
                        <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-emerald-50 transition-colors duration-300 animate-fadeInRow" style="animation-delay: {{ $index * 50 }}ms">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $d[0] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $d[1] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $d[2] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Custom CSS -->
<style>
    .timeline-item {
        display: flex;
        align-items: flex-start;
    }

    .timeline-dot {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 16px;
        height: 16px;
        border-radius: 50%;
        z-index: 10;
    }

    @media (max-width: 767px) {
        .timeline-dot {
            left: 20px;
        }
        .timeline-item > div:last-child {
            margin-left: 48px;
            width: calc(100% - 48px) !important;
        }
    }

    /* Animations - hanya aktif ketika memiliki kelas 'animated' */
    .animate-fadeInDown.animated {
        animation: fadeInDown 0.8s ease-out both;
    }

    .animate-fadeInUp.animated {
        animation: fadeInUp 0.8s ease-out both;
    }

    .animate-fadeIn.animated {
        animation: fadeIn 1s ease-out both;
    }

    .animate-slideInLeft.animated {
        animation: slideInLeft 0.8s ease-out both;
    }

    .animate-slideInRight.animated {
        animation: slideInRight 0.8s ease-out both;
    }

    .animate-popIn.animated {
        animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
    }

    .animate-scaleX.animated {
        animation: scaleX 0.8s ease-out both;
        transform-origin: left;
    }

    .animate-drawLine.animated {
        animation: drawLine 1.5s ease-out both;
        transform-origin: top;
    }

    .animate-pulse.animated {
        animation: pulse 2s infinite;
    }

    .animate-pingOnce.animated {
        animation: pingOnce 0.8s ease-out both;
    }

    .animate-underline.animated::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #059669;
        transform: scaleX(0);
        transform-origin: left;
        animation: scaleX 0.8s ease-out 0.3s forwards;
    }

    .animate-fadeInRow.animated {
        animation: fadeIn 0.5s ease-out both;
    }

    .animate-bounce.animated {
        animation: bounce 1s infinite;
    }

    /* Tambahkan opacity: 0 ke elemen animasi sebelum dipicu */
    .animate-fadeInDown,
    .animate-fadeInUp,
    .animate-fadeIn,
    .animate-slideInLeft,
    .animate-slideInRight,
    .animate-popIn,
    .animate-scaleX,
    .animate-fadeInRow,
    .timeline-item {
        opacity: 0;
    }

    /* Elemen yang sudah dianimasikan */
    .animated {
        opacity: 1;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes popIn {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        70% {
            opacity: 1;
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes scaleX {
        from { transform: scaleX(0); }
        to { transform: scaleX(1); }
    }

    @keyframes drawLine {
        from { transform: scaleY(0); }
        to { transform: scaleY(1); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes pingOnce {
        0% {
            transform: translateX(-50%) scale(1);
            opacity: 1;
        }
        50% {
            transform: translateX(-50%) scale(1.5);
            opacity: 0.5;
        }
        100% {
            transform: translateX(-50%) scale(1);
            opacity: 1;
        }
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    /* Animation Delays */
    .delay-100 { animation-delay: 0.1s; }
    .delay-150 { animation-delay: 0.15s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-600 { animation-delay: 0.6s; }
    .delay-900 { animation-delay: 0.9s; }

    /* Transition effects */
    .transition-all {
        transition-property: all;
    }

    .duration-300 {
        transition-duration: 300ms;
    }
</style>

<!-- JavaScript for Scroll Trigger Animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk mengatur animasi saat scroll
    function setupScrollAnimations() {
        // Ambil semua elemen yang memiliki kelas animasi
        const animatedElements = document.querySelectorAll(
            '[class*="animate-"], .timeline-item'
        );

        // Buat Intersection Observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Tambahkan kelas 'animated' untuk memicu animasi
                    const element = entry.target;

                    // Handle delay classes
                    let delay = 0;
                    if (element.classList.contains('delay-100')) delay = 100;
                    if (element.classList.contains('delay-150')) delay = 150;
                    if (element.classList.contains('delay-200')) delay = 200;
                    if (element.classList.contains('delay-300')) delay = 300;
                    if (element.classList.contains('delay-600')) delay = 600;
                    if (element.classList.contains('delay-900')) delay = 900;

                    setTimeout(() => {
                        element.classList.add('animated');
                    }, delay);

                    // Stop observing setelah animasi dipicu
                    observer.unobserve(element);
                }
            });
        }, {
            threshold: 0.1, // Trigger ketika 10% elemen terlihat
            rootMargin: '0px 0px -50px 0px' // Adjust untuk trigger lebih awal
        });

        // Observe semua elemen animasi
        animatedElements.forEach(el => {
            observer.observe(el);
        });
    }

    // Panggil fungsi setup
    setupScrollAnimations();
});
</script>
@endsection
