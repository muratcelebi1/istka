@php $count = 0; @endphp
                                        @foreach ($userEvents as $ue)
                                            @if ($ue->guid == $event->event_id)
                                                @php
                                                    $count++; // Kullanıcıyı sayıyoruz
                                                @endphp

                                                @if ($count <= 3)
                                                    @if (!is_null($ue->image))
                                                        <!-- Kullanıcı resmi -->
                                                        <img id="profileImage"
                                                            src="{{ asset('/image/' . $ue->image_name) }}"
                                                            alt="Profil Foto" class="rounded-circle"
                                                            style="width: 30px; height: 30px;">
                                                    @else
                                                        <!-- Varsayılan profil resmi -->
                                                        <img id="profileImage" src="{{ asset('/image/d3.png') }}"
                                                            alt="Profil Foto" class="rounded-circle"
                                                            style="width: 30px; height: 30px;">
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                        @if ($count >= 4)
                                            <!-- Eğer kullanıcı sayısı 3'ü aşarsa '+' sembolünü göster -->
                                            <span class="plus-icon text-muted ms-2">+{{ $count - 3 }}</span>
                                        @endif
