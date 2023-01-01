<html>
    <head>
        <style>
            @page { margin: 100px 50px; }
            header {
                position: fixed;
                top: -60px;
                left: 0;
                right: 0;
                height: 50px;
            }
            footer {
                position: fixed;
                bottom: -60px;
                left: 0;
                right: 0;
                height: 50px;
            }
            .page-break { page-break-after: always; }
            table { width: 100% }
            .table-bordered { border-collapse: collapse }
            .table-bordered tr td,
            .table-bordered tr th {
                border: 1px solid black;
                padding: 3px;
            }
        </style>
    </head>
    <body>
        <header>
            <table>
                <tr>
                    <td style="width: 50%">
                        Parrainages IUT
                    </td>
                    <td style="width: 50%; text-align: right">
                        {{ Carbon\Carbon::now()->format('d/m/Y H:i') }}
                    </td>
                </tr>
            </table>
        </header>
        <main>
            <h1 style="text-align: center">Parrainages IUT</h1>

            <h2>Parrainages</h2>
            <table class="table-bordered">
                <tr>
                    <th style="width: 50%">Filleul</th>
                    <th style="width: 50%">Parrain</th>
                </tr>
                @forelse($parrainages as $parrainage)
                    <tr>
                        <td>{{ $parrainage->lastname }} {{ $parrainage->firstname }}</td>
                        <td>{{ $parrainage->parrain->lastname }} {{ $parrainage->parrain->firstname }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" style="font-style: italic; text-align: center">
                            La liste est vide
                        </td>
                    </tr>
                @endforelse
            </table>

            @if (count($absents))
                <div class="page-break"></div>

                <h2>Absents</h2>
                <table class="table-bordered">
                    <tr>
                        <th style="width: 50%">Nom</th>
                        <th style="width: 50%">Prénom</th>
                    </tr>
                    @foreach($absents as $absent)
                        <tr>
                            <td>{{ $absent->lastname }}</td>
                            <td>{{ $absent->firstname }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </main>
        <script type="text/php">
            if (isset($pdf)) {
                $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width) / 2;
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    </body>
</html>
