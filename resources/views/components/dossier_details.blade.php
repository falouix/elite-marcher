<div class="pl-0">
    <div class="main-profile-overview">

        <div class=" justify-content-between ">

            <table class="table">
                <tbody>
                    <tr>
                        <td style="padding: 0.3rem; border-top:white;">
                            <h6> السنة المالية </h6>
                        </td>
                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                            {{ $dossier->annee_gestion }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0.3rem; border-top:white;">
                            <h6>
                                مشروع عدد :
                            </h6>
                        </td>
                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                            {{ $dossier->code_projet }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0.3rem; border-top:white;">
                            <h6>
                                الإطار :
                            </h6>
                        </td>
                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                            {{ $dossier->type_demande }}
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0.3rem; border-top:white;">
                            <h6>
                                جهة التمويل :
                            </h6>
                        </td>
                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                            {{ $dossier->organisme_financier }}
                        </td>
                    </tr>


                    <tr>
                        <td style="padding: 0.3rem; border-top:white;">
                            <h6>
                                طريقة التمويل :
                            </h6>
                        </td>
                        <td class="text-right" style="padding: 0.3rem; border-top:white;">

                            @switch($dossier->source_finance)
                                @case(1)
                                ميزانية الدولة
                                    @break
                                    @case(2)
                                    قرض
                                    @break
                                @default
                                هبة
                            @endswitch
                        </td>
                    </tr>


                    <tr>
                        <td style="padding: 0.3rem; border-top:white;">
                            <h6>
                                طبيعة الأسعار :
                            </h6>
                        </td>
                        <td class="text-right" style="padding: 0.3rem; border-top:white;">
                            @if($dossier->nature_finance == "FIXE")
                            ثابتة
                            @else
                            قابلة للتغيير
                            @endif
                        </td>
                    </tr>

                </tbody>
            </table>
            <hr class="mg-y-20">
            <h6>الموضوع </h6>
            <div class="main-profile-social-list">

                <div class="media">
                    <p style="line-height: 27px">
                        {{ $dossier->objet_dossier }}
                    </p>
                </div>
            </div>

        </div>

        <hr class="mg-y-20">
        <h6>المتعهد</h6>
        <hr class="mg-y-20">
        <div class=" justify-content-between ">

            <table class="table">

                <tr>
                    <td style="padding: 0.3rem; border-top:white;">
                        <h6>{{ __('labels.tbl_client_name') }} </h6>
                    </td>
                    <td class="text-right" style="padding: 0.3rem; border-top:white;">

                    </td>
                </tr>
                <tr>
                    <td style="padding: 0.3rem; border-top:white;">
                        <h6>
                            {{ __('labels.tbl_client_phone') }} :

                        </h6>
                    </td>
                    <td class="text-right" style="padding: 0.3rem; border-top:white;">

                    </td>
                </tr>
                <tr>
                    <td style="padding: 0.3rem; border-top:white;">
                        <h6>
                            {{ __('labels.tbl_email_abr') }} :
                        </h6>
                    </td>
                    <td class="text-right" style="padding: 0.3rem; border-top:white;">

                    </td>
                </tr>

                <tr>
                    <td style="padding: 0.3rem; border-top:white;">
                        <h6>
                            {{ __('labels.tbl_client_adress') }} :
                        </h6>
                    </td>
                    <td class="text-right" style="padding: 0.3rem; border-top:white;">

                    </td>
                </tr>

            </table>
        </div>




    </div><!-- main-profile-overview -->
</div>
