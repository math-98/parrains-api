@extends('shared.front')

@section('title', "Importer une liste d'étudiants parrains")

@section("content")
    <div class="row">
        <div class="col-lg-6">
            <section class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('parrains.import') }}" id="fileFormatForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4">
                            <h3>Options du fichier</h3>
                            <div class="row">
                                <div class="col-6">
                                    <label for="separatorSelect">Séparateur</label>
                                    <select id="separatorSelect" class="custom-select" name="separator" required>
                                        <option selected>Sélectionnez une option</option>
                                        <option value="comma">,</option>
                                        <option value="semicolon">;</option>
                                        <option value="colon">:</option>
                                        <option value="tab">Tab</option>
                                        <option value="space">Espace</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="delimiterSelect">Délimiteur</label>
                                    <select id="delimiterSelect" class="custom-select" name="delimiter" required>
                                        <option selected>Sélectionnez une option</option>
                                        <option value="double">"</option>
                                        <option value="simple">'</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <h3>Uploader le fichier</h3>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fileInput" name="file">
                                <label class="custom-file-label" for="fileInput">Choisir fichier</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
                    </form>
                </div>
            </section>
        </div>
        <div class="col-lg-6">
            <section class="card">
                <div class="card-body" id="descriptions">
                    <h3>CSV</h3>
                    Le fichier ne doit pas comporter de ligne d'en-tête et doit se composer d'au moins deux colonnes ordonnées ainsi :
                    <ul class="list">
                        <li>Nom de famille</li>
                        <li>Prénom</li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('js')
    <script>
        bsCustomFileInput.init();
    </script>
@endsection
