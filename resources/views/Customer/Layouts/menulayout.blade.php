    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="generator" content="Hugo 0.88.1">
        <title>Menu</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbar-static/">

        

        <!-- Bootstrap core CSS -->
    <link href="{{asset ('style/assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">

        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        </style>

        
        <!-- Custom styles for this template -->
        <link href="{{asset('style/css/menu.css')}}" rel="stylesheet">
    </head>
    <body>
    
    <!-- navbar -->
    <nav class="navbartop navbar navbar-expand-md navbar-dark mb-4" style="background-color: #AD3537;">
    <div class="container-fluid">
        <a class="navbar-brand" href="login.html">
        <img src="{{asset('style/img/Logo.png')}}  " alt="" width="115" height="34" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"></a>
            </li>
        </ul>
        <form class="d-flex">
            <input class="form-control me-4" type="search" placeholder="Cari makanan/minuman.." aria-label="Search">
            <button class="btn btn-outline-light me-3"  type="submit">Cari</button>
        </form>
        </div>
    </div>
    </nav>

    <!-- menu -->

@yield('menu')


    <!-- footer -->

@yield('footer')
    

        <script src="{{asset('style/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('style/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
        <script src="{{asset('style/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('style/assets/dist/js/bootstrap.bundle.min.js')}} "></script>
        <script>
        const plus = document.querySelector(".plus"),
        minus = document.querySelector(".minus"),
        num = document.querySelector(".num");

        let a = 0;

        plus.addEventListener("click", ()=>{
            a++;
            a = (a < 10) ? + a : a;
            num.innerText = a;
            console.log(a);
        })

        minus.addEventListener("click", ()=>{
            if(a > 0){
            a--;
            }
            a = (a < 10) ? + a : a;
            num.innerText = a;
        })
        </script>

<script>
    var checkbox = document.getElementsByName('menu[]');
    var jml = document.getElementsByName('jumlah[]');
    var ket = document.getElementsByName('keterangan[]');

    function show() {
        for (var i = 0; i < checkbox.length; i++) {
            if(checkbox[i].checked == true){
                jml[i].disabled = false;
                ket[i].disabled = false;
                jml[i].hidden = false;
                ket[i].hidden = false;
            }else{
                jml[i].disabled = true;
                ket[i].disabled = true;
                jml[i].hidden = true;
                ket[i].hidden = true;
            }
        }
    }

    function test(){
        var checkedValue = null; 
        var inputElements = document.getElementsByName('menu[]');
        for(var i=0; inputElements[i]; ++i){
            if(inputElements[i].checked){
            checkedValue = inputElements[i].value;
            break;
    }
}
    }

</script>

<script>
    var incrementButton = document.getElementsByClassName('inc');
    var decrementButton = document.getElementsByClassName('dec');
    // console.log(incrementButton); 
    // console.log(decrementButton);

    // INCREMENT
    for(var i = 0; i < incrementButton.length; i++){
        var button = incrementButton[i];
        button.addEventListener('click',function(event){
            var buttonClicked = event.target;
            // console.log();
            var input = buttonClicked.parentElement.children[2];
            
            var inputValue = input.value;
            // console.log(inputValue);
            var newValue = parseInt(inputValue) + 1;

            input.value = newValue;
        })
    }

    // DECREMENT
    for(var i = 0; i < decrementButton.length; i++){
        var button = decrementButton[i];
        button.addEventListener('click',function(event){
            var buttonClicked = event.target;
            // console.log();
            var input = buttonClicked.parentElement.children[2];

            var inputValue = input.value;
            // console.log(inputValue);
            var newValue = parseInt(inputValue) - 1;

            if (newValue >= 0){
            input.value = newValue;
            }
            else {
                input.value = 0
            }
        })
    }
</script>

<script>
    $('.form-group').on('input','.prc',function() {
        var totalsum = 0;
        $('.form-group .prc').each(function() {
            var inputVal = $(this).val();
            if($.isNumeric(inputVal)) {
                totalsum += parseInt (inputVal);
            }
        });
        $('#hasil').text(totalsum);
    });
</script>
        
    </body>
    </html>
