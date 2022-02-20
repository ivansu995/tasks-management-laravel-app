@extends('home')
@section('title', $task->title)
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="naslov_zadatka">
                <h2 class="naziv_zadatka"> {{ $task->title }} </h2>
            </div>
            <div class="ostatak_zadatka">
                <p class="prioritet">
                    Prioritet zadatka: {{ $task->priority }}
                </p><hr>
                <p>Opis zadatka: {{ $task->description }} </p><hr>
                <p>Prilog:
{{--                    <?php foreach ($prilozi as $p): ?>--}}
{{--                    <?php if ($_GET['id'] === $p->zadatak_id): ?>--}}
{{--                    <a href="../<?= $p->naziv_priloga ?>">--}}
{{--                        <?= $p->naziv_fajla . " " ?>--}}
{{--                    </a>--}}
{{--                    <?php endif ?>--}}
{{--                    <?php endforeach ?>--}}
                </p>
            </div>
        </div>
{{--        <div class="col-3 jusify-content-center">--}}
{{--            <div class="grafikon_zadatak">--}}
{{--                <div class="chart" data-percent="<?= $trenutni_procenat ?>">--}}
{{--                    <div class="percent"><?= $trenutni_procenat ?></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <form action="../logika/zavrsiZadatak.php"--}}
{{--                  method="post"--}}
{{--                  class="zavrsen_zadatak">--}}
{{--                <?php if ($da_li_je_izvrsen->izvrsio === "0"): ?>--}}
{{--                <input type="submit"--}}
{{--                       id="zavrsen_zadatak_dugme"--}}
{{--                       value="Zavrsi zadatak"--}}
{{--                       class="btnZavrsi"--}}
{{--                >--}}
{{--                <?php else: ?>--}}
{{--                <div class="zavrsen_zadatak form-group">--}}
{{--                    <input type="submit"--}}
{{--                           id="zavrsen_zadatak_dugme"--}}
{{--                           disabled="true"--}}
{{--                           value="Zavrsi zadatak"--}}
{{--                           class="btnZavrsi">--}}
{{--                    <div class="alert alert-success">--}}
{{--                        Uspesno ste zavrsili deo zadatka!--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <?php endif ?>--}}
{{--                <input type="hidden"--}}
{{--                       name="zadatak_id"--}}
{{--                       value="<?= $zadatak->id ?>">--}}
{{--                <input type="hidden" name="korisnik_id"--}}
{{--                       value="<?= $_SESSION['korisnik_id'] ?>">--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
    <hr>
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-8">--}}
{{--            <h3>Komentari</h3>--}}
{{--            <div>--}}
{{--                <form action="../logika/snimiKomentarKorisnik.php"--}}
{{--                      id="komentar_forma" method="post">--}}
{{--                    <div class="form-group">--}}
{{--                                <textarea name="opis_komentara"--}}
{{--                                          id="opis_komentara"--}}
{{--                                          placeholder="Unesite komentar"--}}
{{--                                          class="form-control"--}}
{{--                                          rows="3">--}}
{{--                                </textarea>--}}
{{--                    </div>--}}
{{--                    <input type="hidden"--}}
{{--                           name="zadatak_id"--}}
{{--                           id="zadatak_id"--}}
{{--                           value="<?= $zadatak->id ?>">--}}
{{--                    <input type="hidden"--}}
{{--                           name="korisnik_id"--}}
{{--                           id="korisnik_id"--}}
{{--                           value="<?= $_SESSION['korisnik_id'] ?>">--}}
{{--                    <input type="submit"--}}
{{--                           id="postavi_komentar"--}}
{{--                           value="Posalji komentar"--}}
{{--                           class="btnKomentar">--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div><hr>--}}
{{--    </div>--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-8">--}}
{{--            <?php foreach ($komentari as $komentar): ?>--}}
{{--            <div class="komentar">--}}
{{--                <div class="naslov_komentara">--}}
{{--                    <h5 class="ime_korisnika">--}}
{{--                        <?= $komentar->getKorisnik()->ime_prezime .--}}
{{--                        " - " .--}}
{{--                        date('d.m.Y. H:i',--}}
{{--                            strtotime($komentar->kreiran)) ?>--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--                <div class="ostatak_komentara">--}}
{{--                    <p>--}}
{{--                        <?= $komentar->opis_komentara ?>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <?php endforeach ?>--}}
{{--        </div>--}}
    </div>
</div>

<section>
    <div class="row justify-content-center">
        <div class="col-8">
            <h3>Comments</h3>
            <div>
                <form action="{{ route('comments.store') }}"
                      id="komentar_forma" method="post">
                    <div class="form-group">
                        <textarea name="comment"
                                  id="comment"
                                  placeholder="Enter comment here..."
                                  class="form-control"
                                  rows="3"></textarea>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden"
                           name="user_id"
                           value="{{ auth()->user()->id }}"
                           >
                    <input type="hidden"
                           name="task_id"
                           value="{{ $task->id }}"
                            >
                    <input type="submit"
                           id="postavi_komentar"
                           value="Posalji komentar"
                           class="btnKomentar">
                </form>
            </div>
        </div><hr>
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            @foreach ($task->comments as $comment)
                <div class="komentar">
                    <div class="naslov_komentara">
                        <h5 class="ime_korisnika">
                            {{ auth()->user()->name }}
                            -
                            {{ $comment->created_at->format('d.m.Y H:i')  }}
                        </h5>
                        <form action="../logika/obrisiKomentarKorisnik.php"
                              method="post"
                              class="obrisi_komentar">
                            <input type="hidden" name="komentar_id" >
                            <input type="submit" class="obrisi"value="Obrisi">
                        </form>
                    </div>
                    <div class="ostatak_komentara">
                        <p>
                            {{ $comment->comment }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
