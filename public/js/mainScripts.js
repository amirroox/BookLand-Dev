// Script For Header

    const HeaderSection = document.querySelector('header');
    window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
    HeaderSection.classList.add('md:bg-white', 'md:opacity-90', '!pb-10');
    HeaderSection.classList.remove('md:container');
} else {
    HeaderSection.classList.add('md:container');
    HeaderSection.classList.remove('md:bg-white', 'md:opacity-90', '!pb-10');
}
});


// {{-- Script For Sharing Host Deploy --}}
//     {{--    const baseUrl = '{{ \Illuminate\Support\Facades\URL::to('/') }}';--}}
//     {{--    if(!baseUrl.includes('127.0.0.1')){--}}
//     {{--        const allLinkToPublic = document.querySelectorAll('link');--}}
//     {{--        const allImgToPublic = document.querySelectorAll('img');--}}
//     {{--        allLinkToPublic.forEach(function (link){--}}
//     {{--            if(link.href.includes(baseUrl)){--}}
//     {{--                let replace = link.href.replace(baseUrl, '');--}}
//     {{--                link.href = 'public' + replace;--}}
//     {{--            }--}}
//     {{--        });--}}
//     {{--        allImgToPublic.forEach(function (img){--}}
//     {{--            if(img.src.includes(baseUrl)){--}}
//     {{--                let replace = img.src.replace(baseUrl, '');--}}
//     {{--                img.src = 'public' + replace;--}}
//     {{--            }--}}
//     {{--        });--}}
//     {{--    }--}}
