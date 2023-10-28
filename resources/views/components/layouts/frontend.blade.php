<x-layouts.main>
    @push('css')
    <style>
        .loader {
            width: 48px;
            height: 48px;
            border: 5px solid #000000;
            border-bottom-color: transparent;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
            margin-top: 20%;
            margin-left: 50%;

        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
        .main{
            visibility: hidden;
        }
    </style>
    @endpush

    @push('js')
    <script>
        //loader
        document.onreadystatechange = function () {
            var state = document.readyState
            console.log(state);
            if (state == 'interactive') {
                document.querySelector('.main').style.visibility = "hidden";
            } else if (state == 'complete') {
                setTimeout(function () {
                    document.querySelector('.loader').style.display = "none";
                    document.querySelector('.main').style.visibility = "visible";
                }, 500);
            }
        }
    </script>
    @endpush
    <x-ui.frontend.header />
    <div class="loader"></div>
    <div class="main">
        {{ $slot }}
    </div>

</x-layouts.main>
