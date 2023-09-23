@extends('frontend.main.master')

@section('title', 'Home')

@section('content')
    <div
        class="[&>div]:rounded-3xl [&>div]:mb-12 [&>div]:p-5 [&>div]:mx-auto [&>div]:bg-gray-900 p-5 bg-gray-800 rounded-3xl">
        <div class="!p-0 overflow-hidden">
            <img src="{{ asset('img/BannerHome.png') }}" alt="Banner">
        </div>
        <div class="relative">
            <h2 class="text-2xl mb-5 text-center"><b>کتاب های جدید :</b></h2>
            <div class="grid grid-cols-1 md:grid-cols-4 text-center mb-10 gap-4">
                @foreach($Books as $Book)
                    <a href="{{url($Book->categories[0]->slug . '/' . $Book->name)}}"
                       class="inline-block h-[21rem] md:h-[23.5rem]">
                        <div
                            class="h-full space-y-3 col-span-1 bg-gray-800 px-10 pt-5 rounded-3xl hover:duration-300 hover:bg-white hover:text-black">
                            <h3 class="mb-4"><b>{{$Book->name}}</b></h3>
                            <div class="w-full h-3/4 overflow-hidden">
                                <img
                                    src="{{ ($Book->cover ?? ( strpos(asset($Book->photo_path), 'img/books') ? asset($Book->photo_path) : asset('img/books/template.png') )) }}"
                                    alt="{{$Book->name}}" class="rounded-3xl object-fill w-full h-full">
                            </div>
                            <div>
                                <span>{{ views($Book)->unique()->count() }}</span>
                                <i class="fa-solid fa-eye"></i>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <a href="{{route('library')}}"
               class="text-center hover:duration-300 hover:bg-blue-500 absolute md:bottom-[-5vh] bottom-[-2vh] rounded-3xl mx-auto bg-red-500 left-[10%] right-[10%] md:left-[30%] p-2 md:p-6 md:right-[30%]">
                مشاهده تمامی کتاب ها
            </a>
        </div>
        <div class="relative">
            <h2 class="text-2xl mb-5 text-center"><b>دسته بندی ها :</b></h2>
            <div class="grid grid-cols-2 md:grid-cols-4 text-center mb-10 gap-4">
                @foreach($Categories as $Category)
                    <a href="{{url('/category/' . $Category->slug)}}">
                        <div
                            class="col-span-1 bg-gray-800 overflow-hidden p-2 md:p-5 rounded-3xl hover:duration-300 hover:bg-white hover:text-black">
                            <h3><b>{{$Category->slug}}</b></h3>
                        </div>
                    </a>
                @endforeach
            </div>
            <a href="{{route('category')}}"
               class="text-center hover:duration-300 hover:bg-blue-500 absolute md:bottom-[-5vh] bottom-[-2vh] rounded-3xl mx-auto bg-red-500 left-[10%] right-[10%] md:left-[30%] p-2 md:p-6 md:right-[30%]">
                مشاهده تمامی دسته بندی ها
            </a>
        </div>
        <div>
            <div class="grid grid-cols-1 text-center gap-4 py-10">
                <div class="text-center text-2xl textJS"></div>
            </div>
        </div>
        <script>

            class TextScramble {
                constructor(el) {
                    this.el = el;
                    this.chars = "!<>-_\\/[]{}—=+*^?#________";
                    this.update = this.update.bind(this);
                }

                setText(newText) {
                    const oldText = this.el.innerText;
                    const length = Math.max(oldText.length, newText.length);
                    const promise = new Promise(resolve => this.resolve = resolve);
                    this.queue = [];
                    for (let i = 0; i < length; i++) {
                        const from = oldText[i] || "";
                        const to = newText[i] || "";
                        const start = Math.floor(Math.random() * 40);
                        const end = start + Math.floor(Math.random() * 40);
                        this.queue.push({from, to, start, end});
                    }
                    cancelAnimationFrame(this.frameRequest);
                    this.frame = 0;
                    this.update();
                    return promise;
                }

                update() {
                    let output = "";
                    let complete = 0;
                    for (let i = 0, n = this.queue.length; i < n; i++) {
                        let {from, to, start, end, char} = this.queue[i];
                        if (this.frame >= end) {
                            complete++;
                            output += to;
                        } else if (this.frame >= start) {
                            if (!char || Math.random() < 0.28) {
                                char = this.randomChar();
                                this.queue[i].char = char;
                            }
                            output += `<span class="dud">${char}</span>`;
                        } else {
                            output += from;
                        }
                    }
                    this.el.innerHTML = output;
                    if (complete === this.queue.length) {
                        this.resolve();
                    } else {
                        this.frameRequest = requestAnimationFrame(this.update);
                        this.frame++;
                    }
                }

                randomChar() {
                    return this.chars[Math.floor(Math.random() * this.chars.length)];
                }
            }

            const allBooks = {{ count($allBooks) }};
            const allCategories = {{ count($allCategories) }};
            const allViews = {{ views(\App\Models\Book::class)->count() }};

            const phrases = [
                ` بازدید ها : ${allViews}`,
                ` کتاب ها : ${allBooks}`,
                ` دسته ها : ${allCategories}`,
                ": Created By",
                ":) Amir Roox",
                "خوش باشید!"
            ];


            const el = document.querySelector(".textJS");
            const fx = new TextScramble(el);

            let counter = 0;
            const next = () => {
                fx.setText(phrases[counter]).then(() => {
                    setTimeout(next, 1500);
                });
                counter = (counter + 1) % phrases.length;
            };

            next();
        </script>
    </div>
@endsection
