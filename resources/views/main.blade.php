@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <div id="showcase">
    <div class="container showcase">
        <div class="full-width text-center showcase-caption mt-30">
              <h1>Усадьба "Степановское-Волосово"</h1>
                    <div class="showcase-button">
                      <!--<a href="{{ route('exhib.index') }}" class="button-style showcase-btn">
                        Выставки
                      </a>-->
                      <a href="{{ route('excursions.index') }}" class="button-style showcase-btn">
                        Экскурсии
                      </a>
                </div>
    		</div>
      </div>
  </div>

  <div id="features">
  <iframe height=600px src="https://www.google.com/maps/embed?pb=!4v1670227964564!6m8!1m7!1sCAoSK0FGMVFpcE9BZG5xX2kwQm9PSGE1RGxnMDktR1dRN1dZVHNFZjNEU0FsdUk.!2m2!1d56.2732669!2d35.3612893!3f44.59941837357701!4f7.5785520534842306!5f0.4000000000000002" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
  <footer class="text-center pos-re">
    <div class="container">
      <div class="footer__box">
        <!-- Logo -->
            <h2 style="color:#fff">Музей "Степановское-Волосово"</h2>
        <p>&copy; 2022 Saschockk. All Rights Reserved.</p>
      </div>
    </div>

    <div class="curve curve-top curve-center"></div>
</footer>


@endsection
