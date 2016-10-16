@extends('layouts.pdf')

@section('title', $title)

@section('content')
  <table class="Table">
    <thead>
      <tr>
        <!-- <th style="width: 30px; height: 10px;">Nº</th> -->
        <th style="width: 30px; height: 10px;">Nº</th>
        <!-- <th style="width: 70px; height: 10px;">Rif</th> -->
        <th style="width: 100px; height: 10px;">Rif</th>
        <!-- <th style="width: 500px; height: 10px;">Nombre</th> -->
        <th style="width: 450px; height: 10px;">Nombre</th>
        <!-- <th style="width: 500px; height: 10px;">Dirección</th> -->
        <th style="width: 450px; height: 10px;">Dirección</th>
        <!-- <th style="width: 70px; height: 10px;">Teléfono</th> -->
        <th style="width: 100px; height: 10px;">Teléfono</th>
        <!-- <th style="width: 110px; height: 10px;">Parroquia</th> -->
        <th style="width: 175px; height: 10px;">Parroquia</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($institutions as $index => $institution)
      <tr>
        <td class="center-text">{!! $index+1 !!}</td>
        <td class="center-text">{!! $institution->identification !!}</td>
        <td>{!! $institution->full_name !!}</td>
        <td>{!! $institution->address !!}</td>
        <td class="center-text">{!! $institution->prefix_phone !!}-{!! $institution->number_phone !!}</td>
        <td class="center-text">{!! $institution->parish->name !!}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
