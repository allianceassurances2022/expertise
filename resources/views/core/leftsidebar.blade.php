{{-- ========== Left Sidebar Start ========== --}}
<div class="left side-menu" id="side-menu" value="hello">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <div class="left-side-logo d-block d-lg-none">
        <div class="text-center">

            <a href="{{ route('dashboard') }}" class="logo"><img
                    src="{{ asset('assets/images/logo-dark.png') }}" height="20" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span> Dashboard</span>
                    </a>
                </li>
                @if (auth()->user()->hasAnyPermission(['index user', 'show user', 'add user']))
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account"></i> <span>
                                Utilisateurs</span> <span class="menu-arrow float-right"><i
                                    class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            @if (auth()->user()->hasAnyPermission(['index user', 'show user']))
                                <li><a href="{{ route('utilisateur.index') }}"><i class="ion-android-social"></i>
                                        Liste
                                        des Utilisateurs</a></li>
                            @endif
                            @if (auth()->user()->hasAnyPermission(['add user']))
                                <li><a href="{{ route('utilisateur.ajouter') }}"><i class="ion-person-add"></i>
                                        Ajouter
                                        Utilisateur</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->hasAnyPermission(['add role', 'show role', 'edit role', 'show permission']))
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ion-gear-b"></i> <span>
                                Parametrage</span> <span class="menu-arrow float-right"><i
                                    class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            @if (auth()->user()->hasAnyPermission(['show role']))
                                <li><a href="{{ route('roles') }}"><i class="typcn typcn-group"></i> Role</a></li>
                            @endif
                            @if (auth()->user()->hasAnyPermission(['add role']))
                                <li><a href="{{ route('role.create') }}"><i class="ion-plus-circled"></i> Ajouter un
                                        Role</a></li>
                            @endif
                            @if (auth()->user()->hasAnyPermission(['show permission']))
                                <li><a href="{{ route('permissions') }}"><i class="typcn typcn-flow-children"></i>
                                        Permissions</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->hasAnyPermission(['index agence', 'show agence', 'add agence']))
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-home-variant"></i> <span>
                                Agences</span> <span class="menu-arrow float-right"><i
                                    class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            @if (auth()->user()->hasAnyPermission(['index agence']))
                                <li><a href="{{ route('agence.index') }}"><i class="mdi mdi-view-list"></i> Liste Des
                                        Agences</a></li>
                            @endif
                            @if (auth()->user()->hasAnyPermission(['add agence']))
                                <li><a href="{{ route('agence.ajouter') }}"><i class="ion-plus-circled"></i> Ajouter
                                        Une
                                        Agence</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (auth()->user()->hasAnyPermission(['index expert', 'show expert', 'add expert']))
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-usd"></i> <span>
                                Experts</span> <span class="menu-arrow float-right"><i
                                    class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            @if (auth()->user()->hasAnyPermission(['index expert']))
                                <li><a href="{{ route('expert.index') }}"><i class="mdi mdi-view-list"></i> Liste Des
                                        Experts</a></li>
                            @endif
                        </ul>
                    </li>

                @endif

                {{-- @if (auth()->user()->hasAnyPermission(['add ods', 'edit ods', 'disable ods', 'relance ods']))
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-folder"></i> <span> ODS</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                         @if (auth()->user()->hasAnyPermission(['add ods']))
                        <li><a href="{{route('ods.creer')}}"><i class="mdi mdi-plus"></i> Creer Un ODS</a></li>
                         @endif
                         @if (auth()->user()->hasAnyPermission(['edit ods']))
                        <li><a href="{{route('ods.modifier')}}"><i class="ion ion-edit"></i> modifier Un ODS</a></li>
                         @endif
                         @if (auth()->user()->hasAnyPermission(['disable ods']))
                        <li><a href="{{route('ods.annuler_supprimer')}}"><i class="mdi mdi-delete"></i> Annuler/Supprimer</a></li>
                         @endif
                         @if (auth()->user()->hasAnyPermission(['relance ods']))
                        <li><a href="{{route('ods.relance')}}"><i class="mdi mdi-rotate-right"></i> Relancer Un ODS</a></li>
                         @endif
                    </ul>
                </li>
 @endif --}}

                @if (auth()->user()->hasAnyPermission(['index rdv']))
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ion ion-calendar"></i> <span>
                                RDV</span> <span class="menu-arrow float-right"><i
                                    class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            @if (auth()->user()->hasAnyPermission(['index rdv']))
                                <li><a href="{{ route('rdv.creer') }}"><i class="mdi mdi-plus"></i> Creer/Modifier
                                        Un
                                        RDV</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (auth()->user()->hasAnyPermission(['index piece', 'add piece', 'add category']))
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ion ion-model-s"></i> <span>
                                Pieces</span> <span class="menu-arrow float-right"><i
                                    class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            @if (auth()->user()->hasAnyPermission(['index piece']))
                                <li><a href="{{ route('pieces.index') }}"><i class="fa fa-list-ul"></i>
                                        Inventaire</a>
                                </li>
                                <li><a href="{{ route('autres.piece') }}"><i class="fa fa-list-ul"></i> Autres
                                        pièces</a></li>
                            @endif
                            @if (auth()->user()->hasAnyPermission(['add piece']))
                                <li><a href="{{ route('pieces.article', '0') }}"><i
                                            class="mdi mdi-plus-circle-outline"></i> Ajouter Article</a></li>
                            @endif
                            @if (auth()->user()->hasAnyPermission(['add category']))
                                <li><a href="{{ route('pieces.categorie') }}"><i class="mdi mdi-playlist-plus"></i>
                                        Ajouter Catégorie</a></li>
                            @endif
                        </ul>

                @endif

                @if (auth()->user()->hasAnyPermission(['index dossier']))
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-folder"></i> <span>
                                Expertise</span> <span class="menu-arrow float-right"><i
                                    class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            @if (auth()->user()->hasAnyPermission(['index dossier']))
                                <li><a href="{{ route('expertise.liste') }}"><i class="mdi mdi-plus"></i> Liste</a>
                                </li>
                            @endif

                            <li><a href="{{ route('report.raporthonoraire') }}"><i class="mdi mdi-view-list"></i>
                                    Raport Honoraire</a></li>
                            <li><a href="{{ route('detail_ods') }}"><i class="mdi mdi-view-list"></i> Nouveau ODS</a>
                            </li>
                            <li><a href="{{ route('detail', '1') }}"><i class="mdi mdi-view-list"></i> En cours
                                    d'expertise</a></li>
                            <li><a href="{{ route('detail', '2') }}"><i class="mdi mdi-view-list"></i> Expertise
                                    pre-validée</a></li>
                            <li><a href="{{ route('detail', '3') }}"><i class="mdi mdi-view-list"></i> Expertise
                                    validée</a></li>

                        </ul>
                    </li>
                @endif
            </ul>
        </div>

        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End
