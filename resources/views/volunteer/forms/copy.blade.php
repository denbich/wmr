@if ($form->expiration <= date('Y-m-d H:i:s'))
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="alert alert-danger text-center" role="alert">
                            <span class="alert-icon"><i class="far fa-frown"></i></span>
                            <span class="alert-text"><strong>Alert!</strong> Zapisy zostały zamknięte!</span>
                        </div>
                    </div>
                </div>
                @else
                    @if ($signed_volunteer == null)
                        <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">Nazwa stanowiska</th>
                                    <th scope="col">Ilość punktów</th>
                                    <th scope="col">Zapotrzebowanie</th>
                                    <th scope="col">Ilość zapisanych</th>
                                    <th>Opcje</th>
                                </tr>
                            </thead>
                            <tbody class="list text-center">
                                @foreach ($form_positions as $position)
                                <tr>
                                    <td>{{ $position->translate_form_position->title }}</td>
                                    <td>{{ $position->points }}</td>
                                    <td>{{ $position->max_volunteer }}</td>
                                    <td>{{ $position->signed_form_count }}</td>
                                    <td>
                                        <form action="{{ route('v.form.show', [$form->id]) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="position" value="{{ $position->id }}">
                                            <button class="btn btn-primary">Zapisz się</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        @switch($signed_volunteer->condition)
                            @case(0)
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="text-center">
                                        <span class="h2"><strong>Zapisałeś się na stanowisko:</strong> {{ $signed_volunteer->trans_position->title }}</span>
                                        <p><b>Otrzymasz tyle punktów*: </b>{{ $signed_volunteer->post_form->points }}</p>
                                        <p>Czekaj na wiadomość o przydzieleniu stanowiska (dostaniesz maila lub sprawdzaj co jakiś czas).</p>
                                        <p class="text-sm">* - Jeśli będziesz uczestniczyć w tej akcji.</p>
                                    </div>
                                    <form action="{{ route('v.form.unsign', [$form->id]) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="position" value="{{ $signed_volunteer->id }}">
                                        <button type="submit" class="btn btn-danger w-100">Wypisz się</button>
                                    </form>
                                </div>
                            </div>
                                @break

                            @case(1)
                                <div class="text-center">
                                    <h1 class="text-success">Stanowiska zostały przydzielone przez koordynatora</h1>
                                    <span class="h3">
                                        @if (Auth::user()->gender == 'm')
                                            <b>Zostałeś przydzielony na stanowisko:</b>
                                        @elseif (Auth::user()->gender == 'f')
                                            <b>Zostałaś przydzielony na stanowisko:</b>
                                        @endif
                                        {{ $signed_volunteer->trans_position->title }}
                                    </span>
                                    <p><b>Otrzymasz tyle punktów*: </b>{{ $signed_volunteer->post_form->points }}</p>
                                    <p class="text-sm">* - Jeśli będziesz uczestniczyć w tej akcji.</p>
                                </div>
                                @break

                            @case(2)
                                <div class="text-center">
                                    @if (Auth::user()->gender == 'm')
                                        <h2>Dziękujemy za twoją obecność!</h2>
                                        <h3 class="text-success">Otrzymałeś punkty za tą akcję!</h3>
                                    @elseif (Auth::user()->gender == 'f')
                                        <h2>Dziękujemy za twoją obecność!</h2>
                                        <h3 class="text-success">Otrzymałaś punkty za tą akcję!</h3>
                                    @endif
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <form action="{{ route('v.form.certificate') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="form" value="{{ $form->id }}">
                                            <button type="submit" class="btn btn-primary w-100">Generuj zaświadczenie</button>
                                        </form>
                                    </div>
                                </div>
                                @break

                            @case(3)
                                <div class="text-center">
                                    @if (Auth::user()->gender == 'm')
                                        <h2 class="text-danger">Nie byłeś obecny, więc nie otrzymasz punktów :(</h2>
                                        <p>Jeśli jednak uczesticzyłeś, to zgłoś ten fakt koordynatorowi bądź administratorowi!</p>
                                    @elseif (Auth::user()->gender == 'f')
                                        <h2 class="text-danger">Nie byłaś obecna, więc nie otrzymasz punktów :(</h2>
                                        <p>Jeśli jednak uczesticzyłaś, to zgłoś ten fakt koordynatorowi bądź administratorowi!</p>
                                    @endif
                                </div>
                                @break
                        @endswitch
                    @endif

                @endif
