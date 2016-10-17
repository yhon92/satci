@extends('layouts.pdf')

@section('title', $title)

@section('content') 
  <table class="Table">
    <thead>
      <tr>
        <th style="width: 30px; height: 10px;">Nº</th>
        <th style="width: 80px; height: 10px;">Cédula</th>
        <th style="width: 310px; height: 10px;">Nombre</th>
        <th style="width: 100px; height: 10px;">Teléfono</th>
        <th style="width: 350px; height: 10px;">Correo</th>
        <th style="width: 345px; height: 10px;">Área</th>
        <th style="width: 90px; height: 10px;">Resolusión</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($directors as $director)
      @if ($director->areas)
        @foreach ($director->areas as $area)
          <tr>
            <td class="center-text">{!! $index++ !!}</td>
            <td class="center-text">{!! $director->identification !!}</td>
            <td>{!! $director->full_name !!}</td>
            <td class="center-text">{!! $director->prefix_phone !!}-{!! $director->number_phone !!}</td>
            <td>{!! $director->email !!}</td>
              <td  class="center-text">{!! $area->name !!}</td>
            <td  class="center-text">{!! $director->resolution !!}</td>
          </tr>
        @endforeach
      @endif
    @endforeach
    </tbody>
  </table>
@endsection
