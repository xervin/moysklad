@extends('layouts.app')

@section('head')
@endsection

@section('header')
    <header class="header container">
        <div class="header__inner">
            <div class="user-info">
                <div class="user-info__login">{{ \App\Services\User::login() }}</div>
                <div class="buttons">
                    <a class="button" href="{{ route('logout') }}">Выйти</a>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="container">
        <table class="ui-table">
            <thead>
            <tr>
                <th><h3>№</h3></th>
                <th><h3>Время</h3></th>
                <th><h3>Контрагент</h3></th>
                <th><h3>Организация</h3></th>
                <th><h3>Сумма</h3></th>
                <th><h3>Валюта</h3></th>
                <th><h3>Статус</h3></th>
                <th><h3>Когда изменен</h3></th>
            </tr>
            </thead>

            <tbody>
            @foreach($rows as $row)
                <tr>
                    <td>
                        <a class="" target="_blank"
                           href="{{ $row['id']->value }}">{{ $row['id']->name }}</a>
                    </td>
                    <td>
                        {{ $row['moment']->name }}
                    </td>
                    <td>
                        <a href="javascript:void(0);">
                            <a href="javascript:void(0);" class="js-popup-open"
                               data-name="{{ md5($row['agent']->name) }}">{{ $row['agent']->name }}
                            </a>
                            <div class="popup b-hide js-popup-window" data-name="{{ md5($row['agent']->name) }}">
                                <div class="popup__overlay js-popup-close"></div>
                                <dialog open="" class="popup__body">
                                    <div class="popup__title">{{ $row['agent']->value['name'] }}</div>
                                    <div class="popup__content">
                                        <div class="popup__row">
                                            <div class="popup__col">
                                                <p class="caption">Статус</p>
                                            </div>
                                            <div class="popup__col">
                                                <div class="">
                                                    <select class="sel-popup ui-select" name="ui-select">
                                                        @foreach($states as $state)
                                                            <option
                                                                value="{{ $state['id'] }}" {{ $row['state']->name == $state['name'] ? 'selected' : null }}>
                                                                {{ $state['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="popup__row">
                                            <div class="popup__col">
                                                <p class="caption">Группы</p>
                                            </div>
                                            <div class="popup__col">
                                                <input class="ui-input" type="text" name="ui-input" placeholder=""
                                                       value="{{ $row['group']->name }}">
                                            </div>
                                        </div>

                                        <div class="popup__row">
                                            <div class="popup__col">
                                                <p class="caption">Телефон</p>
                                            </div>
                                            <div class="popup__col">
                                                <input class="ui-input" type="text" name="ui-input" placeholder=""
                                                       value="{{ $row['group']->name }}">
                                            </div>
                                        </div>

                                        <div class="popup__row">
                                            <div class="popup__col">
                                                <p class="caption">Факс</p>
                                            </div>
                                            <div class="popup__col">
                                                <input class="ui-input" type="text" name="ui-input" placeholder=""
                                                       value="{{ $row['agent']->value['fax'] ?? null }}">
                                            </div>
                                        </div>

                                        <div class="popup__row">
                                            <div class="popup__col">
                                                <p class="caption">Электронный адрес</p>
                                            </div>
                                            <div class="popup__col">
                                                <input class="ui-input" type="text" name="ui-input" placeholder=""
                                                       value="{{ $row['agent']->value['email'] ?? null }}">
                                            </div>
                                        </div>

                                        <div class="popup__row">
                                            <div class="popup__col">
                                                <p class="caption">Телефон</p>
                                            </div>
                                            <div class="popup__col">
                                                <input class="ui-input" type="text" name="ui-input" placeholder=""
                                                       value="{{ $row['agent']->value['phone'] ?? null }}">
                                            </div>
                                        </div>

                                        <div class="popup__row">
                                            <div class="popup__col">
                                                <p class="caption">Фактический адрес</p>
                                            </div>
                                            <div class="popup__col">
                                                <input class="ui-input" type="text" name="ui-input" placeholder=""
                                                       value="{{ $row['agent']->value['actualAddress'] ?? null }}">
                                            </div>
                                        </div>

                                        <div class="popup__row">
                                            <div class="popup__col">
                                                <p class="caption">Комментарий к адресу</p>
                                            </div>
                                            <div class="popup__col">
                                                <textarea rows="5" class="ui-input ui-input__textarea" type="text" name="ui-input" placeholder="">
                                                    {{ $row['agent']->value['actualAddressFull']['comment'] ?? null }}
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="popup__row">
                                            <div class="popup__col">
                                                <p class="caption">Комментарий</p>
                                            </div>
                                            <div class="popup__col">
                                                 <textarea rows="5" class="ui-input ui-input__textarea" type="text" name="ui-input" placeholder="">
                                                    {{ $row['agent']->value['description'] ?? null }}
                                                </textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="buttons">
                                        <button class="button js-popup-close">Закрыть</button>
                                    </div>
                                </dialog>
                            </div>
                        </a>
                    </td>
                    <td>
                        {{ $row['organization']->name }}
                    </td>
                    <td>
                        {{ $row['sum']->name }}
                    </td>
                    <td>
                        {{ $row['currency']->name }}
                    </td>
                    <td>
                        <select class="sel ui-select-custom" name="ui-select-custom" data-uid="{{ $row['uid']->name }}">
                            @foreach($states as $state)
                                <option
                                    value="{{ $state['id'] }}"
                                    {{ $row['state']->name == $state['name'] ? 'selected' : null }}
                                    data-id="{{ $state['id'] }}"
                                    data-state="{{ $state['name'] }}">
                                    {{ $state['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        {{ $row['updated']->name }}
                    </td>
                </tr>
            @endforeach
            </tbody>

            <tfoot>
            <tr>
                <td colspan="8">
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('footer')
    <footer>

    </footer>
@endsection
