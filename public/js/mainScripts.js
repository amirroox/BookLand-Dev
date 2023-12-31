// Script For Header and Footer

const HeaderSection = $('#MyHeader');
const footerLang = $('#footerLang');
const EditButton = $('#EditBtn');
$(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
        // Fixing Jump
        if($(this).scrollTop() > 50 && $(this).scrollTop() < 55){
            $(this).scrollTop(56);
        }
        HeaderSection.addClass('scrolledMyHeader');
        footerLang.addClass('!block');
    } else {
        HeaderSection.removeClass('scrolledMyHeader');
        footerLang.removeClass('!block');
    }

    let windowsHeight = document.body.scrollHeight;
    if ($(this).scrollTop() > 0.6 * windowsHeight || $(this).scrollTop() < 0.2 * windowsHeight) {
        EditButton.fadeOut();
    }
    else {
        EditButton.fadeIn();
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


// Script For Ajax Model Request Book
function alertAjax(){
    Swal.fire({
        title: 'اسم کتاب مورد نظرتون رو بنویسید',
        html:
            '<input id="swal-input1" class="swal2-input" placeholder="نام کتاب">' +
            '<input id="swal-input2" class="swal2-input" placeholder="نام نویسنده">' ,
        showCancelButton: true,
        confirmButtonText: 'درخواست',
        cancelButtonText: 'لغو',
        showLoaderOnConfirm: true,

    }).then(() => {
        let inp1 = $('#swal-input1').val();
        let inp2 = $('#swal-input2').val();
        let linkGiyHub = 'https://github.com/amirroox/BookLand-Dev/issues/new';
        if (inp1 && inp2) {
            let text = `**Name BOOK :** _${inp1}_ \`and\` **Name Author :** _${inp2}_`;
            window.open(`${linkGiyHub}?title=[Need Book] : ${inp1}&body=${text}`, '_blank');
        }
    })
}
