@extends("shared.front")

@section("title", "Accueil")

@auth
    @php $class = "col-xl-3 col-sm-6 mb-3" @endphp
@endauth
@guest
    @php $class = "col-xl-4 col-sm-6 mb-3" @endphp
@endguest

@section("content")
    <div class="row">
        <div class="{{ $class }}">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-user-plus"></i>
                    </div>
                    <div class="mr-5">
                        <h5>Filleuls</h5>
                        0
                    </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Plus de détails...</span>
                    <span class="float-right">
                      <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="{{ $class }}">
            <div class="card text-white bg-secondary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-users"></i>
                    </div>
                    <div class="mr-5">
                        <h5>Parrains</h5>
                        0
                    </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Plus de détails...</span>
                    <span class="float-right">
                      <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        @auth
            <div class="{{ $class }}">
                <div class="card text-white bg-dark o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-users-cog"></i>
                        </div>
                        <div class="mr-5">
                            <h5>Managers</h5>
                            0
                        </div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">Plus de détails...</span>
                        <span class="float-right">
                          <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        @endauth
        <div class="{{ $class }}">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-hands-helping"></i>
                    </div>
                    <div class="mr-5">
                        <h5>Parrainages</h5>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Plus de détails...</span>
                    <span class="float-right">
                      <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
@endsection
