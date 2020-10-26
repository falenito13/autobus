<div class="sign-form">
    <div class="sign-inner search find">
        <div class="btn-wrapper">
            <button data-id="1" class="active">{{Lang::get('global.login')}}</button>
            <button data-id="2">{{Lang::get('global.register')}}</button>
            <img src="/front_assets/img/close.svg" alt="" class="close-btn">
        </div>
        <form action="{{route('user.login')}}" data-success-url="{{route('user.home')}}" method="POST" onsubmit="return user.logIn(this); return false;">
            @csrf
            <div class="input-wrapper display-none active" data-id="1">
            <div class="inner">
                <img src="/front_assets/img/right-arrow-green.png" alt="">
                <input type="email" name="email" placeholder="{{Lang::get('global.Email')}}" required>
            </div>
            <div class="inner">
                <img src="/front_assets/img/right-arrow-green.png" alt="">
                <input type="password" name="password" placeholder="{{Lang::get('global.password')}}" required>
            </div>
            <div class="log-in-with">
                <button type="button"><a href="{{route('social.auth',['facebook'])}}" ><img src="/front_assets/img/facebook-blue.svg" alt="">Facebook</a></button>
                <button type="button"><a href="{{route('social.auth',['google'])}}" ><img src="/front_assets/img/google-classic.svg" alt="">Google</a></button>
            </div>
                <button type="submit" class="btn-link" >{{Lang::get('global.login')}}</button>
        </div>
        </form>
        <form action="{{ route('user.register') }}" data-success-url="{{route('user.home')}}" method="POST" onsubmit="return user.register(this)">
            @csrf
            <div class="input-wrapper display-none" data-id="2">
            <div class="inner">
                <img src="/front_assets/img/right-arrow-green.png" alt="">
                <input type="text" name="name" placeholder="{{Lang::get('global.name')}}">
            </div>
            <div class="inner">
                <img src="/front_assets/img/right-arrow-green.png" alt="">
                <input type="text" name="lastname" placeholder="{{Lang::get('global.lastname')}}">
            </div>
            <div class="inner">
                <img src="/front_assets/img/right-arrow-green.png" alt="">
                <input type="number" name="phone_number" placeholder="{{Lang::get('global.phone')}}">
            </div>
            <div class="inner">
                <img src="/front_assets/img/right-arrow-green.png" alt="">
                <input type="email" name="email" placeholder="{{Lang::get('global.email')}}">
            </div>
            <div class="inner">
                <img src="/front_assets/img/right-arrow-green.png" alt="">
                <input type="password"  name="password" placeholder="{{Lang::get('global.password')}}">
            </div>
            <div class="inner">
                <img src="/front_assets/img/right-arrow-green.png" alt="">
                <input type="password"  name="password_confirmation" placeholder="{{Lang::get('global.confirm_password')}}">
            </div>
            <div class="log-in-with">
                <button type="button"><img src="/front_assets/img/facebook-blue.svg" alt="">Facebook</button>
                <button type="button"><img src="/front_assets/img/google-classic.svg" alt="">Google</button>
            </div>
            <button type="submit" class="btn-link">{{Lang::get('global.register')}}</button>
        </div>
        </form>
        <a href="#" class="forgot-pass">{{Lang::get('global.forgot_password')}}?</a>
    </div>
</div>
