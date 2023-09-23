// Script For Header

const HeaderSection = $('#MyHeader');
$(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
        // Fixing Jump
        if($(this).scrollTop() > 50 && $(this).scrollTop() < 55){
            $(this).scrollTop(56);
        }
        HeaderSection.addClass('scrolledMyHeader')
    } else {
        HeaderSection.removeClass('scrolledMyHeader');
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
