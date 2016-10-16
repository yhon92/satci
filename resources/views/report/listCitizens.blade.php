@extends('layouts.pdf')

@section('title', $title)

@section('content') 
  <table class="Table">
    <thead>
      <tr>
        <th style="width: 30px; height: 10px;">Nº</th>
        <th style="width: 80px; height: 10px;">Cédula</th>
        <th style="width: 460px; height: 10px;">Nombre</th>
        <th style="width: 460px; height: 10px;">Dirección</th>
        <th style="width: 100px; height: 10px;">Teléfono</th>
        <th style="width: 175px; height: 10px;">Parroquia</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($citizens as $index => $citizen)
      <tr>
        <td class="center-text">{!! $index+1 !!}</td>
        <td class="center-text">{!! $citizen->identification !!}</td>
        <td>{!! $citizen->full_name !!}</td>
        <td>{!! $citizen->address !!}</td>
        <td class="center-text">{!! $citizen->prefix_phone !!}-{!! $citizen->number_phone !!}</td>
        <td class="center-text">{!! $citizen->parish->name !!}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
