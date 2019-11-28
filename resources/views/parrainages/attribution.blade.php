@extends("shared.center")

@section("title", "Attribution")

@section("content")
    <div id="app">
        <attribution
            api-route="{{ route('parrainages.attribution') }}"
            home-route="{{ route('home') }}"
        ></attribution>
    </div>
@endsection

@section("js")
    <script>
        const app = new Vue({
            el: '#app',
        });
    </script>
@endsection
